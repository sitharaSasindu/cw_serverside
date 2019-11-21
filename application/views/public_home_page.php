
<!DOCTYPE html>
<html>
<head>
	<title>Musically</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/time-line.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/home_page.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/main.js'); ?>"></script>


	<!--time line style-->
	<style>

	</style>

</head>
<body>

<div class='container' style="background-color: #e2e0e0">
	<div class="fb-profile">
		<img align="left" class="fb-image-lg"
			 src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTfMhgAB_nzwLdNIpmxUz3YaWtkGhqi7QUkljzC_ogmqxT7b7VQ"
			 alt="Profile image example"/>
		<img align="left" class="fb-image-profile thumbnail"
			 src="http://www.tutorialspoint.com/about/images/mohtashim.jpg" alt="Profile image example"/>
		<div class="fb-profile-text">
			<h1><?php echo $this->session->userdata('redirectedUsersFirstName'); ?>
				<?php echo $this->session->userdata('redirectedUsersLastName'); ?></h1>
			<p><?php echo $this->session->userdata('redirectedUsersMusicGenre'); ?></p>
		</div>
	</div>


	<div class="navbar" style="background-color: #999999">
		<a class="active" href="/2016372/cw_serverside/index.php/home"><i class="fa fa-fw fa-home"></i> Home</a>
		<a href="/2016372/cw_serverside/index.php/findFriends"><i class="fa fa-fw fa-user"></i> Friends</a>
		<a href="/2016372/cw_serverside/index.php/followers"><i class="fa fa-fw fa-user"></i> Followers</a>
		<a href="/2016372/cw_serverside/index.php/followings"><i class="fa fa-fw fa-user"></i> Followings</a>
		<a href="/2016372/cw_serverside/index.php/logout"><i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
		<form class="form-inline" method="post"
			  action="/2016372/cw_serverside/index.php/FriendsController/ShowUsersByGenre">
			<input class="form-control mr-sm-2" name="genreSearch" type="text" placeholder="Search">
			<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-search"></i>Search</button>
		</form>
	</div>


	<div class="timeline-centered">
		<?php

		if(empty($currentUserPosts)) {
echo "No Posts";
		}else{

		foreach ($currentUserPosts as $row) {
			$date = date('Y-m-d', strtotime($row->timestamp));
			$time = date('H:i:s', strtotime($row->timestamp));



			if ($row->counter % 2 == 0) {

				?>

				<?php echo $date ?>
				<article class="timeline-entry">

					<div class="timeline-entry-inner">
						<time class="timeline-time" datetime="2014-01-10T03:45"><span><?php echo $time ?></span>
							<span>	<?php echo $date ?></span>
						</time>

						<div class="timeline-icon bg-success">
							<i class="entypo-feather"></i>
						</div>

						<div class="timeline-label">
							<h2><a href="#">Mohtashim M.</a> <span>Founder & Managing Director</span></h2>
							<p>Mohtashim is an MCA from AMU (Aligarah) and a Project Management Professional. He has
								more
								than 17 years of experience in Telecom and Datacom industries covering complete SDLC. He
								is
								managing in-house innovations, business planning, implementation, finance and the
								overall
								business development of Tutorials Point.</p>
						</div>
					</div>

				</article>

			<?php } else { ?>


				<article class="timeline-entry left-aligned">

					<div class="timeline-entry-inner">
						<time class="timeline-time" datetime="2014-01-10T03:45"><span>03:45 AM</span> <span>Today</span>
						</time>

						<div class="timeline-icon bg-warning">
							<i class="entypo-camera"></i>
						</div>

						<div class="timeline-label">
							<h2><a href="#">Gopal K Verma </a> <span>changed his</span> <a href="#">Profile Picture</a>
							</h2>

							<blockquote>Gopal is an MCA from GJU (Hisar) and a Cisco Certified Network Professional. He
								has
								more than 11 years of experience in core data networking and telecommunications. He
								develops
								contents for Computer Science related subjects. He is also involved in developing Apps
								for
								various Mobile devices.
							</blockquote>

							<img src="http://www.tutorialspoint.com/about/images/gopal_verma.jpg"
								 class="img-responsive img-rounded full-width">
						</div>
					</div>

				</article>
			<?php }
		}	} ?>

		<article class="timeline-entry begin">

			<div class="timeline-entry-inner">

				<div class="timeline-icon"
					 style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
					<i class="entypo-flight"></i>
				</div>

			</div>

		</article>
	</div>
	<!--			</div>-->
	<!--	</div>-->

	<div class="page-footer">
		© Copyright 2019. All Rights Reserved.
	</div>
</div>


</body>
</html>
