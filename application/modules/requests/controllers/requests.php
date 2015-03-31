<?php

class Requests extends MX_Controller {

    private $module = 'requests';
    private $module_name = 'Поиск отеля';

    public function __construct() {
        parent::__construct();
        $this->load->model('requests_model');
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
            $this->requests_model->save_email();
        }
    }

    public function view($for_front = false) {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $data['email'] = $this->requests_model->get_email();
        if (!$for_front) {
            $data['entries'] = $this->requests_model->get();
        } else {
            $data['entries'] = $this->requests_model->get('', true);
        }
        $this->load->view($this->module, $data);
    }

    public function save() {
        if ($this->input->post('do') == $this->module . 'Save') {
            $this->form_validation->set_rules('country', 'Страна и город', 'required|trim|xss_clean');
            $this->form_validation->set_rules('rooms', 'Количество комнат', 'required|trim|xss_clean');
            $this->form_validation->set_rules('price', 'Цена за сутки', 'required|trim|xss_clean');
            $this->form_validation->set_rules('name', 'Имя, Фамилия', 'required|trim|xss_clean');
            $this->form_validation->set_rules('phone', 'Телефон', 'required|trim|xss_clean');
            $this->form_validation->set_rules('text', 'Дополнительная информация', 'required|trim|xss_clean');
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim|xss_clean');
            $this->form_validation->set_rules('stars', 'Количество звезд', 'trim|xss_clean');
            $this->form_validation->set_rules('places', 'Количество мест', 'trim|xss_clean');
            $this->form_validation->set_rules('days', 'Количество дней', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('front/request_form');
            } else {
                $this->requests_model->set();
                echo '<p style="margin:10px; font-weight:bold; text-align:center; color:green">Успех! Заявка на поиск отеля была успешно отправлена! Ожидайте...наш менеджер свяжется с вами в ближайшее время.</p>';

                $emailArray = $this->requests_model->get_email();

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
                    $this->email->from('support@travelshop.ru', 'Новая заявка на поиск отеля');
                    $this->email->to($emailArray['email']);
                    $this->email->subject('Новая заявка на поиск отеля на сайте' . str_ireplace('http://', '', substr(base_url(), 0, -1)));
                    $this->email->message(
                            'Имя: ' . $this->input->post('name') . '<br>' .
                            'Телефон: ' . $this->input->post('phone') . '<br>' .
                            'Страна и город: ' . $this->input->post('country') . '<br>' .
                            'Количество комнат: ' . $this->input->post('rooms') . '<br>' .
                            'Цена за сутки: ' . $this->input->post('price') . '<br>' .
                            'Дополнительная информация: ' . $this->input->post('text') . '<br>' .
                            'E-mail: ' . $this->input->post('email') . '<br>' .
                            'Количество звезд: ' . $this->input->post('stars') . '<br>' .
                            'Количество мест: ' . $this->input->post('places') . '<br>' .
                            'Количество дней: ' . $this->input->post('days') . '<br>' .
                            'Дата: ' . date('Y-m-d H:i:s') . '<br>' .
                            'IP: ' . $this->input->ip_address() . '<br>'
                    );
                    $this->email->send();
                }
            }
        } else {
            $this->load->view('front/request_form');
        }
    }

    public function more($id = null) {
        $data['title'] = 'Административная панель';
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        $entry = $this->requests_model->get($id);
        $data['entry'] = $entry;
        $this->load->view('more', $data);
    }

    public function get_unread_requests() {
        return $this->requests_model->get_unread_requests();
    }

    public function setread() {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $this->requests_model->update_request_read($id);
        }
    }

    public function get_point_by_url($url) {
        if ($url) {
            $query = $this->db->get_where($this->module, array('url' => $url));
            if ($query) {
                return $query->row_array();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function check_url($url) {
        if ($this->requests_model->get_by_url($url)) {
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
        if ($this->input->post('do') == 'blogAdd') {
            $this->form_validation->set_rules('name', 'Заголовок', 'required|trim|xss_clean');
            $this->form_validation->set_rules('url', 'Чпу', 'required|trim|xss_clean|callback_check_url');
            $this->form_validation->set_rules('text', 'Текст', 'trim|xss_clean');
            $this->form_validation->set_rules('title', 'Мета title', 'trim|xss_clean');
            $this->form_validation->set_rules('desc', 'Мета description', 'trim|xss_clean');
            $this->form_validation->set_rules('keyw', 'Мета keywords', 'trim|xss_clean');
            $this->form_validation->set_rules('date', 'Дата публикации', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('add', $data);
            } else {
                $config['upload_path'] = './images/' . $this->module;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size'] = '5120';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                $image_data = $this->upload->data();
                if (!$this->upload->do_upload('image')) {
                    $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                    redirect('admin/' . $this->module . '/add');
                } else {
                    $image_data = $this->upload->data();
                    $insert_id = $this->requests_model->set($image_data['file_name']);

                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно добавлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $insert_id);
                }
            }
        } else {
            $this->load->view('add', $data);
        }
    }

    public function delete($id) {
        $entry = $this->requests_model->get($id);
        if (count($entry) > 0) {
            $this->requests_model->delete($id);
            redirect('admin/' . $this->module);
        } else {
            die('Ошибка! Такой записи в базе не существует!');
        }
    }

    public function up($id) {
        $this->requests_model->order($id, 'up');
    }

    public function down($id) {
        $this->requests_model->order($id, 'down');
    }

}
