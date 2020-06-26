<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ob_book_model extends MY_Model {

	public $table = 'tbl_ob_book';

	public function __construct()
	{
		parent::__construct();
	}

/**
     * This function is used to get the listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function obentryListing()
    {
        $this->db->select('BaseTbl.id, BaseTbl.ob_number, BaseTbl.date, BaseTbl.sapsVehicle, BaseTbl.incidentAddress, BaseTbl.description,  Category.category, Status.status, BaseTbl.statusId, Saps.sapsRating, User.username, Sector.sector');
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->from('tbl_ob_book as BaseTbl');
        $this->db->join('users as User', 'User.id = BaseTbl.userId','left');
        $this->db->join('tbl_category as Category', 'Category.catId = BaseTbl.catId','left');
        $this->db->join('tbl_sapsrating as Saps', 'Saps.id = BaseTbl.sapsRatingId','left');
        $this->db->join('tbl_ob_status as Status', 'Status.statusId = BaseTbl.statusId','left');
        $this->db->join('sector as Sector', 'Sector.sectorId = BaseTbl.sectorId','left');
        $this->db->where('BaseTbl.statusId !=', 0);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function obStatusListing()
    {
        $this->db->select('BaseTbl.id, BaseTbl.ob_number, BaseTbl.date, BaseTbl.sapsVehicle, BaseTbl.incidentAddress, BaseTbl.description,  Category.category, Status.status, BaseTbl.statusId, Saps.sapsRating, User.username, Sector.sector');
        $this->db->from('tbl_ob_book as BaseTbl');
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->join('users as User', 'User.id = BaseTbl.userId','left');
        $this->db->join('tbl_category as Category', 'Category.catId = BaseTbl.catId','left');
        $this->db->join('tbl_sapsrating as Saps', 'Saps.id = BaseTbl.sapsRatingId','left');
        $this->db->join('tbl_ob_status as Status', 'Status.statusId = BaseTbl.statusId','left');
        $this->db->join('sector as Sector', 'Sector.sectorId = BaseTbl.sectorId','left');
        $this->db->where('BaseTbl.statusId !=', 1);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

     function lookoutListing()
    {
        $this->db->select('BaseTbl.id, BaseTbl.ob_number, BaseTbl.date, BaseTbl.plate, BaseTbl.description,  Category.category, Status.status, BaseTbl.statusId, User.username, Sector.sector');
        $this->db->from('tbl_ob_book as BaseTbl');
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->join('users as User', 'User.id = BaseTbl.userId','left');
        $this->db->join('tbl_category as Category', 'Category.catId = BaseTbl.catId','left');
        $this->db->join('tbl_ob_status as Status', 'Status.statusId = BaseTbl.statusId','left');
        $this->db->join('sector as Sector', 'Sector.sectorId = BaseTbl.sectorId','left');
        $this->db->where('BaseTbl.catId =', 49);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    public function getLastEntry()
    {
        $this->load->database();
        $item = $this->db->order_by('id', 'DESC')
                         ->limit(1)
                         ->get('tbl_ob_book')
                         ->row();
        return $item;
    }

    //This function is used to count all on duty patrollers 

    public function countStatus()
    {
        //return $this->db->count_all_results($this->table);
        //$this->db->where('dutyTypeId !=', 2)
        $this->db->where('statusId !=', 1);
        $this->db->from('tbl_ob_book');
        return $this->db->count_all_results();
    }

    function topTenListing()
    {
        $this->db->select('Category.category');
        $this->db->from('tbl_ob_book as BaseTbl');
        $this->db->join('tbl_category as Category', 'Category.catId = BaseTbl.catId','left');
        $this->db->where('BaseTbl.catId !=', 34);
        $this->db->where('BaseTbl.catId !=', 35);
        $this->db->limit(5);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    public function statusType($status)
    {
        switch ($status) {
            case 1:
                return 'label-success';
            case 2:
                return 'label-warning';
            case 3:
                return 'label-danger';
            default:
                return null;
        }
    }


}

