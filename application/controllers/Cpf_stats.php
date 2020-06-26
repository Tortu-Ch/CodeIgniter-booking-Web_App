<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Cpf_stats extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cpf_stats_model');
        $this->page_data['page']->title = 'CPF STATS';
        $this->page_data['page']->menu = 'cpf_stats';
    }
    public function index()
    {
        ifPermissions('index_cpf');
        $today = date("d/m/Y");
        $todayArray = explode('/', $today);
        $this->page_data['page']->month=$todayArray[1].'/'.$todayArray[2];
        $this->page_data['page']->date='';
        $this->page_data['page']->sectorId=0;
        $this->page_data['page']->userId=0;
        $this->load->view('cpf_stats/index', $this->page_data);
    }

    public function form_refresh()
    {
        ifPermissions('form_refresh_cpf');
        $this->page_data['page']->month=$this->input->post('month');
        $this->page_data['page']->date=$this->input->post('date');
        $this->page_data['page']->sectorId=$this->input->post('sector');
        $this->page_data['page']->userId=$this->input->post('user');
        $this->load->view('cpf_stats/index', $this->page_data);
    }
}