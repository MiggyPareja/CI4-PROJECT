<?php

namespace App\Controllers;

use App\Models\CalendarModel;

class Calendar extends BaseController
{
    private $model;
    private $session;
    
    public function __construct()
    {
        helper(['date','form','url']);
        $this->session = session();
        $this->model = new CalendarModel();
    }

    public function index()
    {
        if (!$this->session->has('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'todo' => $this->model->findAll(),
            'id' => $this->model->find('id')
        ];

        return view('templates/db_header') .
            view('calendar', $data) .
            view('templates/db_footer');
    }

    public function add()
    { 
        $data = [];
        $data['validation'] = null;

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'appointment' => 'required|min_length[3]|max_length[50]',
                'notes' => 'required|min_length[3]|max_length[100]',
                'start_date' => 'required|valid_date[]',
                'end_date' => 'required|valid_date[]',
            ];

            if ($this->validate($rules)) {
                $start_date = $this->request->getPost('start_date');
                $end_date = $this->request->getPost('end_date');
                $calData = [
                    'Appointment' => $this->request->getPost('appointment'),
                    'appoint_desc' => $this->request->getPost('notes'),
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                ];

                if ($this->model->insert($calData)) {
                    $this->session->setFlashdata('Calendar', 'Successfully added');
                    return redirect()->to(base_url('/Calendar'))->withInput();
                }
            } else {
                $data['validation'] = $this->validator;
                return redirect()->to(base_url('/Calendar'))->withInput();
            } 
        }

        return view('templates/db_header') .
            view('calendar', $data) .
            view('templates/db_footer'); 
    }

    public function get()
    {
        $getAll = $this->model->findAll();
        $data = [];

        foreach ($getAll as $get) {
            $data[] = [
                'id' => $get['id'],
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

        if ($this->model->where('id', $id)->delete()) {
            $this->session->setFlashdata('Calendar', 'Successfully deleted');
            return redirect()->to(base_url('/calendar'));
        } else {
            $this->session->setFlashdata('Calendar', 'Delete Error');
            return redirect()->to(base_url('/calendar'))->withInput();
        }
    }
    
    public function update()
    {
        $id = $this->request->getPost('edit-eventId');

        if ($this->request->getMethod() == 'post') {
            $data = [
                'Appointment' => $this->request->getPost('edit-appointment'),
                'appoint_desc' => $this->request->getPost('edit-notes'),
                'start_date' => $this->request->getPost('editStart_date'),
                'end_date' => $this->request->getPost('editEnd_date'),
            ];

            if ($this->model->update($id, $data)) {
                $this->session->setFlashdata('Edit', 'Appointment Updated');
                return redirect()->to(base_url('/Calendar'))->withInput();
            } else {
                $this->session->setFlashdata('Edit', 'Update Error');
                return redirect()->to(base_url('/Calendar'))->withInput();
            }
        }
    }
}
