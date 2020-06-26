<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends MY_Model {

	public $table = 'activity_logs';

	public function __construct()
	{
		parent::__construct();
	}

	public function add($message, $user_id = 0, $ip_address = false)
	{
		return $this->create([
			'title' => $message,
			'user' => ($user_id==0) ? logged('id') : $user_id,
			'ip_address' => !empty($ip_address) ? $ip_address : ip_address()
		]);
	}

}

/* End of file Activity_model.php */
/* Location: ./application/models/Activity_model.php */