<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Table_structure_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbutil();
        $this->db->query('use w1714855_0');
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
