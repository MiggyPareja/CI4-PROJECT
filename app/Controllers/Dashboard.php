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
        $this->session = session();
        $this->model = new DashboardModel();
    }
    public function index()
    {
        //prod_name','prod_file','prod_desc','prod_price','prod_create','prod_updated
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

        if($prod)
        {
            $this->model->delete($id);
            
            $this->session->setTempdata('successDel','Deleted Succesfully');
        }else{
            $this->session->setTempdata('errorDel','Action Unsuccessfull');
        }
        redirect()->to(base_url('/dashboard'));
    }
    
    public function logout()
    {
        unset($session);   
        session_destroy();
        return redirect()->to(base_url('/login'));
    }
}

?>