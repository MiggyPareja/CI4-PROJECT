<?php 
namespace App\Controllers;
use App\Models\DashboardModel;

use function PHPUnit\Framework\isEmpty;

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
        $data = [
            'products' => $this->model->dashboard()
        ];
        return view('templates/db_header')
        .view('dashboard',$data)
        .view('templates/db_footer');
    }
    public function add()
    {
        return view('templates/db_header')
            .view('add')
            .view('templates/db_footer');
    }
    public function delete($id)
    {
        if($this->model->delete($id))
        {
        
            $this->session->setTempdata('success','Deleted Succesfully');
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
        $this->session->setTempdata('success', 'Successfully Edited Product!');
        return redirect()->to(current_url());
    } else {
        $vali['validation'] = $this->validator;
        return redirect()->withInput()->to(previous_url());
    }
    
    }

    public function search()
    {
        $term = $this->request->getGet('searchTable');
        $data = [
            'products' =>$this->model->like (['prod_name' =>$term])
                    ->orLike(['prod_desc' =>$term])
                    ->orLike(['prod_price' =>$term])
                    ->findAll()
        ];
        
        session()->setTempdata('success', 'Data Indexes Successfully');
        
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
    try {
        $userData = $this->session->get('id');
        $file = $this->request->getFile('importFile');
        $handle = fopen($file->getTempName(), 'r');
    } catch (\Exception $e) {
        session()->setTempdata('error', 'Invalid file uploaded.');
        return redirect()->back();
    }

    fgets($handle);

    while (($data = fgetcsv($handle)) !== false) {
        $data = array_map('trim', $data);
        list($name, $pic, $description, $price) = $data;

        if (empty($name)||empty($pic)||empty($description)||empty($price)) {
            session()->setTempdata('error', 'File content invalid.');
            return redirect()->back();
        }

        $imageFileName = null;

        if (filter_var($pic, FILTER_VALIDATE_URL)) {
            $imageFile = file_get_contents($pic);

            if ($imageFile !== false) {
                $imageFileExtension = pathinfo(parse_url($pic, PHP_URL_PATH), PATHINFO_EXTENSION);
                $imageFileName = random_string('alnum', 14) . '.' . $imageFileExtension;
                write_file(WRITEPATH . 'uploads/' . $imageFileName, $imageFile);
            }
        } elseif (is_file($pic)) {
            $imageFileExtension = pathinfo($pic, PATHINFO_EXTENSION);
            $imageFileName = random_string('alnum', 14) . '.' . $imageFileExtension;
            copy($pic, WRITEPATH . 'uploads/' . $imageFileName);
        }

        $this->model->insert([
            'prod_name' => $name,
            'prod_file' => $imageFileName,
            'prod_desc' => $description,
            'prod_price' => (float)$price,
            'user'=>$userData
        ]);
    }
    
    session()->setTempdata('success', 'Data imported successfully.');
    fclose($handle);
    return redirect()->back();
    
}

public function clear()
{
    $this->model->truncate();
    delete_files('C:\xampp\htdocs\ci4\writable\uploads');
    session()->setTempdata('success', 'Data cleared successfully.');
    return redirect()->back(); 
}

}
?>