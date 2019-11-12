<!DOCTYPE html>
<html>
<head>
	<title>Musically</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="C:\xampp\htdocs\2016372\cw_serverside\application\views\css\main.css">

</head>
<body>

<div class="container">
	<h1>Musically</h1>
	<form class="form-horizontal" action="/2016372/cw_serverside/index.php/UserController/Login" method="post">
		<div class="form-group">
			<label class="control-label col-sm-2" >First Name</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstName">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Last Name</label>
			<div class="col-sm-3">
				<input type="Text" class="form-control" id="lastName" placeholder="Last Name" name="lastName">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Email</label>
			<div class="col-sm-3">
				<input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Password</label>
			<div class="col-sm-3">
				<input type="password" class="form-control" id="pwd" placeholder="Enter Password" name="password">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Verify Password</label>
			<div class="col-sm-3">
				<input type="password" class="form-control" id="pwdVerify" placeholder="Reenter Password" name="passwordVerify">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<div class="dropdown">
					<button class="dropbtn">Dropdown</button>
					<div class="dropdown-content">
						<a href="#">Link 1</a>
						<a href="#">Link 2</a>
						<a href="#">Link 3</a>
					</div>
				</div>
			</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">
					<label><input type="checkbox" name="remember">Remember me</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
	</form>
</div>
</body>
</html>
