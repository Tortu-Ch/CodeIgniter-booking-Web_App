<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Add Category';
		$this->page_data['page']->menu = 'cate';
	}

	public function index()
	{
		
		ifPermissions('options_settings');

		$this->page_data['cate'] = $this->category_model->categoryListing();
		$this->load->view('category/list', $this->page_data);
	}


	public function add()
	{

		ifPermissions('options_settings');

		$this->load->view('category/add', $this->page_data);
	}

	public function edit($id)
	{

		ifPermissions('options_settings');

		$this->page_data['cate'] = $this->category_model->getBy('catId', $id);
		$this->load->view('category/edit', $this->page_data);

	}

	public function save()
	{
		
		postAllowed();

		ifPermissions('options_settings');

		$cate = $this->category_model->create([
				'category' => $this->input->post('category'),
  
		]);

		$this->activity_model->add("New category Created by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New category Created Successfully');
		
		redirect('category');

	}

	public function update($id)
	{
		
		postAllowed();

		ifPermissions('options_settings');

		$data = [
				'category' => $this->input->post('category'),
		];

		$cate = $this->category_model->update('catId', $id, $data);

		$this->activity_model->add("Category #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Category has been Updated Successfully');
		
		redirect('category');

	}

	public function delete($id)
	{

		ifPermissions('options_settings');

		$this->category_model->delete('catId', $id);

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Category has been Deleted Successfully');

		$this->activity_model->add("Category #$cate Deleted by User: #".logged('id'));

		redirect('category');

	}

}

/* End of file Category.php */
/* Location: ./application/controllers/Category.php */