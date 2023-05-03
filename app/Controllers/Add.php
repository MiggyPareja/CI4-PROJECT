<?php 
namespace App\Controllers;
use App\Models\DashboardModel;

class Add extends BaseController
{
    public $session;
    public $model;
    public function __construct()
    {
        $this->session = session();
        helper(['form','filesystem','url','security']);
        $this->model = new DashboardModel();
    }
    public function index()
    {
        return view('templates/db_header')
        .view('add')
        .view('templates/db_footer');
    }
    //<!-- prod_name','prod_file','prod_desc','prod_price','prod_create','prod_updated -->
    public function store()
    {
        $data =[];
        $data['validation'] = null;
        if($this->request->getMethod() == 'post')
        {
            $rules = [
                'name' => 'required|min_length[3]|max_length[35]',
                'description' => 'required|min_length[3]|max_length[100]',
                'price' => 'required|numeric'
            ];
            if($this->validate($rules))
            {
                $prodData = [
                    'prod_name' => $this->request->getPost('name'),
                    'prod_file' => $this->request->getFile('file'),
                    'prod_desc' => $this->request->getPost('description'),
                    'prod_price' => $this->request->getPost('price'),
                    'user' => $this->request->getPost('user')
                ];
                if($prodData['prod_file'] && $prodData['prod_file']->isValid())
                {
                    $fileName =$prodData['prod_file']->getName();
                    $prodData['prod_file']->move(WRITEPATH.'uploads',$fileName);
                    $prodData['prod_file'] = $fileName;
                }
                if($this->model->save($prodData))
                {
                    $this->session->setTempdata('successStore', 'Successfully Added Product!');
                
                    return redirect()-> to(current_url());
                }else{
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        return view('templates/db_header')
        .view('add',$data)
        .view('templates/db_footer');
    }
}
?>