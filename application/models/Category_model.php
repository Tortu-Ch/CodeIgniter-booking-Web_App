<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends MY_Model {

	public $table = 'tbl_category';

	public function __construct()
	{
		parent::__construct();
	}

	 function categoryListing()
    {
        $this->db->select('BaseTbl.catId, BaseTbl.category');
        $this->db->from('tbl_category as BaseTbl');
        $this->db->order_by('BaseTbl.category', 'ASC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

}

/* End of file Permissions_model.php */
/* Location: ./application/models/Permissions_model.php */