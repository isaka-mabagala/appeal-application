<?php
	$form_id = base64_decode($_GET['s']);
	$user_id = $this->session->userdata('user_id');
	$this->session->set_userdata('previous_url', current_url().'/?s='.$_GET['s']);
	
	//get student registration number
	$this->db->select('stud_reg_no');
	$this->db->where('id', $form_id);
	$query = $this->db->get('form');
	
	foreach($query->result() as $row){
		
		$stud_reg_no	= $row->stud_reg_no;
	}

	//student's appeal progress
	$this->db->select('*');
	$this->db->where('form_id', $form_id);
	$query = $this->db->get('progress');
	$num_row = $query->num_rows();
	
	foreach($query->result() as $row){
		
		$academic_advisor	= $row->academic_advisor;
		$head_department	= $row->head_department;
		$dean_faculty		= $row->dean_faculty;
		$dean_students		= $row->dean_students;
		
	}

?>

<div class="w-100 text-center bg-info mt-4">
	<h4 class="text-white"> Views by the Academic Advisor plus any attachments </h4>
</div>
<div class="w-100 bg-white">
	<div class="col">
		<?php
			if($num_row > 0){
				
				//get comment
				$query = $this->db->query("
					SELECT comment
					FROM comments
					WHERE user_id = '1'
					AND stud_reg_no = '$stud_reg_no'
				");
				foreach($query->result() as $row){
					
					$comment = $row->comment;
				}

				$query = $this->db->query("
					SELECT comment_doc.document
					FROM comments, comment_doc
					WHERE comments.user_id = '1'
					AND comments.stud_reg_no = '$stud_reg_no'
					AND comment_doc.comment_id = comments.id
				");

		?>
				<div class="py-5 col-md-8">
					<p class="font-weight-bold"> Comment: </p>
					<p><?php echo $comment; ?></p>
				</div>
				<div class="col-md-4 py-5">
					<p class="font-weight-bold"> Attachments: </p>
					<?php
						if($query->num_rows() > 0){
							foreach($query->result() as $row){
								$document = $row->document;
					?>
							<li class="file"><a class="file-view" href="#<?php echo $document; ?>" data-path="<?php echo base_url() .'assets/files/comments/'.$document; ?>"><?php echo pathinfo($document, PATHINFO_FILENAME); ?></a></li>
					<?php
							}
						}
						else{
					?>
							<p class="font-italic text-muted"> no attachments </p>
					<?php
						}
					?>
				</div>
		<?php
			}
			else if($user_id == '1'){
		?>
				<div class="py-5 col-md-8">
					<form id="form-user" action="<?php echo base_url() ?>admin/user_comment" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label> Add comment </label>
							<textarea name="comment" class="form-control" rows="4" placeholder="comment..."></textarea>
							<span class="text-danger"> <?php echo $this->session->flashdata('error_comment'); ?></span>
							
							<input type="hidden" name="reg-no" value="<?php echo $stud_reg_no; ?>">
							<input type="hidden" name="form-id" value="<?php echo $form_id; ?>">
						</div>
						<div class="form-group">
							<input id="user-files" type="file" name="files[]" multiple>
							<div class="files-selected list"> </div>
						</div>
						<div class="form-group">
							<input type="submit" value="Comment" class="btn btn-success">
						</div>
					</form>
				</div>
		<?php
			}
			else{
		?>
				<div class="py-5 font-italic text-muted">
					<p class="px-4"> waitting for Academic Advisor's comment... </p>
				</div>
		<?php
			}
		?>
	</div>
</div>

<?php
	if($num_row > 0 && $academic_advisor > 0){
?>
		<div class="w-100 text-center bg-info mt-4">
			<h4 class="text-white"> Views by the Head of Department plus any attachments </h4>
		</div>
		<div class="w-100 bg-white">
			<div class="col">
				<?php
					if($head_department > 0){
						
					//get comment
					$query = $this->db->query("
						SELECT comment
						FROM comments
						WHERE user_id = '2'
						AND stud_reg_no = '$stud_reg_no'
					");
					foreach($query->result() as $row){
						
						$comment = $row->comment;
					}

					$query = $this->db->query("
						SELECT comment_doc.document
						FROM comments, comment_doc
						WHERE comments.user_id = '2'
						AND comments.stud_reg_no = '$stud_reg_no'
						AND comment_doc.comment_id = comments.id
					");
					
				?>
						<div class="py-5 col-md-8">
							<p class="font-weight-bold"> Comment: </p>
							<p><?php echo $comment; ?></p>
						</div>
						<div class="col-md-4 py-5">
							<p class="font-weight-bold"> Attachments: </p>
							<?php
								if($query->num_rows() > 0){
									foreach($query->result() as $row){
										$document = $row->document;
							?>
										<li class="file"><a class="file-view" href="#<?php echo $document; ?>" data-path="<?php echo base_url() .'assets/files/comments/'.$document; ?>"><?php echo pathinfo($document, PATHINFO_FILENAME); ?></a></li>
							<?php
									}
								}
								else{
							?>
									<p class="font-italic text-muted"> no attachments </p>
							<?php
								}
							?>
						</div>
				<?php
					}
					else if($user_id == '2'){
				?>
						<div class="py-5 col-md-8">
							<form id="form-user" action="<?php echo base_url() ?>admin/user_comment" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label> Add comment </label>
									<textarea name="comment" class="form-control" rows="4" placeholder="comment..."></textarea>
									<span class="text-danger"> <?php echo $this->session->flashdata('error_comment'); ?></span>
									
									<input type="hidden" name="reg-no" value="<?php echo $stud_reg_no; ?>">
									<input type="hidden" name="form-id" value="<?php echo $form_id; ?>">
								</div>
								<div class="form-group">
									<input id="user-files" type="file" name="files[]" multiple>
									<div class="files-selected list"> </div>
								</div>
								<div class="form-group">
									<input type="submit" value="Comment" class="btn btn-success">
								</div>
							</form>
						</div>
				<?php
					}
					else{
				?>
						<div class="py-5 font-italic text-muted">
							<p class="px-4"> waitting for Head of Department's comment... </p>
						</div>
				<?php
					}
				?>
			</div>
		</div>
<?php
	}
?>

<?php
	if($num_row > 0 && $head_department > 0){
?>
		<div class="w-100 text-center bg-info mt-4">
			<h4 class="text-white"> Views by the Dean of the Faculty plus any attachments </h4>
		</div>
		<div class="w-100 bg-white">
			<div class="col">
				<?php
					if($dean_faculty > 0){
						
					//get comment
					$query = $this->db->query("
						SELECT comment
						FROM comments
						WHERE user_id = '3'
						AND stud_reg_no = '$stud_reg_no'
					");
					foreach($query->result() as $row){
						
						$comment = $row->comment;
					}

					$query = $this->db->query("
						SELECT comment_doc.document
						FROM comments, comment_doc
						WHERE comments.user_id = '3'
						AND comments.stud_reg_no = '$stud_reg_no'
						AND comment_doc.comment_id = comments.id
					");
					
				?>
						<div class="py-5 col-md-8">
							<p class="font-weight-bold"> Comment: </p>
							<p><?php echo $comment; ?></p>
						</div>
						<div class="col-md-4 py-5">
							<p class="font-weight-bold"> Attachments: </p>
							<?php
								if($query->num_rows() > 0){
									foreach($query->result() as $row){
										$document = $row->document;
							?>
									<li class="file"><a class="file-view" href="#<?php echo $document; ?>" data-path="<?php echo base_url() .'assets/files/comments/'.$document; ?>"><?php echo pathinfo($document, PATHINFO_FILENAME); ?></a></li>
							<?php
									}
								}
								else{
							?>
									<p class="font-italic text-muted"> no attachments </p>
							<?php
								}
							?>
						</div>
				<?php
					}
					else if($user_id == '3'){
				?>
						<div class="py-5 col-md-8">
							<form id="form-user" action="<?php echo base_url() ?>admin/user_comment" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label> Add comment </label>
									<textarea name="comment" class="form-control" rows="4" placeholder="comment..."></textarea>
									<span class="text-danger"> <?php echo $this->session->flashdata('error_comment'); ?></span>
									
									<input type="hidden" name="reg-no" value="<?php echo $stud_reg_no; ?>">
									<input type="hidden" name="form-id" value="<?php echo $form_id; ?>">
								</div>
								<div class="form-group">
									<input id="user-files" type="file" name="files[]" multiple>
									<div class="files-selected list"> </div>
								</div>
								<div class="form-group">
									<input type="submit" value="Comment" class="btn btn-success">
								</div>
							</form>
						</div>
				<?php
					}
					else{
				?>
						<div class="py-5 font-italic text-muted">
							<p class="px-4"> waitting for Dean of the Faculty's comment... </p>
						</div>
				<?php
					}
				?>
			</div>
		</div>
<?php
	}
?>

<?php 
	if($num_row > 0 && $dean_faculty > 0){
?>
		<div class="w-100 text-center bg-info mt-4">
			<h4 class="text-white"> Views by the Dean of Students plus any attachments </h4>
		</div>
		<div class="w-100 bg-white">
			<div class="col">
				<?php
					if($dean_students > 0){
						
					//get comment
					$query = $this->db->query("
						SELECT comment
						FROM comments
						WHERE user_id = '4'
						AND stud_reg_no = '$stud_reg_no'
					");
					foreach($query->result() as $row){
						
						$comment = $row->comment;
					}

					$query = $this->db->query("
						SELECT comment_doc.document
						FROM comments, comment_doc
						WHERE comments.user_id = '4'
						AND comments.stud_reg_no = '$stud_reg_no'
						AND comment_doc.comment_id = comments.id
					");
					
				?>
						<div class="py-5 col-md-8">
							<p class="font-weight-bold"> Comment: </p>
							<p><?php echo $comment; ?></p>
						</div>
						<div class="col-md-4 py-5">
							<p class="font-weight-bold"> Attachments: </p>
							<?php
								if($query->num_rows() > 0){
									foreach($query->result() as $row){
										$document = $row->document;
							?>
									<li class="file"><a class="file-view" href="#<?php echo $document; ?>" data-path="<?php echo base_url() .'assets/files/comments/'.$document; ?>"><?php echo pathinfo($document, PATHINFO_FILENAME); ?></a></li>
							<?php
									}
								}
								else{
							?>
									<p class="font-italic text-muted"> no attachments </p>
							<?php
								}
							?>
						</div>
				<?php
					}
					else if($user_id == '4'){
				?>
						<div class="py-5 col-md-8">
							<form id="form-user" action="<?php echo base_url() ?>admin/user_comment" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label> Add comment </label>
									<textarea name="comment" class="form-control" rows="4" placeholder="comment..."></textarea>
									<span class="text-danger"> <?php echo $this->session->flashdata('error_comment'); ?></span>
									
									<input type="hidden" name="reg-no" value="<?php echo $stud_reg_no; ?>">
									<input type="hidden" name="form-id" value="<?php echo $form_id; ?>">
								</div>
								<div class="form-group">
									<input id="user-files" type="file" name="files[]" multiple>
									<div class="files-selected list"> </div>
								</div>
								<div class="form-group">
									<input type="submit" value="Comment" class="btn btn-success">
								</div>
							</form>
						</div>
				<?php
					}
					else{
				?>
						<div class="py-5 font-italic text-muted">
							<p class="px-4"> waitting for Dean of Students's comment.... </p>
						</div>
				<?php
					}
				?>
			</div>
		</div>
<?php 
	} 
?>
