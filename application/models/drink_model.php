<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Drink_Model extends CI_Model
{
    public $drink_id;
    public $drink_name;
    public $drink_pr_small;
    public $drink_pr_large;

    public function __construct()    {
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
}
