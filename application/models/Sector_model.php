<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sector_model extends MY_Model {

	public $table = 'sector';

	public function __construct()
	{
		parent::__construct();
	}

	  /**
     * This function is used to get the user sector information
     * @return array $result : This is result of the query
     */
    function getSectors()
    {
        $this->db->select('sectorId, sector');
        $this->db->from('sector');
        $this->db->where('sectorId !=', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
}

/* End of file Sector_model.php */
/* Location: ./application/models/Sector_model.php */