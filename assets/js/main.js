function submitdata()
{
	var firstName = $('firstName').val();
	var lastName = $('lastName').val();
	var email = $('email').val();
	var password = $('password').val();

	$.ajax({
		type: 'post',
		url: '/2016372/cw_serverside/index.php/UserController/Registration',
		data: {
			firstName: firstName,
			lastName: lastName,
			email:email,
			password: password
		},
		success: function (response) {
			// $('#success__para').html("You data will be saved");
			alert("saved");
		}
	});

	return false;
}
