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

    function insert_record($data)
    {
        $this->drink_name =  $data[0];
        $this->drink_price = $data[1];
        $result = $this->db->get_where('drinks', array('drink_name' => $data[0]));
        if ($result->num_rows() === 0) {
            $this->db->insert('drinks', $this);
        }
    }
    function get_price($id)
    {
        $this->drink_id = $id;
        $query = $this->db->select(['drink_price', 'drink_name'])
            ->where('drink_id', $this->drink_id)
            ->get('drinks');
        //echo '<p class="text-white">' . json_encode($query->row_array()) . '</p>';
        return ($query->row_array());
    }
}
