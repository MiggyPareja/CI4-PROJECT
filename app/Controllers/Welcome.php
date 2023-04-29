<?php 
namespace App\Controllers;

class Welcome extends BaseController
{
    public function index()
    {
        return view('templates/header')
        .view('welcome_Page')
        .view('templates/footer');
    }
}
?>