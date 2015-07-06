	
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
									<div class="stepcontActive" style="padding: 12px 0px 0px 30px;" ><?php echo $step_select_mem;?></div>
									<div class="stepheadActive"></div>
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
								<!--<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_testcall;?></div>
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
							<section>
							<?php 
							if(!empty($message)){
								echo '<div class="alert '.$alertclass.'" >'.$message.'</div>';
							}
							?>
							
							<div id="" ><?php echo $make_selection;?><font color="red">*</font></div> 
							<div class="clear" ></div>
							
							<div class="w100" >
								<div class="w45" >
									<a class="btn-primary" href="javascript:void(0)" style="padding: 5px 33px;"  id="grouptab" ><?php echo $category;?></a>
									<a class="btn-primary_active" href="javascript:void(0)" style="padding: 5px 33px;" id="membertab" ><?php echo $member;?></a>
								</div>
							</div>
							
							<div class="clear" ></div>
							<?php
							$attributes = array('class' => 'form-horizontal', 'id' => 'form_members', 'name' => 'form_members', 'enctype' => 'multipart/form-data');
							echo form_open('phonecall/step1Action', $attributes);
							?>
							<?php 
							$tgps = 0;
							if(!empty($mgroups)){
							$tgps = count($mgroups);
							?>
							<!---------GROUPS--------->
							<div id="groupsList" style="margin-top: 6px;" >
							<div class="w100" >
								<div id="uploadResult" >
									<table class="table-data" >
										<tr style="background:#F9F9F9;font-weight: 500;">
											<th width="10%" align="center" ><input type="checkbox" name="checkall1" id="checkall1" value="" class="checkall1" /></th>
											<th width="90%" ><?php echo $group_menu;?></th>
										</tr>
										<?php 
										$i=1;$sel = "";
										foreach($mgroups as $gp){
											if(!empty($sgroups)){
												foreach($sgroups as $sgp){
													if($gp->category_id == $sgp->category_id){$sel = "checked='true'";break;}else{$sel="";}
												}
											}
										?>
										<tr>
											<td align="center" ><input type="checkbox" name="check1[]" id="check<?php echo $i;?>" value="<?php echo $gp->category_id;?>" class="checkbox1" onclick="checkMembersGroup(this.value, this.checked, 'check<?php echo $i;?>')"   <?php echo $sel;?> /></td>
											<td style="padding-left:10px;" ><?php echo $gp->category_name;?></td>
										</tr>
										<?php 
										$i++;
										}
										?> 
										
									</table>
								</div>
							</div>
							</div>
							<?php 
							}
							?>
							<?php 
							$tmem = 0;
							if(!empty($musers)){
							$tmem = count($musers);
							?>
							<!---------MEMBERS--------->
							<div id="membersList" style="display:none; margin-top:6px;" >
							<div id="uploadResult" >
								<table class="table-data" >
									<tr style="background:#F9F9F9;font-weight: 500;"> 
										<th width="10%" align="center" ><input type="checkbox" name="checkall" id="checkall" value="" class="parentCheckBox" /></th>
										<th width="30%" align="center" ><?php echo $name_label;?></th>
										<th width="30%" align="center" ><?php echo $phone_label;?></th>
										<th width="30%" align="center" ><?php echo $email_label;?></th>
									</tr>
									<?php 
									$sel = "";
									foreach($musers as $user){
										if(!empty($susers)){
											foreach($susers as $suser){
												if($user->member_id == $suser->member_id){$sel = "checked='true'";break;}else{$sel="";}
											}
										}
									?>
									<tr>
										<td align="center" ><input type="checkbox" name="check[]" id="check" value="<?php echo $user->member_id;?>" class="checkbox childCheckBox" <?php echo $sel;?> /></td>
										<td align="center" ><?php echo $user->member_name;?></td>
										<td align="center" ><?php echo '+'.$user->country_code.' '.$user->phone_no;?></td>
										<td align="center" ><?php echo $user->email;?></td>
									</tr>
									<?php 
									}
									?>
									
								</table>
							</div>
							</div>
							<?php 
							}
							?>
							<?php 
							$tcount = $tmem + $tgps;
							if($tcount > 0){
							?>
							<div class="formBtnGroup" style="padding: 20px 0px;" >
								<?php 
								if(isset($_GET['sid']) && $_GET['sid'] != ""){$sid = $_GET['sid'];}else{$sid = "";}
								?>
								<input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>" />
								<input type="submit" class="btn-primary" name="btnshw" id="btnshw" value="<?php echo $continue_btn;?>" style="float:right;" onclick="return validate();" />
							</div>
							<?php 
							}
							?>
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
	<div id="copyright" style="position: fixed;" >
			2015&copy; CopyRight Emotion Wave Co., Ltd
	</div>
</body>
<script>

<?php 
if(isset($sgroups) && isset($susers)){
	if(!empty($susers) && empty($sgroups)){
		?>
		$("#membersList").show();
		$("#groupsList").hide();
		$("#membertab").addClass("btn-primary");$("#membertab").removeClass("btn-primary_active");
		$("#grouptab").removeClass("btn-primary");$("#grouptab").addClass("btn-primary_active");
		<?php 
	}
}
?>

function validate(){
	var check = $(".checkbox:checked").length + $(".checkbox1:checked").length;
	if (check == 0) {
		alert('<?php echo $chkalert;?>');
		return false;
	}
} 

$(document).ready(function(){
	$("#checkall").click(function(){
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
	
	$("#checkall1").click(function(){
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
		
	$("#grouptab").click(function(){
		$("#groupsList").show();
		$("#membersList").hide();
		$("#grouptab").addClass("btn-primary");$("#grouptab").removeClass("btn-primary_active");
		$("#membertab").removeClass("btn-primary");$("#membertab").addClass("btn-primary_active");
	});
	$("#membertab").click(function(){
		$("#membersList").show();
		$("#groupsList").hide();
		$("#membertab").addClass("btn-primary");$("#membertab").removeClass("btn-primary_active");
		$("#grouptab").removeClass("btn-primary");$("#grouptab").addClass("btn-primary_active");
	});
});

function checkMembersGroup(gid, chk, id){
	if(chk == true){
		if(gid != ""){
			$.post("<?php echo site_url("member/checkMembersGroup");?>",{gid:gid},
			function(data){
				if(data == true){} 
				else{alert("<?php echo $nomembersgroup;?>");$("#"+id).attr("checked", false);}
			});
		}
	}
}
$(document).ready(function(){
	$('.checkbox').click(function(event) {  
			$('.checkbox').each(function() { 
				$('#checkall').attr("checked",true);
				if(this.checked == false) { 
					$('#checkall').attr("checked",false);
				}
			});
		});
		
		$('.checkbox1').click(function(event) {  
			$('.checkbox1').each(function() { 
				$('#checkall1').attr("checked",true);
				if(this.checked == false) { 
					$('#checkall1').attr("checked",false);
				}
			});
		});
});
</script>
</html>