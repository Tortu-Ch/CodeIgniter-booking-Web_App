<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Profile Management';
		$this->page_data['page']->menu = false;
	}

	public function index($tab = 'profile')
	{
		$this->page_data['user'] = $this->users_model->getBy('id', logged('id'));
		$this->page_data['user']->role = $this->roles_model->getBy('id', logged('role') );
		$this->page_data['activeTab'] = $tab;
		$this->load->view('account/profile', $this->page_data);
	}

	public function updateProfile()
	{

		$id = logged('id');
		
		postAllowed();

		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
		];

		$password = post('password');

		if(!empty($password))
			$data['password'] = md5($password);

		$id = $this->users_model->update($id, $data);

		$this->activity_model->add("User #$id Updated his/her Profile");

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Profile has been Updated Successfully');
		
		redirect('profile/index/edit');

	}

	public function updateProfilePic()
	{

		$id = logged('id');
		
		if (!empty($_FILES['image']['name'])) {

			$this->uploadlib->initialize([
				'file_name' => $id.'.png'
			]);

			$this->uploadlib->uploadImage('image', '/users');

		}

		$this->activity_model->add("User #$id Updated his/her Profile Image.");

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Profile Image has been Updated Successfully');

		redirect('profile/index/change_pic');

	}


}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */