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

//
// /* When the user clicks on the button,
// toggle between hiding and showing the dropdown content */
// function myFunction() {
// 	document.getElementById("myDropdown").classList.toggle("show");
// }
//
// function filterFunction() {
// 	var input, filter, ul, li, a, i;
// 	input = document.getElementById("myInput");
// 	filter = input.value.toUpperCase();
// 	div = document.getElementById("myDropdown");
// 	a = div.getElementsByTagName("a");
// 	for (i = 0; i < a.length; i++) {
// 		txtValue = a[i].textContent || a[i];.innerText;
// 		if (txtValue.toUpperCase().indexOf(filter) > -1) {
// 			a[i].style.display = "";
// 		} else {
// 			a[i].style.display = "none";
// 		}
// 	}
// }
