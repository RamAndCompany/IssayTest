	
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2><?php echo $category_label;?></h2>
			</div>
			
			<div class="11u" style="margin-left:23px;width: 95%;" > 
				<!-----CALLS START----->
				<div class="row">
					<div class="12u">
						
						<h2 class="title-bar" ><?php echo $category_label;?></h2>
						<section class="dash-container" >
							<div class="12u">
								<section style="padding-top: 10px;">
									
									
									<?php 
									if(!empty($message)){
										echo '<div class="alert '.$alertclass.'" >'.$message.'</div>';
									}
									?>
									
									<?php 
									if(!empty($categories)){
									?>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_list', 'name' => 'form_list', 'enctype' => 'multipart/form-data');
									echo form_open('member/deleteCategory', $attributes);
									?>
									<div id="uploadResult" style="  width: 97%;margin-top: 0px;margin-bottom: 10px;"  >
										<table class="table-data" >
											<tr>
												<th width="5%" align="center" ><input type="checkbox" name="checkAll" id="checkAll" value="" /></th>
												<th width="95%" ><?php echo $category_label;?></th>
											</tr>
											<?php 
											foreach($categories as $cat){
											?>
											<tr id="<?php echo "row".$cat->category_id;?>" >
												<td align="center" ><input type="checkbox" name="check[]" id="check" value="<?php echo $cat->category_id;?>" class="checkbox" /></td>
												<td ><?php echo $cat->category_name;?></td>
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
							
							</section>
						
							<section>
								<div class="formBtnGroup" style="padding: 0px 15px;text-align: left;" >
									<input type="button" class="btn-primary" name="btn" id="btn_add_new" value="<?php echo $addnew_btn;?>" />
									<?php 
									if(!empty($categories)){
									?>
									<input type="button" class="btn-primary" name="btn" style="padding: 5px 21px;" id="btn_edit_mem" value="<?php echo $edit_btn;?>" />
									<!--<input type="button" class="btn-primary" onclick="gotoMemberGroup('<?php echo site_url("member/member_category");?>');" value="<?php echo $membergroup_menu;?>" style="width: 133px;text-align: center;" />-->
									<input type="button" class="btn-primary" name="btn" style="padding: 5px 17px;" id="btn_delete" value="<?php echo $delete_btn;?>" onclick="deleteMembers()" />
									<?php 
									}
									?>
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
										
							<div id="modal-2" class="modal-box"  style="display:none;position:fixed;" >
								<div class="modal-content" style="margin-top:1%;width:75%;" >
									<div class="model-header">
										<div class="model-title" ><?php echo $category_add;?></div>
										<div class="model-close" id="close-model2" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_cat_add', 'name' => 'form_cat_add', 'enctype' => 'multipart/form-data');
									echo form_open('member/saveCategory', $attributes);
									?>
									<div style="margin-bottom: 10px;" >
										<div class="formLabel" ><?php echo $name_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="text" name="category" id="category" class="formFileField" onchange="checkGroupExst(this.value);" /></div>
										<div class="clear" ></div>
									</div>
									<div class="clear" ></div>
									
									<?php 
									$catnm = '';
									if(!empty($allusers)){
									?>
									<div class="w100" >
										<div class="w40 left" style="margin-left:0px;" >
											<h2 class="title-bar" ><?php echo $step_select_mem;?></h2>
											<div class="clear"></div>
											
											<div style="height: 350px;overflow-x: auto;border-bottom: 1px solid #CCC;" >
											<table class="table-data" >
												<tr id="OrgSelUsersRow" >
													<th align="center" ><input type="checkbox" name="checkAll1" id="checkAll1" value="" /></th>
													<th><?php echo $name_label;?></th>
													<th><?php echo $phone_label;?></th>
												</tr>
												<?php 
												if(!empty($allusers)){
													foreach($allusers as $user){
													?>
													<tr id="frow-<?php echo $user->member_id;?>" >
														<td align="center">
														<input type="checkbox" name="check1" id="check1" class="checkbox1" value="<?php echo $user->member_id;?>" /></td>
														<td><?php echo $user->member_name;?>
															<input type="hidden" name="mname<?php echo $user->member_id;?>" id="mname<?php echo $user->member_id;?>" value="<?php echo $user->member_name;?>" />
														</td>
														<td>
															<?php echo $user->phone_no;?>
															<input type="hidden" name="mphone<?php echo $user->member_id;?>" id="mphone<?php echo $user->member_id;?>" value="<?php echo $user->phone_no;?>" />
														</td>
													</tr>
													<?php 
													}
												}
												?>
											</table>
											</div>
											
											<div class="clear"></div>
										</div>
										<div class="w10 left" style="margin-left: 60px" >
											<input type="button" class="btn-primary" name="btn_add" id="btn_add" onclick="addToGroup()" value="&#x2192;<?php echo $addtogroup_btn;?>" style="margin-top:170px;width: 80px;" />
											<input type="button" class="btn-primary" name="btn_add" id="btn_add" onclick="removeFromGroup()" value="<?php echo $remfromgroup_btn;?>&#x2190;" style="margin-top:10px;width: 80px;" />
										</div>
										<div class="w40 right" style="margin-right:0px;" >
											<h2 class="title-bar" ><?php echo $added_members;?></h2>
											<div class="clear"></div>
											<div style="height: 350px;overflow-x: auto;border-bottom: 1px solid #CCC;" >
											<table class="table-data" >
												<tr id="selUsersRow" >
													<th align="center" ><input type="checkbox" name="checkAll2" id="checkAll2" value="" /></th>
													<th><?php echo $name_label;?></th>
													<th><?php echo $phone_label;?></th>
												</tr>
												<?php 
												if(!empty($selusers)){
												foreach($selusers as $suser){
												?>
												<tr id="srow-<?php echo $suser->member_id;?>" >
													<td align="center">
														<input type="checkbox" name="check" id="check" class="checkbox" value="<?php echo $suser->member_id;?>" />
													</td>
													<td>
														<?php echo $suser->member_name;?>
														<input type="hidden" name="mnamer<?php echo $suser->member_id;?>" id="mnamer<?php echo $suser->member_id;?>" value="<?php echo $suser->member_name;?>" />
													</td>
													<td>
														<?php echo $suser->phone_no;?>
														<input type="hidden" name="mphoner<?php echo $suser->member_id;?>" id="mphoner<?php echo $suser->member_id;?>" value="<?php echo $suser->phone_no;?>" />
													</td>
												</tr>
												<?php 
												}
												}
												?>
											</table>
											</div>
											
											<div class="clear"></div>
										</div>
									</div>
											
											<div class="clear"></div>		
									<?php 
									}else{echo $nodata;}
									?>
									
									<div class="formBtnGroup" style="margin-top: 10px;" >
										<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $save_btn;?>" onclick="return addNewCategory();" />
									</div>
									</form>
								</div>
							</div>
							
							<div id="modal-3" class="modal-box"  style="display:none;position:fixed;" >
								<div class="modal-content" style="margin-top:15%" >
									<div class="model-header">
										<div class="model-title" ><?php echo $edit_mem_title;?></div>
										<div class="model-close" id="close-model3" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('member/updateCategory', $attributes);
									?>
									<div id="" >
										<div class="formLabel" ><?php echo $name_label;?><font color="red">*</font></div>
										<div class="formFields" ><input type="text" name="txtNmEdt" id="txtNmEdt" class="formFileField" onchange="checkGroupExstEdt(this.value);" /></div>
										<div class="clear" ></div>
										
									</div>
									<div class="clear" ></div>
									
									<div class="formBtnGroup" >
										<input type="hidden" name="mid" id="mid" />
										<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $update_btn;?>" onclick="return editMember();" />
									</div>
									</form>
								</div>
							</div>
							
		<!--- ---->
	
	
</body>
<script>
	function gotoMemberGroup(link){
		window.location = link;
	}
	
	function addNewCategory(){
		if($("#category").val() == false){
				alert("<?php echo $mandatory_name;?>");$("#category").focus();
				return false;
		}	
		else if ($("input[class=checkbox2]").length == 0) {
				alert('<?php echo $chkalertgm;?>');
				return false;
		}
		/*else if ($("input[class=checkbox2]").length > 0) {
				if ($("input[class=checkbox2]:checked").length == 0) {
						alert('<?php echo $chkalertam;?>');
						return false;
				}
				else{alert("<?php echo $datasaved;?>");return true;}	
		}*/
		else{alert("<?php echo $datasaved;?>");return true;}	

		
	}
	
	function editMember(){
		if($("#txtNmEdt").val() == false){alert("<?php echo $mandatory_name;?>");$("#txtNmEdt").focus();return false;}	
		else{alert("<?php echo $dataupdated;?>");return true;}	
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
					$.post('<?php echo site_url('member/deleteCategory');?>',{mid:mid},
					function(data){
						if(data == true){
							$("#row"+mid).remove();
							flag = true;
						}
					});
				});
			}if(flag == true){alert("<?php echo $datadeleted;?>");}
		}
		
		
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
				window.location = "<?php echo site_url("member/member_category");?>?category="+mid;
				/*$.post('<?php echo site_url('member/getCategory');?>',{mid:mid},
				function(data){
					if(data != ""){
						for(i in data){
							var mbid = data[i]['category_id'];
							var mnm = data[i]['category_name'];
							$("#txtNmEdt").val(mnm);
							$("#mid").val(mbid);
						}
						$("#modal-3").toggle();
					}
				});*/
			}
			else{
				alert('<?php echo $chkonealert;?>');
			}
		});
		
		$("#close-model3").click(function(){
			$("#modal-3").toggle();
		});
	});
	
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
	
	function checkGroupExst(gp){
		if(gp != ""){
			$.post("<?php echo site_url('member/checkGroupExst');?>",{gp:gp},
			function(data){
				if(data == true){alert("<?php echo $alreadyexst;?>");$("#category").val("");}
			});
		}
	}
	function checkGroupExstEdt(gp){
		var gid = $("#mid").val();
		if(gp != ""){
			$.post("<?php echo site_url('member/checkGroupExst');?>",{gp:gp,gid:gid},
			function(data){
				if(data == true){alert("<?php echo $alreadyexst;?>");$("#txtNmEdt").val("");}
			})
		}
	}
	</script>
	
	
	<script>	
	function deleteMembers(){
		if ($("input[type=checkbox]:checked").length === 0) {
			alert('<?php echo $chkalert;?>');
		}
		else{
			$('input[type=checkbox]:checked').each(function() { 
				var mid = $(this).val();
				$.post('<?php echo site_url('member/deleteCategory');?>',{mid:mid},
				function(data){
					if(data == true){
						$("#row"+mid).remove();
					}
				});
			});
		}
	}
	
	function loadPageWithCat(){
		document.form_cat_list.submit();
	}
	
	function addToGroup(){
		var html = '';
		var cid = $("#category").val();
		$("input[name='check1']:checked").each(function() { 
			var mid = $(this).val();
			var mnm, mphn = '';
			if(mid != ''){
						$(this).attr("checked",false);
						mnm  = $("#mname"+mid).val();
						mphn = $("#mphone"+mid).val();
						$("#frow-"+mid).remove();
						html = '<tr id="srow-'+mid+'" >'+
										'<td align="center">'+
											'<input type="checkbox" name="check2[]" id="check2" class="checkbox2" value="'+mid+'" />'+
											'<input type="hidden" name="member[]" id="member" class="checkbox2" value="'+mid+'" />'+
										'</td>'+
										'<td>'+mnm+'<input type="hidden" name="mnamer'+mid+'" id="mnamer'+mid+'" value="'+mnm+'" /></td>'+
										'<td>'+mphn+'<input type="hidden" name="mphoner'+mid+'" id="mphoner'+mid+'" value="'+mphn+'" /></td>'+
										'</tr>';
						$("#selUsersRow").after(html);
						$('#checkAll1').attr("checked",false);
						$('#checkAll2').attr("checked",false);
			}
		});
		
	}
	
	function removeFromGroup(){
		var html = '';
		var cid = $("#category").val();
		$("input[class='checkbox2']:checked").each(function() { 
			var mid = $(this).val();
			var mnm, mphn = '';
			if(mid != ''){
						$(this).attr("checked",false);
						mnm  = $("#mnamer"+mid).val();
						mphn = $("#mphoner"+mid).val();
						$("#srow-"+mid).remove();
						html = '<tr id="frow-'+mid+'" >'+
										'<td align="center">'+
											'<input type="checkbox" name="check1" id="check1" class="checkbox1" value="'+mid+'" />'+
										'</td>'+
										'<td>'+mnm+'<input type="hidden" name="mname'+mid+'" id="mname'+mid+'" value="'+mnm+'" /></td>'+
										'<td>'+mphn+'<input type="hidden" name="mphone'+mid+'" id="mphone'+mid+'" value="'+mphn+'" /></td>'+
										'</tr>';
						$("#OrgSelUsersRow").after(html);
						$('#checkAll1').attr("checked",false);
						$('#checkAll2').attr("checked",false);
			}
		});
	}
	
	$(document).ready(function() {
		$('#checkAll1').click(function(event) {  
			if(this.checked) { 
				$('.checkbox1').each(function() { 
					this.checked = true;  
				});
			}else{
				$('.checkbox1').each(function() {
					this.checked = false; 
				});         
			}
		});
		
		$('#checkAll2').click(function(event) {  
			if(this.checked) { 
				$('.checkbox2').each(function() { 
					this.checked = true;  
				});
			}else{
				$('.checkbox2').each(function() {
					this.checked = false; 
				});         
			}
		});
		
		$('.checkbox2').click(function(event) {  
			$('.checkbox2').each(function() { 
				if(this.checked == false) { 
					$('#checkAll2').attr("checked",false);
				}
			});
		});
		
		$('.checkbox1').click(function(event) {  
			$('.checkbox1').each(function() { 
				if(this.checked == false) { 
					$('#checkAll1').attr("checked",false);
				}
			});
		});
	});
	
</script>
</html>