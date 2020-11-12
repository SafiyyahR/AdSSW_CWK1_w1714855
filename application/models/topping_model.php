<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Topping_model extends CI_Model
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

    function get_price($data)
    {
        $this->topping_id = $data['id'];
        $size = $data['size'];
        $query = $this->db->select(['topping_pr_' . $size, 'topping_name'])
            ->where('topping_id', $this->topping_id)
            ->get('toppings');
        return ($query->row_array());
    }
}
