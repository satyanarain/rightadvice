$(document).ready(function() {
    $('#lawyer_registration').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            full_name: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please enter your Name'
                    },
					regexp: {
                        regexp: /^[a-zA-Z \.]+$/,
                        message: 'Only alphanumerics and blank spaces allowed'
                    }
                }
            },
			email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your Email Address'
                    },
                    emailAddress: {
                        message: 'Please enter a valid Email Address'
                    }
                }
            },
			mobile: {
                validators: {
					/*stringLength: {
                        min: 10, 
                        max: 10,
					},*/
					notEmpty: {
                        message: 'Please enter your Contact Number'
					},
					regexp: {
                        regexp: /^[0-9\.]+$/,
                        message: 'Only numbers allow.'
                    }
				}
            },
			gender: {
                validators: {
					notEmpty: {
                        message: 'Please select your Gender'
					},
				}
            },
			user_password: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please enter your Password'
                    }
                }
            },
			confirm_password: {
                validators: {
                    identical: {
						field: 'user_password',
						message: 'Passwords do not match'
					}

                }
            },
            
            
		}
	})
	.on('success.form.bv', function(e) {
		$('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
			alert("success");
			$('#lawyer_registration').data('bootstrapValidator').resetForm();

		// Prevent form submission
		e.preventDefault();

		// Get the form instance
		var $form = $(e.target);

		// Get the BootstrapValidator instance
		var bv = $form.data('bootstrapValidator');

		
		/* $.post($form.attr('action'), $form.serialize(), function(result) {
			console.log(result);
		}, 'json'); */
		
		
	});
});		



