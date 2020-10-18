<?php
class Pizza_Model extends CI_Model
{
    public $pizza_id;
    public $pizza_name;
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
        $this->pizza_pr_small = $data[1];
        $this->pizza_pr_medium = $data[2];
        $this->pizza_pr_large = $data[3];
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
}
