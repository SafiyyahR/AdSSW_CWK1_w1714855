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
        echo '<p class="text-white">' . json_encode($this->session->userdata('order')) . '</p>';
    }

    public function index()
    {
        //echo json_decode($this->input->post('id'), true)['type'];
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
                    $topping_ids = [];
                    $toppings = [];
                    if ($this->input->post('size')) {
                        $size = $this->input->post('size');
                        if ($size != 'small' && $size != 'medium' && $size && 'large') {
                            $error_found = true;
                        } else {
                            $orders = $this->session->userdata('order');
                            for ($j = 0; $j < count($data['toppings']); $j++) {
                                if ($this->input->post('topping_' . $j)) {
                                    array_push($topping_ids, $this->input->post('topping_' . $j));
                                }
                            }
                            $total_price = 0.0;
                            $this->load->model('pizza_model');
                            $this->load->model('topping_model');
                            $pizza_details = $this->pizza_model->get_price(['size' => $size, 'id' => $this->input->post('id')]);
                            $total_price += floatval($pizza_details['pizza_pr_' . $size]);
                            for ($i = 0; $i < count($topping_ids); $i++) {
                                $topping_details = $this->topping_model->get_price(['size' => $size, 'id' => $topping_ids[$i]]);
                                $total_price += floatval($topping_details['topping_pr_' . $size]);
                                $topping = array('id' => $topping_ids[$i], 'name' => $topping_details['topping_name'], 'price' => $topping_details['topping_pr_' . $size]);
                                array_push($toppings, $topping);
                            }
                            // echo '<p class="text-white">' .  $pizza_details['pizza_pr_' . $size] . '</p>';
                            // echo '<p class="text-white">' . json_encode($toppings) . '</p>';
                            // echo '<p class="text-white">' . $this->input->post('type') . '</p>';
                            // echo '<p class="text-white">' . $this->input->post('id') . '</p>';
                            // echo '<p class="text-white">' . $this->input->post('size') . '</p>';
                            // echo '<p class="text-white">' . $total_price . '</p>';
                            if (count($orders) > 0) {
                                $id = $orders[count($orders) - 1]['id'] + 1;
                            } else {
                                $id = 1;
                            }
                            $order = array(
                                'id' => $id,
                                'type' => $type,
                                'size' => $size,
                                'topping' => $toppings,
                                'total_price' => $total_price,
                                'confirmed' => false,
                                'details' => array('id' => $this->input->post('id'), 'name' => $pizza_details['pizza_name'], 'price' => $pizza_details['pizza_pr_' . $size])
                            );
                        }
                    }
                    break;
            }
            echo '<p class="text-white">' . json_encode($order) . '</p>';
            // array_push($orders, $order);
            // $this->session->set_userdata('order', $orders);
            $this->load->view('head', array('page_title' => 'Confirm Order '));
            $this->load->view('navbar', array('page_name' => 'confirm_order'));
            $this->load->view('scrolltotop');
            $this->load->view('confirm_order', array('details' => $order));
            $this->load->view('footer');
        } else {
            echo '<p class="text-white">False</p>';
            $message = 'Did Not Select any item to be added to the cart';
            $this->load->view('head', array('page_title' => 'Confirm Order '));
            $this->load->view('navbar', array('page_name' => 'confirm_order'));
            $this->load->view('scrolltotop');
            $this->load->view('error', array('message' => $message));
            $this->load->view('footer');
        }
    }
}
