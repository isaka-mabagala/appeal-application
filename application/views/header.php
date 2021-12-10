<?php

//getting current url
 $url = current_url();
 $base_url = base_url();
 $basename = basename($url);

//form page session
if ($url == $base_url)
{
	if ($this->session->has_userdata('showfiles'))
	{
		redirect(base_url(). 'appeal/form_reset');
		exit;
	}
}

//submit page session
if ($basename == 'submit')
{
	if (!$this->session->has_userdata('reg_no'))
	{
		redirect(base_url());
		exit;
	}
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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sweetalert2.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
</head>
	<body>
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
							<h4> APPEAL FORM AGAINST THE DECISION OF THE SENATE </h4>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<hr>
		<a class="mx-4 btn btn-primary btn-sm" href="<?php echo base_url(); ?>login">LOG IN</a>
		
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