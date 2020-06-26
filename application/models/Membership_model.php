<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_model extends MY_Model {

	public $table = 'membership';

	public function __construct()
	{
		parent::__construct();
	}

	  /**
     * This function is used to get the user sector information
     * @return array $result : This is result of the query
     */
    function getMembership()
    {
        $this->db->select('membershipId, membership');
        $this->db->from('membership');
        $this->db->where('membershipId !=', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
}

/* End of file Sector_model.php */
/* Location: ./application/models/Sector_model.php */