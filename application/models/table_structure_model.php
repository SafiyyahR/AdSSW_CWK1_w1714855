<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Table_Structure_Model extends CI_Model
{
    private $table_structure;

    public function __construct()
    {
        parent::__construct();
        $this->table_structure = array(
            'pizza' => array(
                'fields' => array(
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
                    'pizza_description' => array(
                        'type' => 'VARCHAR',
                        'null' => FALSE,
                        'constraint' => '350',
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
                ), 'primary_key' => 'pizza_id', 'candidate_key' => 'pizza_name', 'records' => array(
                    array("Margherita", "Mozzarella Cheese and Tomato Sauce", 3, 6, 10),
                    array("Veggie Delight", 'Mushrooms, Mixed Peppers, Red Onions, Tomato, Mozzarella Cheese and Tomato Sauce', 3, 6, 10),
                    array("Pepperoni", 'Pepperoni, Mozzarella Cheese and Tomato Sauce', 4, 7, 11),
                    array("Meat Delight", 'Spicy Chicken, Pepperoni, Seasoned Minced Beef, Mozzarella Cheese and Tomato Sauce', 4.5, 8, 11.50),
                    array("BBQ Chicken", "BBQ Sauce, Chicken,  Red Onions, Tomato and Mozzarella Cheese", 4, 7.50, 10.50),
                    array("Breakfast Special", "Baked Beans, Cherry Tomatoes, Scrambled Eggs, Cheddar Cheese, Mushroom and Potato Tots", 4.5, 8, 11.50)
                )
            ), 'toppings' => array(
                'fields' => array(
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
                ), 'primary_key' => 'topping_id', 'candidate_key' => 'topping_name', 'records' => array(
                    array("Triple Cheese", 0.50, 1.00, 1.50),
                    array("Olives", 0.50, 1.00, 1.50),
                    array("Pepperoni", 0.55, 1.10, 1.65),
                    array("Prawn", 0.80, 1.60, 2.40),
                    array("Anchovies", 0.70, 1.40, 2.10),
                    array("Tomatoes", 0.60, 1.20, 1.80)
                )
            ),
            'sides' => array(
                'fields' => array(
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
                ), 'primary_key' => 'side_id', 'candidate_key' => 'side_name', 'records' => array(
                    array("Coleslaw", 1.50, 2.50),
                    array("Bread Sticks", 3, 5),
                    array("Garlic Bread", 3, 5),
                    array("Onion Rings", 3, 5),
                    array("Potato Wedges", 3, 5),
                    array("Mozzarella Sticks", 5, 7.50)
                )

            ),
            'drinks' => array(
                'fields' => array(
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
                ), 'primary_key' => 'drink_id', 'candidate_key' => 'drink_name', 'records' => array(
                    array("Pepsi", 1.75, 3.00),
                    array("Pepsi Max", 1.50, 2.50),
                    array("Pepsi Diet", 1.50, 2.50),
                    array("Tango", 1.50, 2.50),
                    array("7up Sugar Free", 1.50, 2.50),
                    array("Bottled Water", 1.00, 1.50)
                )
            ),
            'combo_meals' => array('fields' => array(
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
                'cm_description' => array(
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

            ), 'primary_key' => 'cm_id', 'candidate_key' => 'cm_name', 'records' => array(
                array("Family Deal", '2 large pizzas, 2 large sides and a 1.5l drink', 0, 0, 2, 0, 2, 0, 1, 30.00),
                array("Couples Deal", '2 medium pizzas, 1 small side and a 0.5l drink', 0, 2, 0, 0, 1, 1, 0, 20.00),
                array("Game Night Deal", '3 large pizzas, 3 large sides and 2 1.5l drinks', 0, 0, 3, 0, 3, 0, 2, 40.00),
                array("Halloween Deal", '3 large pizzas, 1 large sides and a 1.5l drink', 0, 0, 3, 0, 1, 0, 1, 35.00),
                array("Favourite Deal", '3 small pizzas, 2 small sides and a 0.5l drink', 3, 0, 0, 2, 0, 1, 0, 20.00),
                array("Feast", '2 medium pizzas, 4 small sides and 2 0.5l drinks', 0, 2, 0, 4, 0, 2, 0, 25.00)
            ))
        );
        //loading all the models
        $this->load->model('pizza_model');
        $this->load->model('combo_meal_model');
        $this->load->model('drink_model');
        $this->load->model('side_model');
        $this->load->model('topping_model');
        $this->load->dbutil();
        $this->load->dbforge();
        if (!$this->dbutil->database_exists('w1714855_0')) {
            $this->dbforge->create_database('w1714855_0');
        }
        $this->db->query('use w1714855_0');
        $table_data_array = $this->table_structure;
        foreach ($table_data_array as $table_name => $table_data) {
            $fields = $table_data['fields'];
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key($table_data['primary_key'], TRUE);
            $this->dbforge->add_key($table_data['candidate_key']);
            $this->dbforge->create_table($table_name);
            $query = $this->db->get($table_name);
            // echo $table_name . ' ' . $query->num_rows() . '<br>';
            if ($query->num_rows() < 6) {
                for ($i = 0; $i < count($table_data['records']); $i++) {
                    switch ($table_name) {
                        case "pizza":
                            $this->pizza_model->insert_record($table_data['records'][$i]);
                            break;
                        case "toppings":
                            $this->topping_model->insert_record($table_data['records'][$i]);
                            break;
                        case "sides":
                            $this->side_model->insert_record($table_data['records'][$i]);
                            break;
                        case "drinks":
                            $this->drink_model->insert_record($table_data['records'][$i]);
                            break;
                        case "combo_meals":
                            $this->combo_meal_model->insert_record($table_data['records'][$i]);
                            break;
                    }
                }
            }
        }
    }

    function get_data()
    {
        $this->db->query('use w1714855_0');
        $data = array();
        $table_name_array = array('pizza', 'toppings', 'sides', 'drinks', 'combo_meals');
        for ($i = 0; $i < count($table_name_array); $i++) {
            $query = $this->db->get($table_name_array[$i]);
            $data[$table_name_array[$i]] = $query->result_array();
        }
        return $data;
    }
}
