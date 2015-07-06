<!DOCTYPE HTML>
<!--
	Ex Machina by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php echo $title;?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php echo base_url();?>application/views/js/skel.min.js"></script>
		<script src="<?php echo base_url();?>application/views/js/skel-panels.min.js"></script>
		<script src="<?php echo base_url();?>application/views/js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/skel-noscript.css" />
			<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style.css" />
			<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo base_url();?>application/views/css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo base_url();?>application/views/css/ie/v9.css" /><![endif]-->
		<!--<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style-desktop.css" />-->
	</head>
	<body class="homepage">

		
	<!-- Main -->
		<div id="page">

			<!-- Extra -->
			<div class="container">
				<div class="row">
					<div class="clear" ></div>
					<div class="12u">
						<section>
							<?php
							$attributes = array('class' => 'form-horizontal', 'id' => 'form_login', 'name' => 'form_login', 'enctype' => 'multipart/form-data');
							echo form_open('indexpage/login', $attributes);
							?>
							<div id="loginPanel" >
							<div><a href="#"><img src="<?php echo base_url();?>application/views/images/logo.png" alt=""></a></div>
							
								<?php 
								if(isset($error) && $error != false){
									echo '<div class="alert alert-error" >'.$error.'</div>';
									echo '<div class="clear" ></div>';
								}
								?>
								<div style="padding:10px">
									<input type="text" id="username" name="username" value="" placeholder="<?php echo $userid;?>" class="formTxt" tabindex="1" />
								</div>
								<div style="padding:10px">
									<input type="password" id="password" name="password" value="" placeholder="<?php echo $password;?>" class="formTxt" tabindex="2" />
								</div>
								<div style="padding:10px;text-align: center;">
									<input type="submit" class="btn-login" name="btn" id="btn" value="<?php echo $login_btn;?>" onclick="return submitForm();" tabindex="3" />
								</div>
							</div>
							</form>
						</section>
					</div>
				</div>
			</div>
			<!-- /Extra -->
				
			

		</div>
	<!-- /Main -->
	</body>
	<script>
		function submitForm(){
			$("#username").css({'border':'1px solid #CCC'});
			$("#password").css({'border':'1px solid #CCC'});
			if($("#username").val() == false){
				$("#username").focus();
				$("#username").css({'border':'1px solid #FF0000'});
				return false;
			}
			if($("#password").val() == false){
				$("#password").focus();
				$("#password").css({'border':'1px solid #FF0000'});
				return false;
			}
		}		 
	</script>
</html>