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
