		<div id="header-line" >
			<div id="headIco" ><img src="<?php echo base_url();?>application/views/images/content.jpg" alt=""></div>
			<div id="headTitle" ><?php echo $content_title;?></div>
			<div class="clear" ></div>
			<div id="headerLine" ></div>
		</div>
		
		<div class="clear" ></div>
		
	<!-- Main -->
		<div id="page" style="padding-top: 15px;" >

			<!-- Extra -->
			<div id="marketing" class="container">
				<div class="row">
					<div class="12u">
						<section>
							<div style="padding: 40px;background: #0BA29B;" >
								<div class="clear" ></div>
								<div class="w35 left" style="margin-left: 135px;" >
									<section>
										<p><a href="<?php echo site_url("content/content_home").'?type=calls';?>"><img src="<?php echo base_url();?>application/views/images/call.jpg" alt=""></a></p>
										<header>
											<h2><?php echo $calls;?></h2>
										</header>
									</section>
								</div>
								<div class="w35 left">
									<section>
										<p><a href="<?php echo site_url("content/content_home").'?type=sms';?>"><img src="<?php echo base_url();?>application/views/images/message.jpg" alt=""></a></p>
										<header>
											<h2><?php echo $sms;?></h2>
										</header>
									</section>
								</div>
								<div class="clear" ></div>
							</div>
						</section>
					</div>
					
				</div>
			</div>
			<!-- /Extra -->
				
			

		</div>
	<!-- /Main -->

	

	<!-- Copyright -->
		<div id="copyright" class="container">
			2015&copy; CopyRight Emotion Wave Co., Ltd
		</div>
	</body>
</html>