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

		@media (min-width: 1400px) {
			.container {
				width: 1800px;
			}
		}
	</style>
	<script>
        function hideAlertBoxes() {
            var y = document.getElementById("formValidateErrors");
            y.style.display = "none";
        }
	</script>
</head>
<body>
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar" style="top: 0;">
	<div class="container"><a class="navbar-brand logo"><h1>Musically</h1></a>
	</div>
</nav>

<div class="background">
	<div class="container">
		<div class="row" style="margin-top: 62px">
			<div class="col-lg-9"></div>
			<div class="col-lg-3" style="background-color: white">
				<label class="label">Not a Member</label><input type="button" onclick="location.replace('register')"
																id="signUp" value="Sign Up"
																class="btn btn-xs btn-block">
				<div class="login-form">
					<div class="logo-container" align="center"><img
							src="<?php echo base_url('assets/image/logo1.jpg'); ?>" width="100" height="150">
					</div>
					<form id="login" name="loginForm"
						  action="/2016372/cw_serverside/index.php/UserController/CheckLogin"
						  method="post">
						<div class="form-group">

							<br> <span class="form-title">Sign In<br><br></span>

							<div class="alert alert-success alert-dismissible fade in" id="formValidateErrors">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<h4><?php echo $this->session->flashdata('msg'); ?></h4>
							</div>

							<div class="wrap-input">
								<input id="userName" class="input" type="userName" name="userName"
									   placeholder="UserName">
								<span class="focus-input"></span>
							</div>
						</div>

						<div class="form-group">
							<div class="wrap-input">
								<input type="Password" class="input" name="password" id="password"
									   placeholder="Password">
								<span class="focus-input"></span>
							</div>
						</div>

						<?php echo anchor('register', 'Forget Password'); ?>

						<center>
							<input type="submit" id="loginbtn" value="Login"
								   class="btn btn-xs btn-success btn-block">
						</center>
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
