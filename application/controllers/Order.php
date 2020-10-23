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
        $data = $this->table_structure_model->get_data();
        $this->load->view('head', array('page_title' => 'View Basket '));
        $this->load->view('navbar', array('page_name' => 'view_basket'));
        $this->load->view('scrolltotop');
        $this->load->view('take_order', array('data' => $data));
        $this->load->view('footer');
    }
}
