<?php

class Widget extends MX_Controller {

    private $module = 'widget';
    private $module_name = 'Виджеты';

    public function __construct() {
        parent::__construct();
        $this->load->model('widget_model');
    }

    public function index() {
        $this->load->helper('url');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        } else {
            redirect('admin/main');
        }
    }

    public function view($for_front = false) {
        if (!$for_front) {
            $data['entries'] = $this->widget_model->get();
        } else {
            $data['entries'] = $this->widget_model->get('', true);
        }
        $this->load->view('widget', $data);
    }

    public function get_widget($widget) {
        $t = $this->widget_model->get_widget($widget);
        if ($t) {
            return $t['text'];
        } else {
            return 'Текста нет!';
        }
    }

    public function getByTitle($title) {
        $data['widget'] = $this->widget_model->get_by_title($title);
        if (!empty($data['widget'])) {
            $this->load->view('front/view', $data);
        }
    }

    public function edit($id = null) {
        $entry = $this->widget_model->get($id);
        $data['entry'] = $entry;
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if ($this->input->post('do') == 'widgetEdit') {
            $this->form_validation->set_rules('title', 'Название', 'required|trim|xss_clean');
            $this->form_validation->set_rules('text', 'Значение виджета', 'required');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('edit', $data);
            } else {
                $arr = array(
                    'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                );
                $this->session->set_userdata($arr);
                $this->widget_model->update($id);
                redirect('admin/' . $this->module . '/edit/' . $entry['id']);
            }
        } else {
            $this->load->view('edit', $data);
        }
    }

    public function add() {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if ($this->input->post('do') == 'widgetAdd') {
            $this->form_validation->set_rules('title', 'Название', 'required|trim|xss_clean');
            $this->form_validation->set_rules('text', 'Значение виджета', 'required|trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('add', $data);
            } else {
                $arr = array(
                    'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно добавлена!</div>'
                );
                $this->session->set_userdata($arr);
                $insert_id = $this->widget_model->set();
                redirect('admin/' . $this->module . '/edit/' . $insert_id);
            }
        } else {
            $this->load->view('add', $data);
        }
    }

    public function delete($id) {
        $entry = $this->widget_model->get($id);
        if (count($entry) > 0) {
            $this->widget_model->delete($id);
            redirect('admin/' . $this->module);
        } else {
            die('Ошибка! Такой записи в базе не существует!');
        }
    }

    public function up($id) {
        $this->widget_model->order($id, 'up');
    }

    public function down($id) {
        $this->widget_model->order($id, 'down');
    }

}
