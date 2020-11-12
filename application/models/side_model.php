<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Side_model extends CI_Model
{
    public $side_id;
    public $side_name;
    public $side_price;

    public function __construct()
    {
        parent::__construct();
    }


    function get_price($id)
    {
        $this->side_id = $id;
        $query = $this->db->select(['side_price', 'side_name'])
            ->where('side_id', $this->side_id)
            ->get('sides');
        return ($query->row_array());
    }
}
