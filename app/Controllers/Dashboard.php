<?php 
namespace App\Controllers;
use App\Models\DashboardModel;
use CodeIgniter\Pager\PagerInterface;

class Dashboard extends BaseController{
    public $table;
    public $model;
    public $session;
    public function __construct()
    {
        helper(['form','filesystem','url','security','text']);
        $this->session = session();
        $this->model = new DashboardModel();
    }
    public function index()
    {
        $getUserId = $this->session->get('id');
        if(!(session()->has('id')))
        {
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'products' => $this->model->where(['user' => $getUserId])->paginate(10),
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
        session_destroy();
        return redirect()->to(base_url('/login'));
    }
    public function editPage($id)
    {
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
        $term = $this->request->getGet('searchTable');
        
        if(empty($products))
        {
            session()->setFlashdata('error', "No '$term' Found, Returning to Dashboard...");
            return redirect()->back()->withInput();
        }
        
        $data = [
            'products' => $this->model->like (['prod_name' =>$term])
                    ->orLike(['prod_desc' =>$term])
                    ->orLike(['prod_price' =>$term])
                    ->paginate(10),
            'pager' => $this->model->pager,
        ];
        

        session()->setFlashdata('success', 'Data Indexes Successfully');
        return view('templates/db_header')
            .view('dashboard',$data)
            .view('templates/db_footer');
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
    
        $handle = fopen($file->getTempName(), 'r');
        
        fgetcsv($handle);
        while (($data = fgetcsv($handle)) !== false) {
            list($name, $image, $description, $price) = $data;
        
            $imageFileName = null;
    
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                $imageFile = file_get_contents($image);
        
                if ($imageFile !== false) {
                    $imageFileExtension = pathinfo(parse_url($image, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $imageFileName = random_string('alnum', 14) . '.' . $imageFileExtension;
                    write_file(WRITEPATH . 'uploads/' . $imageFileName, $imageFile);
                }
            } elseif (is_file($image)) {
                $imageFileExtension = pathinfo($image, PATHINFO_EXTENSION);
                $imageFileName = random_string('alnum', 14) . '.' . $imageFileExtension;
                copy($image, WRITEPATH . 'uploads/' . $imageFileName);
            }
        
            $productData = [
                'prod_name' => $name,
                'prod_file' => $imageFileName,
                'prod_desc' => $description,
                'prod_price' => (float)$price,
                'user' => $userData
            ];
        
            $this->model->insert($productData);
        }
        if(empty($productData))
        {
            session()->setFlashdata('error', 'No data Found.');
            return redirect()->back()->withInput();
        }else{
            session()->setFlashdata('success', 'Data imported successfully.');
            fclose($handle);
            return redirect()->back();
        }
    }
    
public function clear()
{
    
    $this->model->truncate();
    delete_files('C:\xampp\htdocs\ci4\writable\uploads');
    session()->setFlashdata('success', 'Data cleared successfully.');
    return redirect()->to(base_url('/dashboard')); 
}

}
?>