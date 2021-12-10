<?php

if ($this->session->has_userdata('user_id'))
{
	redirect(base_url().'dashboard');
	exit;
}

$email = '';
$password = '';

if ($this->session->has_userdata('remember_password'))
{
	$email = $this->session->userdata('email');
	$password = $this->session->userdata('password');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Appealing</title>
	
	<meta charset="UTF-8">
	<meta name="description" content="Student appealing system">
	<meta name="author" content="Isaxstar">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/theme.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fontawesome/fonts/fontawesome-all.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
</head>
<body class="body-login">
	<div class="container py-6">
		<div class="row justify-content-center mt-6">
			<div class="col-12 col-md-8 col-lg-6 pb-5">
			
				<form id="login-form" action="<?php echo base_url(); ?>admin/user_login" method="post">
					<div class="card border-primary rounded-2">
					
						<div class="card-header p-0">
							<div class="bg-info text-white text-center py-2">
								<h3> LOGIN </h3>
							</div>
						</div>
						
						<?php if ($this->session->has_userdata('login_error')){ ?>
							<div class="alert alert-warning"><?php echo $this->session->userdata('login_error'); ?></div>
						<?php } $this->session->unset_userdata('login_error'); ?>
						
						<div class="card-body p-3">
							<div class="form-group mb-4 mt-4">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
									</div>
									<input type="email" class="form-control" name="email" placeholder="exmple@gmail.com" value="<?php echo $email; ?>">
								</div>
							</div>
							<div class="form-group mb-4">
								<div class="input-group pass_show append_show">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-lock text-info"></i></div>
									</div>
									<input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $password; ?>">
								</div>
							</div>
							<div class="form-group mb-5 mt-3">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="remember" id="customCheck1">
									<label class="custom-control-label" for="customCheck1">Remember password</label>
								</div>
							</div>
							<div class="text-center">
								<input type="submit" value="Log In" class="btn btn-success btn-block rounded-2 py-3">
							</div>
						</div>
						
					</div>
				</form>
				
			</div>
		</div>
		<div class="text-center">
			<p> &copy; <?php echo date("Y"); ?> Sokoine University. </p>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/js-scripts.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	
	<!-- remember checkbox script -->
	<?php if($this->session->has_userdata('remember_password')){ ?>
		<script>
			$(document).ready(function(){
				
				$('input[name="remember"]').prop('checked', true);
			});
		</script>
	<?php	} ?>
	
</body>
</html>

