	
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2><?php echo $member_groups;?></h2>
			</div>
			
			<div class="11u" style="margin-left:23px;width: 95%;" > 
				<!-----CALLS START----->
				<div class="row">
					<div class="12u">
						
						<h2 class="title-bar" ><?php echo $member_groups;?></h2>
						<section class="dash-container" >
							<?php
							$attributes = array('class' => 'form-horizontal', 'id' => 'form_cat_list', 'name' => 'form_cat_list', 'enctype' => 'multipart/form-data');
							echo form_open('member/member_category', $attributes);
							?>
							<div class="12u">
								<section style="padding-top: 15px;" >
									
									
									<?php 
									if(!empty($message)){
										echo '<div class="alert '.$alertclass.'" >'.$message.'</div>';
									}
									?>
									
									<?php 
									if(!empty($categories)){
									$ctanm = '';
									?>
									<div class="w100" >
										<div class="w15 left" ><?php echo $category_label;?></div>
										<div class="w45 left" >
										<?php 
										echo '<select id="category" name="category" class="formFileField " onchange="loadPageWithCat();" >';
										echo '<option value="" >-- Select --</option>';
										foreach($categories as $cat){
											if(isset($_REQUEST['category']) && $_REQUEST['category'] == $cat->category_id){$sel = 'selected="true"';$ctanm = $cat->category_name;}else{$sel='';}
											echo '<option value="'.$cat->category_id.'" '.$sel.'>'.$cat->category_name.'</option>';
										
										}
										echo '</select>';
										?>
										</div>
										<div class="clear"></div>
									</div>
									<div class="clear" style="height:15px;" ></div>
									<?php 
									if(isset($_REQUEST['category'])){
									if(!empty($allusers)){
									?>
									<div class="w100" >
										<div class="w40 left" >
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
										<div class="w10 left" >
											<input type="button" class="btn-primary" name="btn_add" id="btn_add" onclick="addToGroup()" value="&#x2192;<?php echo $addtogroup_btn;?>" style="margin-top:170px;width: 80px;" />
											<input type="button" class="btn-primary" name="btn_add" id="btn_add" onclick="removeFromGroup()" value="<?php echo $remfromgroup_btn;?>&#x2190;" style="margin-top:10px;width: 80px;" />
										</div>
										<div class="w40 left" >
											<h2 class="title-bar" ><?php echo $added_members;?></h2>
											<div class="clear"></div>
											<div style="height: 350px;overflow-x: auto;border-bottom: 1px solid #CCC;" >
											<table class="table-data" >
												<tr id="selUsersRow" >
													<th align="center" ><input type="checkbox" name="checkAll" id="checkAll" value="" /></th>
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
									}else{echo 'No Results Found !!';}
									}
									
									?>
									<div class="clear"></div>
									<?php 
									}
									?>
									
											<div class="clear"></div>		
											<div class="formBtnGroup" style="margin-top: 8px;margin-left: 28px;" >
												<a type="button" class="btn-primary" href="<?php echo site_url('member/category');?>" ><?php echo $back_btn;?></a>
											</div>
											<div class="clear"></div>
							</section>
							<?php 
							/*if(isset($_POST['category'])){
							?>
							<section>
								<div class="formBtnGroup" style="padding: 0px;text-align: right;" >
									<input type="button" class="btn-primary" name="btn_add" id="btn_add" value="<?php echo $addnew_btn;?>" onclick="addGroupMembers()" />
								</div>
								<div class="clear"></div>
							</section>
							<?php 
							}*/
							?>
							</div>
							</form>
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
		var flag = false;
		$("input[name='check1']:checked").each(function() { 
			var mid = $(this).val();
			var mnm, mphn = '';
			if(mid != ''){
				$.post("<?php echo site_url("member/savemembergroup");?>",{gid:cid,mid:mid},
				function(data){
					if(data == true){
						$(this).attr("checked",false);
						mnm  = $("#mname"+mid).val();
						mphn = $("#mphone"+mid).val();
						$("#frow-"+mid).remove();
						html = '<tr id="srow-'+mid+'" >'+
										'<td align="center">'+
											'<input type="checkbox" name="check" id="check" class="checkbox" value="'+mid+'" />'+
										'</td>'+
										'<td>'+mnm+'<input type="hidden" name="mnamer'+mid+'" id="mnamer'+mid+'" value="'+mnm+'" /></td>'+
										'<td>'+mphn+'<input type="hidden" name="mphoner'+mid+'" id="mphoner'+mid+'" value="'+mphn+'" /></td>'+
										'</tr>';
						$("#selUsersRow").after(html);
					}
				});
			flag = true;	
			}
		});
		
		if(flag == false){alert("<?php echo $chkalert;?>");}
		
	}
	
	function removeFromGroup(){
		var html = '';
		var cid = $("#category").val();
		var flag = false;
		$("input[name='check']:checked").each(function() { 
			var mid = $(this).val();
			var mnm, mphn = '';
			if(mid != ''){
				$.post("<?php echo site_url("member/deletemembergroup");?>",{gid:cid,mid:mid},
				function(data){
					if(data == true){
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
					}
				});
			flag = true;
			}
		});
		if(flag == false){alert("<?php echo $chkalert;?>");}
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
				if(this.checked == false) { 
					$('#checkAll').attr("checked",false);
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