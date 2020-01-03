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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/preloader.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/main.js'); ?>"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
	<script type="text/javascript">
        $(window).on('load', function () { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(650).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(550).css({'overflow': 'visible'});
        })
	</script>
	<style>
		.container{
			padding-bottom: 100px;
		}
		.background {
			background-image: url("<?php echo base_url('assets/image/back3.jpg'); ?>");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
			/*height: 100%;*/
		}
	</style>
</head>
<body onload="onload()">
<div id="preloader">
	<div id="status">&nbsp;</div>
</div>
<div class="background">
	<div class='container' style="background-color: #e2e0e0">
		<div class="wall-profile">
			<img align="left" class="wall-image-lg"
				 src="http://kmit.in/emagazine/wp-content/uploads/2017/10/1260-music.jpg"/>
			<img align="left" class="wall-image-profile thumbnail"
				 src="<?php echo $this->session->userdata('avatarUrl') ?>" "/>
			<div class="wall-profile-text">
				<h1><?php echo $this->session->userdata('firstName'); ?>
					<?php echo $this->session->userdata('lastName'); ?></h1>
				<p><?php
					$favGenreList = $this->session->userdata('musicGenre');
					foreach ($favGenreList as $key => $item) {
						echo $favGenreList[$key];
						echo " ";
					}
					?></p>
			</div>
		</div>

		<div class="navbar" style="background-color: #999999">
			<a href="/2016372/cw_serverside/index.php/home"><i class="fa fa-fw fa-home"></i> Home</a>
			<a class="active" href="/2016372/cw_serverside/index.php/userProfile"><i class="fa fa-fw fa-home"></i> My Profile</a>
			<a href="/2016372/cw_serverside/index.php/contacts"><i class="fa fa-fw fa-user"></i> Contacts</a>
			<a href="/2016372/cw_serverside/index.php/friends"><i class="fa fa-fw fa-user"></i> Friends</a>
			<a href="/2016372/cw_serverside/index.php/followers"><i class="fa fa-fw fa-user"></i> Followers</a>
			<a href="/2016372/cw_serverside/index.php/followings"><i class="fa fa-fw fa-user"></i> Followings</a>
			<a href="/2016372/cw_serverside/index.php/logout"><i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
			<form class="form-inline" method="post"
				  action="/2016372/cw_serverside/index.php/FriendsController/ShowUsersByGenre">
				<input class="form-control mr-sm-2" name="genreSearch" type="text" placeholder="Search">
				<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-search"></i>Search</button>
			</form>
		</div>

		<div class="row">
			<div class="col-md-9">
				<div class="widget-area no-padding blank">
					<div class="status-upload">
						<form action="/2016372/cw_serverside/index.php/HomePageController/NewPost"
							  method="post">
							<textarea name='newpost' placeholder="What are you doing right now?"></textarea>
							<button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="timeline-centered">
			<?php
			if (empty($allPosts)) { ?>
				<div class='page-small-title'>You have No Posts. Start Posting Today,</div>
			<?php	} else {
				foreach ($allPosts as $key => $row) {
					$date = date('Y-m-d', strtotime($row->getTimestamp()));
					$time = date('H:i:s', strtotime($row->getTimestamp()));

					if ($key % 2 == 0) { ?>

						<article class="timeline-entry">

							<div class="timeline-entry-inner">
								<time class="timeline-time" datetime="2014-01-10T03:45"><span><?php echo $time ?></span>
									<span>	<?php echo $date ?></span>
								</time>

								<div class="timeline-icon bg-success">
									<i class="entypo-feather"></i>
								</div>

								<div class="timeline-label">
									<h2>
										<img src=" <?php echo $currentlyPostedUsersDetails->getProfilePhotoUrl() ?>" style='width: 40px; height: 40px; border-radius: 50%;'><span>
											<?php	echo $currentlyPostedUsersDetails->getFirstName()." ".$currentlyPostedUsersDetails->getLastName();
											?>
									</span></h2>

									<p><?php
										echo $row->getPostBody() ?></p>
								</div>
							</div>

						</article>

					<?php } else { ?>

						<article class="timeline-entry left-aligned">

							<div class="timeline-entry-inner">
								<time class="timeline-time" datetime="2014-01-10T03:45"><span><?php echo $time ?></span>
									<span><?php echo $date ?></span>
								</time>

								<div class="timeline-icon bg-warning">
									<i class="entypo-camera"></i>
								</div>

								<div class="timeline-label">
									<h2>
										<img src=" <?php echo $currentlyPostedUsersDetails->getProfilePhotoUrl() ?>" style='width: 40px; height: 40px; border-radius: 50%;'><span>
											<?php	echo $currentlyPostedUsersDetails->getFirstName()." ".$currentlyPostedUsersDetails->getLastName();
											?>
									</span></h2>
									<p><?php echo $row->getPostBody()
										?></p>
								</div>
							</div>

						</article>
					<?php }
				}
			} ?>

			<article class="timeline-entry begin">

				<div class="timeline-entry-inner">

					<div class="timeline-icon"
						 style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
						<i class="entypo-flight"></i>
					</div>

				</div>

			</article>
		</div>
	</div>
	<div class="page-footer">
		<div class="footer-copyright" style="color: #938c8c;">
			© Copyright 2019. All Rights Reserved.
		</div>
	</div>


</body>
</html>
