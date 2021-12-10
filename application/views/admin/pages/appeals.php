<div class="table-responsive">
	<table id="std-appeals" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col"> Registration No. </th>
				<th scope="col"> Appeal for </th>
				<th scope="col"> Date </th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach($appeal_detail->result() as $row){
				$form_id = base64_encode($row->id);
				$student_regNo = $row->stud_reg_no;
				$appeal_for = $row->appeal_against;
				$date = $row->date;
			?>
				<tr>
					<td><a href="<?php echo base_url().'dashboard/stud_appeal/?s='.$form_id; ?>"><?php echo $student_regNo; ?></a></td>
					<td><?php echo $appeal_for; ?></td>
					<td><?php echo date('d/m/Y H:i:s', $date); ?></td>
				</tr>
			<?php	
			}
		?>
		</tbody>
	</table>
</div>