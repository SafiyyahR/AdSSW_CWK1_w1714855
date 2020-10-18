<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->model('pizza_model');
		$this->load->model('combo_meal_model');
		$this->load->model('drink_model');
		$this->load->model('side_model');
		$this->load->model('topping_model');
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
		$topping_array = array (
			array("Extra Mozzarella Cheese",0.50, 1.00, 1.50),
			array("Olives",0.50, 1.00, 1.50),
			array("Extra Pepperoni", 0.55, 1.10, 1.65),
			array("Prawn", 0.80, 1.60, 2.40),
			array("Anchovies", 0.70, 1.40, 2.10),
			array("Sun Dried Tomatoes", 0.60, 1.20, 1.80)			
		);

		for ($i=0; $i < count($topping_array); $i++) { 
			$this->topping_model->insert_record($topping_array[$i]);
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
				'default' => 1.50
			),
			'side_pr_large' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 2.50
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

		$side_array = array (
			array("Coleslaw",1.50, 2.50),
			array("Bread Sticks",3, 5),
			array("Garlic Bread",3, 5),
			array("Onion Rings",3, 5),
			array("Potato Wedges",3, 5),
			array("Mozzarella Sticks",5, 7.50)						
		);

		for ($i=0; $i < count($side_array); $i++) { 
			$this->side_model->insert_record($side_array[$i]);
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
			'drink_pr_large' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 2.50
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

		$drink_array = array (
			array("Pepsi",1.75, 3.00),
			array("Pepsi Max",1.50, 2.50),
			array("Pepsi Diet",1.50, 2.50),
			array("Tango",1.50, 2.50),
			array("7up Sugar Free",1.50, 2.50),
			array("Bottled Water",1.00, 1.50)							
		);

		for ($i=0; $i < count($drink_array); $i++) { 
			$this->drink_model->insert_record($drink_array[$i]);
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
			'cm_no_large_drink' =>  array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'cm_price' =>  array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'null' => FALSE,
				'default' => 2.50
			)

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

		$cm_array = array (
			array("Family Deal",0, 0, 2, 0,2,0,1, 30.00),
			array("Couples Deal",0, 2, 0, 0,1,1,0,20.00 ),
			array("Game Night Deal",0, 0, 3, 0,3,0,2,40.00),
			array("Halloween Deal",0, 0, 3, 0,1,0,1,35.00),
			array("Favourite Deal",3, 0, 0, 2,0,1,0,20.00),
			array("Feast",0, 2, 0, 4,0,2,0, 25.00)					
		);

		for ($i=0; $i < count($cm_array); $i++) { 
			$this->combo_meal_model->insert_record($cm_array[$i]);
		}
		
		$this->load->view('display_menu');
	}
}
