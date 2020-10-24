<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('table_structure_model');
		$this->load->library('session');
		if (!$this->session->has_userdata('order')) {
			$this->session->set_userdata('order', []);
		}
		//echo '<p class="text-white">' . json_encode($this->session->userdata('order')) . '</p>';
	}

	public function index()
	{
		$data = $this->table_structure_model->get_data();
		$this->load->helper('url');
		$this->load->view('head', array('page_title' => 'Menu '));
		$this->load->view('navbar', array('page_name' => 'menu'));
		$this->load->view('scrolltotop');
		$this->load->view('display_menu', array('data' => $data));
		$this->load->view('footer');
	}
}
