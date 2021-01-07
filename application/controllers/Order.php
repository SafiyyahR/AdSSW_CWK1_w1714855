<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //load the session library and the table_structure_model
        $this->load->model('table_structure_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        //initialize session variable order if not present.
        if (!$this->session->has_userdata('order')) {
            $this->session->set_userdata('order', []);
        }
    }

    //when the user completes filling the details of the delivery and clicks place order this function is executed.
    public function order_complete()
    {
        $error_found = false;
        $message = "Details to confirm order have not been entered.";
        //the names of the fields in the checkout page.
        $items_to_be_entered = array(
            'fname' => 'first name', 'lname' => 'last name', 'house_no' => 'house number',
            'street_add' => 'street address', 'postcode' => 'postcode', 'phone_no' => 'phone number'
        );
        $data = array();
        //changing the timezone to the Europe/London Time zone
        date_default_timezone_set('Europe/London');
        //for loop is used to check if all the required fields have been entered.
        foreach ($items_to_be_entered as $key => $value) {
            //if the user has not entered one of the required fields then the loop is broken and a string is stored in $message.
            if ($this->input->post($key) == "") {
                $error_found = true;
                $message = 'The ' . $value . ' has not been entered.';
                break;
            } else {
                $data[$key] = str_replace(',', '', $this->input->post($key));
            }
        }
        if ($this->input->post('business')) {
            $data['business'] = str_replace(',', '', $this->input->post('business'));
        }
        //if any error is found then 
        if ($error_found) {
            $this->load->view('head', array('page_title' => 'Error '));
            $this->load->view('navbar', array('page_name' => 'error'));
            $this->load->view('scrolltotop');
            $this->load->view('error', array('err_message' => $message));
            $this->load->view('footer');
        } else {
            //if no error then the order is placed and the session is destroyed.
            $this->session->sess_destroy();
            //$timezone = date_default_timezone_get();
            //the delivery time is calculated 30 minutes from the order time placed.
            $data['data_time'] = date('d-m-Y h:i:s', time() + 1800);
            $this->load->view('head', array('page_title' => 'Order Completed '));
            $this->load->view('navbar', array('page_name' => 'order_completed'));
            $this->load->view('scrolltotop');
            $this->load->view('order_complete', array('data' => $data));
            $this->load->view('footer');
        }
    }

    //this function is used to display the make order page.
    public function index()
    {
        //all the orders from the session variable are retrieved.
        $orders = $this->session->userdata('order');
        $updated = false;
        // check if the confirm_order_btn is posted
        if ($this->input->post('confirm_order_btn')) {
            //if yes then check if new_order is posted
            if ($this->input->post('new_order')) {
                //convert json to an array
                $new_order = json_decode($this->input->post('new_order'), true);
                //store value of posted field confirm_order_btn
                $choice = $this->input->post('confirm_order_btn');
                //if it is confirm check if item has already been selected an update the quantity else add a new order to the orders array.
                if ($choice == 'Confirm') {
                    $new_order_details = $new_order['details'];
                    for ($i = 0; $i < count($orders); $i++) {
                        if ($orders[$i]['type'] == $new_order['type']) {
                            $order_details = $orders[$i]['details'];
                            if ($order_details['id'] == $new_order_details['id']) {
                                if ($orders[$i]['type'] == 'pizza') {
                                    if ($orders[$i]['size'] == $new_order['size']) {
                                        if ($orders[$i]['topping'] == $new_order['topping']) {
                                            $orders[$i]['quantity'] = $orders[$i]['quantity'] + 1;
                                            $updated = true;
                                        }
                                    }
                                } else if ($orders[$i]['type'] == 'cm') {
                                    if ($orders[$i]['details']['items'] == $new_order['details']['items']) {
                                        $orders[$i]['quantity'] = $orders[$i]['quantity'] + 1;
                                        $updated = true;
                                    }
                                } else {
                                    $orders[$i]['quantity'] = $orders[$i]['quantity'] + 1;
                                    $updated = true;
                                }
                            }
                        }
                    }
                    if (!$updated) {
                        if (!in_array($new_order, $orders)) {
                            array_push($orders, $new_order);
                        }
                    }
                    //then set the order session variable once updated.
                    $this->session->set_userdata('order', $orders);
                }
            }
        }
        //retrieve all the data from the table_structure_model
        $data = $this->table_structure_model->get_data();
        $this->load->view('head', array('page_title' => 'Make Order '));
        $this->load->view('navbar', array('page_name' => 'make_order'));
        $this->load->view('scrolltotop');
        $this->load->view('make_order', array('data' => $data));
        $this->load->view('footer');
    }

    //view the basket
    public function view_basket()
    {
        $error_found = false;
        $message = 'Did Not Select any item to be added to the cart';
        //retrieve all the data from the database
        $data = $this->table_structure_model->get_data();
        //retrieve all the orders from the session variable
        $orders = $this->session->userdata('order');
        $new_order = array();
        //if new order type posted then identify the type and size. Make a new order and send it to be confirmed by the user.
        if ($this->input->post('new_type')) {
            $type = $this->input->post('new_type');
            switch ($type) {
                case "pizza":
                    $topping_ids = [];
                    $toppings = [];
                    if ($this->input->post('new_size')) {
                        $size = $this->input->post('new_size');
                        if ($size != 'small' && $size != 'medium' && $size != 'large') {
                            $error_found = true;
                        } else {
                            for ($j = 0; $j < count($data['toppings']); $j++) {
                                if ($this->input->post('new_topping_' . $j)) {
                                    array_push($topping_ids, $this->input->post('new_topping_' . $j));
                                }
                            }
                            $total_price = 0.0;
                            $this->load->model('pizza_model');
                            $this->load->model('topping_model');
                            $pizza_details = $this->pizza_model->get_price(['size' => $size, 'id' => $this->input->post('new_id')]);
                            $total_price += floatval($pizza_details['pizza_pr_' . $size]);
                            for ($i = 0; $i < count($topping_ids); $i++) {
                                $topping_details = $this->topping_model->get_price(['size' => $size, 'id' => $topping_ids[$i]]);
                                $total_price += floatval($topping_details['topping_pr_' . $size]);
                                $topping = array('id' => $topping_ids[$i], 'name' => $topping_details['topping_name'], 'price' => $topping_details['topping_pr_' . $size], 'tp_total_price' => $topping_details['topping_pr_' . $size]);
                                array_push($toppings, $topping);
                            }
                            if (count($orders) > 0) {
                                $id = $orders[count($orders) - 1]['id'] + 1;
                            } else {
                                $id = 1;
                            }
                            //new order is created
                            $new_order = array(
                                'id' => $id,
                                'type' => $type,
                                'size' => $size,
                                'quantity' => 1,
                                'topping' => $toppings,
                                'indi_price' => number_format((float)$total_price, 2, '.', ''),
                                'total_price' => number_format((float)$total_price, 2, '.', ''),
                                'details' => array('id' => $this->input->post('new_id'), 'name' => $pizza_details['pizza_name'], 'indi_price' => $pizza_details['pizza_pr_' . $size], 'total_price' => $pizza_details['pizza_pr_' . $size])
                            );
                        }
                    } else {
                        $error_found = true;
                    }
                    break;
                case 'side':
                    $total_price = 0.0;
                    $this->load->model('side_model');
                    $side_details = $this->side_model->get_price($this->input->post('new_id'));
                    $total_price += floatval($side_details['side_price']);
                    if (count($orders) > 0) {
                        $id = $orders[count($orders) - 1]['id'] + 1;
                    } else {
                        $id = 1;
                    }
                    $new_order = array(
                        'id' => $id,
                        'type' => $type,
                        'quantity' => 1,
                        'indi_price' => number_format((float)$total_price, 2, '.', ''),
                        'total_price' => number_format((float)$total_price, 2, '.', ''),
                        'details' => array('id' => $this->input->post('new_id'), 'name' => $side_details['side_name'], 'price' => $side_details['side_price'])
                    );

                    break;
                case 'drink':
                    $orders = $this->session->userdata('order');
                    $total_price = 0.0;
                    $this->load->model('drink_model');
                    $drink_details = $this->drink_model->get_price($this->input->post('new_id'));
                    $total_price += floatval($drink_details['drink_price']);
                    if (count($orders) > 0) {
                        $id = $orders[count($orders) - 1]['id'] + 1;
                    } else {
                        $id = 1;
                    }
                    $new_order = array(
                        'id' => $id,
                        'type' => $type,
                        'quantity' => 1,
                        'indi_price' => number_format((float)$total_price, 2, '.', ''),
                        'total_price' => number_format((float)$total_price, 2, '.', ''),
                        'details' => array('id' => $this->input->post('new_id'), 'name' => $drink_details['drink_name'], 'price' => $drink_details['drink_price'])
                    );

                    break;
                case 'cm':
                    $this->load->model('combo_meal_model');
                    if (count($orders) > 0) {
                        $id = $orders[count($orders) - 1]['id'] + 1;
                    } else {
                        $id = 1;
                    }
                    $cm_details = $this->combo_meal_model->get_details($this->input->post('new_id'));
                    $items_chosen = array();
                    $items = array();
                    if ($cm_details["cm_no_small_pizza"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_small_pizza"]; $i++) {
                            if ($this->input->post('new_cm_small_pizza_' . $i)) {
                                array_push($items, $this->input->post('new_cm_small_pizza_' . $i));
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
                            if ($this->input->post('new_cm_medium_pizza_' . $i)) {
                                array_push($items, $this->input->post('new_cm_medium_pizza_' . $i));
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
                            if ($this->input->post('new_cm_large_pizza_' . $i)) {
                                array_push($items, $this->input->post('new_cm_large_pizza_' . $i));
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
                    if ($cm_details["cm_no_side"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_side"]; $i++) {
                            if ($this->input->post('new_cm_side_' . $i)) {
                                array_push($items, $this->input->post('new_cm_side_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_side"]) {
                            $items_chosen['side'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The side has not been chosen for the combo meal.';
                        }
                    }
                    $items = array();
                    if ($cm_details["cm_no_drink"] > 0) {
                        for ($i = 0; $i < $cm_details["cm_no_drink"]; $i++) {
                            if ($this->input->post('new_cm_drink_' . $i)) {
                                array_push($items, $this->input->post('new_cm_drink_' . $i));
                            }
                        }
                        if (count($items) == $cm_details["cm_no_drink"]) {
                            $items_chosen['drink'] = $items;
                        } else {
                            $error_found = true;
                            $message = 'The drink has not been chosen for the combo meal.';
                        }
                    }
                    $new_order = array(
                        'id' => $id,
                        'type' => $type,
                        'quantity' => 1,
                        'indi_price' => $cm_details['cm_price'],
                        'total_price' => $cm_details['cm_price'],
                        'details' => array('id' => $this->input->post('new_id'), 'name' => $cm_details['cm_name'], 'items' => $items_chosen)
                    );

                    break;
                default:
                    $error_found = true;
                    $message = 'The type of item is not in the menu';
                    break;
            }
        }
        //if error is found then error is displayed.
        if ($error_found) {
            $this->load->view('head', array('page_title' => 'Confirm Order '));
            $this->load->view('navbar', array('page_name' => 'confirm_order'));
            $this->load->view('scrolltotop');
            $this->load->view('error', array('err_message' => $message));
            $this->load->view('footer');
        } else {
            //else it is checked if there is any order to be updated if so then it is checked if it needs to be removed or changed.
            if ($this->input->post('update_order')) {
                for ($i = 0; $i < count($orders); $i++) {
                    $order = $orders[$i];
                    if ($order['id'] == $this->input->post('update_order')) {
                        if ($this->input->post('quantity')) {
                            //if it the quantity is remove then it is deleted from the array orders else the quantity is updated and saved in the orders array.
                            if ($this->input->post('quantity') != 'remove') {
                                $order['quantity'] = $this->input->post('quantity');
                                $new_total_price = number_format($this->input->post('quantity') * $order['indi_price'], 2, '.', '');
                                $order['total_price'] = $new_total_price;
                                if ($order['type'] == 'pizza') {
                                    $order['details']['total_price'] = number_format($this->input->post('quantity') * $order['details']['indi_price'], 2, '.', '');
                                    for ($tp_i = 0; $tp_i < count($order['topping']); $tp_i++) {
                                        $topping = $order['topping'][$tp_i];
                                        $tp_total_price = number_format($this->input->post('quantity') * $topping['price'], 2, '.', '');
                                        $topping['tp_total_price'] = $tp_total_price;
                                        $order['topping'][$tp_i] = $topping;
                                    }
                                }
                                $orders[$i] = $order;
                                break;
                            } else {
                                array_splice($orders, $i, 1);
                                break;
                            }
                        }
                    }
                }
                //the updated order is made
                $this->session->set_userdata('order', $orders);
            }
            //the total price is calculated
            $total_price = 0;
            for ($i = 0; $i < count($orders); $i++) {
                $order = $orders[$i];
                $total_price += $order['total_price'];
            }
            //the details array is created.
            $details = array(
                'orders' => $orders,
                'total_price' => number_format((float)$total_price, 2, '.', ''),
                'new_order' => $new_order
            );
            //the views are loaded.
            $this->load->view('head', array('page_title' => 'View Basket '));
            $this->load->view('navbar', array('page_name' => 'view_basket'));
            $this->load->view('scrolltotop');
            $this->load->view('view_basket', array('data' => $details));
            $this->load->view('footer');
        }
    }

    //display the checkout page where the form is filled.
    public function checkout()
    {
        $this->load->view('head', array('page_title' => 'Checkout '));
        $this->load->view('navbar', array('page_name' => 'checkout'));
        $this->load->view('scrolltotop');
        $this->load->view('checkout',);
        $this->load->view('footer');
    }
}
