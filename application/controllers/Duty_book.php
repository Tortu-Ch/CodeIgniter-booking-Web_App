<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duty_book extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Duty book';
		$this->page_data['page']->menu = 'duty';
	}

	public function index()
	{
		
		ifPermissions('list_duty');

		//$this->page_data['duty'] = $this->duty_book_model->get();
		//$data['Records'] = $this->ob_book_model->dutyListing();
		$this->page_data['Records'] = $this->duty_book_model->dutyListing();
		$this->load->view('duty_book/list', $this->page_data);
	}

	public function off_duty()
	{
		
		ifPermissions('list_duty');

		$this->page_data['Records'] = $this->duty_book_model->dutyListingb();
		$this->load->view('duty_book/list_off_duty', $this->page_data);
	}

	public function export_duty()
	{
		
		ifPermissions('export_table');

		$this->page_data['Records'] = $this->duty_book_model->dutyListingb();
		$this->load->view('duty_book/export_off_duty', $this->page_data);
	}

	public function view()
	{

		ifPermissions('view_ob');

		//$this->page_data['duty'] = $this->category_model->get($ud);
		//$this->page_data['duty'] = $this->users_model->getBy('id', $id);
		//$this->page_data['duty']->role = $this->roles_model->getByWhere([
		//	'id'=> $this->page_data['duty']->role
		//])[0];
		$this->load->view('duty_book/view', $this->page_data);

	}

	public function add()
	{

		ifPermissions('add_duty');

		$this->load->view('duty_book/add', $this->page_data);
	}

	public function edit($id)
	{

		ifPermissions('edit_duty');

		$this->page_data['duty'] = $this->duty_book_model->getBy('id', $id);
		$this->load->view('duty_book/edit', $this->page_data);

	}

	public function super_edit($id)
	{

		ifPermissions('super_edit_duty');

		$this->page_data['duty'] = $this->duty_book_model->getBy('id', $id);
		$this->load->view('duty_book/super_edit', $this->page_data);

	}

	public function save()
	{
		
		postAllowed();

		ifPermissions('add_duty');

		$duty = $this->duty_book_model->create([
				'on_ob_number' => $this->input->post('on_ob_number'),
                'onDutyTime' => $this->input->post('onDutyTime'),
                'dutyTypeId' => $this->input->post('dutyType'),
                'asId' => $this->input->post('bookOnAs'),
                'userId' => $this->input->post('username'),
                'comments' => $this->input->post('comments'),
                //'createdBy' => $this->input->post('.logged('id')'),
                'createdDtm'=>date('Y-m-d H:i:s'),
		]);

		$this->activity_model->add("New Duty Record Created by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New Duty Details Created Successfully');
		
		redirect('duty_book');

	}

	public function update($id)
	{
		
		postAllowed();

		ifPermissions('edit_duty');

		$data = [
				'on_ob_number' => $this->input->post('on_ob_number'),
				'off_ob_number' => $this->input->post('off_ob_number'),
                'onDutyTime' => $this->input->post('onDutyTime'),
                'offDutyTime' => $this->input->post('offDutyTime'),
                'dutyTypeId' => $this->input->post('dutyType'),
                'asId' => $this->input->post('bookOnAs'),
                'userId' => $this->input->post('username'),
                'comments' => $this->input->post('comments'),
                'updatedDtm'=>date('Y-m-d H:i:s'),
		];

		$duty = $this->duty_book_model->update($id, $data);

		$this->activity_model->add("Duty  #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Duty has been Updated Successfully');
		
		redirect('duty_book');

	}

	public function delete($id)
	{

		ifPermissions('delete_duty');

		$this->duty_book_model->delete('id', $id);

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Duty details has been Deleted Successfully');

		$this->activity_model->add("Duty #$id Deleted by User: #".logged('id'));

		redirect('duty_book');

	}

  public function check()
	{
		$on_ob_number = !empty(get('on_ob_number')) ? get('on_ob_number') : false;
		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;

		if($on_ob_number)
			$exists_on = count($this->duty_book_model->getByWhere([
					'on_ob_number' => $on_ob_number,
					'id !=' => $notId,
				])) > 0 ? true : false;

		if($on_ob_number)
			$exists_off = count($this->duty_book_model->getByWhere([
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
			$exists_on = count($this->duty_book_model->getByWhere([
					'on_ob_number' => $off_ob_number,
					'id !=' => $notId,
				])) > 0 ? true : false;

		if($off_ob_number)
			$exists_off = count($this->duty_book_model->getByWhere([
					'off_ob_number' => $off_ob_number,
					'id !=' => $notId,
				])) > 0 ? true : false;

		echo (($exists_on===true)||($exists_off===true)) ? 'false' : 'true';
	}

	public function check_duty()
	{
		$username = !empty(get('username')) ? get('username') : false;
		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;

		if($username)
			$exists = count($this->duty_book_model->getByWhere([
					'userId' => $username,
					'dutyTypeId' => 1,
					'id !=' => $notId,
				])) > 0 ? true : false;

		echo $exists ? 'false' : 'true';
	}

}

/* End of file Duty_book.php */
/* Location: ./application/controllers/Duty_book.php */