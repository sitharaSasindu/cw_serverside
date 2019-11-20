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
			<h1><?php echo $this->session->userdata('firstName'); ?>
				<?php echo $this->session->userdata('lastName'); ?></h1>
			<p><?php echo $this->session->userdata('musicGenre'); ?></p>
		</div>
	</div>


	<div class="navbar" style="background-color: #999999">
		<a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home
			<form method="POST" action="/2016372/cw_serverside/index.php/PageController/HomePage">
				<input type="submit" name="button1" value="Friends">
			</form></a></a>
		<a href="#"><i class="fa fa-fw fa-search"></i> Search</a>
		<a href="#"><i class="fa fa-fw fa-envelope">
			<form method="POST" action="/2016372/cw_serverside/index.php/FriendsController/FindFriends">
				<input type="submit" name="button1" value="Friends"></i>
			</form></a>
		<a href="#"><i class="fa fa-fw fa-user"></i>
			<form method="POST" action="/2016372/cw_serverside/index.php/UserController/logout">
				<input type="submit" name="button1" value="Sign Out">
			</form>
		</a>
		<form class="form-inline" method="post" action="/2016372/cw_serverside/index.php/FriendsController/ShowUsersByGenre">
			<input class="form-control mr-sm-2" name="genreSearch" type="text"  placeholder="Search">
			<button class="btn btn-success" type="submit">Search</button>
		</form>
	</div>

	<br><br><h1>Followers</h1>
	<?php
	foreach ($followers as $key => $item) {
		echo $followers[$key][0]; ?> <?php echo $followers[$key][1];
	} ?>


	<div class="page-footer">
		© Copyright 2019. All Rights Reserved.
	</div>
</div>


</body>
</html>
<?php
