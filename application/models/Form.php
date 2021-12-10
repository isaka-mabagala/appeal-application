<?php

class Form extends CI_Model {

	public function insert_data($data){
		
		//Insert data into database
		$this->db->insert('form', $data);
	}
}
