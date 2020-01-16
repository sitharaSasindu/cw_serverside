<!DOCTYPE html>
<html>
<head>
	<title>Musically</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/home_page.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/main.js'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/preloader.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>">
	<script type='text/javascript' src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="<?php echo base_url('assets/js/underscore.js'); ?>"></script>
	<meta charset="UTF-8">
	<script src="<?php echo base_url('assets/js/backbone.js'); ?>"></script>
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
	<script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

	</script>
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
			<a class="active" href="/2016372/cw_serverside/index.php/friends"><i class="fa fa-fw fa-user"></i> Contacts</a>
			<a href="/2016372/cw_serverside/index.php/friends"><i class="fa fa-fw fa-user"></i> Friends</a>
			<a href="/2016372/cw_serverside/index.php/followers"><i class="fa fa-fw fa-user"></i>Followers</a>
			<a href="/2016372/cw_serverside/index.php/followings"><i class="fa fa-fw fa-user"></i> Followings</a>
			<a href="/2016372/cw_serverside/index.php/logout"><i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
			<form class="form-inline" method="post"
				  action="/2016372/cw_serverside/index.php/FriendsController/ShowUsersByGenre">
				<input class="form-control mr-sm-2" name="genreSearch" type="text" placeholder="Search">
				<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-search"></i>Search</button>
			</form>
		</div>

		<div style="background-color: #ffffff">

			<button class="btn btn-warning show">Add Contact</button>
			<button style="text-align: right" class="btn btn-warning tagsShow"> Tags
			</button>
			<input class="form-control search" name="search" type="text" placeholder="Search">
			<button style="text-align: right" class="btn btn-warning searchBtn"> Search
			</button>

			<br><br>

			<table class="table" style="text-align-last: center;">
				<thead>
				<tr>
					<th>First Name</th>
					<th class="">SurName</th>
					<th class="tb-header-address">Address</th>
					<th class="tb-header-email">Email</th>
					<th>Phone</th>
					<th class="tb-header-tags">Tags</th>
					<th>Action</th>
				</tr>
				<tr class="insert-contact">
					<td><input class="form-control firstName-input"></td>
					<td><input class="form-control surName-input"></td>
					<td><input class="form-control address-input"></td>
					<td><input class="form-control email-input"></td>
					<td><input class="form-control phone-input"></td>
					<td>
						<script type="text/javascript">
						//fetch tag names from db and show it in a dropdown
                            $(document).ready(function() {
                                $('.selected_tags').select2({
                                    ajax: {
                                        url: "<?php echo base_url(); ?>index.php/ContactsAPI/tag/",
                                        dataType: 'json',
                                        processResults: function (data) {
                                            var tag_data_array = [];
                                            data.forEach(function(value,key){
                                                tag_data_array.push({id:value.tagID,text:value.tagName})
                                            });
                                            return {
                                                results: tag_data_array
                                            }
                                        }
                                    }
                                });
                            });
						</script>
							<select class="selected_tags" name="selectedGenres[]" multiple="multiple" style="width: 100% ">
							</select>
					</td>
					<td>
						<button class="btn btn-primary add-contact">Add</button>
					</td>
				</tr>
				</thead>
				<!--where new contact data injects from backbone-->
				<tbody class="contact-list"></tbody>
			</table>

<!--			table row script template which injects to html-->
			<script type="text/template" class="contacts-list">
				<td class="hidden"><span class="contactID"><%= contactID %></span></td>
				<td><span class="firstName"><%= firstName  %></span></td>
				<td><span class="surName"><%= surName %></span></td>
				<td class="td-address"><span class="address"><%= address %></span></td>
				<td class="td-email"><span class="email"><%= email %></span></td>
				<td><span class="phone"><%= phone %></span></td>
				<td><span class="contactTags"><%= contactTags %></span></td>
				<td>
					<button class="btn btn-warning moreDetails-contact">Show-more</button>
					<button class="btn btn-warning edit-contact">Edit</button>
					<button class="btn btn-danger delete-contact">Delete</button>
					<button class="btn btn-success update-contact" style="display:none">Update</button>
					<button class="btn btn-danger cancel" style="display:none">Cancel</button>
				</td>
			</script>

			<script type="text/template" class="tags-list">
				<td class="hidden"><span class="tagID"><%= tagID %></span></td>
				<td><span class="tagName"><%= tagName  %></span></td>
				<td>
					<button class="btn btn-warning edit-tag">Edit</button>
					<button class="btn btn-danger delete-tag">Delete</button>
					<button class="btn btn-success update-tag" style="display:none">Update</button>
					<button class="btn btn-danger cancel" style="display:none">Cancel</button>
				</td>
			</script>

			<script src="<?php echo base_url('assets/js/contacts_script.js'); ?>"></script>
			<script src="<?php echo base_url('assets/js/tags_script.js'); ?>"></script>

		</div>

		<script type="text/javascript">
            //fetch tag names from db and show it in a dropdown
            $(document).ready(function() {
                $('.xxxx').select2({
                    ajax: {
                        url: "<?php echo base_url(); ?>index.php/ContactsAPI/tag/",
                        dataType: 'json',
                        processResults: function (data) {
                            var tag_data_array = [];
                            data.forEach(function(value,key){
                                tag_data_array.push({id:value.tagID,text:value.tagName})
                            });
                            return {
                                results: tag_data_array
                            }
                        }
                    }
                });
            });
		</script>
		<div class="page-footer">
			<div class="footer-copyright" style="color: #938c8c;">
				© Copyright 2019. All Rights Reserved.
			</div>
		</div>
</body>
</html>

