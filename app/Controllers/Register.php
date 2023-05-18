<?php

namespace App\Controllers;

use App\Models\RegisterModel;

class Register extends BaseController
{
    private $registerModel;
    private $session;

    public function __construct()
    {
        $this->registerModel = new RegisterModel();
        $this->session = \Config\Services::session();
        helper('form');
    }

    public function index()
    {
        $data = [
            'validation' => null
        ];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[16]',
                'cpassword' => 'required|matches[password]',
                'mobile' => 'required|exact_length[10]|numeric',
            ];

            if ($this->validate($rules)) {
                $userData = [
                    'username' => htmlspecialchars($this->request->getVar('username')),
                    'email' => htmlspecialchars($this->request->getVar('email')),
                    'password' => password_hash(htmlspecialchars($this->request->getVar('password')), PASSWORD_DEFAULT),
                    'mobile' => htmlspecialchars($this->request->getVar('mobile')),
                ];

                if ($this->registerModel->save($userData)) {
                    $this->session->setTempdata('success', 'Successfully registered an account.', 3);
                } else {
                    $this->session->setTempdata('error', 'Failed to register user account. Please try again.', 3);
                }
                return redirect()->to(current_url());
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('templates/header')
            . view('register_Form', $data)
            . view('templates/footer');
    }
}
