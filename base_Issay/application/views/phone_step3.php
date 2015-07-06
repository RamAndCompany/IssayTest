<!----FULL CALENDAR ---->
<link href='<?php echo base_url();?>application/views/css/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>application/views/css/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url();?>application/views/js/fullcalendar/fullcalendar.min.js'></script>
<!----FULL CALENDAR ---->
	
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
									<div class="stepcont" ><?php echo $step_select_mem;?></div>
									<div class="stephead"></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail" ></div>
									<div class="stepcont" ><?php echo $step_select_fl;?></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail steptailActive" ></div>
									<div class="stepcontActive" ><?php echo $step_scheduling;?></div>
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
							if(!empty($schdata)){
								foreach($schdata as $sdata);
								$sdtm = explode(" ", $sdata->schedule_date);
								if($sdtm[0] != '0000-00-00'){
									 $sdate = $sdtm[0];
								}
								else{$sdate = '';}
								
								$sdt = explode("-", $sdtm[0]);
								$yy  = $sdt[0];
								$mth = $sdt[1];
								
								$tm = explode(":", $sdtm[1]);
								$hr = $tm[0];
								$mn = $tm[1];
								
								$shdt = $sdate;
							}
							else{
								$yy  = date('Y');
								$mth =  date('m');
								$sdate = date('Y-m-d');
								$hr = date('H');$mn = date('i');
								
								$shdt = '';
							}
							?>
							
							<?php
							$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
							echo form_open('phonecall/step3Action', $attributes);
							?>
							<div class="voicePanel" style="padding:5px" >
								<div class="w20 left" >
									
									<select name="cmbCalYear" id="cmbCalYear" onchange="setCalendar();clearCurrentDate();" style="height: 30px;width: 70px; padding: 5px;"  >
										<option value="" ><?php echo $year;?></option>
										<?php 
										for($i=date('Y');$i <= (date('Y')+10);$i++){
											$sel='';
											if($i == date('Y')){$sel = 'selected="true"';}
											if($i == $yy){$sel = 'selected="true"';}
											echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
										}
										?>
									</select>
									<?php echo $year;?>
								</div>
								<div class="w20 left" >
									<select name="cmbCalMonth" id="cmbCalMonth" onchange="setCalendar();clearCurrentDate();" style="height: 30px;width: 70px; padding: 5px;"  >
										<option value="" ><?php echo $month;?></option>
										<?php 
										for($j=1; $j <= 12; $j++){
											if(strlen($j) == 1){$j='0'.$j;}
											$sel = '';
											if(date('m') == $j){$sel = 'selected="true"';}
											if($j == $mth){$sel = 'selected="true"';}else{$sel = '';}
											echo '<option value="'.($j-1).'" '.$sel.'>'.$j.'</option>';
										}
										?>
									</select>
									<?php echo $month;?>
								</div>
								<div class="clear" ></div>
							</div>
							
							<div class="clear" ></div>
							
							<div class="voicePanel" style="padding:5px" id="calPanel" >
								<div class="formLabel" style="width:50%" >
								<div id='calendar'></div>
								</div>
							</div>
							
							<div class="clear" ></div>
							<div class="voicePanel" style="padding:5px;width:48%;float:left;" >
								<div class="w45 left" >
									<select name="hr" id="hr" style="height: 30px;width: 70px; padding: 5px;" >
										<option value="" ><?php echo $hour;?></option>
										<?php 
										for($i=0;$i <= 23;$i++){
											if(strlen($i) == 1){$i='0'.$i;}
											if($i == $hr){$sel = 'selected="true"';}else{$sel = '';}
											echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
										}
										?>
									</select>
									<?php echo $hour;?>
								</div>
								<div class="w45 left">
									<select name="mnt" id="mnt" style="height: 30px;width: 70px; padding: 5px;"  >
										<option value="" ><?php echo $minute;?></option>
										<?php 
										for($j=0; $j <= 59; $j++){
											if(strlen($j) == 1){$j='0'.$j;}
											if($j == $mn){$sel = 'selected="true"';}else{$sel = '';}
											echo '<option value="'.$j.'" '.$sel.'>'.$j.'</option>';
										}
										?>
									</select>
									<?php echo $minute;?>
								</div>
								<div class="clear" ></div>
							</div>
							<div class="voicePanel" style="padding:7px;width:48%;float:left;margin-left:4%;" >
								<div class="w100 left"><input type="checkbox" name="stype" id="stype1" value="now" onclick="disableAll(this.checked)" /> <?php echo $now;?></div>
								<div class="clear" ></div>
							</div>
							<div class="clear" ></div>
							
							<div class="formBtnGroup" >
								<input type="hidden" name="cdate" id="cdate" value="<?php if($sdate != ''){echo $sdate;}else{echo date('Y-m-d');}?>" />
								<input type="hidden" name="sid" id="sid" value="<?php echo $_GET['sid'];?>" />
								<a class="btn-primary" style="float:left; padding: 6px 22px;" href="<?php echo site_url("phonecall/step2").'?sid='.$_GET['sid'];?>" ><?php echo $back_btn;?></a>
								<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $continue_btn;?>" style="float:right;" onclick="return saveForm()" />
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
</body>
<script>
setCalendar();
/* CALENDAR */
function setCalendar(){
	$('#calendar').html('');
		var syr = $('#cmbCalYear').val();
		var smn = $('#cmbCalMonth').val();
		
		$('#calendar').fullCalendar({
		dayClick: function(date, allDay, jsEvent, view) {
				if($(this).hasClass('fc-other-month')){}
				else{
					$('.fc-widget-content').removeClass('fc-state-highlight');
					$(this).addClass("fc-state-highlight");
					date = convert(date);
					$("#cdate").val(date);
				}
			}
		});
		
		$('#calendar').fullCalendar('gotoDate', syr,smn);
		$(".fc-header-right").hide();
		$(".fc-other-month").html("");
		$(".fc-today").removeClass('fc-state-highlight');
}

function convert(str) {
			var date = new Date(str),
				mnth = ("0" + (date.getMonth()+1)).slice(-2),
				day  = ("0" + date.getDate()).slice(-2);
			return [ date.getFullYear(), mnth, day ].join("-");
}


function clearCurrentDate(){
	$("#cdate").val("");
}


function disableAll(chk){
	if(chk == true){
		$("#calPanel").hide();
		$("#cmbCalYear").attr("disabled", true);
		$("#cmbCalMonth").attr("disabled", true);
		$("#hr").attr("disabled", true);
		$("#mnt").attr("disabled", true);
	}
	else{
		$("#calPanel").show();
		$("#cmbCalYear").attr("disabled", false);
		$("#cmbCalMonth").attr("disabled", false);
		$("#hr").attr("disabled", false);
		$("#mnt").attr("disabled", false);
	}
}

function saveForm(){
		var stype = $("#form_fileupload input[type='checkbox']:checked").val();
		if(stype != 'now'){
			var yr = $("#cmbCalYear").val();
			var mn = $("#cmbCalMonth").val();
			var dt = $("#cdate").val();
			var hr = $("#hr").val();
			var mnt = $("#mnt").val();
			var sec = '00';
			var today = new Date();
			var year = dt.substring(0, 4);
            var month = dt.substring(5, 7);
            var day = dt.substring(8, 10);
            var sdate = new Date(year, month - 1, day, hr, mnt, sec);
			
			if(yr == ""){
				alert("<?php echo $select_year;?>");return false;
			}
			if(mn == ""){
				alert("<?php echo $select_month;?>");return false;
			}
			if(hr == ""){
				alert("<?php echo $select_hour;?>");return false;
			}
			if(mnt == ""){
				alert("<?php echo $select_minute;?>");return false;
			}
			if(dt == ""){
				alert("<?php echo $select_day;?>");return false;
			}
			if (sdate < today) {
                alert("<?php echo $sdatelessmsg;?>");return false;
            }
			
		}
	}
	
<?php
if($shdt != ""){ 
$ndt = explode("-", $shdt);
$ny = $ndt[0];
$nm = $ndt[1];
$nd = $ndt[2];
?>
function highlightCell(){
	var ny = '<?php echo $ny;?>';
	var nm = parseInt('<?php echo $nm;?>')-1;
	var nd = '<?php echo $nd;?>';
	var dt = new Date(ny,nm,nd);
	var object = findContainerForDate(dt);
	var clist = object.classList;
	var fc = clist[0];
	var sc = clist[1];
	var tc = clist[2];
	$('.'+tc).addClass('fc-state-highlight');
}
highlightCell();
<?php 
}
?>
function findContainerForDate(date) {
    var firstDayFound = false;
    var lastDayFound = false;
    var calDate = $('#calendar').fullCalendar('getDate');

    var allDates = $('td[class*="fc-day"]');
    for (var index = 0; index < allDates.length; index++) {
        var container 	= allDates[index];
        var month 		= calDate.getMonth();
        var dayNumber 	= $(container).find(".fc-day-number").html();
        if (dayNumber == 1 && ! firstDayFound) {
            firstDayFound = true;
        }
        else if (dayNumber == 1) {
            lastDayFound = true;
        }

        if (! firstDayFound) {
            month--;
        }
        if (lastDayFound) {
            month++;
        }
		if (month == date.getMonth() && dayNumber == date.getDate()) {
            return container;
        }
    }
}
</script>
</html>