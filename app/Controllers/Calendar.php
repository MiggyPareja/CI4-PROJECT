<?php 

namespace App\Controllers;

use App\Models\CalendarModel;


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
    $data = [
        'todo' =>$this->model->findAll(),
        'id' =>$this->model->find('id')
    ];
    return view('templates/db_header') .
        view('calendar',$data) .
        view('templates/db_footer');
}

    public function add()
    { 
        $rules =[
            'appointment' => 'required|min_length[3]|max_length[50]',
            'notes' => 'required|min_length[3]',
            'start_date' => 'valid_date[]',
            'end_date' => 'valid_date[]',
        ];
        
            $start_date = $this->request->getPost('start_date');
            $end_date = $this->request->getPost('end_date');
            $calData = [
                'Appointment' => $this->request->getPost('appointment'),
                'appoint_desc' => $this->request->getPost('notes'),
                'start_date' => $start_date,
                'end_date' => $end_date,
            ];
            $this->model->insert($calData);
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
            'appoint_desc' => $get['appoint_desc'],
            'start' => $get['start_date'],
            'end' => $get['end_date'],
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
    public function edit_page() 
    {
        
    }

    public function update()
    {
        
    }
}