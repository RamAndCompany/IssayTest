	
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2><?php echo $callschedule_title;?></h2>
			</div>
			
			<div class="11u" style="margin-left:23px;width: 95%;" > 
				<!-----CALLS START----->
				<div class="row">
					<div class="12u">
						
						<h2 class="title-bar-blank" ></h2>
						<section class="dash-container" >
							
							<div class="clear" ></div>
							<div id="stepsdiv" >
								<div class="steps stepfirst" >
									<div class="stepcont" ><?php echo $step_select_mem;?></div>
									<div class="stephead"></div>
								</div>
								<div class="steps stepother" style="
    width: 18%;
" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_select_fl;?></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_scheduling;?></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_confirmation;?></div>
								</div>
								<!--<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_testcall;?></div>
								</div>-->
								<div class="steps stepother" >
									<div class="steptail steptailActive" ></div>
									<div class="stepcont" style="background:#48B033;" ><?php echo $step_finish;?></div>
									<div class="stepheadActive"></div>
								</div>
							</div>
						<div class="clear" ></div>
						
							<div class="left"></div>
							<div class="w90 mc">
								<section>
									<div style="text-align:center" ><?php echo $finish_message;?></div>
										
										<div class="clear" ></div>
										
										<div class="voicePanel" style="background:#FFF;text-align:center;padding:25px;width: 50%;margin-left: auto;margin-right: auto;" >
											<img src="<?php echo base_url();?>application/views/images/call_finish.png" alt="" />
										</div>
										
										<div class="clear" ></div>
										
										<div class="formBtnGroup" >
											<input type="hidden" name="cdate" id="cdate" value="<?php echo date('Y-m-d');?>" />
											<input type="hidden" name="sid" id="sid" value="<?php echo $_GET['sid'];?>" />
											
											<a class="btn-primary" style="float:left; padding: 6px 22px;" href="<?php echo site_url("phonecall/step4").'?sid='.$_GET['sid'];?>" ><?php echo $back_btn;?></a>
											<input type="button" class="btn-primary" name="btn" id="btn" value="<?php echo $step_finish;?>" onclick="confirmSchedule()" style="float:right; padding:6px 15px;" />
											<div class="clear"></div>
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
	<div id="copyright" style="position:fixed" >
			2015&copy; CopyRight Emotion Wave Co., Ltd
	</div>					
</body>
<script>
function confirmSchedule(){
	window.location = "<?php echo site_url('phonecall/finishschedule?sid=').$_GET['sid'];?>";
}

</script>
</html>