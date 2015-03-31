<?php

class Attributes extends MX_Controller {

    private $module = 'attributes';
    private $module_name = 'Атрибуты товаров';

    public function __construct() {
        parent::__construct();
        $this->load->model('attributes_model');
        $this->model = $this->attributes_model;
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
                $data['entries'] = $this->model->get_by_url($url);
                $this->load->view('front/new', $data);
            } else {
                $entries = $this->model->get('', true);
                $data['entries'] = $entries;
                $this->load->view('front/' . $this->module, $data);
            }
        }
    }

    public function get_by_url($url, $for_front = true) {
        return $this->model->get_by_url($url, $for_front);
    }

    public function edit($id = null) {
        $data['title'] = 'Административная панель';
        $entry = $this->model->get($id);
        foreach ($entry as $k => $v) {
            $entry[$k] = htmlspecialchars(stripslashes($v));
        }
        $data['entry'] = $entry;
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $data['categories'] = $categories = Modules::run('categories/get', '', true);
        if ($this->input->post('do') == $this->module . 'Edit') {
            $this->form_validation->set_rules('name', '', 'trim|xss_clean');
            $this->form_validation->set_rules('category', '', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('add', $data);
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

//    public function unique_url($url) {
//        $category = $this->model->get_by_url($url, false);
//        if (is_string($category['url'])) {
//            $this->form_validation->set_message('unique_url', 'ЧПУ должен быть уникальным!');
//            return false;
//        } else {
//            return true;
//        }
//    }

    public function add() {
        global $object;
        $object = 'blog';
        $data['title'] = 'Административная панель';
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $categories = Modules::run('categories/get', '', true);
        $data['categories'] = $categories;
        if ($this->input->post('do') == $this->module . 'Add') {
            $this->form_validation->set_rules('name', '', 'trim|xss_clean');
            $this->form_validation->set_rules('category', '', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('add', $data);
            } else {
                $this->model->set();
                $arr = array(
                    'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно добавлена!</div>'
                );
                $this->session->set_userdata($arr);
                redirect('admin/' . $this->module . '/add');
            }
        } else {
            $this->load->view('add', $data);
        }
    }

    public function delete($id) {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
            exit();
        }
        $entry = $this->model->get($id);
        if (count($entry) > 0) {
            $this->model->delete($id);
            redirect('admin/' . $this->module);
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
