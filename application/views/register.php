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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
	<style>
		.background {
			background-image: url("<?php echo base_url('assets/image/login_back.jpg'); ?>");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
			/*height: 100%;*/
		}

		@media (min-width: 1400px) {
			.container {
				width: 1800px;
			}
		}
	</style>
	<script type="text/javascript">
        function hideAlertBoxes() {
            var x = document.getElementById("genreBox");
            var y = document.getElementById("formValidateErrors");
            x.style.display = "none";
            y.style.display = "none";
        }

        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
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
																		value="Sign In"
																		class="btn btn-xs btn-block">

					<form id="login" name="loginForm"
						  action="/2016372/cw_serverside/index.php/UserController/Registration"
						  method="post">

						<div class="form-group">
							<br> <span class="form-title">Sign Up<br><br></span>
							<div class="alert alert-success alert-dismissible fade in" id="formValidateErrors">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<h4><?php echo $this->session->flashdata('registerValidation'); ?></h4>
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
							<label class="label">UserName</label>
							<div class="wrap-input">
								<input type="text" class="input" name="userName" id="userName"
									   placeholder="Choose a Username">
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
							<label class="label">Avatar Url</label>
							<div class="wrap-input">
								<input type="url" class="input" name="photoUrl" id="photoUrl"
									   placeholder="Enter a Url to Update Your Profile Photo">
								<span class="focus-input"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="label">Select Your Favorite Genres</label>
							<select class='js-example-basic-multiple' name='selectedGenres[]' multiple='multiple'
									style="width: 100%" required>
								<?php
								foreach ($genre as $row) {
									echo "<option value='" . $row->getGenreId() . "'>" . $row->getGenreName() . "</span>";
								}
								?>
							</select>
						</div><br>

						<div class="form-group">
							<center><br><input type="submit" id="loginbtn" value="Sign Up"
										   class="btn btn-xs btn-success btn-block">
							</center>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="page-footer">
	<div class="footer-copyright" style="color: #938c8c;">
		© Copyright 2019. All Rights Reserved.
	</div>
</div>

</body>
</html>

