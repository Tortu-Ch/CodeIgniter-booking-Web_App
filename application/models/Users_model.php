<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {

	public $table = 'users';

	public function login($data)
	{

		$data['password'] = md5($data['password']);

		$this->db->group_start();
			$this->db->where('username', $data['username']);
			$this->db->or_where('email', $data['username']);
		$this->db->group_end();

		$this->db->where('password', $data['password']);

		$query = $this->db->get_where($this->table)->row();

		if(!empty($query)){
			return $query;
		}

		return false;

	}


	public function login_attempt($row, $remember = false)
	{

		if($remember===false){
			$array = [
				'login' => true,
				'logged' => [
					'id' => $row->id,
					'name' => $row->name,
					'email' => $row->email,
					'phone' => $row->phone
				]
			];
			$this->session->set_userdata( $array );
		}else{

			$data = [
				'id' => $row->id,
				'name' => $row->name,
				'email' => $row->email,
				'phone' => $row->phone
			];
			set_cookie( 'login', true, ($expiry = strtotime('+30 days')) );
			set_cookie( 'logged', json_encode($data), $expiry );

		}

		$this->update($row->id, [
			'last_login' => date('Y-m-d H:m:i')
		]);

		$this->activity_model->add($row->name.' Logged in', $row->id);

	}

	public function logout()
	{
		// Deleting Sessions
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('logged');
		// Deleting Cookie
		delete_cookie('login');
		delete_cookie('logged');
	}
	
	 /**
     * This function is used to get the user sector information
     * @return array $result : This is result of the query
     */
    function getSectors()
    {
        $this->db->select('sectorId, sector');
        $this->db->from('sector');
        $this->db->where('sectorId !=', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

	public function resetPassword($data)
	{

		$this->db->where('username', $data['username']);
		$this->db->or_where('email', $data['username']);

		$user = $this->db->get_where($this->table)->row();

		if(!empty($user)){ }else{
			return 'invalid';
		}

		$password = $reset_token	=	password_hash((time().$user->id), PASSWORD_BCRYPT);

		$this->db->where('id', $user->id);
		$this->db->update($this->table, compact('reset_token', 'password'));

		$this->email->from(setting('company_email'), setting('company_name') );
		$this->email->to($user->email);

		$this->email->subject('Reset Your Account Password | ' . setting('company_name') );

		$reset_link = url('login/new_password?token='.$reset_token);

		$data = getEmailShortCodes();
		$data['user_id'] = $user->id;
		$data['user_name'] = $user->name;
		$data['user_email'] = $user->email;
		$data['user_username'] = $user->username;
		$data['reset_link'] = $reset_link;

		$html = $this->parser->parse('templates/email/reset', $data, true);

		$this->email->message( $html );

		$this->email->send();

		return true;

	}

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */