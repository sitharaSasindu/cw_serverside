<!DOCTYPE html>
<html>
<head>
	<title>Musically</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/main.js'); ?>"></script>
	<style>
		.background {
			background-image: url("<?php echo base_url('assets/image/login_back.jpg'); ?>");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
			height: 100%;
		}
	</style>
	<script type="text/javascript">
        function hideAlertBoxes() {
            var x = document.getElementById("genreBox");
            var y = document.getElementById("formValidateErrors");
            x.style.display = "none";
            y.style.display = "none";
        }

        function doSelect(el) {
            sel = el.options[el.selectedIndex].value;
            // var select += sel;
            if (sel == "-") {
                alert("Please choose an option");
            } else {
                var x = document.getElementById("genreBox");
                // if (x.style.display === "none") {
                x.style.display = "block";
                document.getElementById("selectedGenres").value += sel;
                $('#selectedGenres').val($('#selectedGenres').val() + ', ');
            }
        }
	</script>
</head>
<body>
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
	<div class="container"><a class="navbar-brand logo"><h1>Musically</h1></a>
	</div>
</nav>

<div class="background">
	<div class="container">
		<div class="row" style="margin-top: 62px">
			<div class="col-lg-9"></div>
			<div class="col-lg-3" style="background-color: white">
				<div class="login-form">

					<label class="label">Already a Member</label><input type="button"
																		onclick="location.replace('login')"
																		value="Sign Ip"
																		class="btn btn-xs btn-success btn-block">

					<form id="login" name="loginForm"
						  action="/2016372/cw_serverside/index.php/UserController/Registration"
						  method="post">

						<div class="form-group">
							<br> <span class="form-title">Sign Up<br><br></span>
							<div class="alert alert-success alert-dismissible fade in" id="formValidateErrors">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo validation_errors(); ?>
							</div>
							<label class="label">First Name</label>
							<div class="wrap-input">
								<input id="firstName" class="input" type="text" name="firstName"
									   placeholder="First Name">
								<span class="focus-input"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="label">Last Name</label>
							<div class="wrap-input">
								<input type="text" class="input" name="lastName" id="lastName"
									   placeholder="Last Name">
								<span class="focus-input"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="label">email</label>
							<div class="wrap-input">
								<input type="email" class="input" name="email" id="email"
									   placeholder="Email">
								<span class="focus-input"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="label">password</label>
							<div class="wrap-input">
								<input type="Password" class="input" name="password" id="password"
									   placeholder="Password">
								<span class="focus-input"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="label">Verify password</label>
							<div class="wrap-input">
								<input type="Password" class="input" name="passwordVerify" id="passwordVerify"
									   placeholder="Password">
								<span class="focus-input"></span>
							</div>
						</div>

						<div class="form-group">
							<select class="dropbtn" name="select" id="mySelect" onchange="doSelect(this)">
								<div class="dropdown-content">
									<option value="-">Choose Your Genres</option>
									<option value="Pop">Pop</option>
									<option value="Jazz">Jazz</option>
									<option value="Classic">Classic</option>
									<option value="Rock">Rock</option>
									<option value="Electro">Electro</option>
									<option value="Hiphop">Hiphop</option>
								</div>
							</select>
							<div class="alert alert-success alert-dismissible fade in" id="genreBox">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<input type="text" class="input" name="selectedGenres" id="selectedGenres" readonly><br>
								<!--							<label type="text" id="selectedGenres" name="selectedGenres"></label><br>-->
							</div>
						</div>
						<br>

						<div class="form-group">
							<center>
								<br><input type="submit" id="loginbtn" value="Sign Up"
										   class="btn btn-xs btn-success btn-block">
							</center>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>


<footer class="page-footer">
	<div class="footer-copyright">
		<p>© 2019 Copyright</p>
	</div>
</footer>


</body>
</html>
