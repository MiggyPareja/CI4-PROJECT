<?php 
namespace App\Controllers;
use App\Models\CalendarModel;
use DateTime;
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
    $start_date = $this->request->getPost('start_date');
    $end_date = $this->request->getPost('end_date');
    $calData = [
        'Appointment' => $this->request->getPost('appointment'),
        'appoint_desc' => $this->request->getPost('notes'),
        'start_date' => $start_date,
        'end_date' => $end_date,
    ];

    $this->model->save($calData);
    
    return redirect()->to(base_url('/calendar'))->withInput();
}


public function get()
{
   $getAll = $this->model->findAll();
    $data = [];
    foreach($getAll as $get)
    {
        $data[] = [
            'title' => $get['Appointment'],
            'start' => $get['start_date'],
            'end' => $get['end_date'],
        ];
    }
    return $this->response->setJSON($data);
}

}

?>