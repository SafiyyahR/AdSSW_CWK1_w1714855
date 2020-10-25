<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Combo_Meal_Model extends CI_Model
{
    public $cm_id;
    public $cm_name;
    public $cm_description;
    public $cm_no_small_pizza;
    public $cm_no_medium_pizza;
    public $cm_no_large_pizza;
    public $cm_no_small_side;
    public $cm_no_large_side;
    public $cm_no_small_drink;
    public $cm_no_large_drink;
    public $cm_price;

    public function __construct()
    {
        parent::__construct();
    }

    function insert_record($data)
    {
        $this->cm_name = $data[0];
        $this->cm_description = $data[1];
        $this->cm_no_small_pizza = $data[2];
        $this->cm_no_medium_pizza = $data[3];
        $this->cm_no_large_pizza =  $data[4];
        $this->cm_no_small_side = $data[5];
        $this->cm_no_large_side = $data[6];
        $this->cm_no_small_drink = $data[7];
        $this->cm_no_large_drink = $data[8];
        $this->cm_price = $data[9];
        $result = $this->db->get_where('combo_meals', array('cm_name' => $data[0]));
        if ($result->num_rows() === 0) {
            $this->db->insert('combo_meals', $this);
        }
    }
    function get_price($id)
    {
        $this->cm_id = $id;
        $query = $this->db->select(['cm_price', 'cm_name', 'cm_description'])
            ->where('cm_id', $this->cm_id)
            ->get('combo_meals');
        //echo '<p class="text-white">' . json_encode($query->result()) . '</p>';
        return ($query->row_array());
    }
}
