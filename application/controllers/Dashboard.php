<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		$this->page_data['Records'] = $this->duty_book_model->onDutyListing();
		$this->page_data['Status'] = $this->ob_book_model->obStatusListing();
		$this->page_data['Data'] = $this->ob_book_model->topTenListing();
		$this->load->view('dashboard', $this->page_data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */