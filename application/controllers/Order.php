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
        $this->load->view('take_order', array('data' => $data));
    }
    public function display()
    {
        $data = $this->table_structure_model->get_data();
        $this->load->view('display_order', array('data' => $data));
    }
}
