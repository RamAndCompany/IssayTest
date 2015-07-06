	
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2><?php echo $member_title;?></h2>
			</div>
			
			<div class="11u" style="margin-left:23px;width: 95%;" > 
				<!-----CALLS START----->
				<div class="row">
					<div class="12u">
						
						<h2 class="title-bar" ><?php echo $memberlist_title;?></h2>
						<section class="dash-container" >
							<div class="12u">
								<section style="padding-top: 10px;" >
									
									
									<?php 
									if(!empty($message)){
										echo '<div class="alert '.$alertclass.'" >'.$message.'</div>';
									}
									?>
									
									<?php 
									if(!empty($users)){
									?>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_list', 'name' => 'form_list', 'enctype' => 'multipart/form-data');
									echo form_open('member/deleteMember', $attributes);
									?>
									<div id="uploadResult" style="  width: 97%;margin-top: 0px;margin-bottom: 10px;" >
										<table class="table-data" > 
											<tr>
												<th width="10%" align="center" ><input type="checkbox" name="checkAll" id="checkAll" value="" /></th>
												<th width="30%" ><?php echo $name_label;?></th>
												<th width="30%" align="center" ><?php echo $phone_label;?></th>
												<th width="30%" align="center" ><?php echo $email_label;?></th>
											</tr>
											<?php 
											foreach($users as $user){
											?>
											<tr id="<?php echo "row".$user->member_id;?>" >
												<td align="center" ><input type="checkbox" name="check[]" id="check" value="<?php echo $user->member_id;?>" class="checkbox" /></td>
												<td ><?php echo $user->member_name;?></td>
												<td align="center" ><?php echo $user->phone_no;?></td>
												<td align="center" ><?php echo $user->email;?></td>
											</tr>
											<?php 
											}
											?>
											
										</table>
									</div>
									</form>
									<?php 
									}
									?>
							
							
								<div class="formBtnGroup" style="padding: 0px 10px;text-align: left;" >
									<input type="button" class="btn-primary" name="btn" id="btn_add_new" value="<?php echo $addnew_btn;?>" />
									<?php 
									if(!empty($users)){
									?>
									<input type="button" class="btn-primary" name="btn" id="btn_edit_mem" style="padding: 5px 21px;" value="<?php echo $edit_btn;?>" />
									<input type="button" class="btn-primary" name="btn" id="btn_delete" value="<?php echo $delete_btn;?>" onclick="deleteMembers()" />
									<?php 
									}
									?>
									<input type="button" class="btn-primary" name="btn" id="btn_upload" value="<?php echo $uploadmem_btn;?>" style="float:right" />
									<div class="clear" ></div>
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
	
	
	<!------- DIALOUGES -------->
						<div id="modal-1" class="modal-box" style="display:none;position:fixed" >
								<div class="modal-content"  style="margin-top:10%" >
									<div class="model-header">
										<div class="model-title" ><?php echo $uploadmem_btn;?></div>
										<div class="model-close" id="close-model1" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('member/uploadMembers', $attributes);
									?>
									<div id="filebrowserPanel" >
										<div class="formLabel" ><?php echo $category;?></div>
										<div class="formFields" >
											<select id="category" name="category" class="formFileField" >
												<option value="" ></option>
												<?php 
													if(!empty($mgroups)){
														foreach($mgroups as $gp){
															echo '<option value="'.$gp->category_id.'">'.$gp->category_name.'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="clear" ></div>
									<div id="filebrowserPanel" >
										<div class="formLabel" ><?php echo $selectfl_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="file" name="filefld" id="filefld" class="formFileField" /></div>
									</div>
									
									<div class="clear" ></div>
									<div class="iteminfo" ><?php echo $filetypesmsg;?></div>
									<div class="clear" ></div>
									<div class="w45" style="color: #FF0000;" ><?php echo $maxfilesize.' : 2mb';?></div>
									<div class="clear" ></div>
									<div class="iteminfo" style="color:blue" ><?php echo $filecontentsmsg;?></div>
									<div class="formBtnGroup" >
										<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $uploadmem_btn;?>" onclick="return uploadFile()" />
									</div>
									</form>
								</div>
							</div>
							
							<div id="modal-2" class="modal-box"  style="display:none;" >
								<div class="modal-content"  >
									<div class="model-header">
										<div class="model-title" ><?php echo $addnew_mem_title;?></div>
										<div class="model-close" id="close-model2" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('member/saveMember', $attributes);
									?>
									<div id="" >
										<div class="formLabel" ><?php echo $name_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="text" name="txtNm" id="txtNm" class="formFileField" /></div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $country_label;?><font color="red">*</font></div>
										<div class="formFields" >
												<select id="code" name="code" style="padding: 9px;width:100%" >
													<option value="91" >India</option>
													<option value="81" >Japan</option>
													<option value="1" >US</option>
												</select>
										</div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $phone_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="text" name="txtPh" id="txtPh" class="formFileField" onchange="checkPhoneno(this.value)" /></div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $email_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="text" name="txtEml" id="txtEml" class="formFileField" /></div>
										<div class="clear" ></div>
										
									</div>
									<div class="clear" ></div>
									
									<div class="formBtnGroup" >
										<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $save_btn;?>" onclick="return addNewMember()" />
									</div>
									</form>
								</div>
							</div>
							
							<div id="modal-3" class="modal-box"  style="display:none" >
								<div class="modal-content" >
									<div class="model-header">
										<div class="model-title" ><?php echo $edit_mem_title;?></div>
										<div class="model-close" id="close-model3" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('member/updateMember', $attributes);
									?>
									<div id="" >
										<div class="formLabel" ><?php echo $name_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="text" name="txtNmEdt" id="txtNmEdt" class="formFileField" /></div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $country_label;?><font color="red">*</font></div>
										<div class="formFields" >
												<select id="codeEdt" name="codeEdt" style="padding: 9px;width:100%" >
													<option value="" ></option>
													<option value="91" >India</option>
													<option value="81" >Japan</option>
													<option value="1" >US</option>
												</select>
										</div>
										
										<div class="formLabel" ><?php echo $phone_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="text" name="txtPhEdt" id="txtPhEdt" class="formFileField" onchange="checkPhonenoEdt(this.value)" /></div>
										<div class="clear" ></div>
										
										<div class="formLabel" ><?php echo $email_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="text" name="txtEmlEdt" id="txtEmlEdt" class="formFileField" /></div>
										<div class="clear" ></div>
										
									</div>
									<div class="clear" ></div>
									
									<div class="formBtnGroup" >
										<input type="hidden" name="mid" id="mid" />
										<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $update_btn;?>" onclick="return editMember()" />
									</div>
									</form>
								</div>
							</div>
							
		<!--- ---->
	
	
</body>
<script>
	
	$("#filefld").change(function() {
		var allowed = {csv:"csv",xlsx:"xlsx",xls:"xls"};
		var fpath = $("#filefld").val();
		var file_size 	= $('#filefld')[0].files[0].size;
		var extn = fpath.split(".");
		var elen = extn.length;
		var ext = extn[elen-1];
		if(file_size>2097152) {
			alert('<?php echo $maxfilesize_alert;?>');
			$('#previewHolder1').html('');
			$("#filefld").val("");
		}
		else{
			if (typeof allowed[ext] != 'undefined'){
					readURL(this);
			}
			else{
				alert('<?php echo $filetypesmsg;?>');
				$('#previewHolder1').html('');
				$("#filefld").val("");
			}
		}
	});
	
	function uploadFile(){
		/*var allowed = {xls:"xls",xlsx:"xlsx",csv:"csv"};*/
		var allowed = {csv:"csv",xlsx:"xlsx",xls:"xls"};
		var fpath = $("#filefld").val();
		if(fpath != ""){
			var extn = fpath.split(".");
			var elen = extn.length;
			var ext = extn[elen-1];
			if (typeof allowed[ext] != 'undefined'){
				return true;
			}
			else{
				alert('<?php echo $invalidfile;?>');return false;
			}
		}
		else{
			alert('<?php echo $selectfl_label;?>');return false;
		}
	}
	
	function addNewMember(){
		var epat =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var alphaExp = /^[0-9\ ]+$/;
		
		if($("#txtNm").val() == false){alert("<?php echo $mandatory_name;?>");$("#txtNm").focus();return false;}
		else if(alphaExp.test($("#txtNm").val())){alert("<?php echo $invalid_name;?>");$("#txtNm").focus();return false;}
		else if($("#txtPh").val() == false){alert("<?php echo $mandatory_phone;?>");$("#txtPh").focus();return false;}		
		else if(isNaN($("#txtPh").val())){alert("<?php echo $invalid_phone;?>");$("#txtPh").focus();return false;}		
		else if($("#txtPh").val().length > 10){alert("<?php echo $invalid_phone;?>");$("#txtPh").focus();return false;}		
		else if($("#txtPh").val().length < 10){alert("<?php echo $invalid_phone;?>");$("#txtPh").focus();return false;}		
		else if($("#txtEml").val() == false){alert("<?php echo $mandatory_email;?>");$("#txtEml").focus();return false;}		
		else if(!epat.test($("#txtEml").val())){alert("<?php echo $invalid_email;?>");$("#txtEml").focus();return false;}		
		else{
			alert("<?php echo $datasaved;?>");
			return true;
		}
	}
	
	function editMember(){
		var epat =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var alphaExp = /^[0-9\ ]+$/;
		
		if($("#txtNmEdt").val() == false){alert("<?php echo $mandatory_name;?>");$("#txtNmEdt").focus();return false;}	
		else if(alphaExp.test($("#txtNmEdt").val())){alert("<?php echo $invalid_name;?>");$("#txtNmEdt").focus();return false;}
		else if($("#codeEdt").val() == ""){alert("<?php echo $mandatory;?>");$("#codeEdt").focus();return false;}		
		else if($("#txtPhEdt").val() == false){alert("<?php echo $mandatory_phone;?>");$("#txtPhEdt").focus();return false;}		
		else if(isNaN($("#txtPhEdt").val())){alert("<?php echo $invalid_phone;?>");$("#txtPhEdt").focus();return false;}		
		else if($("#txtPhEdt").val().length > 10){alert("<?php echo $invalid_phone;?>");$("#txtPhEdt").focus();return false;}		
		else if($("#txtPhEdt").val().length < 10){alert("<?php echo $invalid_phone;?>");$("#txtPhEdt").focus();return false;}		
		else if($("#txtEmlEdt").val() == false){alert("<?php echo $mandatory_email;?>");$("#txtEmlEdt").focus();return false;}		
		else if(!epat.test($("#txtEmlEdt").val())){alert("<?php echo $invalid_email;?>");$("#txtEmlEdt").focus();return false;}
		else{
			alert("<?php echo $dataupdated;?>");
			return true;
		}		
	}
	
	function deleteMembers(){
		var ans = confirm("<?php echo $cnfmalert;?>");
		var flag = true;
		if(ans == true){
			if ($("input[type=checkbox]:checked").length === 0) {
				alert('<?php echo $chkalert;?>');
			}
			else{
				$('input[type=checkbox]:checked').each(function() { 
					var mid = $(this).val();
					$.post('<?php echo site_url('member/deleteMember');?>',{mid:mid},
					function(data){
						if(data == true){
							$("#row"+mid).remove();
							flag = true;
						}
					});
				});
			}
		alert("<?php echo $datadeleted;?>");
		}
		else{}
	}
	
	$(document).ready(function(){
		/*Add New Model*/
		$("#btn_add_new").click(function(){
			$("#modal-2").toggle();
		});
		$("#close-model2").click(function(){
			$("#modal-2").toggle();
		});
		/*File Upload Model*/
		$("#btn_upload").click(function(){
			$("#modal-1").toggle();
		});
		$("#close-model1").click(function(){
			$("#modal-1").toggle();
		});
		
		/*Edit Model*/
		$("#btn_edit_mem").click(function(){
			if ($("input[type=checkbox]:checked").length === 1) {
				var mid = $("input[type=checkbox]:checked").val();
				$.post('<?php echo site_url('member/getMember');?>',{mid:mid},
				function(data){
					if(data != ""){
						for(i in data){
							var mbid = data[i]['member_id'];
							var mnm = data[i]['member_name'];
							var code = data[i]['country_code'];
							var mphn = data[i]['phone_no'];
							var meml = data[i]['email'];
							$("#txtNmEdt").val(mnm);
							$("#codeEdt").val(code);
							$("#txtPhEdt").val(mphn);
							$("#txtEmlEdt").val(meml);
							$("#mid").val(mbid);
						}
						$("#modal-3").toggle();
					}
				});
				
			}
			else{
				alert('<?php echo $chkonealert;?>');
			}
		});
		
		$("#close-model3").click(function(){
			$("#modal-3").toggle();
		});
	});
	
	function checkPhoneno(phn){
		if(phn != ""){
			$.post("<?php echo site_url('member/checkPhoneno');?>",{phone:phn},
			function(data){
				if(data == true){alert("<?php echo $alreadyexst;?>");$("#txtPh").val("");}
			})
		}
	}
	function checkPhonenoEdt(phn){
		var mid = $("#mid").val();
		if(phn != ""){
			$.post("<?php echo site_url('member/checkPhoneno');?>",{phone:phn,mid:mid},
			function(data){
				if(data == true){alert("<?php echo $alreadyexst;?>");$("#txtPhEdt").val("");}
			})
		}
	}
	
	$(document).ready(function() {
		$('#checkAll').click(function(event) {  
			if(this.checked) { 
				$('.checkbox').each(function() { 
					this.checked = true;  
				});
			}else{
				$('.checkbox').each(function() {
					this.checked = false; 
				});         
			}
		});
		
		$('.checkbox').click(function(event) {  
			$('.checkbox').each(function() { 
				$('#checkAll').attr("checked",true);
				if(this.checked == false) { 
					$('#checkAll').attr("checked",false);
				}
			});
		});
	});
	</script>
</html>