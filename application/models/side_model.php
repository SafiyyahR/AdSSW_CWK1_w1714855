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

    function insert_record($data)
    {
        $this->side_name =  $data[0];
        $this->side_price = $data[1];
        $result = $this->db->get_where('sides', array('side_name' => $data[0]));
        if ($result->num_rows() === 0) {
            $this->db->insert('sides', $this);
        }
    }
    function get_price($id)
    {
        $this->side_id = $id;
        $query = $this->db->select(['side_price', 'side_name'])
            ->where('side_id', $this->side_id)
            ->get('sides');
        //echo '<p class="text-white">' . json_encode($query->row_array()) . '</p>';
        return ($query->row_array());
    }
}
