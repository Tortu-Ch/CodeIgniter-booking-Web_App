<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Radio_test_model extends MY_Model {

	public $table = 'tbl_radiotest';

	public function __construct()
	{
		parent::__construct();
	}

	public function getLastEntry()
    {
        $this->load->database();
        $item = $this->db->order_by('id', 'DESC')
                         ->limit(1)
                         ->get('tbl_radiotest')
                         ->row();
        return $item;
    }

     function radioListing()
    {
        $this->db->select('BaseTbl.id, BaseTbl.ob_number, TestType.testType, Users.username, BaseTbl.description, BaseTbl.radioTestDate');
        $this->db->from('tbl_radiotest as BaseTbl');
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->join('users as Users', 'Users.id = BaseTbl.userId','left');
       $this->db->join('tbl_radiotesttype as TestType', 'TestType.id = BaseTbl.radioTypeId','left');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

}

/* End of file Radio_test_model.php */
/* Location: ./application/models/Radio_test_model.php */