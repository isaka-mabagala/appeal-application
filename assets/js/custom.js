$(document).ready(function(){

	var base_url = base_url();

	//modal file viewer
	$('.file-view').click(function(){

		var viewer_modal = $('#viewer-modal');
	    var viewer = $('#doc-view');
	    var path = $(this).attr('data-path');
	    var fileName= path.split('/').pop();
		var ext = fileName.split('.').pop();
		var download = $('#download-path');

		viewer_modal.modal('show');

	    if(ext.toLowerCase() == 'pdf'){

	    	download.html('Download file');
	    	download.attr('href',path);
	    	path = 'https://pdfobject.com/pdf/sample-3pp.pdf';
	    	viewer.html('<embed src="http://docs.google.com/viewer?url='+path+'&embedded=true" width="100%" height="500px">');
	    }
	    else {
	    	download.html('Download image');
	    	download.attr('href',path);
	    	viewer.html('<img src="'+ path +'" alt="'+ fileName +'" style="width:100%" />'+
	    			'<div class="title"><span> '+ fileName +' </span></div>'
	    		);

	    	//css style for images view
	    	$('.file.modal-dialog').addClass('image');
	    	viewer_modal.on('hidden.bs.modal', function(){
	    		$('.file.modal-dialog').removeClass('image');
	    	});
	    }


	});

	//get files name to upload(appeal form)
	$("#files , #user-files").on('change', function(){
		
		$('.files-selected.list').empty();
		
		var _files = $(this);
		var _length = _files[0].files.length;
		var items = _files[0].files;
		var file_list = $('.files-selected.list');
		var output = '';
		
		if($('.text-danger').hasClass('file-error')){
			$('.text-danger.file-error').remove();
		}

		for(var i = 0; i < _length; i++){
			
			var fileName = items[i].name;
			var fileSize = items[i].size;
			var ext = fileName.split('.').pop();
			ext = ext.toLowerCase();
			
			if(ext != 'jpg' && ext != 'jpeg' && ext != 'png' && ext != 'pdf'){
				_files.val("");
				_files.after('<span id="files-error" class="text-danger file-error"> files supported jpg, png and pdf </span>');

				_files.focusout(function(){
					$("#files-error").remove();
				});
				return false;
			}
			if(fileSize > 2000000){
				_files.val("");
				_files.after('<span id="files-error" class="text-danger file-error"> Max file size 2Mb </span>');

				_files.focusout(function(){
					$("#files-error").remove();
				});
				return false;
			}
		}

		if(i == _length){

			if(_length > 1){

				for(var i = 0; i < _length; i++){

					var fileName = items[i].name;
					output += '<span class="file-item">'+ fileName +'</span>';
				}
				file_list.append(output);
			}
		}

	});

	//appeal form validation
	$.validator.addMethod("empty", function(value, element){
		var text = $.trim(element.value);

		if(text == ""){
			return false;
		}else{
			return true;
		}
	}, "This field contain characters");

	$.validator.setDefaults({
		errorPlacement: function(error,element){
			if(element.prop('type') === 'password' || element.prop('type') === 'email'){
				error.insertAfter(element.parent());
			}
			else{
				error.insertAfter(element);
			}
		},
		highlight: function(element){
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element){
			$(element).closest('.form-group').removeClass('has-error');
		}
	});

	$("#form-user").validate({
		rules: {
			comment: {
				required: true,
				empty: true
			}
		}
	});

	$("#appealing_other").hide();

	$("#appealing").on("change", function(){

		if ($(this).val() == "other") {
			$("#appealing_other").show();
		}
		else {
			$("#appealing_other").hide();
		}
	});

	$("#appeal-form").validate({
		rules: {
			regNo: {
				required: true,
				empty: true,
				remote: {
					url: base_url+"appeal/check_student",
					type: "post",
					data: {
						regNo: function(){
							return $('#appeal-form :input[name="regNo"]').val();
						}
					}
				}
			},
			appealing: {
				required: function(element){
					return !$("#other").val();
				}
			},
			other: {
				required: function(element){
					return !$("#appealing").val();
				},
				empty: true
			},
			summary: {
				required: true,
				empty: true
			}
		},
		messages: {
            regNo: {
                remote: "Registration number not registered"
            }
        }
	});

	$("#files").rules("add", {required:true});

	//login form validation
	$("#login-form").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true
			}
		}
	});

	//user uodates validation
	$("#form-image").validate({
		rules: {
			imageFile: {
				required: true
			}
		}
	});

	$("#form-password").validate({
		rules: {
			current_pass: {
				required: true
			},
			new_pass: {
				required: true
			}
		}
	});
	
	//data table plugin
	$('#std-appeals').DataTable();

	//Functions
	function base_url() // get base url
    {
        var pathparts = location.pathname.split('/');
        var host_array = ['localhost','127.0.0.1'];
        var current_host = location.host;

        if (host_array.includes(current_host))
        {
            var url = location.origin+'/'+pathparts[1].trim('/')+'/';
        }
        else
        {
            var url = location.origin+'/';
        }
        return url;
    }
	
});
