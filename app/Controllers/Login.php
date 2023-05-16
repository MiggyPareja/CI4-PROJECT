<?php 
namespace App\Controllers;
use App\Models\LoginModel;

class Login extends BaseController
{
    public $loginModel;
    public $session;
    public function __construct()
    {
        helper(['form','session']);
        $this->loginModel = new LoginModel();
    }
    public function index()
    {
        
        $data = [];
        if($this->request->getMethod()=='post')
        {
            $rules = [
                'email' =>'required|valid_email',
                'password' => 'required|min_length[6]|max_length[16]'
            ];

             if($this->validate($rules))
             {
                $session = session();
                $email =  $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $getData = $this->loginModel->where('email',$email)->first();

                if($getData){
                    $pass = $getData['password'];
                    $auth = password_verify($password,$pass);
                    if($auth)
                    {
                        $session_data= [
                            'id' =>$getData['id'],
                            'username' =>$getData['username'],
                            'email' => $getData['email'],
                            'isLoggedIn' => true,
                        ];
                        $session ->set($session_data);
                        return redirect()->to(base_url('/Calendar'));
                    }else{
                        $session->setTempdata('errmsg','Password is Incorrect.');
                        return redirect()->to(base_url('/login'));
                    }
                }else{
                    $session->setTempdata('errmsg','Email or Password Incorrect.');
                    return redirect()->to(base_url('/login'));
                }
                
             }else{
                $data['validation'] =$this->validator;
             }
        }
        
        return view('templates/header')
                .view('login_Form',$data)
                .view('templates/footer');
          
    }
    
}
?>