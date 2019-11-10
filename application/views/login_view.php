<!DOCTYPE html>
/**
* Created by PhpStorm.
* User: #Property_Of_Ss
* Date: 12/4/2018
* Time: 9:36 AM
*/

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blockchain - eKYC</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
	<link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="js/main.js"> -->
</head>

<body>

<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
	<div class="container"><a class="navbar-brand logo" href="#">Blockchain - eKYC</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span
				class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse"
			 id="navcol-1">
			<ul class="nav navbar-nav ml-auto">
				<li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Login</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!--===============================================================================================-->

<div class="background">
	<div class="container">
		<div class="row" style="margin-top: 62px">

			<div class="col-lg-4"></div>
			<div class="col-lg-4" style="background-color: white">
				<div class="login-form">
					<form id="login" name="loginForm" action="/new-connection" method="post">
						<div class="form-group">
							<br> <span class="contact100-form-title">Sign In<br><br></span>

							<div class="wrap-input">
								<input id="agntName" class="input" type="text" name="agntName"
									   placeholder="Agent Name">
								<span class="focus-input"></span>
							</div>
						</div>

						<div class="form-group">
							<div class="wrap-input">
								<input type="Password" class="input" name="pass" id="pass" placeholder="Password">
								<span class="focus-input"></span>
							</div>
						</div>

						<center>
							<input type="button" id="loginbtn" value="Login"
								   class="btn btn-xs btn-success btn-block">
						</center>
					</form>

				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>
</div>

<!--===============================================================================================-->

<script type="text/javascript">
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    $(function () {
        $("#loginbtn").click(function () {

            var agntName = document.forms["loginForm"]["agntName"].value;
            var pass = document.forms["loginForm"]["pass"].value;

            setCookie("agentName", agntName, 1);

            if (agntName == "") {
                alert("Please Enter Your User Name !")
                returnToPreviousPage();
            } else if (pass == "") {
                alert("Password is Empty or Mismatch")
                returnToPreviousPage();
            } else {
                document.forms['loginForm'].submit();
                $("#loginForm").trigger('reset');
                $("#agntName").val("");
            }

            $("#loginForm").trigger('reset');
            $("#agntName").val("");

        });
    });
</script>

<footer class="page-footer">
	<div class="footer-copyright">
		<p>© 2019 Copyright</p>
	</div>
</footer>


</body>
</html>
