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
	<script type='text/javascript' src="<?php echo base_url('assets/js/main.js'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/preloader.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
	<script type="text/javascript">
        $(window).on('load', function () { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(450).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(550).css({'overflow': 'visible'});
        })
	</script>
	<style>
		.container {
			padding-bottom: 100px;
			/*height: 100%;*/
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
			<a href="/2016372/cw_serverside/index.php/userProfile"><i class="fa fa-fw fa-home"></i> My Profile</a>
			<a href="/2016372/cw_serverside/index.php/contacts"><i class="fa fa-fw fa-user"></i> Contacts</a>
			<a href="/2016372/cw_serverside/index.php/friends"><i class="fa fa-fw fa-user"></i> Friends</a>
			<a class="active" href="/2016372/cw_serverside/index.php/followers"><i class="fa fa-fw fa-user"></i>Followers</a>
			<a href="/2016372/cw_serverside/index.php/followings"><i class="fa fa-fw fa-user"></i> Followings</a>
			<a href="/2016372/cw_serverside/index.php/logout"><i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
			<form class="form-inline" method="post"
				  action="/2016372/cw_serverside/index.php/FriendsController/ShowUsersByGenre">
				<input class="form-control mr-sm-2" name="genreSearch" type="text" placeholder="Search">
				<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-search"></i>Search</button>
			</form>
		</div>

		<div id='page-small-title' class="page-small-title">Your Followers,</div>
		<div class='page-small-title' id='page-small-title-no'>You have no Followers.</div>
		<script>
            $('#page-small-title').hide();
            $('#page-small-title-no').hide();
		</script>
		<?php
		if (!empty($followers)) { ?>
			<?php
		foreach ($followers as $row) {
			if(!empty($friends)){
		foreach ($friends as $row2) {
		if (in_array($row, $friends)) {
		if (count($followers) == count($friends)) {
			?>
			<script>
                $('#page-small-title').hide();
                $('#page-small-title-no').show();
			</script>
		<?php }
		}else { ?>
			<script>
                $('#page-small-title').show();
                $('#page-small-title-no').hide();
			</script>
			<div class='profile' style="">
				<img src="<?php echo $row->getProfilePhotoUrl() ?>" class='avatar'>
				<label class="label-profile">
					<?php echo $row->getFirstName(); ?>
					<?php echo $row->getLastName(); ?>
				</label>
			</div>
		<?php }
		} }else{ ?>
			<script>
                $('#page-small-title').show();
                $('#page-small-title-no').hide();
			</script>
			<div class='profile' style="">
				<img src="<?php echo $row->getProfilePhotoUrl() ?>" class='avatar'>
				<label class="label-profile">
					<?php echo $row->getFirstName(); ?>
					<?php echo $row->getLastName(); ?>
				</label>
			</div>
	<?php	}
		} ?>
		<?php } else{ ?>
			<script>
                $('#page-small-title').hide();
                $('#page-small-title-no').show();
			</script>
		<?php } ?>


	</div>
	<div class="page-footer">
		<div class="footer-copyright" style="color: #938c8c;">
			© Copyright 2019. All Rights Reserved.
		</div>
	</div>
</body>
</html>

