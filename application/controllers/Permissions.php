<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Permissions Management';
		$this->page_data['page']->menu = 'permissions';
	}

	public function index()
	{
		
		ifPermissions('permissions_list');

		$this->page_data['permissions'] = $this->permissions_model->get();
		$this->load->view('permissions/list', $this->page_data);
	}

	public function add()
	{

		ifPermissions('permissions_add');

		$this->load->view('permissions/add', $this->page_data);
	}

	public function edit($id)
	{

		ifPermissions('permissions_edit');

		$this->page_data['permission'] = $this->permissions_model->getBy('id', $id);
		$this->load->view('permissions/edit', $this->page_data);

	}

	public function save()
	{
		
		postAllowed();

		ifPermissions('permissions_add');

		$permission = $this->permissions_model->create([
			'title' => $this->input->post('name'),
			'code' => $this->input->post('code'),
		]);

		$this->activity_model->add("New Permission #$permission Created by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New Permission Created Successfully');
		
		redirect('permissions');

	}

	public function update($id)
	{
		
		postAllowed();

		ifPermissions('permissions_edit');

		$data = [
			'title' => $this->input->post('name'),
			'code' => $this->input->post('code'),
		];

		$permission = $this->permissions_model->update($id, $data);

		$this->activity_model->add("Permission #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Permission has been Updated Successfully');
		
		redirect('permissions');

	}

	public function delete($id)
	{

		ifPermissions('permissions_delete');

		$this->permissions_model->delete('id', $id);

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Permission has been Deleted Successfully');

		$this->activity_model->add("Permission #$permission Deleted by User: #".logged('id'));

		redirect('permissions');

	}

	public function checkIfUnique()
	{
		
		$code = get('code');

		if(!$code)
			die('Invalid Request');

		$arg = [ 'code' => $code ];

		if(!empty(get('notId')))
			$arg['id !='] = get('notId');

		$query = $this->permissions_model->getByWhere($arg);

		if(!empty($query))
			die('false');
		else
			die('true');
		

	}

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */