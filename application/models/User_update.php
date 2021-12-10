<?php

class User_update extends CI_Model {
	
	public function password($new_password, $id){
		
		$this->db->where('id', $id);
		$this->db->update('users', $new_password);
	}
	
	public function image($image, $id){
		
		$this->db->where('id', $id);
		$this->db->update('users', $image);
	}
	
}
