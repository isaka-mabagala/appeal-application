<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function index($page = 'dashboard')
	{
		if (!file_exists( APPPATH.'views/admin/pages/'.$page.'.php'))
		{
			show_404();
		}

		$this->load->model('fetch_data');
		$data['user_detail'] = $this->fetch_data->user_profile();
		$data['appeal_detail'] = $this->fetch_data->appeal_form();
		
		$this->load->view('admin/header');
		$this->load->view('admin/pages/'.$page, $data);
		$this->load->view('admin/footer');
	}
	
	public function login()
	{
		$this->load->view('admin/login');
	}
	
	public function user_login()
	{
		if ($this->input->post('remember') == 'on')
		{
			$login_session = array(
			
				'remember_password'		=> 'on',
				'email'					=> $this->input->post('email'),
				'password'				=> $this->input->post('password')
			);
			
			$this->session->set_userdata($login_session);
		}
		else 
		{
			if ($this->session->has_userdata('remember_password'))
			{
				$login_session = array('remember_password', 'email', 'password');
				$this->session->unset_userdata($login_session);
			}
		}
		
		$this->load->model('fetch_data');
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		if ($data['check_user'] = $this->fetch_data->check_user($email,$password))
		{
			foreach ($data['check_user']->result() as $row)
			{
				$this->session->set_userdata('user_id', $row->id);
				redirect(base_url().'dashboard');
				exit;
			}
		}
		else 
		{
			$this->session->set_userdata('login_error', 'Email or password not correct');
			redirect(base_url().'login');
			exit;
		}
		
	}
	
	public function logout()
	{
		//user log out
		$this->session->unset_userdata('user_id');
		redirect(base_url().'login');
	}
	
	public function user_comment()
	{
		$this->load->model('comments');
		
		$comment		 = $this->input->post('comment');
		$stud_reg_no	 = $this->input->post('reg-no');
		$form_id		 = $this->input->post('form-id');
		$user_id		 = $this->session->userdata('user_id');
		$url			 = $this->session->userdata('previous_url');
			
		if ($user_id == '1')
		{
			$attachments = '';
			
			if (!empty(implode(', ', $_FILES['files']['name'])))
			{
				$data = array();
				$filesCount = count($_FILES['files']['name']);
				
				for ($i = 0; $i < $filesCount; $i++)
				{
					$_FILES['file']['name']      = $_FILES['files']['name'][$i];
					$_FILES['file']['type']      = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name']  = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error']     = $_FILES['files']['error'][$i];
					$_FILES['file']['size']      = $_FILES['files']['size'][$i];
					
					// File upload configuration
					$uploadPath = 'assets/files/comments/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf|jpg|png';
					
					// Load and initialize upload library
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					// Upload file to server
					if ($this->upload->do_upload('file'))
					{
						// Uploaded file data
						$fileData = $this->upload->data(); // Uploaded file data to folder
						
						$showfiles[$i] = $fileData['file_name'];
					}
				}
				$attachments = $showfiles;
				
			}
			
			//comment
			$comment = array(
				'user_id'			=> $user_id,
				'stud_reg_no'		=> $stud_reg_no,
				'comment'			=> $comment
			);

			$progress = array(
				'form_id'			=> $form_id,
				'academic_advisor'	=> '1'
			);
			$this->comments->insert_data($comment, $progress);

			$this->load->model('fetch_data'); //fetch comment id

			$comment_id = $this->fetch_data->get_comment_id($user_id);
			foreach ($comment_id->result() as $row)
			{
				$comment_id = $row->id;
			}

			if (!empty($attachments))
			{
				$this->load->model('files'); //load model files

				$insertFiles = array();
				foreach ($attachments as $val)
				{
					$insertFiles[] = array(
						'comment_id'	=> $comment_id,
						'document'		=> $val
					);
				}
				$this->files->comment_files($insertFiles);
			}
			
			$this->session->unset_userdata('previous_url');
			redirect($url);
			exit;
		}
		
		switch($user_id)
		{
			case 2: 
				$commenter = 'head_department';
				break;
			
			case 3:
				$commenter = 'dean_faculty';
				break;
			
			case 4:
				$commenter = 'dean_students';
				break;
		}
		
		$attachments = '';
		
		if (!empty(implode(', ', $_FILES['files']['name'])))
		{
			$data = array();
			$filesCount = count($_FILES['files']['name']);
			
			for ($i = 0; $i < $filesCount; $i++)
			{
				$_FILES['file']['name']      = $_FILES['files']['name'][$i];
				$_FILES['file']['type']      = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name']  = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error']     = $_FILES['files']['error'][$i];
				$_FILES['file']['size']      = $_FILES['files']['size'][$i];
				
				// File upload configuration
				$uploadPath = 'assets/files/comments/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf|jpg|png';
				
				// Load and initialize upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				// Upload file to server
				if ($this->upload->do_upload('file'))
				{
					// Uploaded file data
					$fileData = $this->upload->data(); // Uploaded file data to folder
					
					$showfiles[$i] = $fileData['file_name'];
				}
			}
			$attachments = $showfiles;
			
		}
		
		//comment
		$comment = array(
			'user_id'			=> $user_id,
			'stud_reg_no'		=> $stud_reg_no,
			'comment'			=> $comment
		);
		$progress = array(
			$commenter			=> '1'
		);
		$this->comments->update_data($comment, $form_id, $progress);

		$this->load->model('fetch_data'); //fetch comment id

		$comment_id = $this->fetch_data->get_comment_id($user_id);
		foreach ($comment_id->result() as $row)
		{
			$comment_id = $row->id;
		}

		if (!empty($attachments))
		{
			$this->load->model('files'); //load model files

			$insertFiles = array();
			foreach ($attachments as $val)
			{
				$insertFiles[] = array(
					'comment_id'	=> $comment_id,
					'document'		=> $val
				);
			}
			$this->files->comment_files($insertFiles);
		}
		
		$this->session->unset_userdata('previous_url');
		redirect($url);
		exit;
	}
	
	public function user_update()
	{
		$this->load->model('user_update');
		
		//update password
		if ($this->input->post('new_pass'))
		{
			$id = $this->session->userdata('user_id');
			$current_pass = $this->input->post('current_pass');
			
			$this->load->model('fetch_data');
			$user_detail = $this->fetch_data->user_profile();
			
			foreach ($user_detail->result() as $row)
			{
				if ($row->id == $id)
				{
					$password = base64_decode($row->password);
					if ($current_pass == $password)
					{	
						$new_password = array(
							'password'		=> base64_encode($this->input->post('new_pass'))
						);
						$this->user_update->password($new_password, $id);
						
						$this->session->set_flashdata('update_info', 'Password updated successful');
						redirect(base_url().'dashboard/user_edit');
					}
					else
					{
						$this->session->set_flashdata('update_info', 'UNSUCCESSFUL, Incorrect user password');
						redirect(base_url().'dashboard/user_edit');
					}
					
				}
			}
			
			exit;
		}
		
		//update profile image
		if ($this->input->post('imageUpload'))
		{
			$id = $this->session->userdata('user_id');
				
			$config['upload_path'] = 'assets/images/users/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('imageFile'))
			{
				$data = $this->upload->data();
				
				//resize image
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/images/users/'.$data['file_name'];
				$config['create_thumb'] = FALSE;
				$config['quality'] = '100%';
				$config['width'] = 400;
				$config['height'] = 400;
				$config['new_image'] = 'assets/images/users/'.$data['file_name'];
				
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
				//unlink image old image from folder
				$this->load->model('fetch_data');
				$user_detail = $this->fetch_data->user_profile();
				
				foreach ($user_detail->result() as $row)
				{
					if ($row->id == $id)
					{
						$imagefile = $row->image;
						unlink('assets/images/users/'.$imagefile);
					}
				}
				
				//update image file
				$image = array(
					'image'		=> $data['file_name']
				);
				$this->user_update->image($image, $id);
				
				$this->session->set_flashdata('update_info', 'Image uploaded successful');
				redirect(base_url().'dashboard/user_edit');
			}
			
			exit;
		}

	}

}
