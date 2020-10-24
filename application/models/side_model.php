<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        echo $result->num_rows();
        if ($result->num_rows() === 0) {
            if ($this->db->insert('sides', $this)) {
                echo 'Entry inserted ';
            } else {
                echo 'Entry Error';
            }
        } else {
            echo 'Entry already inserted';
        }
    }
    function get_price($data)
    {
        $this->side_id = $data['id'];
        $size = $data['size'];
        $query = $this->db->select('side_pr_' . $size)
            ->where('side_id', $this->side_id)
            ->get('sides');
        echo '<p class="text-white">' . json_encode($query->result()) . '</p>';
    }
}
