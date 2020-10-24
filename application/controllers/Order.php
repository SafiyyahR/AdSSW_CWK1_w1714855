<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('table_structure_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        if (!$this->session->has_userdata('order')) {
            $this->session->set_userdata('order', []);
        }
        //echo '<p class="text-white">' . json_encode($this->session->userdata('order')) . '</p>';
    }

    public function index()
    {
        $data = $this->table_structure_model->get_data();
        $this->load->view('head', array('page_title' => 'Make Order '));
        $this->load->view('navbar', array('page_name' => 'make_order'));
        $this->load->view('scrolltotop');
        $this->load->view('take_order', array('data' => $data));
        $this->load->view('footer');
    }
    public function view_basket()
    {
        echo '<p class="text-white">' . json_encode($this->input->post()) . '</p>';
        $data = $this->table_structure_model->get_data();
        $this->load->view('head', array('page_title' => 'View Basket '));
        $this->load->view('navbar', array('page_name' => 'view_basket'));
        $this->load->view('scrolltotop');
        $this->load->view('display_order', array('data' => $data));
        $this->load->view('footer');
    }
    public function confirm_order()
    {
        $error_found = false;
        // echo '<p class="text-white">' . json_encode($this->input->post()) . '</p>';
        // echo '<p class="text-white">' . $this->input->post('type') . '</p>';
        // echo '<p class="text-white">' . $this->input->post('id') . '</p>';
        // echo '<p class="text-white">' . $this->input->post('pizza_size') . '</p>';
        $data = $this->table_structure_model->get_data();
        if ($this->input->post('type')) {
            $type = $this->input->post('type');
            switch ($type) {
                case "pizza":
                    $toppings = [];
                    if ($this->input->post('size')) {
                        $size = $this->input->post('size');
                        if ($size != 'small' && $size != 'medium' && $size && 'large') {
                            $error_found = true;
                        } else {
                            for ($j = 0; $j < count($data['toppings']); $j++) {
                                if ($this->input->post('topping_' . $j)) {
                                    array_push($toppings, $this->input->post('topping_' . $j));
                                }
                            }
                            $total_price = 0;
                            // $total_price+=
                            $this->load->model('pizza_model');
                            $this->pizza_model->get_price(['size' => $size, 'id' => $this->input->post('id')]);
                            echo '<p class="text-white">' . json_encode($toppings) . '</p>';
                            echo '<p class="text-white">' . $this->input->post('type') . '</p>';
                            echo '<p class="text-white">' . $this->input->post('id') . '</p>';
                            echo '<p class="text-white">' . $this->input->post('size') . '</p>';
                        }
                    }
                    break;
            }
        } else {
            echo '<p class="text-white">False</p>';
        }
        $data = $this->table_structure_model->get_data();
        $this->load->view('head', array('page_title' => 'Confirm Order '));
        $this->load->view('navbar', array('page_name' => 'confirm_order'));
        $this->load->view('scrolltotop');
        $this->load->view('display_order', array('data' => $data));
        $this->load->view('footer');
    }
}
