<?php 
namespace App\Controllers;
use App\Models\DashboardModel;
use CodeIgniter\Pager\PagerInterface;

class Dashboard extends BaseController{
    public $table;
    public $model;
    public $session;
    public $validation;
public function __construct()
    {
        $this->validation = \Config\Services::validation();
        helper(['form','filesystem','url','security','text']);
        $this->session = session();
        $this->model = new DashboardModel();
        
    }
public function __destruct(){
    
}

public function index()
    {
        $getUserId = $this->session->get('id');
        if(!(session()->has('isLoggedIn')))
        {
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'products' => $this->model->where(['user' => $getUserId])->paginate(20),
            'pager' => $this->model->pager,
        ];
        return view('templates/db_header')
        .view('dashboard',$data)
        .view('templates/db_footer');
    }
public function delete($id)
    {
        if($this->model->delete($id))
        {
            $this->session->setFlashdata('success','Deleted Succesfully');
            return redirect()->to(previous_url());
        }else{
            return redirect()->to(previous_url());
        }
    }
public function logout()
    {  
        $this->session->destroy();
        return redirect()->to(base_url('/login'));
    }
public function editPage($id)

    {
        if(!(session()->has('isLoggedIn')))
        {
            return redirect()->to(base_url('/login'));
        }
        $data['product'] = $this->model->find($id);
        return view('templates/db_header')
         . view('edit', $data)
          . view('templates/db_footer');

    }
public function update($id)
    {
        $product = $this->model->find($id);
        $vali['validation'] = null;
        $rules = [
            'editName' => 'required|min_length[3]|max_length[35]',
            'editFile'=>'max_size[editFile,2048]',
            'editDescription' => 'required|min_length[3]|max_length[100]',
            'editPrice' => 'required|numeric'
        ];

    if ($this->validate($rules)) {
        
        $file = $this->request->getFile('editFile');
        $filename = $product['prod_file'];

        if ($file && $file->isValid()) {
            $filename = $file->getName();
            $file->move(WRITEPATH.'uploads', $filename);
        }

        $data= [
            'prod_name' => $this->request->getVar('editName'),
            'prod_file' => $filename,
            'prod_desc' => $this->request->getVar('editDescription'),
            'prod_price' => $this->request->getVar('editPrice')
        ];

        $this->model->update($id, $data);
        $this->session->setFlashdata('success', 'Successfully Edited Product!');
        return redirect()->to(base_url('/Dashboard'));
    } else {
        $this->session->setFlashdata('error', 'Error updating');
        $vali['validation'] = $this->validator;
        return redirect()->back()->withInput();
        }
    
    }
public function search()
    {
        $perPage = $this->request->getPost('show_entries');
        $term = $this->request->getGet('searchTable');
        
        $data = [
            'products' => $this->model->like (['prod_name' =>$term])
                    ->orLike(['prod_desc' =>$term])
                    ->orLike(['prod_price' =>$term])
                    ->orLike(['prod_file' =>$term])
                    ->paginate($perPage),
            'pager' => $this->model->pager,
        ];
        if(empty($term))
        {
            session()->setFlashdata('search', "Search bar Empty, Returning to Dashboard...");
            return redirect()->to(base_url('/dashboard'));
        }else{
            session()->setFlashdata('success', 'Data Indexes Successfully');
            return view('templates/db_header')
                    .view('dashboard',$data)
                    .view('templates/db_footer');
        }
        
    }
public function download($filename)
    {
         $path = WRITEPATH . "uploads/" .$filename;

         return $this->response->download($path,null);
    }
public function import()
    {
        $userData = $this->session->get('id');
        $file = $this->request->getFile('importFile');
    
        if (!$file || !$file->isValid()) {
            session()->setFlashdata('error', 'Invalid file uploaded.');
            return redirect()->back();
        }
        if ($file->getExtension() !== 'csv') {
            session()->setFlashdata('error', 'Invalid file type. Only CSV files are allowed.');
            return redirect()->back();
        }
        $handle = fopen($file->getTempName(), 'r');
    
        fgetcsv($handle);
    
        
        $this->validation->setRules([
            'prod_name' => 'required|min_length[3]|max_length[35]',
            'prod_desc' => 'required|min_length[3]|max_length[100]',
            'prod_price' => 'required|numeric'
        ]);
        
        $this->model->transStart();
        $products = [];
    
        while (($data = fgetcsv($handle)) !== false) {
            list($name, $image, $description, $price) = $data;
            $imageFileName = null;
    
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                $imageFile = file_get_contents($image);
    
                if ($imageFile !== false) {
                    $imageFileExtension = pathinfo(parse_url($image, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $imageFileName = random_string('alnum', 8) . '.' . $imageFileExtension;
                    write_file(WRITEPATH . 'uploads/' . $imageFileName, $imageFile);
                }
            } elseif (is_file($image)) {
                $imageFileExtension = pathinfo($image, PATHINFO_EXTENSION);
                $imageFileName = random_string('alnum', 8) . '.' . $imageFileExtension;
                copy($image, WRITEPATH . 'uploads/' . $imageFileName);
            }
    
            $productData = [
                'prod_name' => $name,
                'prod_file' => $imageFileName,
                'prod_desc' => $description,
                'prod_price' => (float) $price,
                'user' => $userData
            ];
    
            if (!$this->validation->run($productData)) {
                session()->setFlashdata('error', $this->validation->listErrors());
                fclose($handle);
                $this->model->transComplete(); 
                return redirect()->back();
            }
    
            $products[] = $productData;
    
            
            if (count($products) >= 2000) {
                $this->model->insertBatch($products);
                $products = [];
            }
        }
    
        if (!empty($products)) {
            $this->model->insertBatch($products);
        }
    
        session()->setFlashdata('success', 'Data imported successfully.');
        fclose($handle);
        
        $this->model->transComplete(); 
    
        return redirect()->back();
    }
    

    
public function clear()
    {
    $getUserId = $this->session->get('id');
    $this->model->where(['user' => $getUserId])->delete();
    delete_files('C:\xampp\htdocs\ci4\writable\uploads');
    session()->setFlashdata('success', 'Data cleared successfully.');
    return redirect()->to(base_url('/dashboard')); 

    }

}
