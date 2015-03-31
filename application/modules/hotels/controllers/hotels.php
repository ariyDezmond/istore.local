<?php

class Hotels extends MX_Controller {

    private $module = 'hotels';
    private $module_name = 'Отели';

    public function __construct() {
        parent::__construct();
        $this->load->model('hotels_model');
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
            $data['entries'] = $this->hotels_model->get();
        } else {
            $data['entries'] = $this->hotels_model->get('', true);
        }
        $this->load->view('hotels', $data);
    }

    public function get($id = null, $for_front = false) {
        if ($id) {
            if ($for_front) {
                return $this->hotels_model->get($id, true);
            } else {
                return $this->hotels_model->get($id);
            }
        } else {
            if ($for_front) {
                return $this->hotels_model->get('', true);
            } else {
                return $this->hotels_model->get();
            }
        }
    }

    public function edit($id = null) {
        $entry = $this->hotels_model->get($id);
        $data['entry'] = $entry;
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if ($this->input->post('do') == 'hotelsEdit') {
            $this->form_validation->set_rules('name', 'Название', 'trim|required|xss_clean');
            $this->form_validation->set_rules('status', 'Статус', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Телефон', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|xss_clean');
            $this->form_validation->set_rules('site', 'Сайт', 'trim|xss_clean');
            $this->form_validation->set_rules('fax', 'Факс', 'trim|xss_clean');
            $this->form_validation->set_rules('rooms', 'Количество номеров', 'trim|required|xss_clean');
            $this->form_validation->set_rules('distoport', 'Расстояние до аэропорта', 'trim|required|xss_clean');
            $this->form_validation->set_rules('beachl', 'Пляжная линия', 'trim|required|xss_clean');
            $this->form_validation->set_rules('text', 'Информация об отеле', 'trim|xss_clean');
            //$this->form_validation->set_rules('coords', 'Координаты на карте', 'trim|required|xss_clean');я
            $this->form_validation->set_rules('active', 'Активность', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('edit', $data);
            } else {
                $config['upload_path'] = './images/' . $this->module;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size'] = '5120';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                $image_data = $this->upload->data();
                if ($_FILES['image']['name'] == '') {
                    $this->hotels_model->update($id);
                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись успешно обновлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                } else {
                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_userdata('error', $this->upload->display_errors('<span class="label label-danger">', '</span>'));
                        $this->hotels_model->update($id);
                        redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                    } else {
                        $entry = $this->hotels_model->get($id);
                        if (file_exists('images/' . $this->module . '/' . $entry['image'])) {
                            unlink('images/' . $this->module . '/' . $entry['image']);
                            $image_data = $this->upload->data();
                            $this->hotels_model->update($id, $image_data['file_name']);
                            $arr = array(
                                'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                            );
                            $this->session->set_userdata($arr);
                            redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                        } else {
                            $image_data = $this->upload->data();
                            $this->hotels_model->update($id, $image_data['file_name']);
                            $arr = array(
                                'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно обновлена!</div>'
                            );
                            $this->session->set_userdata($arr);
                            redirect('admin/' . $this->module . '/edit/' . $entry['id']);
                        }
                    }
                }
            }
        } else {
            $this->load->view('edit', $data);
        }
    }

    public function add() {
        $data['module_name'] = $this->module_name;
        $data['module'] = $this->module;
        if ($this->input->post('do') == 'hotelsAdd') {
            $this->form_validation->set_rules('name', 'Название', 'trim|required|xss_clean');
            $this->form_validation->set_rules('status', 'Статус', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Телефон', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|xss_clean');
            $this->form_validation->set_rules('site', 'Сайт', 'trim|xss_clean');
            $this->form_validation->set_rules('fax', 'Факс', 'trim|xss_clean');
            $this->form_validation->set_rules('rooms', 'Количество номеров', 'trim|required|xss_clean');
            $this->form_validation->set_rules('distoport', 'Расстояние до аэропорта', 'trim|required|xss_clean');
            $this->form_validation->set_rules('beachl', 'Пляжная линия', 'trim|required|xss_clean');
            $this->form_validation->set_rules('text', 'Информация об отеле', 'trim|xss_clean');
            //$this->form_validation->set_rules('coords', 'Координаты на карте', 'trim|required|xss_clean');
            $this->form_validation->set_rules('active', 'Активность', 'trim|xss_clean');

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
                    $arr = array(
                        'error' => '<div class="alert alert-success" role="alert"><strong>Успех! </strong>Запись была успешно добавлена!</div>'
                    );
                    $this->session->set_userdata($arr);
                    $insert_id = $this->hotels_model->set($image_data['file_name']);
                    redirect('admin/' . $this->module . '/edit/' . $insert_id);
                }
            }
        } else {
            $this->load->view('add', $data);
        }
    }

    public function delete($id) {
        $entry = $this->hotels_model->get($id);
        if (count($entry) > 0) {
            if (file_exists('images/' . $this->module . '/' . $entry['image'])) {
                $this->hotels_model->delete($id);
                unlink('images/' . $this->module . '/' . $entry['image']);
                $images = $this->hotels_model->get_images($id);
                foreach ($images as $img) {
                    if (file_exists('images/' . $this->module . '/' . $img['image'])) {
                        unlink('images/' . $this->module . '/' . $img['image']);
                        $this->hotels_model->delete_images($id);
                    } else {
                        die('Картинок не найдено');
                    }
                }
                redirect('admin/' . $this->module);
            } else {
                $this->hotels_model->delete($id);
                redirect('admin/' . $this->module);
            }
        } else {
            die('Ошибка! Такой записи в базе не существует!');
        }
    }

    public function images_upload($hotel_id) {
        if (!$this->session->userdata('logged')) {
            redirect('admin/login');
        }
        if (!($_FILES)) {
            die("Не выбрано ни одной картинки!");
        }
        if ($_FILES['file']['name']) {
            foreach ($_FILES['file']['name'] as $k => $f) {
                if (!$_FILES['file']['error'][$k]) {
                    $blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm", ".asp", ".aspx");
                    foreach ($blacklist as $item)
                        if (preg_match("/$item\$/i", $_FILES['file']['name'][$k]))
                            die("Недопустимый формат файла");
                    if (is_uploaded_file($_FILES['file']['tmp_name'][$k])) {
                        $namef = time() . "_" . md5(uniqid()) . "." . preg_replace("/.*?\./", '', $_FILES['file']['name'][$k]);
                        ;
                        $uploadfile = "images/hotels/" . $namef;
                        if (!move_uploaded_file($_FILES['file']['tmp_name'][$k], $uploadfile)) {
                            die("Error");
                        } else {
                            $image = $namef;
                            $this->hotels_model->images_insert($image, $hotel_id);
                            echo 'Файл "' . $_FILES['file']['name'][$k] . '" успешно загружен
';
                        }
                    }
                }
            }
        }
    }

    public function get_images($id, $front = false) {
        if ($front) {
            return $this->hotels_model->get_images($id);
        } else {
            $pimages = $this->hotels_model->get_images($id);

            if (!$pimages) {
                echo '<div class="alert alert-danger" role="alert">Миниатюр не найдено!</div>';
            }
            ?>
            <div class="row images">
                <?php
                foreach ($pimages as $pimage):
                    ?>
                    <div id="image_<?= $pimage['id'] ?>" style="width:200px;" class="col-xs-6 col-md-3">
                        <a class="thumbnail">
                            <button id="<?= $pimage['id'] ?>" type="button" class="close image_del">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <img class="img-rounded" src="/images/hotels/<?= $pimage['image'] ?>" alt="...">
                        </a>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
            <?php
        }
    }

    public function image_delete() {
        if (!$this->session->userdata('logged')) {
            alert('Авторизуйтесь!');
            die();
        }
        $id = $this->input->post('id');
        $image = $this->hotels_model->get_image($id);
        if (count($image) > 0) {
            if (file_exists('images/hotels/' . $image['image'])) {
                $this->hotels_model->delete_image($id);
                unlink('images/hotels/' . $image['image']);
            } else {
                $this->hotels_model->delete_image($id);
            }
        } else {
            die('Такой картинки не существует!');
        }
    }

    public function up($id) {
        $this->hotels_model->order($id, 'up');
    }

    public function down($id) {
        $this->hotels_model->order($id, 'down');
    }

}
