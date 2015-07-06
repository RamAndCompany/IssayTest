	
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
									?>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('user/updatePassword', $attributes);
									?>
									<div class="w25 left" ></div>
									<div class="w75 left" >
										<div class="formLabel" ><?php echo $password_label;?><font color="red" >*</font></div>
										<div class="formFields" ><input type="text" name="txtPwd" id="txtPwd" class="formFileField" /></div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $cpassword_label;?><font color="red" >*</font></div>
										<div class="formFields" ><input type="text" name="txtCPwd" id="txtCPwd" class="formFileField" /></div>
										<div class="clear" ></div>
										
										<div class="formBtnGroup" >
											<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $update_btn;?>" onclick="return changePassword()" />
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
	function changePassword(){
		if($("#txtPwd").val() == false){alert("<?php echo $mandatory_field;?>");$("#txtPwd").focus();return false;}		
		else if($("#txtCPwd").val() == false){alert("<?php echo $mandatory_field;?>");$("#txtCPwd").focus();return false;}		
		else if($("#txtPwd").val() != $("#txtCPwd").val()){alert("<?php echo $pwdsnotmatch_field;?>");$("#txtPwd").focus();return false;}		
		else{alert("<?php echo $dataupdated;?>");return true;}
	}
	
	</script>
</html>