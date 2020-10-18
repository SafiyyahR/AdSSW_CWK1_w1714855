<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->model('pizza_model');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->dbforge();
		if ($this->dbforge->create_database('cwk1_w1714855')) {
			echo 'Database created! ';
		} else {
			echo 'Database already created! ';
		}
		$this->db->query('use cwk1_w1714855');
		$fields = array(
			'pizza_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'pizza_name' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => '100',
			),
			'pizza_pr_small' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 3.00
			),
			'pizza_pr_medium' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 6.00
			),
			'pizza_pr_large' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 10.00
			)

		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('pizza_id', TRUE);
		// gives PRIMARY KEY (blog_id)

		$this->dbforge->add_key('pizza_name');
		// gives KEY (blog_title)

		if ($this->dbforge->create_table('pizza')) {
			echo 'Table pizza Created ';
		} else {
			echo 'Table pizza already created ';
		}
		$pizza_array = array (
			array("Margherita",3, 6, 10),
			array("Veggie Delight", 3, 6, 10),
			array("Pepperoni", 4, 7, 11),
			array("Meat Delight", 4.5, 8, 11.50),
			array("BBQ Chicken", 4, 7.50, 10.50),
			array("Breakfast Special", 4.5, 8, 11.50)
		);

		for ($i=0; $i < count($pizza_array); $i++) { 
			$this->pizza_model->insert_record($pizza_array[$i]);
		}
		
		$fields = array(
			'topping_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'topping_name' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => '100',
			),
			'topping_pr_small' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 0.50
			),
			'topping_pr_medium' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 1.00
			),
			'topping_pr_large' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 1.50
			)

		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('topping_id');
		// gives PRIMARY KEY (blog_id)

		$this->dbforge->add_key('topping_name');
		// gives KEY (blog_title)

		if ($this->dbforge->create_table('toppings')) {
			echo 'Table toppings Created ';
		} else {
			echo 'Table toppings already created ';
		}

		$fields = array(
			'side_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'side_name' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => '100',
			),
			'side_pr_small' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 3.00
			),
			'side_pr_large' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 5.00
			)

		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('side_id', TRUE);
		// gives PRIMARY KEY (blog_id)

		$this->dbforge->add_key('side_name');
		// gives KEY (blog_title)

		if ($this->dbforge->create_table('sides')) {
			echo 'Table sides Created ';
		} else {
			echo 'Table sides already created ';
		}
		$fields = array(
			'drink_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'drink_name' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => '100',
			),
			'drink_pr_small' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 1.00
			),
			'drink_pr_medium' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 1.50
			),
			'drink_pr_large' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 1.75
			)

		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('drink_id', TRUE);
		// gives PRIMARY KEY (blog_id)

		$this->dbforge->add_key('drink_name');
		// gives KEY (blog_title)

		if ($this->dbforge->create_table('drinks')) {
			echo 'Table drinks Created ';
		} else {
			echo 'Table drinks already created ';
		}
		$fields = array(
			'cm_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'cm_name' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => '350',
			),
			'cm_no_small_pizza' => array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'cm_no_medium_pizza' => array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'cm_no_large_pizza' =>  array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'cm_no_small_side' =>  array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'cm_no_large_side' =>  array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'cm_no_small_drink' =>  array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'cm_no_medium_drink' =>  array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'cm_no_large_drink' =>  array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),

		);

		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('cm_id', TRUE);
		// gives PRIMARY KEY (blog_id)

		$this->dbforge->add_key('cm_name');
		// gives KEY (blog_title)

		if ($this->dbforge->create_table('combo_meals')) {
			echo 'Table combo_meals Created ';
		} else {
			echo 'Table combo_meals already created ';
		}
		$this->load->view('display_menu');
	}
}
