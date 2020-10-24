<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Drink_Model extends CI_Model
{
    public $drink_id;
    public $drink_name;
    public $drink_pr_small;
    public $drink_pr_large;

    public function __construct()
    {
        parent::__construct();
    }

    function insert_record($data)
    {
        $this->drink_name =  $data[0];
        $this->drink_pr_small = $data[1];
        $this->drink_pr_large = $data[2];
        $result = $this->db->get_where('drinks', array('drink_name' => $data[0]));
        echo $result->num_rows();
        if ($result->num_rows() === 0) {
            if ($this->db->insert('drinks', $this)) {
                echo 'Entry inserted ';
            } else {
                echo 'Entry error';
            }
        } else {
            echo 'Entry already inserted';
        }
    }
    function get_price($data)
    {
        $this->drink_id = $data['id'];
        $size = $data['size'];
        $query = $this->db->select('drink_pr_' . $size)
            ->where('drink_id', $this->drink_id)
            ->get('drinks');
        echo '<p class="text-white">' . json_encode($query->result()) . '</p>';
    }
}
