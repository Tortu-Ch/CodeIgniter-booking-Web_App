<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duty_book_model extends MY_Model {

	public $table = 'tbl_duty';

	public function __construct()
	{
		parent::__construct();
	}

	 function dutyListing()
    {
        $this->db->select('BaseTbl.id, BaseTbl.on_ob_number, BaseTbl.off_ob_number, BaseTbl.onDutyTime, BaseTbl.offDutyTime, BaseTbl.comments, DutyType.dutyType, DutyType.dutyTypeId, Users.username, Bookingon.bookOnAs');
        $this->db->from('tbl_duty as BaseTbl');
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->join('users as Users', 'Users.id = BaseTbl.userId','left');
       $this->db->join('tbl_duty_type as DutyType', 'DutyType.dutyTypeId = BaseTbl.dutyTypeId','left');
        $this->db->join('tbl_bookingontype as Bookingon', 'Bookingon.id = BaseTbl.asId','left');
        $this->db->where('BaseTbl.dutyTypeId !=', 2);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    function dutyListingb()
    {
        $this->db->select('BaseTbl.id, BaseTbl.on_ob_number, BaseTbl.off_ob_number, BaseTbl.onDutyTime, BaseTbl.offDutyTime, BaseTbl.comments, DutyType.dutyType, DutyType.dutyTypeId, Users.username, Bookingon.bookOnAs');
        $this->db->from('tbl_duty as BaseTbl');
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->join('users as Users', 'Users.id = BaseTbl.userId','left');
       $this->db->join('tbl_duty_type as DutyType', 'DutyType.dutyTypeId = BaseTbl.dutyTypeId','left');
        $this->db->join('tbl_bookingontype as Bookingon', 'Bookingon.id = BaseTbl.asId','left');
        $this->db->where('BaseTbl.dutyTypeId !=', 1);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    //This function is used to count all on duty patrollers 

    public function countOnDuty()
    {
        //return $this->db->count_all_results($this->table);
        //$this->db->where('dutyTypeId !=', 2)
        $this->db->like('dutyTypeId', '1');
        $this->db->from('tbl_duty');
        return $this->db->count_all_results();
    }

    //This table is see all on duty patrollers

     function onDutyListing()
    {
        $this->db->select('BaseTbl.id, BaseTbl.on_ob_number, BaseTbl.off_ob_number, BaseTbl.onDutyTime, BaseTbl.offDutyTime, BaseTbl.comments, DutyType.dutyType, DutyType.dutyTypeId, Users.username, Bookingon.bookOnAs');
        $this->db->from('tbl_duty as BaseTbl');
        $this->db->join('users as Users', 'Users.id = BaseTbl.userId','left');
       $this->db->join('tbl_duty_type as DutyType', 'DutyType.dutyTypeId = BaseTbl.dutyTypeId','left');
        $this->db->join('tbl_bookingontype as Bookingon', 'Bookingon.id = BaseTbl.asId','left');
        $this->db->where('BaseTbl.dutyTypeId !=', 2);
        //$this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    
    public function getLastEntry()
    {
        $this->load->database();
        $item = $this->db->order_by('id', 'DESC')
                         ->limit(1)
                         ->get('tbl_duty')
                         ->row();
        return $item;
    }


    public function dutyType($dutyType)
    {
        switch ($dutyType) {
            case 1:
                return 'label-success';
            case 2:
                return 'label-info';
            default:
                return null;
        }
    }




}

