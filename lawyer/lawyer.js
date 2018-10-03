function update_password()
{
	var c_pass = $('#c_pass').val();
	var n_pass = $('#n_pass').val();
	var r_pass = $('#r_pass').val();
	
	if(c_pass == ''){
		alert("Please enter your current password");
		document.getElementById('c_pass').focus();
		return false;
	}
	else if(n_pass == ''){
		alert("Please enter your new password");
		document.getElementById('n_pass').focus();
		return false;
	}
	else if(r_pass == ''){
		alert("Please confirm your new password");
		document.getElementById('r_pass').focus();
		return false;
	}
	else if(r_pass != n_pass){
		alert("Your confirm passwords do not matched");
		document.getElementById('r_pass').focus();
		return false;
	}
	else
	{
		$.ajax({
			url:'lawyer_ajax.php',
			type:'post',
			data:{
				c_pass:c_pass,
				n_pass:n_pass,
				r_pass:r_pass,
				action:'change_password'
			},
			success:function(response){
				alert(response);
				$("#pass_word")[0].reset();
			}
		});
	}
}

$(document).ready(function() 
{ 
	$('#photoimg').on('change', function() 
	{ 
		$("#preview").html('');
		$("#preview").html('Uploading....');
		$("#imageform").ajaxForm(
		{
			target: '#preview'
		}).submit();
	});
}); 


var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
	$('#add_more').click(function() {
		$(this).before($("<div/>", {
			id: 'filediv'
		}).fadeIn('slow').append($("<input/>", {
			name: 'file[]',
			type: 'file',
			id: 'file'
		}), $("<br/><br/>")));
	});
	// Following function will executes on change event of file input to select different file.
	$('body').on('change', '#file', function() {
		if (this.files && this.files[0]) {
			abc += 1; // Incrementing global variable by 1.
			var z = abc - 1;
			var x = $(this).parent().find('#previewimg' + z).remove();
			$(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			$(this).hide();
			$("#abcd" + abc).append($("<img/>", {
				id: 'img',
				src: 'x.png',
				alt: 'delete'
			}).click(function() {
				$(this).parent().parent().remove();
			}));
		}
	});
	// To Preview Image
	function imageIsLoaded(e) {
		$('#previewimg' + abc).attr('src', e.target.result);
	};
	/*$('#upload').click(function(e) {
		var name = $(":file").val();
		if (!name) {
			alert("First Image Must Be Selected");
			e.preventDefault();
		}
	});*/
});

function remove_image(img)
{
	$.ajax({
		url:'lawyer_ajax.php',
		type:'post',
		data:{
			img:img,
			action:'remove_document'
		},
		success:function(response){
			//alert(response);
			if(response.trim() == 'success')
			{
				$('#refresh_this').load(document.URL + ' #refresh_this');
			}
			else{
				alert("documents can not be deleted");
			}
			//$("#pass_word")[0].reset();
		}
	});
}




