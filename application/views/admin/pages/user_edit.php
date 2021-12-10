<?php

$user_id = $this->session->userdata('user_id');

foreach ($user_detail->result() as $row)
{
	if ($row->id == $user_id)
	{
		$name = $row->f_name.' '.$row->s_name;
		$position = $row->position;
		$email = $row->email;
		$image = $row->image;
	}
}
?>

<div class="row text-center">
<?php if ($this->session->flashdata('update_info')) { ?>

	<div class="col alert alert-info" role="alert">
		<?php echo $this->session->flashdata('update_info'); ?>
	</div>
<?php } ?>
</div>

<!-- image update -->
<div class="row">
	<div class="col-md-4 col-sm-8 m-auto">
		<div class="card mb-6">
			<form id="form-image" action="<?php echo base_url(); ?>admin/user_update" method="post" enctype="multipart/form-data">
				<div class="profile-img crop-img m-auto">
					<img src="<?php echo base_url().'assets/images/users/'.$image; ?>" alt="<?php echo $image; ?>" class="card-img-top" image_preview>
				</div>
				<div class="card-body">
					<input id="imageFile" type="file" name="imageFile" image_upload >
					<input type="submit" name="imageUpload" value="Upload" class="btn btn-success mt-4 px-6">
				</div>
			</form>
		</div>
	</div>

	<!-- password change -->
	<div class="col-xl-6 col-md-8">
		<div class="card">
			<div class="card-header bg-info text-white text-center">
				<h4> Password Change </h4>
			</div>
			
			<div class="card-body">
				<form id="form-password" action="<?php echo base_url(); ?>admin/user_update" method="post">
					<div class="form-group pass_show prepend_show my-3">
						<input class="form-control" type="password" placeholder="Current password" name="current_pass" >
					</div>
					<div class="form-group pass_show prepend_show my-3">
						<input class="form-control" type="password" placeholder="New password" name="new_pass" >
					</div>
					
					<input class="btn btn-success my-3 px-6" type="submit" value="Change" >
				</form>
			</div>
		</div>
	</div>
</div>
