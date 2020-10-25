<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pizza_Model extends CI_Model
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

    function insert_record($data)
    {
        $this->pizza_name =  $data[0];
        $this->pizza_description = $data[1];
        $this->pizza_pr_small = $data[2];
        $this->pizza_pr_medium = $data[3];
        $this->pizza_pr_large = $data[4];
        $result = $this->db->get_where('pizza', array('pizza_name' => $data[0]));
        echo $result->num_rows();
        if ($result->num_rows() === 0) {
            if ($this->db->insert('pizza', $this)) {
                echo 'Entry inserted ';
            } else {
                echo 'Entry already inserted';
            }
        } else {
            echo 'Entry already inserted';
        }
    }

    function get_price($data)
    {
        $this->pizza_id = $data['id'];
        $size = $data['size'];
        $query = $this->db->select('pizza_pr_' . $size)
            ->where('pizza_id', $this->pizza_id)
            ->get('pizza');
        echo '<p class="text-white">' . json_encode($query->row_array()) . '</p>';
        return ($query->row_array());
    }
}
