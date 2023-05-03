<?php 
namespace App\Controllers;
use App\Models\DashboardModel;
use CodeIgniter\Database\Query;

class Dashboard extends BaseController{
    public $table;
    public $model;
    public $session;
    public function __construct()
    {
        helper(['filesystem']);
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
        $prod = $this->model->find($id);
        if($this->model->delete($id))
        {
            $this->session->setTempdata('successDel','Deleted Succesfully');
            return redirect()->to(previous_url());
        }else{
            return redirect()->to(previous_url());
        }
    }
    public function logout()
    {
        unset($session);   
        session_destroy();
        return redirect()->to(base_url('/login'));
    }
    public function editPage()
    {
        return view('templates/db_header')
            .view('edit')
            .view('templates/db_footer');
    }
    public function update($id)
    {
        $data =[];
        $data['validation'] = null;
        if($this->request->getMethod() == 'post')
        {
            $prod = $this->model->find($id);
            $rules = [
            'name' => 'required|min_length[3]|max_length[35]',
            'description' => 'required|min_length[3]|max_length[100]',
            'price' => 'required|numeric'
            ];
        if($this->validate($rules))
        {
            $file = $this->request->getFile('file');
            if($file->isValid())
            {
                $fileName =$file->getBasename();
                $file->move(WRITEPATH.'writable\uploads',$fileName);
                $data = [
                    'name' => $this->request->getPost('name'),
                    'file' => $fileName,
                    'description' =>$this->request->getPost('description'),
                    'price' => $this->request->getPost('price')
                ];
                if($this->model->update($id,$data))
                {
                    $this->session->setTempdata('successEdit', 'Successfully Edited Product!');
                    return redirect()-> to(current_url());
                }else{
                    $this->session->setTempdata('errorEdit', 'Update Error');
                    return redirect()-> to(current_url());
                }
            }
        }else{
            $data['validation'] = $this->validator;
        }
        }
        
    }
}

?>