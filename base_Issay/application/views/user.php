	
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2><?php echo $user_title;?></h2>
			</div>
			
			<div class="11u" style="margin-left:23px;width: 95%;" > 
				<!-----CALLS START----->
				<div class="row">
					<div class="12u">
						
						<h2 class="title-bar" ><?php echo $user_title;?></h2>
						<section class="dash-container" >
							<div class="12u">
								<section>
									
									
									<?php 
									if(!empty($message)){
										echo '<div class="alert '.$alertclass.'" >'.$message.'</div>';
									}
									?>
									
									<?php 
									if(!empty($user)){
									foreach($user as $us);
									?>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('user/updateProfile', $attributes);
									?>
									<div class="w25 left" ></div>
									<div class="w75 left" >
										<div class="formLabel" ><?php echo $usernm_label;?></div>
										<div class="formFields" ><input type="text" readonly="true" name="usernm" id="usernm" class="formFileField" value="<?php echo $us->username;?>" /></div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $name_label;?></div>
										<div class="formFields" ><input type="text" name="txtNm" id="txtNm" class="formFileField" value="<?php echo $us->customer_name;?>" /></div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $phone_label;?></div>
										<div class="formFields" ><input type="text" name="txtPh" id="txtPh" class="formFileField" value="<?php echo $us->customer_phone;?>" /></div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $email_label;?></div>
										<div class="formFields" ><input type="text" name="txtEml" id="txtEml" class="formFileField" value="<?php echo $us->customer_mail;?>" /></div>
										<div class="clear" ></div>
										
										<!--<div class="formLabel" ><?php echo $uploadimg_label;?></div>
										<div class="formFields" ><input type="file" name="image" id="image" class="formFileField" /></div>
										<div class="clear" ></div>-->
										
										<div class="formBtnGroup" >
											<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $update_btn;?>" onclick="return updateProfile()" />
										</div>	
										<div class="clear" ></div>
									</div>
									
									</form>
									<?php 
									}
									?>
									<div class="clear" ></div>
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
	
	
	function updateProfile(){
		var epat =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if($("#txtNm").val() == false){alert("<?php echo $mandatory_name;?>");$("#txtNm").focus();return false;}		
		else if($("#txtPh").val() == false){alert("<?php echo $mandatory_phone;?>");$("#txtPh").focus();return false;}		
		else if(isNaN($("#txtPh").val())){alert("<?php echo $invalid_phone;?>");$("#txtPh").focus();return false;}		
		else if($("#txtPh").val().length > 10){alert("<?php echo $invalid_phone;?>");$("#txtPh").focus();return false;}		
		else if($("#txtPh").val().length < 10){alert("<?php echo $invalid_phone;?>");$("#txtPh").focus();return false;}		
		else if($("#txtEml").val() == false){alert("<?php echo $mandatory_email;?>");$("#txtEml").focus();return false;}		
		else if(!epat.test($("#txtEml").val())){alert("<?php echo $invalid_email;?>");$("#txtEml").focus();return false;}		
		else{alert("<?php echo $dataupdated;?>");return true;}
	}
	
	
	</script>
</html>