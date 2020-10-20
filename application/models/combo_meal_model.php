<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Combo_Meal_Model extends CI_Model
{
    public $cm_id;
    public $cm_name;
    public $cm_no_small_pizza;
    public $cm_no_medium_pizza;
    public $cm_no_large_pizza;
    public $cm_no_small_side;
    public $cm_no_large_side;
    public $cm_no_small_drink;
    public $cm_no_large_drink;
    public $cm_price;

    public function __construct()    {
        parent::__construct();
    }

    function insert_record($data)
    {
        $this->cm_name = $data[0];
        $this->cm_no_small_pizza = $data[1];
        $this->cm_no_medium_pizza = $data[2];
        $this->cm_no_large_pizza =  $data[3];
        $this->cm_no_small_side = $data[4];
        $this->cm_no_large_side = $data[5];
        $this->cm_no_small_drink = $data[6];
        $this->cm_no_large_drink = $data[7];
        $this->cm_price = $data[8];
        $result = $this->db->get_where('combo_meals', array('cm_name' => $data[0]));
        echo $result->num_rows();
        if ($result->num_rows() === 0) {
            if ($this->db->insert('combo_meals', $this)) {
                echo 'Entry inserted ';
            } else {
                echo 'Entry Error';
            }
        } else {
            echo 'Entry already inserted';
        }
    }
}
