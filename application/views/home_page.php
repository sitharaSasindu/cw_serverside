<!DOCTYPE html>
<html>
<head>
	<title>Musically</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/time-line.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/main.js'); ?>"></script>


<!--time line style-->
	<style>
		img {
			vertical-align: middle;
		}

		.img-responsive {
			display: block;
			height: auto;
			max-width: 100%;
		}

		.img-rounded {
			border-radius: 3px;
		}

		.img-thumbnail {
			background-color: #fff;
			border: 1px solid #ededf0;
			border-radius: 3px;
			display: inline-block;
			height: auto;
			line-height: 1.428571429;
			max-width: 100%;
			moz-transition: all .2s ease-in-out;
			o-transition: all .2s ease-in-out;
			padding: 2px;
			transition: all .2s ease-in-out;
			webkit-transition: all .2s ease-in-out;
		}

		.img-circle {
			border-radius: 50%;
		}

		.timeline-centered {
			position: relative;
			margin-bottom: 30px;
		}

		.timeline-centered:before,
		.timeline-centered:after {
			content: " ";
			display: table;
		}

		.timeline-centered:after {
			clear: both;
		}

		.timeline-centered:before,
		.timeline-centered:after {
			content: " ";
			display: table;
		}

		.timeline-centered:after {
			clear: both;
		}

		.timeline-centered:before {
			content: '';
			position: absolute;
			display: block;
			width: 4px;
			background: #f5f5f6;
			left: 50%;
			top: 20px;
			bottom: 20px;
			margin-left: -4px;
		}

		.timeline-centered .timeline-entry {
			position: relative;
			width: 50%;
			float: right;
			margin-bottom: 70px;
			clear: both;
		}

		.timeline-centered .timeline-entry:before,
		.timeline-centered .timeline-entry:after {
			content: " ";
			display: table;
		}

		.timeline-centered .timeline-entry:after {
			clear: both;
		}

		.timeline-centered .timeline-entry:before,
		.timeline-centered .timeline-entry:after {
			content: " ";
			display: table;
		}

		.timeline-centered .timeline-entry:after {
			clear: both;
		}

		.timeline-centered .timeline-entry.begin {
			margin-bottom: 0;
		}

		.timeline-centered .timeline-entry.left-aligned {
			float: left;
		}

		.timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
			margin-left: 0;
			margin-right: -18px;
		}

		.timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
			left: auto;
			right: -100px;
			text-align: left;
		}

		.timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
			float: right;
		}

		.timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
			margin-left: 0;
			margin-right: 70px;
		}

		.timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
			left: auto;
			right: 0;
			margin-left: 0;
			margin-right: -9px;
			-moz-transform: rotate(180deg);
			-o-transform: rotate(180deg);
			-webkit-transform: rotate(180deg);
			-ms-transform: rotate(180deg);
			transform: rotate(180deg);
		}

		.timeline-centered .timeline-entry .timeline-entry-inner {
			position: relative;
			margin-left: -22px;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner:before,
		.timeline-centered .timeline-entry .timeline-entry-inner:after {
			content: " ";
			display: table;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner:after {
			clear: both;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner:before,
		.timeline-centered .timeline-entry .timeline-entry-inner:after {
			content: " ";
			display: table;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner:after {
			clear: both;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
			position: absolute;
			left: -100px;
			text-align: right;
			padding: 10px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span {
			display: block;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:first-child {
			font-size: 15px;
			font-weight: bold;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:last-child {
			font-size: 12px;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
			background: #fff;
			color: #737881;
			display: block;
			width: 40px;
			height: 40px;
			-webkit-background-clip: padding-box;
			-moz-background-clip: padding;
			background-clip: padding-box;
			-webkit-border-radius: 20px;
			-moz-border-radius: 20px;
			border-radius: 20px;
			text-align: center;
			-moz-box-shadow: 0 0 0 5px #f5f5f6;
			-webkit-box-shadow: 0 0 0 5px #f5f5f6;
			box-shadow: 0 0 0 5px #f5f5f6;
			line-height: 40px;
			font-size: 15px;
			float: left;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
			background-color: #303641;
			color: #fff;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-secondary {
			background-color: #ee4749;
			color: #fff;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-success {
			background-color: #00a651;
			color: #fff;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-info {
			background-color: #21a9e1;
			color: #fff;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-warning {
			background-color: #fad839;
			color: #fff;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-danger {
			background-color: #cc2424;
			color: #fff;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
			position: relative;
			background: #f5f5f6;
			padding: 1.7em;
			margin-left: 70px;
			-webkit-background-clip: padding-box;
			-moz-background-clip: padding;
			background-clip: padding-box;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
			content: '';
			display: block;
			position: absolute;
			width: 0;
			height: 0;
			border-style: solid;
			border-width: 9px 9px 9px 0;
			border-color: transparent #f5f5f6 transparent transparent;
			left: 0;
			top: 10px;
			margin-left: -9px;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2,
		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
			color: #737881;
			font-family: "Noto Sans", sans-serif;
			font-size: 12px;
			margin: 0;
			line-height: 1.428571429;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p + p {
			margin-top: 15px;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 {
			font-size: 16px;
			margin-bottom: 10px;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 a {
			color: #303641;
		}

		.timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 span {
			-webkit-opacity: .6;
			-moz-opacity: .6;
			opacity: .6;
			-ms-filter: alpha(opacity=60);
			filter: alpha(opacity=60);
		}
	</style>

</head>
<body>

<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
	<div class="container"><a class="navbar-brand logo"><h1>Musically</h1></a>
	</div>
</nav>

	<div class="col-lg-3" style="background-color: #efefef">
		<?php
		echo $this->session->userdata('firstName');
		?>
	</div>

<div class="col-lg-9" style="background-color: white">

<div class="container">

	<h1 class="thick-heading">
		|| Time line Example||
	</h1>

	<!-- First Featurette -->
	<div class="featurette" id="about">
		<!------------------------code---------------start---------------->
		<div class="container">
			<div class="row">
				<div class="timeline-centered">

					<article class="timeline-entry">

						<div class="timeline-entry-inner">
							<time class="timeline-time" datetime="2014-01-10T03:45"><span>03:45 AM</span> <span>Today</span></time>

							<div class="timeline-icon bg-success">
								<i class="entypo-feather"></i>
							</div>

							<div class="timeline-label">
								<h2><a href="#">Mohtashim M.</a> <span>Founder & Managing Director</span></h2>
								<p>Mohtashim is an MCA from AMU (Aligarah) and a Project Management Professional. He has more than 17 years of experience in Telecom and Datacom industries covering complete SDLC. He is managing in-house innovations, business planning, implementation, finance and the overall business development of Tutorials Point.</p>
							</div>
						</div>

					</article>


					<article class="timeline-entry left-aligned">

						<div class="timeline-entry-inner">
							<time class="timeline-time" datetime="2014-01-10T03:45"><span>03:45 AM</span> <span>Today</span></time>

							<div class="timeline-icon bg-secondary">
								<i class="entypo-suitcase"></i>
							</div>

							<div class="timeline-label">
								<h2><a href="#">Job Meeting</a></h2>
								<p>You have a meeting at <strong>Tutorials point</strong> Today.</p>
							</div>
						</div>

					</article>


					<article class="timeline-entry">

						<div class="timeline-entry-inner">
							<time class="timeline-time" datetime="2014-01-09T13:22"><span>03:45 AM</span> <span>Today</span></time>

							<div class="timeline-icon bg-info">
								<i class="entypo-location"></i>
							</div>

							<div class="timeline-label">
								<h2><a href="#">Gopal K Verma </a> <span>checked in at</span> <a href="#">Tutorials Point</a></h2>

								<blockquote>Great place, feeling like in home.</blockquote>

							</div>
						</div>

					</article>


					<article class="timeline-entry left-aligned">

						<div class="timeline-entry-inner">
							<time class="timeline-time" datetime="2014-01-10T03:45"><span>03:45 AM</span> <span>Today</span></time>

							<div class="timeline-icon bg-warning">
								<i class="entypo-camera"></i>
							</div>

							<div class="timeline-label">
								<h2><a href="#">Gopal K Verma </a> <span>changed his</span> <a href="#">Profile Picture</a></h2>

								<blockquote>Gopal is an MCA from GJU (Hisar) and a Cisco Certified Network Professional. He has more than 11 years of experience in core data networking and telecommunications. He develops contents for Computer Science related subjects. He is also involved in developing Apps for various Mobile devices.</blockquote>

								<img src="http://www.tutorialspoint.com/about/images/gopal_verma.jpg" class="img-responsive img-rounded full-width">
							</div>
						</div>

					</article>


					<article class="timeline-entry begin">

						<div class="timeline-entry-inner">

							<div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
								<i class="entypo-flight"></i>
							</div>

						</div>

					</article>
				</div>
			</div>
		</div>
	</div>
	<!----Code------end----------------------------------->
</div>

</div>
<!-- /.container -->
<div class="footer-copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-1">
				<a href="index.html" class="logo">

					<img alt="Tutorials Point" class="img-responsive" src="http://www.tutorialspoint.com//scripts/img/logo-footer.png">

				</a>
				<form method="POST" action="/2016372/cw_serverside/index.php/UserController/logout">
					<input type="submit" name="button1" value="Sign Out">
			</div>
			<div class="col-md-3 col-sm-12 col-xs-12">
				<p>
					© Copyright 2015. All Rights Reserved.
				</p>
			</div>
		</div>
	</div>
</div>



<!--	<div class="col-lg-9" style="background-color: white">-->
<!--		<form method="POST" action="/2016372/cw_serverside/index.php/UserController/logout">-->
<!--			<input type="submit" name="button1" value="Sign Out">-->
<!--		</form>-->
<!--	</div>-->

</body>
</html>
