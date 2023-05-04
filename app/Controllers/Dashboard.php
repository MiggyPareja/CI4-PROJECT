<?php 
namespace App\Controllers;
use App\Models\DashboardModel;
use CodeIgniter\Database\Query;
use CodeIgniter\Exceptions\AlertError;

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
            $this->session->setTempdata('successDel','Deleted Succesfully');
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
        $rules = [
            'editName' => 'min_length[3]|max_length[35]',
            'editDescription' => 'min_length[3]|max_length[100]',
            'editPrice' => 'numeric'
        ];

    if ($this->validate($rules)) {
        $vali['validation'] = null;
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
        $this->session->setTempdata('successEdit', 'Successfully Edited Product!');
        return redirect()->to(current_url());
    } else {
        $vali['validation'] = $this->validator;
    }

    return redirect()->to(base_url('/dashboard'));
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
        return view('templates/db_header')
            .view('dashboard',$data)
            .view('templates/db_footer');
    }
    public function download($filename)
    {
         $path = WRITEPATH . "uploads/" .$filename;

         return $this->response->download($path,null);
    }
    public function import(){
        $getFile =  $this->request->getFile('importFile');

        if($getFile->isValid() && !$getFile->hasMoved())
        {
            $handle = fopen($getFile->getTempName(),"r");

            fgets($handle);
            while(($data = fgetcsv($handle))!== FALSE)
            {
                $name = isset($data[0]) ? $data[0] : '';
                $file = isset($data[1]) ? $data[1] : '';
                $desc = isset($data[2]) ? $data[2] : '';
                $price = isset($data[3]) ? $data[3] : '';

                if(!empty($name) || !empty($desc)||!empty($price)){
                    $fileName = null;
                    if(filter_var($file, FILTER_VALIDATE_URL)||is_file($file)){
                        $fileContents = file_get_contents($file);
                        $fileExtenstion = pathinfo(parse_url($file,PHP_URL_PATH),PATHINFO_EXTENSION);

                        $fileName = random_string('alnum',14) .'.'.$fileExtenstion;

                        write_file(WRITEPATH . 'uploads/' . $fileName,$fileContents);
                    }else{
                        $this->model->insert(array(
                            'prod_name' => $name,
                            'prod_file' => $fileName,
                            'prod_desc' => $desc,
                            'prod_price' => $price
                        ));
                        fclose($handle);
                    }
                }else{
                    fclose($handle);
                    $this->session->setTempdata('uploadError', 'Name,Description,or Price Empty!');
                }
            }
        }else{
            $this->session->setTempdata('uploadError','');
        }
    }
}
?>