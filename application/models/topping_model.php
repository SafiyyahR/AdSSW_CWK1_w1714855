<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Topping_Model extends CI_Model
{
    public $topping_id;
    public $topping_name;
    public $topping_pr_small;
    public $topping_pr_medium;
    public $topping_pr_large;

    public function __construct()
    {
        parent::__construct();
    }

    function insert_record($data)
    {
        $this->topping_name =  $data[0];
        $this->topping_pr_small = $data[1];
        $this->topping_pr_medium = $data[2];
        $this->topping_pr_large = $data[3];
        $result = $this->db->get_where('toppings', array('topping_name' => $data[0]));
        if ($result->num_rows() === 0) {
            $this->db->insert('toppings', $this);
        }
    }
    function get_price($data)
    {
        $this->topping_id = $data['id'];
        $size = $data['size'];
        $query = $this->db->select(['topping_pr_' . $size, 'topping_name'])
            ->where('topping_id', $this->topping_id)
            ->get('toppings');
        //echo '<p class="text-white">' . json_encode($query->row_array()) . '</p>';
        return ($query->row_array());
    }
}
