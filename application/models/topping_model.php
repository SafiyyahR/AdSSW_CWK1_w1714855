<?php
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
        echo $result->num_rows();
        if ($result->num_rows() === 0) {
            if ($this->db->insert('toppings', $this)) {
                echo 'Entry inserted ';
            } else {
                echo 'Entry already inserted';
            }
        } else {
            echo 'Entry already inserted';
        }
    }
}
