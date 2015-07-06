	<style>
	.datepicker{width:85% !important;background:#FFF !important;}
	</style>
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
						
						<h2 class="title-bar" ><?php echo $log_title;?></h2>
						<section class="dash-container" >
							<div class="12u">
								<?php
								$attributes = array('class' => 'form-horizontal', 'id' => 'form_list', 'name' => 'form_list', 'enctype' => 'multipart/form-data');
								echo form_open('sms/history', $attributes);
								?>
								<section>
									
									
									<?php 
									if(!empty($message)){
										echo '<div class="alert '.$alertclass.'" >'.$message.'</div>';
									}
									?>
									
									
									<div class="w100" >
										<input type="hidden" name="cdate" id="cdate" value="<?php echo date('m/d/Y');?>" />
										
										<div class="w20 left" ><?php echo $from_date;?></div>
										<div class="w20 left" ><?php echo $from_time;?></div>
										<div class="w20 left" ><?php echo $to_date;?></div>
										<div class="w20 left" ><?php echo $to_time;?></div>
										
										<div class="clear"></div>
										
										<div class="w20 left" ><input type="text" name="sdate" id="sdate" value="<?php if(isset($_POST['sdate'])){echo $_POST['sdate'];}?>" class="formFileField datepicker" onchange="checkDate(this.value, 'sdate')" /></div>
										<div class="w20 left" >
											<div class="w45 left" >
												<select name="hr" id="hr" class="formFileField" style="height: 30px;width: 80px; padding: 5px;float:left;" >
													<option value="" ><?php echo $hour;?></option>
													<?php 
													for($i=0;$i <= 23;$i++){
														if(strlen($i) == 1){$i='0'.$i;}
														if(isset($_POST['hr']) && $i==$_POST['hr']){$sel = 'selected="true"';}else{$sel='';}
														echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
													}
													?>
												</select>
												<!--<div class="w10" style="float:left" >
													<?php echo $hour;?>
												</div>-->
											</div>
											
											<div class="w45 left" >
												<select name="mnt" id="mnt" class="formFileField" style="height: 30px;width: 80px; padding: 5px;float:left;"  >
													<option value="" ><?php echo $minute;?></option>
													<?php 
													for($j=0; $j <= 59; $j++){
														if(strlen($j) == 1){$j='0'.$j;}
														if(isset($_POST['mnt']) && $j==$_POST['mnt']){$sel = 'selected="true"';}else{$sel='';}
														echo '<option value="'.$j.'" '.$sel.'>'.$j.'</option>';
													}
													?>
												</select>
												<!--<div class="w10" style="float:left" >
													<?php echo $minute;?>
												</div>-->
											</div>
											
											<div class="clear"></div>
										</div>
										
										<div class="w20 left" ><input type="text" name="edate" id="edate" value="<?php if(isset($_POST['edate'])){echo $_POST['edate'];}?>" class="formFileField datepicker" onchange="checkDate(this.value, 'edate')" /></div>
										<div class="w20 left" >
											<div class="w45 left" >
												<select name="thr" id="thr" class="formFileField" style="height: 30px;width: 80px; padding: 5px;float:left;" >
													<option value="" ><?php echo $hour;?></option>
													<?php 
													for($i=0;$i <= 23;$i++){
														if(strlen($i) == 1){$i='0'.$i;}
														if(isset($_POST['thr']) && $i==$_POST['thr']){$sel = 'selected="true"';}else{$sel='';}
														echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
													}
													?>
												</select>
												<!--<div class="w10" style="float:left" >
													<?php echo $hour;?>
												</div>-->
											</div>
											
											<div class="w45 left" >
												<select name="tmnt" id="tmnt" class="formFileField" style="height: 30px;width: 80px; padding: 5px;float:left;"  >
													<option value="" ><?php echo $minute;?></option>
													<?php 
													for($j=0; $j <= 59; $j++){
														if(strlen($j) == 1){$j='0'.$j;}
														if(isset($_POST['tmnt']) && $j==$_POST['tmnt']){$sel = 'selected="true"';}else{$sel='';}
														echo '<option value="'.$j.'" '.$sel.'>'.$j.'</option>';
													}
													?>
												</select>
												<!--<div class="w10" style="float:left" >
													<?php echo $minute;?>
												</div>-->
											</div>
											
											<div class="clear"></div>
										</div>
										<div class="clear"></div>
										
										<!--<div class="w20 left" ><?php echo $phone_label;?></div>-->
										<div class="w20 left" ><?php echo $group;?></div>
										<div class="w20 left" ><?php echo $status_label;?></div>
										<div class="w20 left" ></div>
										<div class="clear"></div>
										
										<!--<div class="w20 left" >
											<input type="text" name="phone" id="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" class="formFileField" />
										</div>-->
										<div class="w20 left" >
											<select name="category" id="category" class="formFileField" style="padding:5px;" >
												<option value="" > </option>
												<?php 
												if(!empty($mgroups)){
													$sel='';
													foreach($mgroups as $gp){
														if(isset($_POST['category']) && $gp->category_id == $_POST['category']){$sel = 'selected="true"';}else{$sel='';}
														echo '<option value="'.$gp->category_id.'" '.$sel.'>'.$gp->category_name.'</option>';
													}
												}
												?>
											</select>
										</div>
										
										<div class="w20 left" >
											<select name="status" id="status" class="formFileField" style="padding:5px;" >
												<option value="" > </option>
												<option value="0" <?php if(isset($_POST['status']) && $_POST['status'] == '0'){echo 'selected="true"';}else{}?>><?php echo $status_pending;?></option>
												<option value="1" <?php if(isset($_POST['status']) && $_POST['status'] == '1'){echo 'selected="true"';}else{}?> ><?php echo $status_completed;?></option>
											</select>
										</div>
										<div class="w20 left" >
											<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $search_btn;?>" onclick="return validate();" />
										</div>
									</div>
									<div class="clear"></div>
								<div id="uploadResult" style="width: 94%;margin-left: auto;margin-right: auto;margin-top: 10px;" >	
								<?php 
								if(!empty($smsHistory)){
								?>
								
								<table class="table-data_dash">
									<tr>
										<!--<th width="10%" align="center" ><?php echo $serial_label;?></th>-->
										<th width="20%" align="center" ><?php echo $cmp_title_label;?></th>
										<th width="15%" align="center" ><?php echo $schedule_dt;?></th>
										<th width="15%" align="center" ><?php echo $creation_dt;?></th>
										<th width="10%" align="center" ><?php echo $status_label;?></th>
										<th width="10%" align="center" ><?php echo $preview;?></th>
										<th width="10%" align="center" ><?php echo $details;?></th>
									</tr>
									<?php 
									$i=1;
									foreach($smsHistory as $shis){
									$st = $shis->schedule_status;
									if($st == '0'){$status = $status_pending;}
									if($st == '1'){$status = $status_completed;}
									$dtex = explode(" ", $shis->schedule_date);
									$sdt = explode("-", $dtex[0]);
									$shdt = $sdt[1].'/'.$sdt[2].'/'.$sdt[0];
									$shtm = $dtex[1];
									
									$crex = explode(" ", $shis->creation_date);
									$cdt = explode("-", $crex[0]);
									$crdt = $cdt[1].'/'.$cdt[2].'/'.$cdt[0];
									$crtm = $crex[1];
									?>
									<form action="<?php echo site_url('sms/history');?>" method="post" name="frmsms<?php echo $i;?>" id="frmsms<?php echo $i;?>" >
									<tr>
										<!--<td align="center" ><?php echo $i;?></td>-->
										<td align="center" ><?php echo $shis->schedule_title;?></td>
										<td align="center" ><?php echo $shdt.' '.$shtm;?></td>
										<td align="center" ><?php echo $crdt.' '.$crtm;?></td>
										<td align="center" ><?php echo $status;?></td>
										<td align="center" >
											<!--  href="javascript:void(0)" onclick="submitForm('frmsms<?php echo $i;?>')" -->
											<a class="messageico" title="<?php echo $shis->content;?>" ><i class="smstext-ico" ></i></a>
										</td>
										<td align="center" >
											<a id="" onclick="showPopup('<?php echo $shis->schedule_id;?>', 'sms')" href="javascript:void(0)" ><i class="viewdetails-ico" ></i></a>
										</td>
										
									</tr>
									</form>
									<?php 
									$i++;
									}
									?>
								</table>
								
								<?php 
								}
								else{
									echo '<div class="alert alert-error" >'.$nodata.'</div>';
								}
								?>
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
	<div id="copyright" style="position:fixed" >
			2015&copy; CopyRight Emotion Wave Co., Ltd
	</div>
	
	
						<!----------- MODAL DIALOUGES --------->
						<div id="modal-1" class="modal-box" style="position:fixed;" >
								<div class="modal-content" style="position:absolute;width:50%;left:25%;top:1%;min-height:52%;" >
									<div class="model-header" style="position: absolute;width: 100%;left: 0px;top: 0px;padding: 3px 12px;" >
										<div class="model-title" ><?php echo $viewdetails_label;?></div>
										<div class="model-close" id="close-model1" onclick="hidePopup()" >X</div>
										<div class="clear" ></div>
									</div>
									<div style="margin-top:20px;margin-top: 20px;height: 100%;overflow-x: auto;" >
										<?php
										$attributes = array('class' => 'form-horizontal', 'id' => 'form_sms', 'name' => 'form_sms', 'enctype' => 'multipart/form-data');
										echo form_open('content/saveSMS', $attributes);
										?>
										<div id="popresult" >
											
										</div>
										<div class="clear" ></div>
										</form>
									</div>
								</div>
							</div>
	
	
</body>
<script>
$(document).ready(function(){
	$(".datepicker").datepicker({
		changeYear:true, 
		changeMonth:true,
		showOn: "button",
		buttonImage: "<?php echo base_url();?>application/views/images/calendar.png",
		buttonImageOnly: true,
		buttonText: ""
	});
});

function checkDate(dt, id){
	if(dt.length < 10){alert("<?php echo $invalid_date;?>");$("#"+id).val("");}
	else if(dt.length > 10){alert("<?php echo $invalid_date;?>");$("#"+id).val("");}
	else{
		var d=new Date(dt);
		if(d == "Invalid Date"){
			alert("<?php echo $invalid_date;?>");
			$("#"+id).val("");
		}
	}
}

function showPopup(shid, op){
	$("#modal-1").show();
	$("#popresult").html("<?php echo $loading.'....';?>");
	var mnm, phn, sts = '';rsnd = '';
	$.post("<?php echo site_url("indexpage/dashdata");?>", {shid:shid, op:op}, 
	function(data){
		if(data != ''){
			var html =  '<table class="table-data">'
				html += '<tr><th width="30%" ><?php echo $name_label;?></th><th width="15%" ><?php echo $phone_label;?></th><th width="20%" ><?php echo $email_label;?></th><th width="15%" ><?php echo $status_label;?></th><th width="20%" ><?php echo $resend_btn;?></th></tr>';
			for (i in data) {
				smid = data[i]['sch_mem_id'];
				sid = data[i]['schedule_id'];
				mnm = data[i]['member_name'];
				phn = data[i]['phone_no'];
				eml = data[i]['email'];
				if(op == 'call'){
					sts = data[i]['callstatus'];
					if(sts == 'FAILED'){sts = '<?php echo $status_failed;?>';rsnd = '<a href="#" class="btn-primary" id="rsndbtncall'+smid+'" onclick="resendCall('+smid+', '+sid+')" ><?php echo $resend_btn;?></a>';}
					if(sts == null){sts = '<?php echo $status_pending;?>';rsnd = '<a class="btn-disabled" ><?php echo $resend_btn;?></a>';}
					if(sts == 'NO ANSWER'){sts = '<?php echo $status_pending;?>';rsnd = '<a disabled class="btn-disabled" ><?php echo $resend_btn;?></a>';}
					if(sts == 'ANSWERED'){sts = '<?php echo $status_completed;?>';rsnd = '<a disabled class="btn-disabled" ><?php echo $resend_btn;?></a>';}
					
				}
				
				if(op == 'sms'){
					dlst = data[i]['delivery_status'];
					if(dlst == '0'){sts = '<?php echo $status_pending;?>';rsnd = '<a disabled class="btn-disabled" ><?php echo $resend_btn;?></a>';}
					if(dlst == '1'){sts = '<?php echo $status_completed;?>';rsnd = '<a disabled class="btn-disabled" ><?php echo $resend_btn;?></a>';}
					if(dlst == '2'){sts = '<?php echo $status_failed;?>';rsnd = '<a href="#" class="btn-primary" id="rsndbtnsms'+smid+'" onclick="resendSMS('+smid+', '+sid+')" ><?php echo $resend_btn;?></a>';}
					if(dlst == ''){sts = '<?php echo $status_pending;?>';rsnd = '<a disabled class="btn-disabled" ><?php echo $resend_btn;?></a>';}
				}
				
				html += '<tr height="30" ><td>'+mnm+'</td><td>'+phn+'</td><td>'+eml+'</td><td align="center" >'+sts+'</td><td style="padding:5px;" align="center" >'+rsnd+'</td></tr>';
			}
			html += '</table>';
			$("#popresult").html(html);
		}
		else{
			$("#popresult").html('<?php echo $nodata;?>');
		}
	});
}
function hidePopup(){
	$("#modal-1").hide();
}
</script>
	
<script>
$(function(){
    $(".messageico").tooltip({
      show: {
        effect: "slideDown",
        delay: 150
      }
    });
    
});

function validate(){
	var sdt = $("#sdate").val();
	var shr = $("#hr").val();
	var smnt = $("#mnt").val();
	
	var edt = $("#edate").val();
	var ehr = $("#thr").val();
	var emnt = $("#tmnt").val();
	
	var cdt = $("#cdate").val();
	
	var sec = '00';
	var sdate, edate = '';
	
	/**SDATE & EDATE CHECK**/
	if(sdt != ''){
		var syear = sdt.substring(6, 10);
		var smonth = sdt.substring(0, 2);
		var sday = sdt.substring(3, 5);
		sdate = new Date(syear, smonth - 1, sday, shr, smnt, sec);
	}else {sdate = '';}
	if(edt != ''){
		var eyear = edt.substring(6, 10);
		var emonth = edt.substring(0, 2);
		var eday = edt.substring(3, 5);
		var edate = new Date(eyear, emonth - 1, eday, ehr, emnt, sec);
	}else {edate = '';}
	
	/**STIME & ETIME CHECK**/
	if(sdt == ''){
		if(shr != '' && smnt != ''){
			var syear = cdt.substring(6, 10);
			var smonth = cdt.substring(0, 2);
			var sday = cdt.substring(3, 5);
			sdate = new Date(syear, smonth - 1, sday, shr, smnt, sec);	
		}else{sdate = '';}
	}
	if(edt == ''){
		if(ehr != '' && emnt != ''){
			var eyear = cdt.substring(6, 10);
			var emonth = cdt.substring(0, 2);
			var eday = cdt.substring(3, 5);
			edate = new Date(eyear, emonth - 1, eday, ehr, emnt, sec);	
		}else{edate = '';}
	}
	
	if(sdate != '' && edate != ''){
		if(sdate > edate){
			alert("<?php echo $startenddatecheck;?>");
			return false;
		}
	}
}

function resendCall(smid, sid){
	$.post("<?php echo site_url('sms/resend');?>",{smid:smid, sid:sid},
	function(data){
		if(data == true){
			$('#rsndbtncall'+smid).removeAttr("onclick");
			$('#rsndbtncall'+smid).attr("disabled", true);
		}
	});
	
}
function resendSMS(smid, sid){
	$.post("<?php echo site_url('sms/resend');?>",{smid:smid, sid:sid},
	function(data){
		if(data == true){
			$('#rsndbtnsms'+smid).removeAttr("onclick");
			$('#rsndbtnsms'+smid).attr("disabled", true);
		}
	});
}
</script>
	
</html>