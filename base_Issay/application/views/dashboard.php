	
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2><?php echo $dash_title;?></h2>
			</div>
			
			<div class="55u left" style="width:45% !important;"  > 
				<!-----CALLS START----->
				<div class="row">
					<div class="12u">
						
						<h2 class="title-bar" ><?php echo $calllog;?></h2>
						<section class="dash-container" >
							<div class="12u" style="height:350px" >
								<?php 
								if(!empty($callHistory)){
								?>
								<table class="table-data_dash" >
									<tr>
										<!--<th width="10%" align="center" ><?php echo $serial_label;?></th>-->
										<th width="20%" align="center" ><?php echo $cmp_title_label;?></th>
										<th width="12%" align="center" ><?php echo $schedule_dt;?></th>
										<th width="12%" align="center" ><?php echo $creation_dt;?></th>
										<th width="10%" align="center" ><?php echo $status_label;?></th>
										<th width="10%" align="center" ><?php echo $preview;?></th>
										<th width="10%" align="center" ><?php echo $details;?></th>
									</tr>
									<?php 
									$i=1;
									foreach($callHistory as $shis){
									$status = '';
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
									
									<form action="<?php echo site_url('phonecall/history');?>" method="post" name="frm<?php echo $i;?>" id="frm<?php echo $i;?>" >
									<tr>
										<!--<td align="center" ><?php echo $i;?></td>-->
										<td align="center" ><?php echo $shis->schedule_title;?></td>
										<td align="center" ><?php echo $shdt.' '.$shtm;?></td>
										<td align="center" ><?php echo $crdt.' '.$crtm;?></td>
										<td align="center" ><?php echo $status;?></td>
										<td align="center" >
											<input type="hidden" name="category" id="category" value="<?php /*echo $shis->group_id;*/?>" />
											<!--href="javascript:void(0)" onclick="submitForm('frm<?php echo $i;?>')"-->
											<a><i class="play-ico" ></i></a>
											<audio controls id="audioHide" style="margin-left:-39px;" >
											<source src="<?php echo base_url().'application/views/voice/'.$shis->filename;?>" type="audio/mpeg" id="" >
											</audio>
										</td>
										<td align="center" >
											<a id="" onclick="showPopup('<?php echo $shis->schedule_id;?>','call')" href="javascript:void(0)" ><i class="viewdetails-ico" ></i></a>
										</td>
									</tr>
									</form>
									<?php 
									$i++;
									}
									
									/*if(count($callHistory) <5){
										for($i=count($callHistory); $i<5;$i++){
											?>
											<tr height="70" >
											<td align="center" ></td>
											<td align="center" ></td>
											<td align="center" ></td>
											<td align="center" ></td>
											<td align="center" ></td>
											<td align="center" ></td>
											</tr>
											<?php
										}
									}*/
									
									?>
								</table>
								<?php 
								}
								?>
							</div>
							
							<?php 
							if(!empty($callHistory) && count($callHistory) == 5){
							?>
							<div class="clear" ></div>
							<div  class="view_more" ><a href="<?php echo site_url("phonecall/history");?>" ><?php echo $view_more;?></a></div>
							<?php 
							}
							?>
							<div class="clear" ></div>
							
							<?php 
							$totalCalls = '';
							$totalCalls 	= $callTotalCount[0]->tcount;
							$submittedCalls		= $callSubmittedCount[0]->scount;
							$pendingCalls		= $callPendingCount[0]->pcount;
							?>
							<div class="12u" style="padding: 5px;" >
								<div class="graphtitle" ><?php echo $call_last_status;?></div>
								<div class="graph-panel" >
									<div class="clear" ></div>
									<div class="graph-row" >
										<div class="graph-label" ><?php echo $total_announce;?></div>
										<div class="graph-div"><div class="tot_graph"  style="width:100%;" ><?php echo $totalCalls;?></div></div>
									</div>
									<div class="clear" ></div>
									<div class="graph-row" >
										<div class="graph-label" ><?php echo $submitted_announce;?></div>
										<?php 
										if($totalCalls > 0){
										$cper = ($submittedCalls/$totalCalls)*100;
										$cper = round($cper, 2);
										}
										else{$cper = '0';}
										?>
										<div class="graph-div"><div class="sent_graph" style="width:<?php echo $cper;?>%;padding-right: 12px;" ><?php echo $submittedCalls;?></div></div>
									</div>
									<div class="clear" ></div>
									<div class="graph-row" >
										<div class="graph-label"><?php echo $scheduled_announce;?></div>
										<?php 
										if($totalCalls > 0){
											$pper = ($pendingCalls/$totalCalls)*100;
											$pper = round($pper, 2);
										}else{$pper = '0';}
										?>
										<div class="graph-div"><div class="fail_graph" style="width:<?php echo $pper;?>%;padding-right: 12px;" ><?php echo $pendingCalls;?></div></div>
									</div>
									<div class="clear" ></div>
								</div>
							</div>
							
							
						</section>
					</div>
					
				</div>
				<!-----CALLS END----->
				<div class="divider" ></div>
			</div>
			<div class="55u left" style="width:45% !important;" > 
				<!-----SMS START---->
				<div class="row">
					<div class="12u">
						<h2 class="title-bar" ><?php echo $smslog;?></h2>
						<section class="dash-container" >
							<div class="12u" style="height:350px" >
								<?php 
								if(!empty($smsHistory)){
								?>
								<table class="table-data_dash" >
									<tr>
										<!--<th width="10%" align="center" ><?php echo $serial_label;?></th>-->
										<th width="20%" align="center" ><?php echo $cmp_title_label;?></th>
										<th width="12%" align="center" ><?php echo $schedule_dt;?></th>
										<th width="12%" align="center" ><?php echo $creation_dt;?></th>
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
									/*if(count($smsHistory) <5){
										for($i=count($smsHistory); $i<5;$i++){
											?>
											<tr height="70" >
											<td align="center" ></td>
											<td align="center" ></td>
											<td align="center" ></td>
											<td align="center" ></td>
											<td align="center" ></td>
											<td align="center" ></td>
											</tr>
											<?php
										}
									}*/
									?>
								</table>
								<?php 
								}
								?>
							</div>
							
							<?php 
							if(!empty($smsHistory) && count($smsHistory) == 5){
							?>
							<div class="clear" ></div>
							<div class="view_more" ><a href="<?php echo site_url("sms/history");?>" ><?php echo $view_more;?></a></div>
							<?php 
							}
							?>
							
							<div class="clear" ></div>
							
							<div class="12u" style="padding: 5px;" >
							<?php 
							$totalSMS = '';
							$totalSMS 		= $smsTotalCount[0]->tcount;
							$submittedSMS 	= $smsSubmittedCount[0]->scount;
							$pendingSMS		= $smsPendingCount[0]->pcount;
							?>
							<div class="graphtitle" ><?php echo $sms_last_status;?></div>
								<div class="graph-panel" >
									<div class="clear" ></div>
									<div class="graph-row" >
										<div class="graph-label" ><?php echo $total_announce;?></div>
										<div class="graph-div"><div class="tot_graph"  style="width:100%;" ><?php echo $totalSMS;?></div></div>
									</div>
									<div class="clear" ></div>
									<div class="graph-row" >
										<div class="graph-label" ><?php echo $submitted_announce;/*$submittedsms_label;*/?></div>
										<?php 
										if($totalSMS > 0){
											$csper = ($submittedSMS/$totalSMS)*100;
											$csper = round($csper, 2);
										}
										else{$csper = 0;}
										?>
										<div class="graph-div"><div class="sent_graph" style="width:<?php echo $csper;?>%;padding-right: 12px;" ><?php echo $submittedSMS;?></div></div>
									</div>
									<div class="clear" ></div>
									<div class="graph-row" >
										<div class="graph-label"><?php echo $scheduled_announce;?></div>
										<?php 
										if($totalSMS > 0){
											$psper = ($pendingSMS/$totalSMS)*100;
											$psper = round($psper, 2);
										}
										else{$psper = '0';}
										?>
										<div class="graph-div"><div class="fail_graph" style="width:<?php echo $psper;?>%;padding-right: 12px;" ><?php echo $pendingSMS;?></div></div>
									</div>
									<div class="clear" ></div>
								</div>
							</div>
							
						</section>
					</div>
					
				</div>
				<!-----SMS END----->
				<div class="divider" ></div>
				</div>
				<div class="clear" ></div>
				
				<div class="clear" ></div>
				
				<div class="55u left" style="width:45% !important;"  > 
				<!-----CALLS GRAPH----->
				<div class="row">
					<div class="12u">
						<h2 class="title-bar" ><?php echo $totalcalllog;?></h2>
						<section class="dash-container" >
							<div class="12u">
								<div class="graph-panel" >
									<div id="callpiechart" style="width: 470px; height: 320px;"></div>
									<div class="clear" ></div>
								</div>
							</div>
							<div class="clear"></div>
							
						</section>
					</div>
					
				</div>
				<!-----CALLS GRAPH END----->
				<div class="divider" ></div>
			</div>
			
			<div class="55u left" style="width:45% !important;"  > 
				<!-----CALLS GRAPH----->
				<div class="row">
					<div class="12u">
						<h2 class="title-bar" ><?php echo $totalsmslog;?></h2>
						<section class="dash-container" >
							<div class="12u">
								<div class="graph-panel" >
									<div id="smspiechart" style="width: 470px; height: 320px;"></div>
									<div class="clear" ></div>
								</div>
							</div>
							<div class="clear"></div>
							
						</section>
					</div>
					
				</div>
				<!-----CALLS GRAPH END----->
				<div class="divider" ></div>
			</div>
				<div class="clear" ></div>
				
			</div>
			<!-- /Extra -->
			<div class="clear" ></div>	
		</div>
	<!-- /Main -->
	
	<div class="clear" ></div>
	<div id="copyright" class="container">
			2015&copy; CopyRight Emotion Wave Co., Ltd
	</div>
	
	
	<!----------- MODAL DIALOUGES --------->
						<div id="modal-1" class="modal-box" >
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
	<?php 
	$totalCallsAns 		= $totalAnswered[0]->tcount;
	$totalCallsNotAns 	= $totalNotAnswered[0]->tcount;
	$totalCallsFailed 	= $totalFailedCalls[0]->tcount;
	$totalPendingCalls 	= $totalPendingCalls[0]->tcount;
	
	$totalSMSPi 		= $totalSMSPi[0]->tcount;
	$totalSendSMSPi 	= $totalSendSMSPi[0]->tcount;
	$totalPendingSMSPi	= $totalPendingSMSPi[0]->tcount;
	?>
	
</body>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawCallChart);
	  google.setOnLoadCallback(drawSMSChart);
	  
      function drawCallChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['<?php echo $totalans_label;?>',     <?php echo $totalCallsAns;?>],
		  ['<?php echo $scheduled_label;?>',   <?php echo $totalPendingCalls;?>],
          ['<?php echo $totalnotans_label;?>', <?php echo $totalCallsNotAns;?>],
          ['<?php echo $totalfailed_label;?>',   <?php echo $totalCallsFailed;?>]
		]);

        var options = {
          title: '<?php /*echo $calls.':'.$graph;*/?>',pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart(document.getElementById('callpiechart'));

        chart.draw(data, options);
      }
	  
	  function drawSMSChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          /*['<?php echo $total_label;?>',  <?php echo $totalSMSPi;?>],*/
          ['<?php echo $completed_label;?>',<?php echo $totalSendSMSPi;?>],
		  ['<?php echo $scheduled_label;?>',  <?php echo $totalPendingSMSPi;?>]
        ]);

        var options = {
          title: '<?php /*echo $sms.':'.$graph;*/?>', pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart(document.getElementById('smspiechart'));

        chart.draw(data, options);
      }
	  
	  function submitForm(frm){
		$("#"+frm).submit();
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
					/*if(sts == 'NO ANSWER'){rsnd = '<a href="" class="btn-primary" ><?php echo $resend_btn;?></a>';}*/
					
				}
				
				if(op == 'sms'){
					dlst = data[i]['delivery_status'];
					if(dlst == '0'){sts = '<?php echo $status_pending;?>';rsnd = '<a disabled class="btn-disabled" ><?php echo $resend_btn;?></a>';}
					if(dlst == '1'){sts = '<?php echo $status_completed;?>';rsnd = '<a disabled class="btn-disabled" ><?php echo $resend_btn;?></a>';}
					if(dlst == '2'){sts = '<?php echo $status_failed;?>';rsnd = '<a href="#" id="rsndbtnsms'+smid+'" class="btn-primary" onclick="resendSMS('+smid+', '+sid+')" ><?php echo $resend_btn;?></a>';}
					if(dlst == ''){sts = '<?php echo $status_pending;?>';rsnd = '<a disabled class="btn-disabled" ><?php echo $resend_btn;?></a>';}
				}
				
				html += '<tr height="30" ><td>'+mnm+'</td><td>'+phn+'</td><td>'+eml+'</td><td align="center">'+sts+'</td><td style="padding:5px;"  align="center" >'+rsnd+'</td></tr>';
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