<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {

	public $product_db = null;
	
	/**
     * construct
     */
	public function __construct() {
        parent::__construct();
		
		$this->product_db = $this->load->database("product", TRUE);
		
    }

	/**
	 *
	 * @param array product_data	
	 * 
	 * @return int product_id
	 */
	public function add($product_data) {

		$sql = "INSERT INTO user 
					SET product_name = '".$this->product_db->escape_str($product_data['product_name'])."',
						package_id = '".$this->product_db->escape_str($product_data['package_id'])."',	
						price = '".$this->product_db->escape_str($product_data['price'])."',	
						unit = '".$this->product_db->escape_str($product_data['unit'])."',
						createtime = '".date("Y-m-d H:i:s", time())."'";
		$this->product_db->query($sql);
		
		return $this->product_db->insert_id();
	}
		
	public function update($product_id, $product_data) {
		$sql = "UPDATE INTO user 
					SET product_name = '".$this->product_db->escape_str($product_data['product_name'])."',
						package_id = '".$this->product_db->escape_str($product_data['package_id'])."',	
						price = '".$this->product_db->escape_str($product_data['price'])."',	
						unit = '".$this->product_db->escape_str($product_data['unit'])."',
					WHERE package_id = '".$package_id."'";
		$this->product_db->query($sql);
		
	}
	
	public function get($product_id) {
		
		$sql = "SELECT * FROM product WHERE product_id = '".$this->product_db->escape_str($product_id)."'";
		$this->product_db->query($sql);
		$rs = $this->product_db->query($sql);
		
		if ($rs->num_rows() > 0)
		{
			$row = $rs->row_array();
		}
		
		$rs->free_result();
		
		return $row;
	}
	
	public function remove($product_id) {
		$sql = "DELETE FROM product WHERE product_id = '".$product_id."'";
		$this->product_db->query($sql);
	}
	
	public function exist($product_id) {

		$sql = "SELECT product_id FROM product WHERE product_id = '".$product_id."'";
		$this->product_db->query($sql);
		$rs = $this->product_db->query($sql);
		
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