<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pizza_model extends CI_Model
{
    public $pizza_id;
    public $pizza_name;
    public $pizza_description;
    public $pizza_pr_small;
    public $pizza_pr_medium;
    public $pizza_pr_large;

    public function __construct()
    {
        parent::__construct();
    }


    function get_price($data)
    {
        $this->pizza_id = $data['id'];
        $size = $data['size'];
        $query = $this->db->select(['pizza_pr_' . $size, 'pizza_name'])
            ->where('pizza_id', $this->pizza_id)
            ->get('pizza');
        return ($query->row_array());
    }
}
