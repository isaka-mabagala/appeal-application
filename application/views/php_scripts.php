<?php

//sussessful dialog
if($this->session->has_userdata('success')){ ?>
<script>
	swal("Done!", "Your form submited successful!", "success");
	
</script>

<?php
	$this->session->unset_userdata('success');
}

?>