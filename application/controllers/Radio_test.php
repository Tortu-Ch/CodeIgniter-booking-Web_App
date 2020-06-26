<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Radio_test extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'radio test';
		$this->page_data['page']->menu = 'radio';
	}

	public function index()
	{
		
		ifPermissions('list_radio');

		//$this->page_data['radio'] = $this->radio_test_model->get();
		//$data['Records'] = $this->ob_test_model->radioListing();
		$this->page_data['Records'] = $this->radio_test_model->radioListing();
		$this->load->view('radio_test/list', $this->page_data);
	}

	public function view()
	{

		ifPermissions('view_ob');

		//$this->page_data['radio'] = $this->category_model->get($ud);
		//$this->page_data['radio'] = $this->users_model->getBy('id', $id);
		//$this->page_data['radio']->role = $this->roles_model->getByWhere([
		//	'id'=> $this->page_data['radio']->role
		//])[0];
		$this->load->view('radio_test/view', $this->page_data);

	}

	public function add()
	{

		ifPermissions('add_radio');

		$this->load->view('radio_test/add', $this->page_data);
	}

	public function edit($id)
	{

		ifPermissions('edit_radio');

		$this->page_data['radio'] = $this->radio_test_model->getBy('id', $id);
		$this->load->view('radio_test/edit', $this->page_data);

	}

	public function save()
	{
		
		postAllowed();

		ifPermissions('add_radio');

		$radio = $this->radio_test_model->create([
				'on_ob_number' => $this->input->post('on_ob_number'),
                'onradioTime' => $this->input->post('onradioTime'),
                'radioTypeId' => $this->input->post('radioType'),
                'asId' => $this->input->post('testOnAs'),
                'userId' => $this->input->post('username'),
                'comments' => $this->input->post('comments'),
                'createdDtm'=>date('Y-m-d H:i:s'),
		]);

		$this->activity_model->add("New radio Created by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New radio Details Created Successfully');
		
		redirect('radio_test');

	}

	public function update($id)
	{
		
		postAllowed();

		ifPermissions('edit_radio');

		$data = [
				'on_ob_number' => $this->input->post('on_ob_number'),
				'off_ob_number' => $this->input->post('off_ob_number'),
                'onradioTime' => $this->input->post('onradioTime'),
                'offradioTime' => $this->input->post('offradioTime'),
                'radioTypeId' => $this->input->post('radioType'),
                'asId' => $this->input->post('testOnAs'),
                'userId' => $this->input->post('username'),
                'comments' => $this->input->post('comments'),
                'updatedDtm'=>date('Y-m-d H:i:s'),
		];

		$radio = $this->radio_test_model->update($id, $data);

		$this->activity_model->add("radio  #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'radio has been Updated Successfully');
		
		redirect('radio_test');

	}

	public function delete($id)
	{

		ifPermissions('delete_radio');

		$this->radio_test_model->delete('id', $id);

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'radio details has been Deleted Successfully');

		$this->activity_model->add("radio #$id Deleted by User: #".logged('id'));

		redirect('radio_test');

	}

  public function check()
	{
		$on_ob_number = !empty(get('on_ob_number')) ? get('on_ob_number') : false;
		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;

		if($on_ob_number)
			$exists_on = count($this->radio_test_model->getByWhere([
					'on_ob_number' => $on_ob_number,
					'id !=' => $notId,
				])) > 0 ? true : false;

		if($on_ob_number)
			$exists_off = count($this->radio_test_model->getByWhere([
					'off_ob_number' => $on_ob_number,
					'id !=' => $notId,
				])) > 0 ? true : false;

		echo (($exists_on===true)||($exists_off===true)) ? 'false' : 'true';
	}
	
	 public function checkoff()
	{
		$off_ob_number = !empty(get('off_ob_number')) ? get('off_ob_number') : false;
		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;

		if($off_ob_number)
			$exists_on = count($this->radio_test_model->getByWhere([
					'on_ob_number' => $off_ob_number,
					'id !=' => $notId,
				])) > 0 ? true : false;

		if($off_ob_number)
			$exists_off = count($this->radio_test_model->getByWhere([
					'off_ob_number' => $off_ob_number,
					'id !=' => $notId,
				])) > 0 ? true : false;

		echo (($exists_on===true)||($exists_off===true)) ? 'false' : 'true';
	}

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */