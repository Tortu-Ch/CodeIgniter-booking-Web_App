<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public $data;

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set( setting('timezone') );

		if( !empty($this->db->username) && !empty($this->db->hostname) && !empty($this->db->database) ){ }else{
			die('Database is not configured');
		}

		if(is_logged()){
			redirect('dashboard','refresh');
		}

		$this->data = [
			'assets' => assets_url(),
			'body_classes'	=> 'login-page-side login-background'
		];

	}

	public function index()
	{
		$this->load->view('account/login', $this->data, FALSE);
	}


	public function check()
	{

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
            return;
        }

        $username = post('username');
        $password = post('password');

        if( $username && $password && $attempt = $this->users_model->login( compact('username', 'password') )){

        	$this->users_model->login_attempt( $attempt, post('remember_me') );

        }else{

            $this->data['message'] = 'Invalid Email/Password';
            $this->data['message_type'] = 'danger';

			$this->load->view('account/login', $this->data, FALSE);
            return;
        }

        redirect('/','refresh');

	}

	public function forget()
	{
		$this->load->view('account/forget', $this->data, FALSE);
	}

	public function reset_password()
	{
		
		postAllowed();

		$this->form_validation->set_rules('username', 'Username', 'required');

		if($this->form_validation->run() == FALSE){
			$this->forget();
			return;
		}

		$reset = $this->users_model->resetPassword( [ 'username' => post('username') ] );

		$this->data['message']	=	'Email Sent to your registered email address ! Please check your email';
		$this->data['message_type']	=	'info';

		if($reset==='invalid'){
			$this->data['message']	=	'Invalid Email/Username';
			$this->data['message_type']	=	'danger';
		}

		$this->forget();

	}

	public function new_password()
	{
		$reset_token = !empty(get('token')) ? get('token') : false;

		$user = $this->users_model->getByWhere(['reset_token' => $reset_token]);

		if(!$reset_token || !$user || empty($user)){
			echo 'Invalid Request';
			redirect('login/forget', 'refresh'); return;
		}

		$user = $user[0];

		$this->data['user']	=	$user;

		$this->load->view('account/reset_password', $this->data, FALSE);

	}

	public function set_new_password()
	{

		postAllowed();

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|matches[password]');

		if($this->form_validation->run() == FALSE){
			$this->data['user']	=	$this->users_model->getByWhere(['reset_token' => post('token')])[0];
			$this->load->view('account/reset_password', $this->data, FALSE);
			return;
		}

		$reset_token = post('token');

		$user	=	$this->users_model->getByWhere(compact('reset_token'))[0];

		$this->users_model->update($user->id, [
			'password'	=>	md5(post('password')),
			'reset_token'	=>	'',
		]);

		$this->session->set_flashdata('message', 'New Password has been Updated, You can login now');
		$this->session->set_flashdata('message_type', 'success');
		redirect('login', 'refresh');

	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Admin/Login.php */