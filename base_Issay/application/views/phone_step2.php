	
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
									<div class="stepcont" style="padding: 12px 0px 0px 22px;" ><?php echo $step_select_mem;?></div>
									<div class="stephead"></div>
								</div>
								<div class="steps stepother" >
									<div class="steptail steptailActive" ></div>
									<div class="stepcontActive" style="padding: 12px 0px 0px 8px;" ><?php echo $step_select_fl;?></div>
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
							<?php 
							if(!empty($schdata)){
								foreach($schdata as $sdata);
								$contid = $sdata->content_id;
							}
							else{
								$contid = '';
							}
							?>
							<?php 
							if(!empty($contents)){
							?>
							<?php
							$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
							echo form_open('phonecall/step2Action', $attributes);
							?>
							<div id="uploadResult">
								<table class="table-data" >
									<tr style="background:#F9F9F9;font-weight: 500;">
										<td width="10%" align="center" ><?php echo $selectone;?></td>
										<td width="30%" align="center" ><?php echo $title_label;?></td>
										<td width="30%" align="center" ><?php echo $filenm_label;?></td>
										<td width="30%" align="center" ><?php echo $preview;?></td>
									</tr>
									<?php 
									foreach($contents as $content){
									if($contid == $content->content_id){$sel = 'checked="true"';}else{$sel = '';}
									?>
									<tr>
										<td align="center" ><input type="radio" name="check" id="check" value="<?php echo $content->content_id;?>" <?php echo $sel;?> /></td>
										<td align="center" ><?php echo $content->title;?></td>
										<td align="center" ><?php echo $content->filename;?></td>
										<td align="center" >
											<?php 
											echo '<audio controls id="audio1" style="margin-top: 5px;" >
													<source src="'.base_url().'application/views/voice/'.$content->filename.'" type="audio/mpeg" id="" >
												 </audio>';
											?>
										</td>
									</tr>
									<?php 
									}
									?>
									
								</table>
							</div>
							<div class="formBtnGroup" style="padding: 20px 0px;" >
								<input type="hidden" name="sid" id="sid" value="<?php echo $_GET['sid'];?>" />
								<a class="btn-primary" style="float:left; padding: 6px 22px;" href="<?php echo site_url("phonecall/step1").'?sid='.$_GET['sid'];?>" ><?php echo $back_btn;?></a>
								<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $continue_btn;?>" style="float:right;" onclick="return validate();" />
								<div class="clear"></div>
							</div>
							</form>
							<?php 
							}
							?>
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
function validate(){
	var value = $("#check:checked").val();
	if(typeof value === "undefined"){alert("<?php echo $make_selection;?>");return false;}
}
document.addEventListener('play', function(e){
    var audios = document.getElementsByTagName('audio');
    for(var i = 0, len = audios.length; i < len;i++){
        if(audios[i] != e.target){
            audios[i].pause();
        }
    }
}, true);
</script>
</html>