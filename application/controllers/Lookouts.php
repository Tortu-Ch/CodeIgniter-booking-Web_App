<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lookouts extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Lookouts';
		$this->page_data['page']->menu = 'obentry';
	}

	public function index()
	{
		
		ifPermissions('list_ob');
		$this->page_data['obentry'] = $this->ob_book_model->lookoutListing();
		$this->load->view('lookouts/list', $this->page_data);
	}

}

/* End of file Lookouts.php */
/* Location: ./application/controllers/Lookouts.php */