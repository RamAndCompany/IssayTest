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
		
		<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/icons.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/jquery-ui.css" />
		<script src="<?php echo base_url();?>application/views/js/jquery-ui.min.js"></script>
	</head>
	<body class="homepage">
	
	
	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<h1 id="logo-right" >
							<a href="<?php echo site_url("indexpage/dashboard");?>">
								<img src="<?php echo base_url();?>application/views/images/logo.png" alt="">
							</a>
						</h1>
						<div id="logo-left" >
							<a href="<?php echo site_url("langSwitch/switchLanguage/english?url=".$url);?>" >
								<img src="<?php echo base_url();?>application/views/images/icons/flag_en.png" alt="" style="box-shadow: 2px 2px 2px #676767;" >
							</a>
							<a href="<?php echo site_url("langSwitch/switchLanguage/japanese?url=".$url);?>" >
								<img src="<?php echo base_url();?>application/views/images/icons/flag_jp.png" alt="" style="box-shadow: 2px 2px 2px #676767;">
							</a>
						</div>
					</div>
					<div class="clear" ></div>
			</div>
		</div>
	<!-- Header -->
		