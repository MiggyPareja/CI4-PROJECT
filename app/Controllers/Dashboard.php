<?php 
namespace App\Controllers;
use App\Models\DashboardModel;

class Dashboard extends BaseController{
    public $table;
    public $model;
    public function __construct()
    {
        $this->table = new \CodeIgniter\View\Table();
        $this->model = new DashboardModel();
    }
    public function index()
    {
        //prod_name','prod_file','prod_desc','prod_price','prod_create','prod_updated
        $data = [
            'products' => $this->model->findAll(),

        ];
        return view('templates/db_header')
        .view('dashboard',$data)
        .view('templates/db_footer');
    }
    public function logout()
    {
        $session = session(); 
        unset($session);   
        session_destroy();
        return redirect()->to(base_url('/login'));
    }
}

?>