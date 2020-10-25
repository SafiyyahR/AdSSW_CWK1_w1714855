<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Side_Model extends CI_Model
{
    public $side_id;
    public $side_name;
    public $side_pr_small;
    public $side_pr_large;

    public function __construct()
    {
        parent::__construct();
    }

    function insert_record($data)
    {
        $this->side_name =  $data[0];
        $this->side_pr_small = $data[1];
        $this->side_pr_large = $data[2];
        $result = $this->db->get_where('sides', array('side_name' => $data[0]));
        if ($result->num_rows() === 0) {
            $this->db->insert('sides', $this);
        }
    }
    function get_price($data)
    {
        $this->side_id = $data['id'];
        $size = $data['size'];
        $query = $this->db->select(['side_pr_' . $size, 'side_name'])
            ->where('side_id', $this->side_id)
            ->get('sides');
        //echo '<p class="text-white">' . json_encode($query->row_array()) . '</p>';
        return ($query->row_array());
    }
}
