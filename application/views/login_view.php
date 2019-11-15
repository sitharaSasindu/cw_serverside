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
				Not a Member<input type="button" onclick="location.replace('Register')" id="signUp" value="Sign Up"
					   class="btn btn-xs btn-block">
				<div class="login-form">
					<div class="logo-container" align="center"><img
							src="<?php echo base_url('assets/image/logo1.jpg'); ?>" width="100" height="150">
					</div>
					<form id="login" name="loginForm" action="/2016372/cw_serverside/index.php/UserController/Login"
						  method="post">
						<div class="form-group">

						
							<br> <span class="form-title">Sign In<br><br></span>
							<div class="wrap-input">
								<input id="email" class="input" type="email" name="email"
									   placeholder="Email">
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
							<input type="button" id="loginbtn" value="Login"
								   class="btn btn-xs btn-success btn-block">
						</center>
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
