<?php

$user_id = $this->session->userdata('user_id');

foreach($user_detail->result() as $row){
	
	if($row->id == $user_id){
		$name = $row->f_name.' '.$row->s_name;
		$position = $row->position;
		$email = $row->email;
		$image = $row->image;
	}
}
?>
<div class="card mb-6">
	<div class="profile-img m-auto">
		<img src="<?php echo base_url().'assets/images/users/'.$image; ?>" alt="<?php echo $image; ?>" class="card-img-top">
	</div>
	<div class="card-body text-center">
		<h4 class="card-title"><?php echo $name; ?></h4>
		<p class="card-text text-muted"><?php echo $position; ?></p>
		<p class="card-text text-muted"><?php echo $email; ?></p>
	</div>
</div>

