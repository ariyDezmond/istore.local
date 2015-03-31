<?php

class Main extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('admins_model');
    }

    public function index() {
        $this->load->helper('url');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        } else {
            redirect('admin/main');
        }
    }

    public function view() {
        $data['title'] = 'Административная панель';
        $this->load->view('main', $data);
    }

}
