<?php 

namespace App\Controllers;

use App\Models\CalendarModel;
use DateTime;
use CodeIgniter\I18n\Time;

class Calendar extends BaseController
{
    public $model;
    public $session;

    public function __construct()
    {
        helper(['date']);
        $this->session = session();
        $this->model = new CalendarModel();
    }

    public function index()
{
    $data['todo'] = $this->model->findAll();
    $data['id'] = $this->model->find('id');
    return view('templates/db_header') .
        view('calendar',$data) .
        view('templates/db_footer');
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
        $this->session->setFlashdata('Calendar', 'Successfully added');
        return redirect()->to(base_url('/calendar'))->withInput();
    }

    public function get()
{
    $getAll = $this->model->findAll();
    $data = [];
    foreach ($getAll as $get) {
        $data[] = [
            'id' =>$get['id'],
            'title' => $get['Appointment'],
            'start' => $get['start_date'],
            'end' => $get['end_date'],
            'appoint_desc' => $get['appoint_desc'],
            
        ];
    }
    return $this->response->setJSON($data);
}
public function delete()
{
    $id = $this->request->getPost('id');
        if($this->model->where('id',$id)->delete())
        {
            $this->session->setFlashdata('Calendar','Appointment Deleted');
            return redirect()->to(base_url('/calendar'))->withInput();
        }else{
            $this->session->setFlashdata('Calendar','Delete Error');
            return redirect()->to(base_url('/calendar'))->withInput();
        }
}
public function update()
{
    $id = $this->request->getPost('id');
    $appointment = $this->request->getPost('appointment');
    $notes = $this->request->getPost('notes');
    $start = $this->request->getPost('start_date');
    $end = $this->request->getPost('end_date');

    $data = [
        'appoint_title' => $appointment,
        'appoint_desc' => $notes,
        'appoint_start' => $start,
        'appoint_end' => $end,
    ];

    if($this->model->where('id',$id)->update($data))
    {

    }
    
        
}



}