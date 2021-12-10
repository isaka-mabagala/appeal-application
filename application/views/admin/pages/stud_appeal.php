<?php
	$form_id = base64_decode($_GET['s']);
	
	//get student appeal details
	$query = $this->db->query("
		SELECT students.f_name, students.m_name, students.s_name, students.sex, students.reg_no, students.exm_no, students.programme, students.start_year, students.end_year, form.appeal_against, form.appeal_reason, form.reason_summary, form.date 
		FROM students, form
		WHERE form.id = $form_id
		AND form.stud_reg_no = students.reg_no
		ORDER BY form.id DESC
	");
	
	foreach($query->result() as $row){
		
		$name				= $row->f_name.' '.$row->m_name.' '.$row->s_name;
		$sex				= $row->sex;
		$reg_no				= $row->reg_no;
		$exm_no				= $row->exm_no;
		$programme			= $row->programme;
		$year				= $row->start_year.'/'.$row->end_year;
		$appeal_against		= $row->appeal_against;
		$appeal_reason		= $row->appeal_reason;
		$summary			= $row->reason_summary;
		$date				= $row->date;
	}
	
	//get student's progress
	$progress = '0';
	
	$this->db->select('*');
	$this->db->where('form_id', $form_id);
	$query = $this->db->get('progress');
	
	foreach($query->result() as $row){
		
		$step1		= $row->academic_advisor;
		$step2		= $row->head_department;
		$step3		= $row->dean_faculty;
		$step4		= $row->dean_students;
		
		$progress = $step1 + $step2 + $step3 + $step4;
	}
	$progress = $progress.' / 4';
	if($progress == 4){ $progress = '<em>Complete</em>';}
	
	//get student photo
	$filename = strtolower(str_ireplace('/', '', $reg_no));
	
	$files_path = 'assets/images/student';
	$images = scandir($files_path);
	
	for($i = 0; $i < count($images); $i++){
		
		if($images[$i] != '.' && $images[$i] != '..'){
			
			$list = array($filename.'.jpg', $filename.'.JPG', $filename.'.png', $filename.'.PNG');
			foreach($list as $list){
				
				if($images[$i] == $list){
					
					$image = $images[$i];
				}
			}
			
		}
	}
	

?>
<div class="stud-info mt-3 mb-6">
	<div class="row">
		<div class="d-flex w-100">
			<p class="w-100 text-left px-4"><small>Progress: <?php echo $progress; ?></small></p>
			<p class="w-100 text-right px-4"><small>Submited on: <?php echo date('d/m/Y H:i:s', $date); ?></small></p>
			</div>
		<div class="w-100 text-center bg-info mb-4">
			<h4 class="text-white"> Student Information </h4>
		</div>
		<div class="d-md-flex col">
			<div class="profile-img m-auto">
				<img src="<?php echo base_url().'assets/images/student/'.$image; ?>" alt="<?php echo $image; ?>" class="thumb">
			</div>
			
			<div class="col-md-8 table-responsive my-4">
				<table class="table table-borderless">
					<tbody>
						<tr>
							<th scope="row">Name of student:</th>
							<td><?php echo $name; ?></td>
							<th scope="row">Sex:</th>
							<td><?php echo $sex; ?></td>
						</tr>
						<tr>
							<th scope="row">Registration No:</th>
							<td><?php echo $reg_no; ?></td>
							<th scope="row">Examination No:</th>
							<td><?php echo $exm_no; ?></td>
						</tr>
						<tr>
							<th scope="row">Programme:</th>
							<td><?php echo $programme; ?></td>
							<th scope="row">Study year:</th>
							<td><?php echo $year; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="w-100 text-center bg-info mt-4">
			<h4 class="text-white"> Student Appeal Information </h4>
		</div>
		<div class="w-100 bg-white">
			<div class="col-md-8 table-responsive">
				<table class="table table-borderless">
					<tbody>
						<tr>
							<th scope="row">Appealing against:</th>
							<td><?php echo $appeal_against; ?></td>
							<th scope="row">Major reasons for the appeal:</th>
							<td><?php echo $appeal_reason; ?></td>
						</tr>
					</tbody>
				</table>
				<div class="p-3">
					<p class="font-weight-bold"> Appeal summary: </p>
					<p><?php echo $summary; ?></p>
				</div>
			</div>
			<div class="col-md-4 py-5">
				<p class="font-weight-bold"> Attachments: </p>
				<ul>
				<?php
					//get student attachments
					$this->db->select('document');
					$this->db->where('form_id', $form_id);
					$query = $this->db->get('form_doc');
					
					foreach($query->result() as $row){
						$document = $row->document;
				?>
						<li class="file"><a class="file-view" href="#<?php echo $document; ?>" data-path="<?php echo base_url() .'assets/files/'.$document; ?>"><?php echo pathinfo($document, PATHINFO_FILENAME); ?></a></li>
					
				<?php
					}
				?>
				</ul>
			</div>
		</div>
		
		<?php $this->load->view('admin/pages/comments'); ?>
		
	</div>

</div>
	