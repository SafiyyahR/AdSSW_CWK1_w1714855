<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//load the session library and the table_structure_model
		$this->load->model('table_structure_model');
		$this->load->library('session');
		//initialize session variable order if not present.
		if (!$this->session->has_userdata('order')) {
			$this->session->set_userdata('order', []);
		}
	}

	public function index()
	{
		//using the get_data function of the table_structure_model retrieve all 
		//the data from the 5 tables in the w1714855_0 database
		$data = $this->table_structure_model->get_data();
		$this->load->helper('url');
		//load the views
		$this->load->view('head', array('page_title' => 'Menu '));
		$this->load->view('navbar', array('page_name' => 'menu'));
		$this->load->view('scrolltotop');
		$this->load->view('display_menu', array('data' => $data));
		$this->load->view('footer');
	}
}
