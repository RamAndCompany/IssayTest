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
		<script src="<?php echo base_url();?>application/views/js/inner-skel.min.js"></script>
		<script src="<?php echo base_url();?>application/views/js/inner-skel-panels.min.js"></script>
		<script src="<?php echo base_url();?>application/views/js/inner-init.js"></script>
		<noscript>
			<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/skel-noscript.css" />
			<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style-inner.css" />
			<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo base_url();?>application/views/css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo base_url();?>application/views/css/ie/v9.css" /><![endif]-->
	</head>
	<body class="homepage">

	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<h1 id="logo-right" >
							<a href="<?php echo site_url("indexpage/index");?>">
								<img src="<?php echo base_url();?>application/views/images/logo.jpg" alt="">
							</a>
						</h1>
						<div id="logo-left" >
							<a href="<?php echo site_url("langSwitch/switchLanguage/english?url=".$url);?>" >English</a>
							<a href="<?php echo site_url("langSwitch/switchLanguage/japanese?url=".$url);?>" >日本人</a>
						</div>
					</div>
					<div class="clear" ></div>
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="<?php echo site_url("indexpage/dashboard");?>"><img src="<?php echo base_url();?>application/views/images/menu/home.jpg" alt=""></a></li>
							<!--<li><a href="#"><img src="<?php echo base_url();?>application/views/images/menu/signup.jpg" alt=""></a></li>-->
							<li><a href="<?php echo site_url("indexpage/history");?>"><img src="<?php echo base_url();?>application/views/images/menu/time.jpg" alt=""></a></li>
							
							<li><a href="<?php echo site_url("phonecall/step1");?>"><img src="<?php echo base_url();?>application/views/images/menu/phone.jpg" alt=""></a></li>
							<li><a href="<?php echo site_url("sms/step1");?>"><img src="<?php echo base_url();?>application/views/images/menu/sms.jpg" alt=""></a></li>
							<li><a href="<?php echo site_url("member/index");?>"><img src="<?php echo base_url();?>application/views/images/menu/members.jpg" alt=""></a></li>
							<li><a href="<?php echo site_url("content/index");?>"><img src="<?php echo base_url();?>application/views/images/menu/content.jpg" alt=""></a></li>
							
							<li><a href="<?php echo site_url("indexpage/logout");?>"><img src="<?php echo base_url();?>application/views/images/menu/signout.jpg" alt=""></a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->