<?php

class Categories extends MX_Controller {

    private $module = 'categories';
    private $module_name = 'Категории товаров';

    public function __construct() {
        parent::__construct();
        $this->load->model('categories_model');
        $this->model = $this->categories_model;
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

    public function get($id = null, $for_front = false) {
        if ($id) {
            if ($for_front) {
                return $this->model->get($id, true);
            } else {
                return $this->model->get($id);
            }
        } else {
            if ($for_front) {
                return $this->model->get('', true);
            } else {
                return $this->model->get();
            }
        }
    }

    public function get_by_url($url, $for_front = true) {
        return $this->model->get_by_url($url, $for_front);
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
            $this->form_validation->set_rules('text', '', 'trim|xss_clean');
            $this->form_validation->set_rules('url', '', 'trim|xss_clean');
            $this->form_validation->set_rules('title', '', 'trim|xss_clean');
            $this->form_validation->set_rules('desc', '', 'trim|xss_clean');
            $this->form_validation->set_rules('keyw', '', 'trim|xss_clean');

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
                if ($_FILES['image']['name'] == '') {
                    $this->model->update($id);
                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                } else {
                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    } else {
                        $entry = $this->model->get_blogs($id);
                        if (file_exists('images/' . $this->module . '/' . $entry['image'])) {
                            unlink('images/' . $this->module . '/' . $entry['image']);
                        }
                        if ($this->input->post('tags')) {
                            foreach ($this->input->post('tags') as $tag) {
                                Modules::run('admin/set_tag', $tag, $id, $object);
                            }
                        }
                        $image_data = $this->upload->data();
                        $this->model->update($id, $image_data['file_name']);
                        $arr = array(
                            'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                        );
                        $this->session->set_userdata($arr);
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    }
                }
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
        if ($this->input->post('do') == $this->module . 'Add') {
            $this->form_validation->set_rules('text', '', 'trim|xss_clean');
            $this->form_validation->set_rules('url', '', 'trim|xss_clean');
            $this->form_validation->set_rules('title', '', 'trim|xss_clean');
            $this->form_validation->set_rules('desc', '', 'trim|xss_clean');
            $this->form_validation->set_rules('keyw', '', 'trim|xss_clean');

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
                    $this->model->set($image_data['file_name']);

                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно добавлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/add');
                }
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
