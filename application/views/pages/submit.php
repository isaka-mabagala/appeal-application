<?php

$form_submit = array(
	'f_name'				=> $this->session->userdata('f_name'),
	'm_name'				=> $this->session->userdata('m_name'),
	's_name'				=> $this->session->userdata('s_name'),
	'sex'					=> $this->session->userdata('sex'),
	'reg_no'				=> $this->session->userdata('reg_no'),
	'exm_no'				=> $this->session->userdata('exm_no'),
	'programme'				=> $this->session->userdata('programme'),
	'start_year'			=> $this->session->userdata('start_year'),
	'end_year'				=> $this->session->userdata('end_year'),
	'appeal_against'		=> $this->session->userdata('appeal_against'),
	'appeal_reason'			=> $this->session->userdata('appeal_reason'),
	'reason_summary'		=> $this->session->userdata('reason_summary')
);

?>
<h4><strong> Part B: </strong> Confirm the details below and submit. </h4>

<div class="mt-6 mb-6">
	<table class="table">
		<thead>
			<tr>
				<th colspan="4" scope="col" class="text-center"> PERSONAL PARTICULARS </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">Name:</th>
				<td><?php echo $form_submit['f_name'].' '.$form_submit['m_name'].' '.$form_submit['s_name']; ?></td>
				<th scope="row">Sex:</th>
				<td><?php echo $form_submit['sex']; ?></td>
			</tr>
			<tr>
				<th scope="row">Registration No:</th>
				<td><?php echo $form_submit['reg_no']; ?></td>
				<th scope="row">Examination No:</th>
				<td><?php echo $form_submit['exm_no']; ?></td>
			</tr>
			<tr>
				<th scope="row">Degree Programme:</th>
				<td><?php echo $form_submit['programme']; ?></td>
				<th scope="row">Year Study:</th>
				<td><?php echo $form_submit['start_year'].'/'.$form_submit['end_year']; ?></td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<th colspan="4" scope="col" class="text-center"> Other PARTICULARS </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">Appealing against:</th>
				<td><?php echo $form_submit['appeal_against']; ?></td>
			</tr>
			<tr>
				<th colspan="4" scope="row">Major reasons for the appeal</th>
			</tr>
			<tr>
				<td colspan="4">
					<strong><?php echo $form_submit['appeal_reason']; ?>:</strong>
					<?php echo $form_submit['reason_summary']; ?>
				</td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<th colspan="4" scope="col" class="text-center"> List of supporting documents attached </th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($this->session->userdata('showfiles') as $file)
				{
					echo '<tr>';
					echo '<td class="file"><a class="file-view" href="#'.$file.'" data-path="'.base_url() .'assets/files/'.$file.'">'.pathinfo($file, PATHINFO_FILENAME).'</a></td>';
					echo '</tr>';
				}
			?>
		</tbody>
		<thead>
			<tr>
				<th colspan="4" scope="col" class="text-center"></th>
			</tr>
		</thead>
	</table>
	
	<div class="mt-3">
		<a href="<?php echo base_url(); ?>appeal/form_submit"><button class="btn btn-primary m-3"> Submit form </button></a>
		<a href="<?php echo base_url(); ?>appeal/form_reset"><button class="btn btn-primary m-3"> Reset form </button></a>
	</div>
</div>