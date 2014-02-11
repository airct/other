<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	/**
	 * user_id
	 */
	public $user_id = null;
	
	public $user_db = null;
	
	/**
     * construct
     */
	public function __construct() {
        parent::__construct();
		
		$this->user_db = $this->load->database("user", TRUE);
		
    }

	/**
	 * 註冊新的使用者
	 *
	 * @param array user_data	
	 * 
	 * @return int user_id
	 */
	public function regsister($user_data) {

		return $this->add($user_data);
	}
	
	public function add($user_data) {
		
		$sql = "INSERT INTO user 
					SET facebook_id 	= '".$this->user_db->escape_str($user_data['facebook_id'])."',
						google_id		= '".$this->user_db->escape_str($user_data['google_id'])."',	
						createtime 		= '".date("Y-m-d H:i:s", time())."',
						last_login_time = '".date("Y-m-d H:i:s", time())."'";
		$this->user_db->query($sql);
		
		$this->user_id = $this->user_db->insert_id();
		
		return $this->user_id;
	}
	
	public function login($user_id) {
		$sql = "UPDATE user SET last_login_time = '".date("Y-m-d H:i:s", time())."' WHERE user_id = '".$this->user_db->escape_str($user_id)."'";
		$this->user_db->query($sql);
	}
	
	public function get($user_id) {
		
		$sql = "SELECT * FROM user WHERE user_id = '".$this->user_db->escape_str($user_id)."'";
		$this->user_db->query($sql);
		$rs = $this->user_db->query($sql);
		
		if ($rs->num_rows() > 0)
		{
			$row = $rs->row_array();
		}
		
		$rs->free_result();
		
		return $row;
	}
	
	public function exist($identification, $provider) {

		if($provider == "facebook") {
			$sql = "SELECT user_id FROM user WHERE facebook_id = '".$identification."'";
		}
		
		if($provider == "google") {
			$sql = "SELECT user_id FROM user WHERE google_id = '".$identification."'";
		}
		
		$this->user_db->query($sql);
		$rs = $this->user_db->query($sql);
		
		if ($rs->num_rows() > 0)
		{
			return true;
		}
		
		return false;
	}
	
	public function add_friend($user_id, $friend_user_id) {
		
	}
	
	public function get_user_id($identification, $provider) {

		if($provider == "facebook") {
			$sql = "SELECT user_id FROM user WHERE facebook_id = '".$identification."'";
		}
		
		if($provider == "google") {
			$sql = "SELECT user_id FROM user WHERE google_id = '".$identification."'";
		}
		
		$this->user_db->query($sql);
		$rs = $this->user_db->query($sql);
		
		if ($rs->num_rows() > 0)
		{
			$row = $rs->row_array();
			
			return $row['user_id'];
		}
		
		show_error('user identification error:' . $identification);
	}
}


/* End of file user_model.php */
/* Location: ./application/models/user_model.php */