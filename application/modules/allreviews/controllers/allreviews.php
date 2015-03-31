<?php

class Allreviews extends MX_Controller {

    private $module = 'allreviews';
    private $module_name = 'Отзывы о турах';
    public $model;

    public function __construct() {
        parent::__construct();
        $this->load->model('allreviews_model');
        $this->model = $this->allreviews_model;
        $this->form_validation->set_message('required', 'Поле "%s" обязательно для заполения');
        $this->form_validation->set_message('valid_email', 'Поле "%s" должно содержать валидный E-mail адрес');
    }

    public function index() {
        $this->load->helper('url');

        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        } else {
            redirect('admin/main');
        }
    }

    public function savemail() {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
            $this->model->save_email();
        }
    }

    public function view($for_front = false, $tour_id = false) {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $data['email'] = $this->model->get_email();
        if (!$for_front) {
            $data['entries'] = $this->model->get();
            $this->load->view($this->module, $data);
        } else {
            $data['entries'] = $this->model->get('', true);
            $this->load->view('front/allreviews', $data);
        }
    }

    public function get_for_slider() {
        $entries = $this->model->get_for_slider();
        $data['entries'] = array_chunk($entries, 4);
//        echo '<pre>';
//        print_r(array_chunk($entries, 4));
        $this->load->view('front/allreviews_in_slider', $data);
    }

    public function listOnMainPage() {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;

        $data['entries'] = $this->model->getForMainPage();
        $this->load->view('front/allreviews', $data);
    }

    public function fullList($startFrom) {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;

        $data['entries'] = $this->model->getForPagination($startFrom);
        $data['itemsCount'] = count($this->model->get('', true));
        $this->load->view('front/full_reviews_list', $data);
    }

    public function username_check($str) {
        if ($str == 'test') {
            $this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function save() {
        if ($this->input->post('do') == $this->module . 'Save') {
            $this->form_validation->set_rules('name', 'Имя', 'required|trim|xss_clean');
            $this->form_validation->set_rules('text', 'Текст отзыва', 'required|trim|xss_clean');

            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('front/allreviews_add_form');
            } else {
                $this->model->set();
                echo '<p style="margin:10px; font-weight:bold; text-align:center; color:green">Успех! Отзыв появится после рассмотрения администратором.</p>';
                $emailArray = $this->model->get_email();

                if (valid_email($emailArray['email'])) {
                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'officialakniet@gmail.com',
                        'smtp_pass' => 'googstud321',
                        'mailtype' => 'html',
                        'charset' => 'utf-8'
                    );
                    $this->load->library('email');
                    $this->email->initialize($config);

                    $this->email->set_newline("\r\n");
                    $this->email->from('support@travelshop.ru', 'Новый отзыв на сайте ' . str_ireplace('http://', '', substr(base_url(), 0, -1)));
                    $this->email->to($emailArray['email']);
                    $this->email->subject('Новый отзыв на сайте ' . str_ireplace('http://', '', substr(base_url(), 0, -1)));
                    $this->email->message(
                            'Имя: ' . $this->input->post('name') . '<br>' .
                            'Текст отзыва: ' . $this->input->post('text') . '<br>' .
                            'Дата: ' . date('Y-m-d H:i:s') . '<br>' .
                            'IP: ' . $this->input->ip_address() . '<br>'
                    );
                    $this->email->send();
                }
            }
        } else {
            $this->load->view('front/allreviews_add_form');
        }
    }

    public function edit($id = null) {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }

        $data['title'] = 'Административная панель';
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $entry = $this->model->get($id);
        $data['entry'] = $entry;
        $review = $this->model->get($id);

        if ($this->input->post('do') == $this->module . 'Edit') {

            $this->form_validation->set_rules('name', 'Заголовок', 'required|trim|xss_clean');
            $this->form_validation->set_rules('active', 'Активность', 'trim|xss_clean');
            $this->form_validation->set_rules('in_slider', 'Вывод в слайдере', 'trim|xss_clean');
            $this->form_validation->set_rules('text', 'Текст', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('edit', $data);
            } else {
                $this->model->update($id);

                $arr = array(
                    'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно добавлена!</div>'
                );
                $this->session->set_userdata($arr);
                redirect('admin/' . $this->module . '/edit/' . $entry['id']);
            }
        } else {
            $this->load->view('edit', $data);
        }
    }

    public function update() {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $this->model->update_request_read($id, $this->input->post('active'));
        }
    }

    public function setread() {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $this->model->update_request_read($id);
        }
    }

    public function delete($id) {
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
