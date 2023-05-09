<?php 
namespace App\Controllers;
use App\Models\CalendarModel;

class Calendar extends BaseController{
    public function index()
    {
        return view('templates/db_header')
                .view('calendar')
                .view('templates/db_footer') ;
    }
    
    public function add(){
        
    }
}

?>