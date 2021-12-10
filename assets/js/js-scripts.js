$(document).ready(function(){
    
	//text field length limit
	$('[text-limit="substring"]').on('keyup', function(){
		var textValue = this.value;
		var textLength = textValue.length;
		var maxSize = $(this).attr('max-size');
		
		if(textLength > maxSize){
			$(this).val(textValue.substring(0,maxSize));
		}
		
	});
	
	//input password show/hide
	$('.prepend_show').prepend('<span class="ptxt">Show</span>');
	$('.append_show').append('<span class="ptxt">Show</span>');
	$('.pass_show').css({'position': 'relative'});
	$('.pass_show .ptxt').css({'position': 'absolute', 'top': '50%', 'right': '10px', 'z-index': '99', 'cursor': 'pointer'});
	
	$('.prepend_show .ptxt').on('click', function(){
		$(this).text($(this).text() == "Show" ? "Hide" : "Show");
		$(this).next().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });
	});
	$('.append_show .ptxt').on('click', function(){
		$(this).text($(this).text() == "Show" ? "Hide" : "Show");
		$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });
	});
	
	//images upload preview
	$('[image_upload]').on('change', function(){

		var file = $("#imageFile");
		var image = file[0].files;
		var imageName = image[0].name;
		var imageSize = image[0].size;
		var ext = imageName.split('.').pop();
		ext = ext.toLowerCase();

		if(ext != 'jpg' && ext != 'jpeg' && ext != 'png'){
			file.val("");
			file.after('<span id="image-upload-error" class="text-danger file-error" style="display:block"> file not supported </span>');

			file.focusout(function(){
				$("#image-upload-error").remove();
			});
		}
		else if(imageSize > 2000000){
			file.val("");
			file.after('<span id="image-upload-error" class="text-danger file-error" style="display:block"> Max image size 2Mb </span>');

			file.focusout(function(){
				$("#image-upload-error").remove();
			});
		}
		else{

			imagePreview(this, $('[image_preview]'));
		}
		
	});
	function imagePreview(input, preview){

		if (input.files && input.files[0]){
			var reader = new FileReader();

			reader.onload = function(e){
				preview.attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	
	
});
 