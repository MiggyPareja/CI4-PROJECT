<?php 

namespace App\Controllers;
use \App\Models\RegisterModel;

class Register extends BaseController
{
    public $registerModel;
    public $session;
    public function __construct()
    {
        $this->registerModel = new RegisterModel();
        $this->session = \Config\Services::session();
        helper('form');
    }
    public function index()
    {
        $data = [];
        $data['validation'] = null;
        if($this->request->getMethod() == 'post')
        {
            $rules = [
                'username' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[16]',
                'cpassword' => 'required|matches[password]',
                'mobile' => 'required|exact_length[10]|numeric',
            ];

            if($this->validate($rules))
            {
                $userData = [
                    'username' => $this->request->getVar(htmlspecialchars('username')),
                    'email' => $this->request->getVar(htmlspecialchars('email')),
                    'password' =>password_hash($this->request->getVar(htmlspecialchars('password')), PASSWORD_DEFAULT),
                    'mobile' => $this->request->getVar(htmlspecialchars('mobile')),
                ];
                if($this->registerModel->save($userData))
                {
                    $this->session->setTempdata('success','Successfully Registered Account.');
                    return redirect()->to(current_url());
                }else{
                    $this->session->setTempdata('error', 'Try Again!, User Account not Registered.');
                    return redirect()->to(current_url());
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }
        return view('templates/header')
                .view('register_Form',$data)
                .view('templates/footer');
    }
    
}

?>