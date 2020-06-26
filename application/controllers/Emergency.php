<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergency extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Emergency Book';
		$this->page_data['page']->menu = 'emerg';
	}

	public function index()
	{
		
		ifPermissions('list_emerg');

		$this->page_data['emerg'] = $this->emergency_model->get();
		//$this->page_data['emerg'] = $this->emergency_model->getByWhere([
		//	'obId'=> $obId
		//], [ 'order' => ['obId', 'desc'] ]);
		$this->load->view('emergency/list', $this->page_data);
	}


	public function add()
	{

		ifPermissions('add_emerg');

		$this->load->view('emergency/add', $this->page_data);
	}

	public function edit($id)
	{

		ifPermissions('edit_emerg');

		$this->page_data['emerg'] = $this->emergency_model->getBy('id', $id);
		$this->load->view('emergency/edit', $this->page_data);

	}

	public function save()
	{
		
		postAllowed();

		ifPermissions('add_emerg');

		$emerg = $this->emergency_model->create([
				'primaryContact' => $this->input->post('primaryContact'),
                'primaryContactNumber' => $this->input->post('primaryContactNumber'),
                'comSop' => $this->input->post('comSop'),
                'institution' => $this->input->post('institution'),
		]);

		$this->activity_model->add("New Contact Details Created by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New Contact Details Created Successfully');
		
		redirect('emergency');

	}

	public function update($id)
	{
		
		postAllowed();

		ifPermissions('edit_emerg');

		$data = [
				'primaryContact' => $this->input->post('primaryContact'),
                'primaryContactNumber' => $this->input->post('primaryContactNumber'),
                'comSop' => $this->input->post('comSop'),
                'institution' => $this->input->post('institution'),
		];

		$emerg = $this->emergency_model->update($id, $data);

		$this->activity_model->add("Emergency Conatc #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Emergency Conatc has been Updated Successfully');
		
		redirect('emergency');

	}

	public function delete($id)
	{

		ifPermissions('delete_emerg');

		$this->emergency_model->delete('id', $id);

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Contact details has been Deleted Successfully');

		$this->activity_model->add("Contact details #$emerg Deleted by User: #".logged('id'));

		redirect('emergency');

	}

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */