	
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2><?php echo $smsschedule_title;?></h2>
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
									<div class="stepcont" style="padding: 12px 0px 0px 24px;"  ><?php echo $step_select_mem;?></div>
									<div class="stephead"></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_select_text;?></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_scheduling;?></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail steptailActive" ></div>
									<div class="stepcontActive" style="padding: 12px 0px 0px 41px;" ><?php echo $step_confirmation;?></div>
								</div>
								<!--<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_testsms;?></div>
								</div>-->
								<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_finish;?></div>
									<div class="stephead"></div>
								</div>
							</div>
						<div class="clear" ></div>
						
							<div class="left"></div>
							<div class="w90 mc">
							<?php
						$sid = $_GET['sid'];
						$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
						echo form_open('sms/step4Action', $attributes);
						?>
						<section>
							
							<div class="clear" ></div>
							<div class="formLabel" style="font-weight: bold;" ><font color="red" >*</font><?php echo $title_label;?></div>
							<div class="formFields" style="padding-left: 15px;" ><input type="text" name="sch_title" id="sch_title" style="width: 50%;" value="<?php echo $shTitle;?>" /></div>
							
							<div class="clear" ></div>
							<?php 
							if(!empty($users)){
							?>
							<h2 style="margin-left: 5px;font-weight: bold;" ><?php echo $member;?></h2>
							<div id="uploadResult" style="margin-top: 1px;max-height: 280px;height: auto;width:97%;" >
								<table style="width:100%" >
									<tr style="background:#F0F0F0" >
										<td width="30%" align="center" ><?php echo $name_label;?></td>
										<td width="30%" align="center" ><?php echo $phone_label;?></td>
										<td width="30%" align="center" ><?php echo $email_label;?></td>
									</tr>
									<?php 
									foreach($users as $user){
									?>
									<tr>
										<td align="center" ><?php echo $user->member_name;?></td>
										<td align="center" ><?php echo $user->phone_no;?></td>
										<td align="center" ><?php echo $user->email;?></td>
									</tr>
									<?php 
									}
									?>
									
								</table>
							</div>
							<?php 
							}
							?>
							
							
							<?php 
							if(!empty($groups)){
							?>
							<h2 style="margin-left: 5px;font-weight: bold;margin-top: 15px;" ><?php echo $category;?></h2>
							<div id="uploadResult" style="margin-top: 1px;max-height: 280px;height: auto;width:97%;" >
								<table style="width:100%" >
									<tr style="background:#F0F0F0" >
										<td width="10%" ><?php echo '';?></td>
										<td width="90%" ><?php echo $category;?></td>
									</tr>
									<?php 
									$i=1;
									foreach($groups as $gp){
									?>
									<tr>
										<td ><?php echo $i;?></td>
										<td ><?php echo $gp->category_name;?></td>
									</tr>
									<?php 
									$i++;
									}
									?>
									
								</table>
							</div>
							<?php 
							}
							?>
							<!---VOICE FILE -->
							<?php 
							if(!empty($file)){
								foreach($file as $fl){
									$cnt = $fl->content;
									$sdtch = $fl->schedule_date;
								}
							}
							else{
								$cnt = '';
							}
							?>
							<div class="clear" ></div>
							<div class="formLabel" style="padding-left: 15px;" ><?php echo $sms_text;?></div>
							<div class="voicePanel" style="width: 97%;margin-left: 15px;padding:10px;" >
								<div class="formFields" >
										<?php echo $cnt;?>
								</div>
							</div>
							
							<div class="clear" ></div>
							<div class="formLabel" style="padding-left: 15px;" ><?php echo $schedule_dt;?></div>
							<div class="voicePanel" style="width: 97%;margin-left: 15px;padding:10px;" >
								<div class="formLabel" style="width: 50%;padding-top: 15px;">
									<?php 
									echo $sdtch;
									?>
								</div>
							</div>
							
							<div class="formBtnGroup" style="padding-left: 15px;" >
								<input type="hidden" name="cdate" id="cdate" value="<?php echo date('Y-m-d');?>" />
								<input type="hidden" name="sid" id="sid" value="<?php echo $_GET['sid'];?>" />
								<a class="btn-primary" href="<?php echo site_url("sms/step3").'?sid='.$sid;?>" style="float:left; padding:6px 22px;" ><?php echo $back_btn;?><a/>
								<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $confirm_btn;?>" onclick="return confirmSchedule()" style="float:right" />
								<input type="button" class="btn-primary" name="btn" id="btn_voice" value="<?php echo $test_btn;?>" style="float:right; margin-right:5px; padding:5px 18px;" />
								<div class="clear"></div>
							</div>
							
							
							
						</section>
						</form>
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
	<div id="copyright">
			2015&copy; CopyRight Emotion Wave Co., Ltd
	</div>
	
	
	
	<!-----MODAL DIALOUGE STARTS----->
	
							<div id="modal-1" class="modal-box" style="position:fixed" >
								<div class="modal-content" style="margin-top: 15%;" >
									<div class="model-header">
										<div class="model-title" ><?php echo $test_sms;?></div>
										<div class="model-close" id="close-model1" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('sms/step5TestAction', $attributes);
									?>
									<div id="" >
										<div class="w100" ><?php echo $phone_label; ?></div>
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
												<input type="button" class="btn-primary" name="btn_test_call" id="btn_test_call" value="<?php echo $test_sms;?>" onclick="callinfo()" />
											</div>
											
										</div>
										<div class="clear" ></div>
									</div>
									<div class="clear" ></div>
									
									<div class="formBtnGroup" >
										<?php 
										if(!empty($file)){
											foreach($file as $fl){
												$flnm = $fl->content;
												$sdtch = $fl->schedule_date;
												$cid = $fl->content_id;
											}
										}
										else{
											$flnm = '';$cid = '';
										}
										?>
										<input type="hidden" name="message" id="message" value="<?php echo $flnm;?>" />
										<input type="hidden" name="cid" id="cid" value="<?php echo $cid;?>" />
										<input type="hidden" name="sid" id="sid" value="<?php echo $_REQUEST['sid'];?>" />
										
									</div>
									</form>
								</div>
							</div>
				<!-- /MODEL DIALOUGE ENDS -->
				
				
				
	
</body>
<script>
function confirmSchedule(){
	if($("#sch_title").val() == false){alert("<?php echo $mandatory;?>");$("#sch_title").focus();return false;}
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
		alert("<?php echo $mandatory;?>");
	}
	else if(isNaN(ph)){
		alert("<?php echo $invalid_phone;?>");
	}
	else if(ph.length > 10){
		alert("<?php echo $invalid_phone;?>");
	}
	else if(ph.length < 10){
		alert("<?php echo $invalid_phone;?>");
	}
	else{
		var sid 	= $("#sid").val();
		var cid		= $("#cid").val();
		var code	= $("#code").val();
		var txtPhTst= $("#txtPhTst").val();
		var message	= $("#message").val();
		$.post("<?php echo site_url("sms/step5TestAction");?>",{sid:sid, cid:cid, code:code, txtPhTst:txtPhTst, message:message},
		function(data){
			/*if(data == true){*/
				$("#btn_voice").hide();
				$("#modal-1").hide();
				alert("<?php echo $testsmsmsg;?>");
			/*}
			else{
				
			}*/
		});
	}
	
}
</script>	
</html>