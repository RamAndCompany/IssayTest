	
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2><?php echo $sms_success;?></h2>
			</div>
			
			<div class="11u" style="margin-left:23px;width: 95%;" > 
				<!-----CALLS START----->
				<div class="row">
					<div class="12u">
						
						<h2 class="title-bar-blank" ></h2>
						<section class="dash-container" >
							<div class="clear" ></div>
							<div class="left"></div>
							<div class="w90 mc">
							<section>
							
									<div style="text-align:center" ><?php echo $sms_success;?></div>
									
									<div class="clear" ></div>
									
									<div class="voicePanel" style="background:#FFF;text-align:center;padding:25px;width: 50%;margin-left: auto;margin-right: auto;" >
										<img src="<?php echo base_url();?>application/views/images/sms_finish.png" alt="" />
									</div>
									
									<div class="clear" ></div>
									
									<div class="formBtnGroup" style="width: 50%; margin-left: auto;margin-right: auto;" >
										<a class="btn-primary"  href="<?php echo site_url('indexpage/dashboard');?>" ><?php echo $dash_title;?></a>
										<a class="btn-primary"  href="<?php echo site_url('sms/step1');?>" ><?php echo $return_sms;?></a>
									</div>
									
									
									
								</section>
							</div>
							<div class="clear" style="height:15px;" ></div>
						</section>
					</div>
					
				</div>
				<!-----CALLS END----->
				</div>
				<div class="clear" ></div>
				<div class="divider" ></div>
				<div class="clear" ></div>
				
			</div>
			<!-- /Extra -->
			<div class="clear" ></div>	
		</div>
	<!-- /Main -->
	
	<div class="clear" ></div>
	<div id="copyright" style="position:fixed">
			2015&copy; CopyRight Emotion Wave Co., Ltd
	</div>
		
</body>
<script>
function confirmSchedule(){
	window.location = "<?php echo site_url('sms/finishschedule?sid=').$_GET['sid'];?>";
}

</script>
</html>