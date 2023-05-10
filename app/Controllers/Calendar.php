<?php 
namespace App\Controllers;
use App\Models\CalendarModel;
use CodeIgniter\I18n\Time;

class Calendar extends BaseController{
    public $model;
    public $session;
    public function __construct(){
        helper(['date']);
        $this->session = session();
        $this->model = new CalendarModel();
    }
    public function index()
    {
      
        return view('templates/db_header')
                .view('calendar')
                .view('templates/db_footer') ;
    }
    
    public function add()
    {
        
    }
}

?>