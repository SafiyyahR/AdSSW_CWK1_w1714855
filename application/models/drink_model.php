<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Drink_model extends CI_Model
{
    public $drink_id;
    public $drink_name;
    public $drink_price;

    public function __construct()
    {
        parent::__construct();
    }

   
    function get_price($id)
    {
        $this->drink_id = $id;
        $query = $this->db->select(['drink_price', 'drink_name'])
            ->where('drink_id', $this->drink_id)
            ->get('drinks');
        return ($query->row_array());
    }
}
