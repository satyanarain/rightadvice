//Add Data
function add_function(id='')
{
	if(id == ''){
		actionType = 'addLawyer';
	}else{
		actionType = 'editLawyer';
	}
	var lawyer_id = $('#lawyer_id').val();
	
	var full_name = $('#full_name').val();
	var mobile = $('#mobile').val();
	var address = $('#address').val();
	var dob = $('#dob').val();
	var gender = $('#gender').val();
	var organization_name = $('#organization_name').val();
	var email = $('#email').val();
	var about = $('#about').val();
	
	var categories = $('#categories').val(); 
	
	var result = $('#result').val();
	var city = $('#city').val();
	var postcode = $('#postcode').val();
	
	var Specialities_arr = [];
	$(':checkbox:checked').each(function(i){
	  Specialities_arr[i] = $(this).val();
	});
	
	var language = new Array();
	$('input[name="language"]:checked').each(function() {
		language.push(this.value);
	});
	//alert(selectedLanguage); return false;
	var fax = $('#fax').val();
	var website = $('#website').val();
	var youtube = $('#youtube').val();
	var vimeo = $('#vimeo').val();
	var facebook = $('#facebook').val();
	var linkedin = $('#linkedin').val();
	var twitter = $('#twitter').val();
	var gplus = $('#gplus').val();
	var pinterest = $('#pinterest').val();
	var instagram = $('#instagram').val();
	var lawfirmAffiliations = $('#lawfirmAffiliations').val();
	var ExperienceTranining = $('#ExperienceTranining').val();
	var education = $('#education').val();
	var apprenticeships = $('#apprenticeships').val();
	var residency = $('#residency').val();
	var practiseArea = $('#practiseArea').val();
	var certifications = $('#certifications').val();
	var prelaw = $('#prelaw').val();
	var law_school = $('#law_school').val();
	var law_degree = $('#law_degree').val();
	var bar_exam = $('#bar_exam').val();
	var practice_course = $('#practice_course').val();
	var languages = $('#languages').val();
	var preferred = $('#preferred').val();
	
	/*if($("#preferred").is(':checked')){
		var preferred = 1;
	}else{
		var preferred = 0;
	}*/
	
	var admin_email = $('#admin_email').val();
	
	
	if(full_name == '')
	{
		alert('Please enter full name');
		document.getElementById('full_name').focus();
		return false;
	}
	else if(mobile == '')
	{
		alert('Please enter mobile');
		document.getElementById('mobile').focus();
		return false;
	}
	else if(address == '')
	{
		alert('Please enter address');
		document.getElementById('address').focus();
		return false;
	}
	else if(organization_name == '')
	{
		alert('Please enter organization name');
		document.getElementById('organization_name').focus();
		return false;
	}
	else if(email == '')
	{
		alert('Please enter email id');
		document.getElementById('email').focus();
		return false;
	}
	else
	{ 
		$.ajax({
			url:'admin_ajax.php',
			type:'post',
			data:{
				full_name:full_name,
				mobile:mobile,
				address:address,
				dob:dob,
				gender:gender,
				organization_name:organization_name,
				email:email,
				about:about,
				categories:categories,
				result:result,
				city:city,
				postcode:postcode,
				Specialities_arr:Specialities_arr,
				fax:fax,
				website:website,
				youtube:youtube,
				vimeo:vimeo,
				facebook:facebook,
				linkedin:linkedin,
				twitter:twitter,
				gplus:gplus,
				pinterest:pinterest,
				instagram:instagram,
				lawfirmAffiliations:lawfirmAffiliations,
				ExperienceTranining:ExperienceTranining,
				education:education,
				apprenticeships:apprenticeships,
				residency:residency,
				practiseArea:practiseArea,
				certifications:certifications,
				prelaw:prelaw,
				law_school:law_school,
				law_degree:law_degree,
				bar_exam:bar_exam,
				practice_course:practice_course,
				language:language,
				actionType:actionType,
				lawyer_id:lawyer_id,
				admin_email:admin_email,
				preferred:preferred,
				action:'add_data'
	
			},
			success:function(response)
			{
				alert(response);
			}
		});
	}
		
	
}

function deleteThis(lid,type)
{
	if(confirm("Are you sure to delete this record?"))
	{
		$.ajax({
			url:'admin_ajax.php',
			type:'post',
			data:{
				lid:lid,
				type:type,
				action:'delete_record'
			},
			success:function(response)
			{
				$('#item_'+lid).fadeOut();
				alert(response);
			}
		});
	}
	else{
		return false;
	}
}
	
function changeLawyerStatus(status_val,lid,email)
{
	//alert(email);
	$.ajax({
		url:'admin_ajax.php',
		type:'post',
		data:{
			status_val:status_val,
			lid:lid,
			email:email,
			action:'change_lawyer_status'
		},
		success:function(response)
		{
			if(response.trim() == 'success'){
				//$('#status_'+lid).load(document.URL + '#status_'+lid);
				//alert('change');
				location.reload();
			}
			else{
				alert("Status not change, please try again");
			}
		}
	});
}


function deleteQuestion(qid,type)
{
	if(confirm("Are you sure to delete this record?"))
	{
		$.ajax({
			url:'admin_ajax.php',
			type:'post',
			data:{
				qid:qid,
				type:type,
				action:'delete_question'
			},
			success:function(response)
			{
				$('#item_'+qid).fadeOut();
				alert(response);
			}
		});
	}
	else{
		return false;
	}
}

function deleteFeedback(cid)
{
	if(confirm("Are you sure to delete this comment?"))
	{
		$.ajax({
			url:'admin_ajax.php',
			type:'post',
			data:{
				cid:cid,
				action:'delete_comment'
			},
			success:function(response)
			{
				$('#item_'+cid).fadeOut();
				alert(response);
			}
		});
	}
	else{
		return false;
	}
}



function sendReminderEmail(lawyer_email,client_name,subject,question,date)
{
	//alert(lawyer_email+" "+client_name+" "+subject+" "+question+" "+date);
	if(confirm("Are you sure to send reminder email to lawyer?"))
	{
		$.ajax({
			url:'admin_ajax.php',
			type:'post',
			data:{
				lawyer_email:lawyer_email,
				client_name:client_name,
				subject:subject,
				question:question,
				date:date,
				action:'send_reminder_email'
			},
			success:function(response)
			{
				//$('#item_'+qid).fadeOut();
				alert(response);
			}
		});
	}
	else{
		return false;
	}
}

