<?php

class Vises extends MX_Controller {

    private $module = 'vises';
    private $module_name = 'Визовые услуги';

    public function __construct() {
        parent::__construct();
        $this->load->model('vises_model');
        $this->model = $this->vises_model;
    }

    public function index() {
        $this->load->helper('url');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        } else {
            redirect('admin/main');
        }
    }

    public function view($for_front = false, $url = false) {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if (!$for_front) {
            if ($url) {
                $data['entries'] = $this->model->get_by_url($url);
            } else {
                $data['entries'] = $this->model->get();
                $this->load->view($this->module, $data);
            }
        } else {
            if ($url) {
                $data['entries'] = $this->model->get('', true);
                $data['text'] = $this->model->get_by_url($url);
                $this->load->view('front/' . $this->module, $data);
            } else {
                $data['entries'] = $this->model->get('', true);
                $data['firstEntry'] = $this->model->getFirstEntry();
                $this->load->view('front/' . $this->module, $data);
            }
        }
    }

    public function get_by_url($url) {
        return $this->model->get_by_url($url);
    }

    public function edit($id = null) {
        global $object;
        $object = 'blog';
        $data['title'] = 'Административная панель';
        $entry = $this->model->get_blogs($id);
        $data['entry'] = $entry;
        $tags = $this->model->get_tags($id);
        $data['tags'] = $tags;
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if ($this->input->post('do') == $this->module . 'Edit') {

            $this->form_validation->set_rules('name', 'Категория', 'required|trim|xss_clean');
            $this->form_validation->set_rules('url', 'ЧПУ', 'required|trim|xss_clean');
            $this->form_validation->set_rules('text', 'Текст', 'required');
            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('edit', $data);
            } else {
                $this->model->update($id);
                $arr = array(
                    'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                );
                $this->session->set_userdata($arr);
                redirect('admin/' . $this->module . '/edit/' . $entry['id']);
            }
        } else {
            $this->load->view('edit', $data);
        }
    }

    public function check_url($url) {
        if ($this->model->get_by_url($url)) {
            $this->form_validation->set_message('check_url', 'Такой ЧПУ уже занят!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function add() {
        global $object;
        $object = 'blog';
        $data['title'] = 'Административная панель';
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if ($this->input->post('do') == $this->module . 'Add') {
            $this->form_validation->set_rules('name', 'Категория', 'required|trim|xss_clean');
            $this->form_validation->set_rules('url', 'ЧПУ', 'required|trim|xss_clean');
            $this->form_validation->set_rules('text', 'Текст', 'required');
            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('add', $data);
            } else {
                $arr = array(
                    'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно добавлена!</div>'
                );
                $this->session->set_userdata($arr);
                $this->model->set();
                redirect('admin/' . $this->module . '/add');
            }
        } else {
            $this->load->view('add', $data);
        }
    }

    public function delete($id) {
        $entry = $this->model->get($id);
        if (count($entry) > 0) {
            if (file_exists('images/' . $this->module . '/' . $entry['image'])) {
                $this->model->delete($id);
                unlink('images/' . $this->module . '/' . $entry['image']);
                redirect('admin/' . $this->module);
            } else {
                $this->model->delete($id);
                redirect('admin/' . $this->module);
            }
        } else {
            die('Ошибка! Такой записи в базе не существует!');
        }
    }

    public function up($id) {
        $this->model->order($id, 'up');
    }

    public function down($id) {
        $this->model->order($id, 'down');
    }

}
