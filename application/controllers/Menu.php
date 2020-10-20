<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('table_structure_model');
	}

	public function index()
	{
		$data=$this->table_structure_model->get_data();
		$this->load->view('display_menu', array('data' => $data));
	}
}
