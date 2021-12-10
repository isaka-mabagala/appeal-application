<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appeal extends CI_Controller
{
	public function index($page = 'form')
	{
		if (!file_exists( APPPATH.'views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
		$this->load->view('header');
		$this->load->view('pages/'.$page);
		$this->load->view('footer');
	}
	
	public function form_validation()
	{
		//form validations
		$this->load->model('fetch_data');

		$reg_no = mb_strtoupper($this->input->post('regNo'));
		$student_info = $this->fetch_data->student_info($reg_no);

		foreach ($student_info->result() as $row)
		{
			$this->session->set_userdata('f_name', $row->f_name);
			$this->session->set_userdata('m_name', $row->m_name);
			$this->session->set_userdata('s_name', $row->s_name);
			$this->session->set_userdata('sex', $row->sex);
			$this->session->set_userdata('reg_no', $row->reg_no);
			$this->session->set_userdata('exm_no', $row->exm_no);
			$this->session->set_userdata('programme', $row->programme);
			$this->session->set_userdata('start_year', $row->start_year);
			$this->session->set_userdata('end_year', $row->end_year);
			
		}
		
		//values data to inserted into database
		if ($this->input->post('appealing') == "other")
		{
			$appealing = $this->input->post('other');
		}
		else
		{
			$appealing = $this->input->post('appealing');
		}
		
		$data = array(
			'reg_no'				=> mb_strtoupper($this->input->post('regNo')),
			'appeal_against'		=> ucfirst($appealing),
			'appeal_reason'			=> $this->input->post('reasons'),
			'reason_summary'		=> ucfirst($this->input->post('summary')),
		);
		
		$this->session->set_userdata($data);
		
		//attachments
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
			$uploadPath = 'assets/files/';
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
		$this->session->set_userdata('showfiles', $showfiles);

		//redirect to other page
		redirect(base_url() . 'submit' );
	
	}
	
	public function form_submit()
	{
		if ($this->session->has_userdata('reg_no'))
		{
			$this->load->model('form'); //load model form
			
			$this->session->set_userdata('date', time());
			$date = $this->session->userdata('date');

			$formSubmit = array(
				'stud_reg_no'			=> $this->session->userdata('reg_no'),
				'appeal_against'		=> $this->session->userdata('appeal_against'),
				'appeal_reason'			=> $this->session->userdata('appeal_reason'),
				'reason_summary'		=> $this->session->userdata('reason_summary'),
				'date'					=> $date
			);
			$this->form->insert_data($formSubmit);
			
			$this->load->model('fetch_data'); //fetch form id

			$id = $this->fetch_data->get_form_id($date);
			foreach ($id->result() as $row)
			{
				$id = $row->id;
			}

			$this->load->model('files'); //load model files

			$insertFiles = array();
			foreach ($this->session->userdata('showfiles') as $val)
			{
				$insertFiles[] = array(
					'form_id'		=> $id,
					'document'		=> $val
				);
			}
			$this->files->insert_files($insertFiles);
			
			//clear all sessions submit
			$unsetSubmit = array(
				'reg_no', 'appeal_against', 'appeal_reason', 'reason_summary', 'date', 'showfiles'
			);

			foreach ($unsetSubmit as $session)
			{
				$this->session->unset_userdata($session);
			}
			
			$this->session->set_userdata('success', 'submited');//set successful session
			redirect(base_url());
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function form_reset()
	{
		//remove files from folder
		foreach ($this->session->userdata('showfiles') as $file)
		{
			unlink('assets/files/'.$file);
		}
		
		//clear all sessions reset
		$unsetSubmit = array(
			'f_name', 'm_name', 's_name', 'sex', 'reg_no', 'exm_no', 'programme', 'start_year', 'end_year', 'appeal_against', 'appeal_reason', 'reason_summary', 'showfiles'
		);

		foreach ($unsetSubmit as $session)
		{
			$this->session->unset_userdata($session);
		}
		
		redirect(base_url());
	}

	public function check_student()
	{
		$this->load->model('fetch_data');

		//check student registration no.
		$reg_no = mb_strtoupper($this->input->post('regNo'));
		return $this->fetch_data->check_student($reg_no);
	}
}
