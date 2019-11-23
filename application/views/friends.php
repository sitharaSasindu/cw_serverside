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
			 src="http://kmit.in/emagazine/wp-content/uploads/2017/10/1260-music.jpg"
			 alt="Profile image example"/>
		<img align="left" class="fb-image-profile thumbnail"
			 src="<?php echo $this->session->userdata('avatarUrl') ?>" alt="Profile image example"/>
		<div class="fb-profile-text">
			<h1><?php echo $this->session->userdata('firstName'); ?>
				<?php echo $this->session->userdata('lastName'); ?></h1>
			<p><?php
				$favGenreList = $this->session->userdata('musicGenre');
				foreach ($favGenreList as $key => $item){
					echo $favGenreList[$key];
					echo " ";
				}
				?></p>
		</div>
	</div>


	<div class="navbar" style="background-color: #999999">
		<a href="/2016372/cw_serverside/index.php/home"><i class="fa fa-fw fa-home"></i> Home</a>
		<a class="active" href="/2016372/cw_serverside/index.php/friends"><i class="fa fa-fw fa-user"></i> Friends</a>
		<a href="/2016372/cw_serverside/index.php/followers"><i class="fa fa-fw fa-user"></i> Followers</a>
		<a href="/2016372/cw_serverside/index.php/followings"><i class="fa fa-fw fa-user"></i> Followings</a>
		<a href="/2016372/cw_serverside/index.php/logout"><i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
		<form class="form-inline" method="post"
			  action="/2016372/cw_serverside/index.php/FriendsController/ShowUsersByGenre">
			<input class="form-control mr-sm-2" name="genreSearch" type="text" placeholder="Search">
			<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-search"></i>Search</button>
		</form>
	</div>

	<h1>Friends</h1>
<?php
	foreach ($friends as $key => $item) {
		echo $friends[$key][0]; ?> <?php echo $friends[$key][1];
	} ?>


	<div class="page-footer">
		© Copyright 2019. All Rights Reserved.
	</div>
</div>


</body>
</html>
