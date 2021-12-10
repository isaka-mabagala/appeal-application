<?php

class Comments extends CI_Model {

	public function insert_data($comment, $progress){
		
		//Insert data into database
		$this->db->insert('comments', $comment);
		$this->db->insert('progress', $progress);
	}
	
	public function update_data($comment, $form_id, $progress){
		
		//Insert data into database
		$this->db->insert('comments', $comment);
		
		//update data into progess
		$this->db->where('form_id', $form_id);
		$this->db->update('progress', $progress);
	}
}
