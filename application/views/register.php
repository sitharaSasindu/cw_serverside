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
<!--					<div class="logo-container" align="center"><img-->
<!--							src="--><?php //echo base_url('assets/image/logo1.jpg'); ?><!--" width="100" height="150">-->
<!--					</div>-->

					<form id="login" name="loginForm" action="/2016372/cw_serverside/index.php/UserController/Login"
						  method="post">

						<div class="form-group">
							<br> <span class="form-title">Sign Up<br><br></span>
							<div class="alert alert-warning">
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
								<div class="dropdown">
									<button class="dropbtn">Dropdown</button>
									<div class="dropdown-content">
										<a href="#">Link 1</a>
										<a href="#">Link 2</a>
										<a href="#">Link 3</a>
									</div>
							</div> 
							<br>

							<div class="form-group">
						<center>
						<br><input type="submit" id="loginbtn" value="Sign Up"
								   class="btn btn-xs btn-success btn-block">
						</center></div>
					</form>

				</div>
			</div>
			<!--		<div class="col-lg-1"></div>-->
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
