<?php
if(!$this->session->has_userdata('user_id')){
	
	redirect(base_url().'admin/login');
	exit;
}
//unset($_SESSION['user_id']);
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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sweetalert2.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
</head>
	<body class="admin">
		<header class="bg-white">
			<div class="container">
				<div class="row">
					<div class="sitebranding d-md-flex col-lg-10 m-auto">
						<div class="sitelogo col-md-3 text-center">
							<a href="<?php echo base_url(); ?>">
								<img src="<?php echo base_url(); ?>assets/images/logo.jpg">
							</a>
						</div>
						<div class="sitename text-center">
							<h2> SOKOINE UNIVERSITY OF AGRICULTURE </h2>
							<h4> APPEALING DASHBOARD </h4>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<hr>
		
		<div class="p-5 mb-4 clearfix bg-white">
			<div class="float-left">
				<a href="<?php echo base_url(); ?>dashboard"> Dashboard </a>
			</div>
			<div class="btn-group float-right">
				<div class="cog-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-cog text-info"></i>
				</div>
				<div class="dropdown-menu dropdown-menu-right">
					<a href="<?php echo base_url(); ?>dashboard/user_edit" class="dropdown-item" >Edit Profile</a>
					<a href="<?php echo base_url();?>admin/logout" class="dropdown-item" >Log out</a>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="modal fade" id="viewer-modal">
				<div class="file modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<div class="px-3 mb-4">
								<a id="download-path" href="" target="_blank"></a>
								<button class="close" data-dismiss="modal">&times;</button>
							</div>
							<div id="doc-view" class="doc-view"></div>
						</div>
					</div>
				</div>
			</div>