<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Combo_meal_model extends CI_Model
{
    //attributes
    public $cm_id;
    public $cm_name;
    public $cm_description;
    public $cm_no_small_pizza;
    public $cm_no_medium_pizza;
    public $cm_no_large_pizza;
    public $cm_no_side;
    public $cm_no_drink;
    public $cm_price;

    public function __construct()
    {
        parent::__construct();
    }

    // function insert_record($data)
    // {
    //     $this->cm_name = $data[0];
    //     $this->cm_description = $data[1];
    //     $this->cm_no_small_pizza = $data[2];
    //     $this->cm_no_medium_pizza = $data[3];
    //     $this->cm_no_large_pizza =  $data[4];
    //     $this->cm_no_side = $data[5];
    //     $this->cm_no_drink = $data[6];
    //     $this->cm_price = $data[7];
    //     $result = $this->db->get_where('combo_meals', array('cm_name' => $data[0]));
    //     if ($result->num_rows() === 0) {
    //         $this->db->insert('combo_meals', $this);
    //     }
    // }
    function get_details($id)
    {
        $this->cm_id = $id;
        $this->db->select('*');
        $this->db->from('combo_meals');
        $this->db->where('cm_id', $this->cm_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return ($query->row_array());
        }

    }
}
