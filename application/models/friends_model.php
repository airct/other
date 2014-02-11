<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends_model extends CI_Model {

	public $product_db = null;
	
	/**
     * construct
     */
	public function __construct() {
        parent::__construct();
		
		$this->friends_db = $this->load->database("rel_friends", TRUE);
		
    }

	/**
	 *
	 * @param array rel_friends_data	
	 * 
	 * @return int package_id
	 */
	public function add($rel_friends_data) {

		$sql = "INSERT INTO rel_friends 
					SET user_id = '".$this->friends_db->escape_str($rel_friends_data['user_id'])."',
						friend_user_id = '".$this->friends_db->escape_str($rel_friends_data['friend_user_id'])."'";
		$this->friends_db->query($sql);
		
		return $this->friends_db->insert_id();
	}
		
	public function update($rel_friends_id, $rel_friends_data) {
		$sql = "UPDATE rel_friends 
					SET user_id = '".$this->friends_db->escape_str($rel_friends_data['user_id'])."',
						friend_user_id = '".$this->friends_db->escape_str($rel_friends_data['friend_user_id'])."',
					WHERE rel_friends_id = '".$rel_friends_id."'";
		$this->friends_db->query($sql);
	}
	
	public function get($rel_friends_id) {
		
		$sql = "SELECT * FROM rel_friends WHERE rel_friends_id = '".$this->friends_db->escape_str($rel_friends_id)."'";
		$this->friends_db->query($sql);
		$rs = $this->friends_db->query($sql);
		
		if ($rs->num_rows() > 0)
		{
			$row = $rs->row_array();
		}
		
		$rs->free_result();
		
		return $row;
	}
	
	public function remove($rel_friends_id) {
		$sql = "DELETE FROM rel_friends WHERE rel_friends_id = '".$rel_friends_id."'";
		$this->friends_db->query($sql);
	}
	
	public function exist($rel_friends_id) {

		$sql = "SELECT rel_friends_id FROM rel_friends WHERE rel_friends_id = '".$rel_friends_id."'";
		$this->friends_db->query($sql);
		$rs = $this->friends_db->query($sql);
		
		if ($rs->num_rows() > 0)
		{
			return true;
		}
		
		return false;
	}

	// show_error('user identification error:' . $identification);

}


/* End of file user_model.php */
/* Location: ./application/models/user_model.php */