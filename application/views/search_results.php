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
	<script type="text/javascript">
        $(window).on('load', function () { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(450).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(550).css({'overflow': 'visible'});
        })
	</script>
	<style>
		.container{
			padding-bottom: 100px;
			height: 100%;
		}
		.background {
			background-image: url("<?php echo base_url('assets/image/back3.jpg'); ?>");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
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
			<a href="/2016372/cw_serverside/index.php/friends"><i class="fa fa-fw fa-user"></i>
				Friends</a>
			<a href="/2016372/cw_serverside/index.php/followers"><i class="fa fa-fw fa-user"></i> Followers</a>
			<a href="/2016372/cw_serverside/index.php/followings"><i class="fa fa-fw fa-user"></i> Followings</a>
			<a href="/2016372/cw_serverside/index.php/logout"><i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
			<form class="form-inline" method="post"
				  action="/2016372/cw_serverside/index.php/FriendsController/ShowUsersByGenre">
				<input class="form-control mr-sm-2" name="genreSearch" type="text" placeholder="Search">
				<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-search"></i>Search</button>
			</form>
		</div>

		<h1>
			<div style="text-align: -webkit-center; display: flex;">
				<!--check if search result is empty-->
				<?php if (empty($userListByGenre)) { ?>
					<div class='page-small-title'>No Users Follow this Genre</div>
					<?php
				} else {
					foreach ($userListByGenre as $key => $user) { //if it's not empty check one by one
						if ($user->getUserId() !== $this->session->userdata('userId')) {//check whether current user exists in the search result?>
							<!--select results where current user is not existing-->
							<div class="panel panel-default" style="width: 75%">
								<div class="panel-body">

									<!--View search result's User profiles with the names-->
									<form
										action="/2016372/cw_serverside/index.php/PublicHomePageController/RedirectToUserProfile"
										method="POST" class='form-group'>
										<?php echo "<input type='hidden' name='userId' value='" . $user->getUserId() . "' >" ?>
										<img src="<?php echo $user->getProfilePhotoUrl() ?>" class='avatar-search'>
										<label class="label-profile"><h2>
												<?php echo $user->getFirstName(); ?>
												<?php echo $user->getLastName(); ?></h2>
										</label>
										<input id="submit-p" class="btn btn-outline-success" type="submit"
											   value="View Profile">
									</form>

									<form action='/2016372/cw_serverside/index.php/FriendsController/followAUser'
										  method='POST' class='form-group'>
										<div style="disply:inline:Block">
											<!--check whether user particular user is already followed or not-->
											<?php
											if (in_array($user->getUserId(), $alreadyFollowedUsers)) {
												echo "<input type='hidden' name='userId' value='" . $user->getUserId() . "' >" ?>
												<input id="submit-p" class="btn btn-outline-success" type="submit"
													   value="UnFollow">
											<?php } else {
												echo "<input type='hidden' name='userId' value='" . $user->getUserId() . "' >" ?>
												<input id="submit-p" class="btn btn-outline-success" type="submit"
													   value="Follow">

											<?php } ?>
										</div>
									</form>
								</div>
							</div>
						<?php }
					}
				} ?>


			</div>
		</h1>



		<div class="page-footer">
			<div class="footer-copyright" style="color: #938c8c;">
				© Copyright 2019. All Rights Reserved.
			</div>
		</div>
	</div>
</body>
</html>
