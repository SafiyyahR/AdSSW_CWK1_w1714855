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
    }

    public function order_complete()
    {
        if ($this->input->post('del_session')) {
            if ($this->input->post('del_session') == 'true') {
                $this->session->sess_destroy();
                $timezone = date_default_timezone_get();
                // echo "The current server timezone is: " . $timezone;
                // echo date('d-m-Y h:i:s', time() + 1800);
                $data = array('data_time' => date('d-m-Y h:i:s', time() + 1800), 'current_timezone' => $timezone);
                $this->load->view('head', array('page_title' => 'Make Order '));
                $this->load->view('navbar', array('page_name' => 'make_order'));
                $this->load->view('scrolltotop');
                $this->load->view('order_complete', array('data' => $data));
                $this->load->view('footer');
            } else {
                $this->load->view('head', array('page_title' => 'Confirm Order '));
                $this->load->view('navbar', array('page_name' => 'confirm_order'));
                $this->load->view('scrolltotop');
                $this->load->view('error', array('err_message' => 'Delivery Details have not been entered.'));
                $this->load->view('footer');
            }
        } else {
            $this->load->view('head', array('page_title' => 'Confirm Order '));
            $this->load->view('navbar', array('page_name' => 'confirm_order'));
            $this->load->view('scrolltotop');
            $this->load->view('error', array('err_message' => 'Delivery Details have not been entered.'));
            $this->load->view('footer');
        }
    }
    public function index()
    {
        if ($this->input->post('confirm_order_btn')) {
            if ($this->input->post('order')) {
                $order = json_decode($this->input->post('order'), true);
                $orders = $this->session->userdata('order');
                $choice = $this->input->post('confirm_order_btn');
                if ($choice == 'Confirm') {
                    if (!in_array($order, $orders)) {
                        array_push($orders, $order);
                        $this->session->set_userdata('order', $orders);
                    }
                }
            }
        }
        $data = $this->table_structure_model->get_data();
        $this->load->view('head', array('page_title' => 'Make Order '));
        $this->load->view('navbar', array('page_name' => 'make_order'));
        $this->load->view('scrolltotop');
        $this->load->view('take_order', array('data' => $data));
        $this->load->view('footer');
    }
    public function view_basket()
    {
        $orders = $this->session->userdata('order');
        if ($this->input->post('del_order')) {
            for ($i = 0; $i < count($orders); $i++) {
                $order = $orders[$i];
                if ($order['id'] == $this->input->post('del_order')) {
                    array_splice($orders, $i, 1);
                }
            }
            $this->session->set_userdata('order', $orders);
        }
        $total_price = 0;
        for ($i = 0; $i < count($orders); $i++) {
            $order = $orders[$i];
            $total_price += $order['total_price'];
        }
        $details = array(
            'orders' => $orders,
            'total_price' => number_format((float)$total_price, 2, '.', '')
        );
        $this->load->view('head', array('page_title' => 'View Basket '));
        $this->load->view('navbar', array('page_name' => 'view_basket'));
        $this->load->view('scrolltotop');
        $this->load->view('view_basket', array('data' => $details));
        $this->load->view('footer');
    }

    public function checkout()
    {
        $this->load->view('head', array('page_title' => 'Checkout '));
        $this->load->view('navbar', array('page_name' => 'checkout'));
        $this->load->view('scrolltotop');
        $this->load->view('checkout',);
        $this->load->view('footer');
    }
    public function confirm_order()
    {
        $error_found = false;
        $message = 'Did Not Select any item to be added to the cart';
        $data = $this->table_structure_model->get_data();
        if ($this->input->post('type')) {
            $type = $this->input->post('type');
            switch ($type) {
                case "pizza":
                    $topping_ids = [];
                    $toppings = [];
                    if ($this->input->post('size')) {
                        $size = $this->input->post('size');
                        if ($size != 'small' && $size != 'medium' && $size != 'large') {
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
                                'total_price' => number_format((float)$total_price, 2, '.', ''),
                                'details' => array('id' => $this->input->post('id'), 'name' => $pizza_details['pizza_name'], 'price' => $pizza_details['pizza_pr_' . $size])
                            );
                        }
                    } else {
                        $error_found = true;
                    }
                    break;
                case 'side':
                    if ($this->input->post('size')) {
                        $size = $this->input->post('size');
                        if ($size != 'small' && $size != 'large') {
                            $error_found = true;
                        } else {
                            $orders = $this->session->userdata('order');
                            $total_price = 0.0;
                            $this->load->model('side_model');
                            $side_details = $this->side_model->get_price(['size' => $size, 'id' => $this->input->post('id')]);
                            $total_price += floatval($side_details['side_pr_' . $size]);
                            if (count($orders) > 0) {
                                $id = $orders[count($orders) - 1]['id'] + 1;
                            } else {
                                $id = 1;
                            }
                            $order = array(
                                'id' => $id,
                                'type' => $type,
                                'size' => $size,
                                'total_price' => number_format((float)$total_price, 2, '.', ''),
                                'details' => array('id' => $this->input->post('id'), 'name' => $side_details['side_name'], 'price' => $side_details['side_pr_' . $size])
                            );
                        }
                    } else {
                        $error_found = true;
                    }
                    break;
                case 'drink':
                    if ($this->input->post('size')) {
                        $size = $this->input->post('size');
                        if ($size != 'small' && $size != 'large') {
                            $error_found = true;
                        } else {
                            $orders = $this->session->userdata('order');
                            $total_price = 0.0;
                            $this->load->model('drink_model');
                            $drink_details = $this->drink_model->get_price(['size' => $size, 'id' => $this->input->post('id')]);
                            $total_price += floatval($drink_details['drink_pr_' . $size]);
                            if (count($orders) > 0) {
                                $id = $orders[count($orders) - 1]['id'] + 1;
                            } else {
                                $id = 1;
                            }
                            $order = array(
                                'id' => $id,
                                'type' => $type,
                                'size' => $size,
                                'total_price' => number_format((float)$total_price, 2, '.', ''),
                                'details' => array('id' => $this->input->post('id'), 'name' => $drink_details['drink_name'], 'price' => $drink_details['drink_pr_' . $size])
                            );
                        }
                    } else {
                        $error_found = true;
                    }
                    break;
                case 'cm':
                    $orders = $this->session->userdata('order');
                    $this->load->model('combo_meal_model');
                    if (count($orders) > 0) {
                        $id = $orders[count($orders) - 1]['id'] + 1;
                    } else {
                        $id = 1;
                    }
                    $cm_details = $this->combo_meal_model->get_details($this->input->post('id'));
                    $items_chosen = array();
                    $items = array();
                    if ($cm_details["cm_no_small_pizza"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_small_pizza"]; $i++) {
                            if ($this->input->post('cm_small_pizza_' . $i)) {
                                array_push($items, $this->input->post('cm_small_pizza_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_small_pizza"]) {
                            $items_chosen['small_pizza'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The small pizza has not been chosen for the combo meal.';
                        }
                    }
                    $items = array();
                    if ($cm_details["cm_no_medium_pizza"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_medium_pizza"]; $i++) {
                            if ($this->input->post('cm_medium_pizza_' . $i)) {
                                array_push($items, $this->input->post('cm_medium_pizza_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_medium_pizza"]) {
                            $items_chosen['medium_pizza'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The medium pizza has not been chosen for the combo meal.';
                        }
                    }
                    $items = array();
                    if ($cm_details["cm_no_large_pizza"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_large_pizza"]; $i++) {
                            if ($this->input->post('cm_large_pizza_' . $i)) {
                                array_push($items, $this->input->post('cm_large_pizza_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_large_pizza"]) {
                            $items_chosen['large_pizza'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The large pizza has not been chosen for the combo meal.';
                        }
                    }
                    $items = array();
                    if ($cm_details["cm_no_small_side"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_small_side"]; $i++) {
                            if ($this->input->post('cm_small_side_' . $i)) {
                                array_push($items, $this->input->post('cm_small_side_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_small_side"]) {
                            $items_chosen['small_side'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The small side has not been chosen for the combo meal.';
                        }
                    }
                    $items = array();
                    if ($cm_details["cm_no_large_side"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_large_side"]; $i++) {
                            if ($this->input->post('cm_large_side_' . $i)) {
                                array_push($items, $this->input->post('cm_large_side_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_large_side"]) {
                            $items_chosen['large_side'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The large side has not been chosen for the combo meal.';
                        }
                    }
                    $items = array();
                    if ($cm_details["cm_no_small_drink"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_small_drink"]; $i++) {
                            if ($this->input->post('cm_small_drink_' . $i)) {
                                array_push($items, $this->input->post('cm_small_drink_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_small_drink"]) {
                            $items_chosen['small_drink'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The small drink has not been chosen for the combo meal.';
                        }
                    }
                    $items = array();
                    if ($cm_details["cm_no_large_drink"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_large_drink"]; $i++) {
                            if ($this->input->post('cm_large_drink_' . $i)) {
                                array_push($items, $this->input->post('cm_large_drink_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_large_drink"]) {
                            $items_chosen['large_drink'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The large drink has not been chosen for the combo meal.';
                        }
                    }
                    $order = array(
                        'id' => $id,
                        'type' => $type,
                        'total_price' => $cm_details['cm_price'],
                        'items' => $items_chosen,
                        'name' => $cm_details['cm_name']

                    );
                    break;
                default:
                    $error_found = true;
                    break;
            }
            if (!$error_found) {
                $this->load->view('head', array('page_title' => 'Confirm Order '));
                $this->load->view('navbar', array('page_name' => 'confirm_order'));
                $this->load->view('scrolltotop');
                $this->load->view('confirm_order', array('details' => $order));
                $this->load->view('footer');
            }
        } else {
            $error_found = true;
        }
        if ($error_found) {
            $this->load->view('head', array('page_title' => 'Confirm Order '));
            $this->load->view('navbar', array('page_name' => 'confirm_order'));
            $this->load->view('scrolltotop');
            $this->load->view('error', array('err_message' => $message));
            $this->load->view('footer');
        }
    }
}
