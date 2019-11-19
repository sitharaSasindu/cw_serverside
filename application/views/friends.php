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


	<script>
        $(document).ready(function(){
<?php foreach ($user as $key => $item) { ?>
            var i;
            // for(i=0; i<=1; i++){
                console.log("<?php echo $key ?>");
                $("#personal-info<?php echo $key?>").submit(function(e){
                    console.log("<?php echo $key ?>");
                    e.preventDefault();
                    var title = $("#js_personal_title").val();;
                    var decs= $("#js_personal_desc").val();
                    //var dec= $("#queriedUser<?php //echo $user[$key][0][1] ?>//").val();
                    var userId = "<?php echo $user[$key][0][1] ?>";
                    console.log(userId);
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url() ?>index.php/FriendsController/add_personal',
                        data: {userId:userId},
                        success:function(data)
                        {
                            alert('SUCCESS!!');
                        },
                        error:function()
                        {
                            alert('fail');
                        }
                    });
                });

			// }
<?php } ?>
        });
	</script>

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
		<a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
		<a href="#"><i class="fa fa-fw fa-search"></i> Search</a>
		<a href="#"><i class="fa fa-fw fa-envelope"></i> Friends</a>
		<a href="#"><i class="fa fa-fw fa-user"></i>
			<form method="POST" action="/2016372/cw_serverside/index.php/UserController/logout">
				<input type="submit" name="button1" value="Sign Out">
			</form>
		</a>
	</div>
	<!--<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">-->
	<!--	<div class="container"><a class="navbar-brand logo"><h1>Musically</h1></a>-->
	<!--	</div>-->
	<!--</nav>--><h1>
		<?php

		foreach ($user as $row) {
//
//	print_r($row->fname);
//	echo $row->lname;
		}

//		print_r($user[2][0]);

		foreach ($user as $key => $item) {
			 ?>



			<?php

			echo ($user[$key][0][1]); ?> <?php	echo($user[$key][0][2]); ?><br>
			<?php echo"<form action='' method='POST' id='personal-info".$key."' class='form-group'>"; ?>
			<input class="form-control" type="text" id="js_personal_title" name="js_personal_title">
			<input class="form-control" type="text" id="js_personal_desc" name="js_personal_desc">
			<?php echo "<input type='hidden' id='queriedUser".$key."' value='".$user[$key][0][1]."'/>";?>
			<!--			<input type="hidden" name="id_director" value="--><?//= $id ?><!--" />-->
			<input id="submit-p" class="form-control" type="submit" value="Add">
			</form>

			personal-info[<?php echo $key?>]

	<?php	} ?>

	</h1>
<!--	<form action="" method="POST" id="personal-info" class="form-group">-->
<!--		<input class="form-control" type="text" id="js_personal_title" name="js_personal_title">-->
<!--		<input class="form-control" type="text" id="js_personal_desc" name="js_personal_desc">-->
<!--		<input id="submit-p" class="form-control" type="submit" value="Add">-->
<!--	</form>-->
<!--		<form action="" method="POST" id="personal-info1" class="form-group">-->
<!--		<input class="form-control" type="text" id="js_personal_title" name="js_personal_title">-->
<!--		<input class="form-control" type="text" id="js_personal_desc" name="js_personal_desc">-->
<!--		<input id="submit-p" class="form-control" type="submit" value="Add">-->
<!--	</form>-->

	<!--			</div>-->
	<!--	</div>-->





	<div class="page-footer">
		© Copyright 2019. All Rights Reserved.
	</div>
</div>


</body>
</html>
