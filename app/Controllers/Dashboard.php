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
        helper(['form','filesystem','url','security']);
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
        $rules = [
            'editName' => 'min_length[3]|max_length[35]',
            'editDescription' => 'min_length[3]|max_length[100]',
            'editPrice' => 'numeric'
        ];

        if($this->validate($rules))
        {
            $vali =[];
            $vali['validation'] = null;
            $file =$this->request->getFile('editFile');  
            $filename = $product['prod_file'];

           
                $filename = $file ->getName();
                $file->move(WRITEPATH.'uploads',$filename);
                $data= [
                     'prod_name' => $this->request->getVar('editName'),
                     'prod_file' => $filename,
                     'prod_desc' => $this->request->getVar('editDescription'),
                     'prod_price' => $this->request->getVar('editPrice')  
                ];

                $this->model->update($id,$data);
                $this->session->setTempdata('successEdit', 'Successfully Edited Product!');
                return redirect()-> to(current_url());
            
        }else{
            
            $vali['validation'] = $this->validator;
        }
        return redirect()-> to(base_url('/dashboard'));
    }
    public function search()
    {
        $term = $this->request->getGet('searchTable');
        $data = [
            'products' =>$this->model->like(['prod_name' =>$term])
                                    ->orLike(['prod_desc' =>$term])
                                    ->orLike(['prod_price' =>$term])
                                    ->findAll()
        ];
        return view('templates/db_header')
            .view('dashboard',$data)
            .view('templates/db_footer');
    }
    public function download($filename)
    {
         $path = WRITEPATH . "uploads/" .$filename;

         return $this->response->download($path,null);
    }
}
?>