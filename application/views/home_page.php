<!DOCTYPE html>
<html>
<head>
	<title>Musically</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<style>
		.background {
			background-image: url("<?php echo base_url('assets/image/login_back.jpg'); ?>");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
	<div class="container"><a class="navbar-brand logo"><h1>Musically</h1></a>
	</div>
</nav>

<div class="background">
	<div class="col-lg-3"></div>


	<div class="col-lg-9" style="background-color: white">
		<form method="POST" action="/2016372/cw_serverside/index.php/UserController/logout">
			<input type="submit" name="button1" value="Sign Out">
		</form>
	</div>

</body>
</html>
