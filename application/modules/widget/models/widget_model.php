<?php

class Widget_model extends CI_Model {

    private $table_name = 'widget';
    private $redirect_url = 'widget';

    public function __construct() {
        $this->load->database();
    }

    public function order($id, $direction) {
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        $category = $query->row_array();
        $order = $category['order'];
        if ($direction == 'up') {
            $order++;
        } elseif ($direction == 'down') {
            $order--;
        }
        $data = array(
            'order' => $order,
        );

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        redirect('admin/' . $this->redirect_url);
    }

    public function get_by_title($title) {
        $query = $this->db->get_where($this->table_name, array('title' => $title));
        return $query->row_array();
    }

    public function get($id = null, $for_front = false) {
        if (!$for_front) {
            if ($id) {
                $query = $this->db->get_where($this->table_name, array('id' => $id));

                return $query->row_array();
            }
            $this->db->order_by('order', 'desc');
            $query = $this->db->get($this->table_name);
            if (count($query->result_array()) > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        } else {
            if ($id) {
                $query = $this->db->get_where($this->table_name, array('id' => $id, 'active' => 'on'));

                return $query->row_array();
            }
            $this->db->order_by('order', 'desc');
            $query = $this->db->get_where($this->table_name, array('active' => 'on'));
            if (count($query->result_array()) > 0) {
                return $query->result_array();
            } else {
                return false;
            }
        }
    }

    public function get_widget($title) {
        $query = $this->db->get_where($this->table_name, array('title' => $title));
        if (count($query->row_array()) > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function set() {

        $data = array(
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
        );

        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array('id' => $id));
    }

    public function update($id) {
        $data = array(
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
        );
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }

}
