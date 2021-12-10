<h4>
	Before proceed please read PROCEDURES FOR APPEALING
	<a class="file-view" href="#" data-path="<?php echo base_url(); ?>assets/files/sua-appeal-procedures.pdf"> click here </a>
</h4>

<h4><strong> Part A: </strong> (To be filled by the Appellant). </h4>

<form id="appeal-form" class="col-md-8 mt-5 mb-6" action="<?php echo base_url(); ?>appeal/form_validation" method="post" enctype="multipart/form-data">
	<div class="form-group mt-3">
		<input class="form-control" type="text" placeholder="CIT/D/2016/0024" name="regNo">
	</div>

	<div class="form-group mt-3">
		<label> Appealing against: </label>
		<select id="appealing" class="form-control p-2 mt-3" name="appealing">
			<option value=""> select </option>
			<option value="Discontinuation"> Discontinuation </option>
			<option value="Repeating a year of study"> Repeating a year of study </option>
			<option value="Supplementing"> Supplementing </option>
			<option value="other"> Other </option>
		</select>
	</div>
	<div id="appealing_other" class="form-group mt-3 mb-3">
		<input class="form-control" type="text" placeholder="Others" name="other" id="other">
	</div>
	
	<div class="form-group">
		<label class="mt-4"> Major reasons for the appeal (summary) </label>
		<select class="form-control p-2 mt-3" name="reasons">
			<option value="Academic"> Academic </option>
			<option value="Social"> Social </option>
			<option value="Medical"> Medical </option>
			<option value="Others"> Others </option>
		</select>
	</div>
	<div class="form-group mt-3 mb-3">
		<textarea class="form-control" name="summary" rows="4" text-limit="substring" max-size="300" placeholder="reason summary"></textarea>
	</div>

	<label class="mt-4"> List of supporting documents attached (including appeal fee receipt). </label>
	<div class="box-upload mt-5 mb-6">
		<input id="files" type="file" name="files[]" multiple class="mt-5 mb-5">
		<div class="files-selected list"> </div>
	</div>

	<input class="btn btn-success col-sm-4 mt-5 mb-4" type="submit" name="part1" value="Next">
	
</form>