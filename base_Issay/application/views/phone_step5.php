	
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
									<div class="stepcont" style="padding: 12px 0px 0px 22px;" ><?php echo $step_select_mem;?></div>
									<div class="stephead"></div>
								</div>
								<div class="steps stepother" >
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
								<div class="steps stepother" >
									<div class="steptail steptailActive" ></div>
									<div class="stepcontActive" ><?php echo $step_testcall;?></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_finish;?></div>
									<div class="stephead"></div>
								</div>
							</div>
						<div class="clear" ></div>
						
							<div class="left"></div>
							<div class="w90 mc">
							<section>
							
							<div style="text-align:center" ><?php echo $test_call;?></div>
							
							<div class="clear" ></div>
							
							<div class="formBtnGroup" >
								<input type="hidden" name="cdate" id="cdate" value="<?php echo date('Y-m-d');?>" />
								<input type="hidden" name="sid" id="sid" value="<?php echo $_REQUEST['sid'];?>" />
								
								<a class="btn-primary" style="float:left;" href="<?php echo site_url("phonecall/step4").'?sid='.$_GET['sid'];?>" ><?php echo $back_btn;?></a>
								
								<input type="button" class="btn-primary" name="btn" id="btn_skip" value="<?php echo $skip_btn;?>" onclick="confirmSchedule()"  style="float:right;" />
								<?php 
								if(isset($_REQUEST['response']) && $_REQUEST['response'] == true){}
								else{
								?>
								<input type="button" class="btn-primary" name="btn" id="btn_voice" value="<?php echo $test_btn;?>" style="float:right; margin-right: 5px;" />
								<?php 
								}
								?>
								<div class="clear"></div>
							</div>
							
							</form>
							
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
	
	
					<!-- MODAL -->
						<div id="modal-1" class="modal-box" >
								<div class="modal-content" >
									<div class="model-header">
										<div class="model-title" >Test Call</div>
										<div class="model-close" id="close-model1" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('phonecall/step5TestAction', $attributes);
									?>
									<div id="" >
										<div class="w100" >Phone No.</div>
										<div class="w100" >
											<div class="w20 left" >
												<select id="code" name="code" style="padding: 9px;" >
													<option value="91" >India</option>
													<option value="81" >Japan</option>
													<option value="1" >US</option>
												</select>
											</div>
											<div class="w50 left" ><input type="text" name="txtPhTst" id="txtPhTst" class="formFileField" /></div>
											
											<div class="w20 left" >
												<input type="submit" class="btn-primary" name="btn_test_call" id="btn" value="Call" onclick="return callinfo()" />
											</div>
											
										</div>
										<div class="clear" ></div>
									</div>
									<div class="clear" ></div>
									
									<div class="formBtnGroup" style="margin-top:10px;" >
										<?php 
										if(!empty($file)){
											foreach($file as $fl){
												$flnm = $fl->filename;
												$sdtch = $fl->schedule_date;
												$cid = $fl->content_id;
											}
										}
										else{
											$flnm = '';$cid = '';
										}
										?>
										<input type="hidden" name="filenm" id="filenm" value="<?php echo $flnm;?>" />
										<input type="hidden" name="cid" id="cid" value="<?php echo $cid;?>" />
										<input type="hidden" name="sid" id="sid" value="<?php echo $_REQUEST['sid'];?>" />
									</div>
									</form>
								</div>
							</div>
					<!-- /END MODAL -->
</body>

<script>
function confirmSchedule(){
	window.location = "<?php echo site_url('phonecall/step6').'?sid='.$_REQUEST['sid'];?>";
}
$(document).ready(function(){
		/*VOICE Model*/
		$("#btn_voice").click(function(){
			$("#modal-1").toggle();
		});
		$("#close-model1").click(function(){
			$("#modal-1").toggle();
		});
});

function callinfo(){
	var ph = $("#txtPhTst").val();
	if(ph == false){
		alert("Please enter phone no.");
		return false;
	}
	if(isNaN(ph)){
		alert("Only numbers are allowed");
		return false;
	}
	
	if(ph.length > 10){
		alert("Number must be 10 digits");
		return false;
	}
	
	if(ph.length < 10){
		alert("Number must be 10 digits");
		return false;
	}
	
}
</script>

</html>