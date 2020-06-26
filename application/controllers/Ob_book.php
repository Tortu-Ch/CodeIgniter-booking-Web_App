<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ob_book extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Incident Book';
		$this->page_data['page']->menu = 'obentry';
	}

	public function index()
	{
		
		ifPermissions('list_ob');
		$this->page_data['obentry'] = $this->ob_book_model->obentryListing();
		$this->load->view('ob_book/list', $this->page_data);
	}


	public function add()
	{

		ifPermissions('add_ob');

		$this->load->view('ob_book/add', $this->page_data);
	}

	public function view($id)
	{

		ifPermissions('view_ob');

		$this->page_data['obentry'] = $this->ob_book_model->getBy('id', $id);
		$this->page_data['obentry']->catId = $this->category_model->getByWhere([
		'catId'=> $this->page_data['obentry']->catId
		])[0];
		$this->page_data['obentry']->sectorId = $this->sector_model->getByWhere([
		'sectorId'=> $this->page_data['obentry']->sectorId
		])[0];
		$this->page_data['obentry']->userId = $this->users_model->getByWhere([
		'id'=> $this->page_data['obentry']->userId
		])[0];
		$this->page_data['obentry']->statusId = $this->Ob_status_model->getByWhere([
		'statusId '=> $this->page_data['obentry']->statusId
		])[0];
		$this->load->view('ob_book/view', $this->page_data);

	}

	public function edit($id)
	{

		ifPermissions('edit_ob');

		$this->page_data['obentry'] = $this->ob_book_model->getBy('id', $id);
		$this->load->view('ob_book/edit', $this->page_data);

	}

	public function save()
	{
		
		postAllowed();

		ifPermissions('add_ob');

		$obentry = $this->ob_book_model->create([
			'ob_number' => $this->input->post('ob_number'),
                'date' => $this->input->post('date'),
                'catId' => $this->input->post('category'),
                'sapsRatingId' => $this->input->post('sapsRating'),
                'sapsVehicle' => $this->input->post('sapsVehicle'),
                'sectorId' => $this->input->post('sector'),
                'statusId' => $this->input->post('status'),
                'obcreatedDtm' =>date('Y-m-d H:i:s'),
                'userId' => $this->input->post('username'),
                'incidentAddress' => $this->input->post('incidentAddress'),
                'plate' => $this->input->post('plate'),
                'description' => $this->input->post('description'),
		]);

		$this->activity_model->add("New OB Created by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New OB Created Successfully');
		
		redirect('ob_book');

	}

	public function update($id)
	{
		
		postAllowed();

		ifPermissions('edit_ob');

		$data = [
				'ob_number' => $this->input->post('ob_number'),
                'date' => $this->input->post('date'),
                'catId' => $this->input->post('category'),
                'sapsRatingId' => $this->input->post('sapsRating'),
                'sectorId' => $this->input->post('sector'),
                'statusId' => $this->input->post('status'),
                'sapsVehicle' => $this->input->post('sapsVehicle'),
                'userId' => $this->input->post('username'),
                'plate' => $this->input->post('plate'),
                'incidentAddress' => $this->input->post('incidentAddress'),
                'description' => $this->input->post('description')
		];

		$obentry = $this->ob_book_model->update($id, $data);

		$this->activity_model->add("ob_book #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Ob Entry has been Updated Successfully');
		
		redirect('ob_book');

	}

	public function delete($id)
	{

		ifPermissions('delete_ob');

		$this->ob_book_model->delete('id', $id);

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Ob entry has been Deleted Successfully');

		$this->activity_model->add("OB entry #$id Deleted by User: #".logged('id'));

		redirect('ob_book');

	}

	public function checkIfUnique()
	{
		
		$ob_number = get('ob_number');

		if(!$ob_number)
			die('Invalid Request');

		$arg = [ 'ob_number' => $ob_number ];

		if(!empty(get('notId')))
			$arg['obId !='] = get('notId');

		$query = $this->ob_book_model->getByWhere($arg);

		if(!empty($query))
			die('false');
		else
			die('true');
		

	}

	public function check()
	{
		$ob_number = !empty(get('ob_number')) ? get('ob_number') : false;
		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;

		if($ob_number)
			$exists = count($this->ob_book_model->getByWhere([
					'ob_number' => $ob_number,
					'id !=' => $notId,
				])) > 0 ? true : false;

		echo $exists ? 'false' : 'true';
	}

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */