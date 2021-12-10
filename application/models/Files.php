<?php

class Files extends CI_Model {

	public function insert_files($attachments){
		
		//Insert data into database
		$this->db->insert_batch('form_doc', $attachments);
		
	}

	public function comment_files($attachments){
		
		//Insert data into database
		$this->db->insert_batch('comment_doc', $attachments);
		
	}
}
