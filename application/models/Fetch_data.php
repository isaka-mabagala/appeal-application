<?php

class Fetch_data extends CI_Model 
{
	public function user_profile()
	{
		//select users details
		$query = $this->db->get('users');
		return $query;
	}

	public function student_info($reg_no)
	{
		//check student registration
		$this->db->select('*');
		$this->db->where('reg_no', $reg_no);
		$query = $this->db->get('students');
		
		if ($query->num_rows() > 0)
		{
			return $query;
		}
		else {
			return false;
		}
	}
	
	public function appeal_form()
	{
		//select appeal details
		$query = $this->db->query("
			SELECT * 
			FROM form
			ORDER BY id DESC
		");
		return $query;
	}
	
	public function check_user($email,$password)
	{
		$pass = base64_encode($password);
		
		//check user login
		$this->db->select('id');
		$this->db->where('email', $email);
		$this->db->where('password', $pass);
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}

	public function check_student($reg_no)
	{
		//check student registration
		$this->db->select('reg_no');
		$this->db->where('reg_no', $reg_no);
		$query = $this->db->get('students');
		
		if ($query->num_rows() > 0)
		{
			echo 'true';
		}
		else {
			echo 'false';
		}
	}

	public function get_form_id($time)
	{
		//check form id
		$this->db->select('id');
		$this->db->where('date', $time);
		$query = $this->db->get('form');
		
		if ($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}

	public function get_comment_id($user_id)
	{
		//select comment id
		$query = $this->db->query("
			SELECT MAX(id) AS id
			FROM comments
			WHERE user_id = $user_id
		");
		
		return $query;
	}
	
}
