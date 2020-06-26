<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Cpf_stats_model extends MY_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function getSector($sectorId)
    {
        $this->db->select('sector.sectorId, sector.sector');
        $this->db->from('sector');
        if($sectorId>0)$this->db->where('sector.sectorId=', $sectorId);
        $this->db->order_by('sector.sectorId', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getUser($sectorId,$userId)
    {
        $this->db->select('users.id, users.username, users.sectorId');
        $this->db->from('users');
        if($userId)$this->db->where('users.id=', $userId);
        if($sectorId>0)$this->db->where('users.sectorId=', $sectorId);
        $this->db->order_by('users.username', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getDuty($month, $day, $userId, $asId)
    {
        $duty_time0 = null;
        $duty_time1 = null;
        if($month) {
            $duty_time  = explode('/', $month);
            $duty_time0 = $duty_time[1]."-".$duty_time[0]."-01 00:00:00";
            $duty_time1 = $duty_time[1]."-".$duty_time[0]."-31 23:59:59";
        }
        else
        {
            $duty_time0 = $day." 00:00:00";
            $duty_time1 = $day." 23:59:59";
        }

        $this->db->select('tbl_duty.onDutyTime, tbl_duty.offDutyTime');
        $this->db->from('tbl_duty');
        $this->db->where('tbl_duty.dutyTypeId !=',0);
        $this->db->where('tbl_duty.offDutyTime >',$duty_time0);
        $this->db->where('tbl_duty.offDutyTime <=',$duty_time1);
        if($userId)$this->db->where('tbl_duty.userId =',$userId);
        if($asId)$this->db->where('tbl_duty.asId =',$asId);
        $this->db->order_by('tbl_duty.id', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
}