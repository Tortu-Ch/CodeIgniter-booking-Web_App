<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Settings';
		$this->page_data['page']->menu = 'settings';
	}

	public function index()
	{
		$this->company();
	}

	public function company()
	{
		ifPermissions('company_settings');
		$this->page_data['settings'] = $this->roles_model->get();
		$this->page_data['page']->submenu = 'company';
		$this->load->view('settings/company', $this->page_data);
	}

	public function companyUpdate()
	{

		ifPermissions('company_settings');

		postAllowed();
		
		$this->settings_model->updateByKey('company_name', post('company_name'));
		$this->settings_model->updateByKey('company_email', post('company_email'));
		$this->settings_model->updateByKey('timezone', post('timezone'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Settings has been Updated Successfully');

		$this->activity_model->add("CPFd Settings Updated by User: #".logged('id'));
		
		redirect('settings/company');
	}

}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */