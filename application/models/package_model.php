<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package_model extends CI_Model {

	public $product_db = null;
	
	/**
     * construct
     */
	public function __construct() {
        parent::__construct();
		
		$this->package_db = $this->load->database("package", TRUE);
		
    }

	/**
	 *
	 * @param array package_data	
	 * 
	 * @return int package_id
	 */
	public function add($package_data) {

		$sql = "INSERT INTO package 
					SET user_id = '".$this->package_db->escape_str($package_data['user_id'])."',
						createtime = '".date("Y-m-d H:i:s", time())."'";
		$this->package_db->query($sql);
		
		return $this->package_db->insert_id();
	}
		
	public function update($package_id, $package_data) {
		$sql = "UPDATE package 
					SET user_id = '".$this->package_db->escape_str($package_data['user_id'])."',
					WHERE package_id = '".$package_id."'";
		$this->package_db->query($sql);
		
	}
	
	public function get($package_id) {
		
		$sql = "SELECT * FROM package WHERE package_id = '".$this->package_db->escape_str($package_id)."'";
		$this->package_db->query($sql);
		$rs = $this->package_db->query($sql);
		
		if ($rs->num_rows() > 0)
		{
			$row = $rs->row_array();
		}
		
		$rs->free_result();
		
		return $row;
	}
	
	public function remove($package_id) {
		$sql = "DELETE FROM package WHERE package_id = '".$package_id."'";
		$this->package_db->query($sql);
	}
	
	public function exist($package_id) {

		$sql = "SELECT package_id FROM package WHERE package_id = '".$package_id."'";
		$this->package_db->query($sql);
		$rs = $this->package_db->query($sql);
		
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