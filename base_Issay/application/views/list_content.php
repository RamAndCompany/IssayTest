	<?php 
	$type = $_GET['type'];
	?>
	<!-- Main -->
		<div id="dashboard">
			
			<div id="menu-container" >
			<!-- Nav -->
					<?php include "includes/menu.php"; ?>
			</div>
			
			<!-- Extra -->
			<div id="marketing" class="container">
			<div id="header-line" >
					<h2 ><?php echo $content_title;?></h2>
			</div>
			
			<div class="11u" style="margin-left:23px;width: 95%;" > 
				<!-----CALLS START----->
				<div class="row">
					<div class="12u">
						<?php 
						if($type == 'sms'){$ctype = $sms;}
						if($type == 'calls'){$ctype = $calls;}
						?>
						<h2 class="title-bar" ><?php echo $contentlist_title.":".$ctype;?></h2>
						<section class="dash-container" >
							<div class="12u">
								<section style="padding-top: 10px;margin-bottom: 5px;">
									
									
									<?php 
									if(!empty($message)){
										echo '<div class="alert '.$alertclass.'" >'.$message.'</div>';
									}
									?>
									
									<?php 
							if(!empty($contents)){
							?>
							
							<?php
							$attributes = array('class' => 'form-horizontal', 'id' => 'form_list', 'name' => 'form_list', 'enctype' => 'multipart/form-data');
							echo form_open('content/deleteContent', $attributes);
							?>
							<div id="uploadResult" style="width: 98%;height:375px;" >
								<table class="table-data" >
									<tr>
										<th width="5%" align="center" ><input type="checkbox" id="checkall" name="checkall" /></th>
										<th width="30%" ><?php echo $title_label;?></th>
										<?php 
										if($type == 'calls'){
											echo '<th width="20%" align="center" >'.$filenm_label.'</th>';
											echo '<th width="25%" align="center" >'.$voicechk_label.'</th>';
										}
										if($type == 'sms'){
											echo '<th width="30%" align="center" >'.$sms.'</th>';
										}
										?>
										<th width="20%" align="center" ><?php echo $istested_label;?></th>
									</tr>
									<?php 
									foreach($contents as $content){
										
									?>
									<tr id="<?php echo "row".$content->content_id;?>" >
										<td align="center" ><input type="checkbox" name="check[]" id="check" value="<?php echo $content->content_id;?>" class="checkbox" /></td>
										<td ><?php echo $content->title;?></td>
										<?php 
										if($type == 'calls'){
											echo '<td align="center" >'.$content->filename.'</td>';
											echo '<td align="center" >';
											echo '<audio controls id="audio1" style="margin-top: 5px;" >
														<source src="'.base_url().'application/views/voice/'.$content->filename.'" type="audio/mpeg" id="" >
													</audio>';
											echo '</td>';
										}
										if($type == 'sms'){
											echo '<td align="center" >'.$content->content.'</td>';
										}
										?>
										
										
										<td align="center" >
											<?php if($content->is_tested == '1'){echo 'Yes';}else{echo 'No';}?>
										</td>
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
								<div class="formBtnGroup" style="padding: 8px;text-align: left; margin-left: 10px;" >
								<?php 
								if($type == "sms"){
								?>
								<input type="button" class="btn-primary" name="btn" id="btn_sms" value="<?php echo $addnew_btn;?>" />
								<input type="button" class="btn-primary" name="btn" id="btn_edit_sms" value="<?php echo $edit_btn;?>" />
								<?php 
								}
								if($type == "calls"){
								?>
								<input type="button" class="btn-primary" name="btn" id="btn_voice" value="<?php echo $addnew_btn;?>" />
								<!--<input type="button" class="btn-primary" name="btn" id="btn_edit_mem" value="Edit Voice Content" />-->
								<?php 
								}
								?>
								<?php 
								if(!empty($contents)){
								?>
								<input type="button" class="btn-primary" name="btn" id="btn_delete" value="<?php echo $delete_btn;?>" style="padding: 5px 16px;" onclick="deleteInfo()" />
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
	<div class="clear" ></div>
	
	<!----------- MODAL DIALOUGES --------->
								
							
								<!------ADD VOICE DIALOUGE--------->
								<div id="modal-2" class="modal-box" style="" >
									<div class="modal-content" style="top:2%;" >
									<div class="model-header">
										<div class="model-title" ><?php echo $addnew_voice_title;?></div>
										<div class="model-close" id="close-model2" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_createVoice', 'name' => 'form_createVoice', 'enctype' => 'multipart/form-data');
									echo form_open('content/saveVoice', $attributes);
									?>
									<div id="" >
									<div class="clear" ></div>
									<div style="margin-top:10px;margin-bottom:10px; overflow: hidden;" >
										<div class="3u left" >
										<div class="formLabel"><?php echo $title_label;?><font color="red" >*</font></div>
										</div>
										<div class="7u left" >
										<div class="w100" ><input type="text" name="txtTitle" id="txtTitle" class="formFileField" style="width:100%" /></div>
										</div>
									</div>
									<div class="clear" ></div>
										
									<div class="voicePanel" >
										<div class="formLabel" >
										<input type="radio" name="voicetype" class="cvoicetype" id="voicetype1" checked="true" value="1" onclick="activeTab(this.value,this.checked)" /><?php echo $uploadfl_label;?>
										</div>
										<div class="clear" ></div>
										
										<!--<div class="w45 left" >
											<div class="formLabel" ><?php echo $selectfl_label;?><font color="red" >*</font></div>
										</div>-->
										<div class="w45 left" style="" >
											<div class="formFields" style="width:100%">
												<input type="file" name="filefld" id="filefld" class="formFileField" />
											</div>
										</div>
										<div class="w10 left" >
											<div id="previewHolder1" style="margin-top: 7px;" >
												<audio controls id="audio1" >
												<source src="" type="audio/mpeg" id="" >
												</audio>
											</div>
										</div>
										<div class="clear" ></div>
										<div class="w45" style="color: #FF0000;margin-left: 23px;" ><?php echo $maxfilesize.' : 2mb';?></div>
										<div class="clear" ></div>
									</div>
									
									<div class="voicePanel" >
									
										<div class="formLabel" >
											<input type="radio" name="voicetype" class="cvoicetype"  id="voicetype2" value="2" onclick="activeTab(this.value,this.checked)" /><?php echo $recvoice_label;?>
										</div>
										<div class="clear" ></div>
										<div class="recordFields" >
											<!-- script used for audio/video/gif recording -->
											<script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
											<div style="margin-left: 28px;">
												<audio id="preview" controls ></audio>
												<div>
												<a id="record" class="btn-primary" disabled ><?php echo $record_label;?></a>
												<a id="stop" class="btn-primary" disabled ><?php echo $stoplay_label;?></a>
												<a id="delete"  class="btn-primary" disabled ><?php echo $delete_btn;?></a>
												</div>
											</div>	
											<div id="container" style="padding:1em 2em;" class="voicerecContainer" ></div>
											<input type="hidden" name="recordedFile" id="recordedFile" />
											 
											 
											 <div class="clear" ></div>
										</div>
										<div class="clear" ></div>
										
									</div>
									
									<div class="voicePanel" style="padding-bottom: 9px;" >
										<div class="formLabel" ><input type="radio" name="voicetype" class="cvoicetype"  id="voicetype3" value="3" onclick="activeTab(this.value,this.checked)" /><?php echo $txtvoicel_label;?></div>
										<div class="clear" ></div>
										<div class="w100" >
											<div class="w20 left" ><?php echo $selectlang_label;?></div>
											<div class="w25 left" ><input type="radio" name="lang" id="lang1" value="en" checked="true" />English</div>
											<div class="w25 left" ><input type="radio" name="lang" id="lang2" value="ja" />日本人</div>
										</div>
										<div class="clear" ></div>
										<div class="formLabel" ><?php echo $text_label;?><font color="red" >*</font></div>
										<div style="width:98%;margin-left: 5px;" >
											<textarea id="txtToVoice" name="txtToVoice" class="txtareafld" ></textarea>
										</div>
										<div class="clear" ></div>
										<div class="voiceFields" style="margin-left: 5px;" >
												<a onclick="generateVoice()" title="<?php echo $generatevoice;?>" id="mic"  class="btn-primary" style="float: left;margin-right: 5px;" >
													<?php echo $generatevoice;?>
											    </a>
												<a id="generatedVoice" ></a>
												<div class="clear" ></div>
										</div>
									</div>
									
									<div class="clear" ></div>
									
									</div>
									<div class="clear" ></div>
									
									<div class="formBtnGroup" >
										<input type="hidden" name="type" id="type" value="calls" />
										<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $save_btn;?>" onclick="return uploadFile()" />
									</div>
									</form>
								</div>
							</div>
							
							<!-------ADD SMS CONTENT-------->
								<div id="modal-1" class="modal-box" >
								<div class="modal-content" style="position:absolute;width:40%;left:30%;" >
									<div class="model-header">
										<div class="model-title" ><?php echo $addnew_sms_title;?></div>
										<div class="model-close" id="close-model1" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_sms', 'name' => 'form_sms', 'enctype' => 'multipart/form-data');
									echo form_open('content/saveSMS', $attributes);
									?>
									<div id="" >
										<div class="w100" ><?php echo $title_label;?><font color="red" >*</font></div>
										<div class="w100" ><input type="text" name="txtTitle" id="txtTitle" class="formFileField" /></div>
										<div class="clear" ></div>
										
										<div class="w100" ><?php echo $sms;?><font color="red" >*</font></div>
										<div class="w100" >
											<textarea id="txtContent" name="txtContent" class="txtareafld" onkeyup="countChar(this.value, 'txtContent', 'counterDiv')" ></textarea>
										</div>
										<div class="clear" ></div> 
										<div class="w45 left" style="color: #FF0000;" ><?php echo $maxcharsize.' : 160';?></div>
										<div class="w45 left" style="color: #666;" ><?php echo $enteredcharsize;?> : <a style="color: #666;" id="counterDiv" >0</a></div>
										<div class="clear" ></div>
									</div>
									<div class="clear" ></div>
									
									<div class="formBtnGroup" >
										<input type="hidden" name="type" id="type" value="sms" />
										<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $save_btn;?>" onclick="return addNewInfo()" />
									</div>
									</form>
								</div>
							</div>
							
							<!-------EDIT SMS CONTENT -------->
							<div id="modal-3" class="modal-box" >
								<div class="modal-content" >
									<div class="model-header">
										<div class="model-title" ><?php echo $edit_sms_title;?></div>
										<div class="model-close" id="close-model3" >X</div>
										<div class="clear" ></div>
									</div>
									<?php
									$attributes = array('class' => 'form-horizontal', 'id' => 'form_fileupload', 'name' => 'form_fileupload', 'enctype' => 'multipart/form-data');
									echo form_open('content/updateContent', $attributes);
									?>
									<div id="" >
										<div class="w100" ><?php echo $title_label;?><font color="red" >*</font></div>
										<div class="w100" ><input type="text" name="txtTitleEdt" id="txtTitleEdt" class="formFileField" /></div>
										<div class="clear" ></div>
										
										<div class="w100" ><?php echo $sms;?><font color="red" >*</font></div>
										<div class="w100" >
											<textarea id="txtContentEdt" name="txtContentEdt" class="txtareafld" onkeyup="countChar(this.value, 'txtContentEdt', 'counterDivEdt')" ></textarea>
										</div>
										<div class="clear" ></div> 
										<div class="w45 left" style="color: #FF0000;" ><?php echo $maxcharsize.' : 160';?></div>
										<div class="w45 left" style="color: #666;" ><?php echo $enteredcharsize;?> : <a style="color: #666;" id="counterDivEdt" >0</a></div>
										<div class="clear" ></div>
										
									</div>
									<div class="clear" ></div>
									
									<div class="formBtnGroup" >
										<input type="hidden" name="cid" id="cid" />
										<input type="submit" class="btn-primary" name="btn" id="btn" value="<?php echo $update_btn;?>" onclick="return editInfo()" />
									</div>
									</form>
								</div>
							</div>
							
	<!--------MODAL DIALOUGES ENDS HERE---->
	
	
</body>
<script>
document.addEventListener('play', function(e){
    var audios = document.getElementsByTagName('audio');
    for(var i = 0, len = audios.length; i < len;i++){
        if(audios[i] != e.target){
            audios[i].pause();
        }
    }
}, true);

function countChar(txt, id, cid){
	var len = txt.length;
	$('#'+cid).html(len);
	if(len > 160){
		alert("<?php echo $maxcharsize_alert;?>");
		txt = txt.substring(0, 160);
		$("#"+id).val(txt);
		$('#'+cid).html(160);
	}
}

$(document).ready(function(){
	$("#filefld").attr("disabled",false);
	$("#record").attr("disabled",true);
	$("#lang1").attr("disabled",true);
	$("#lang2").attr("disabled",true);
	$("#txtToVoice").attr("disabled",true);
	$("#mic").attr("disabled",true);  
	$("#record").hide();
	$("#stop").hide();
	$("#delete").hide();
	$("#mic").hide();
	$(".voicerecContainer").html("");
});
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
		$('.checkbox').click(function(event) {  
			$('.checkbox').each(function() { 
				$('#checkall').attr("checked",true);
				if(this.checked == false) { 
					$('#checkall').attr("checked",false);
				}
			});
		});
});			
	function addNewInfo(){
		 var title = $("#form_sms #txtTitle").val();
		 var cont = $("#form_sms #txtContent").val();
		 if(title == false){alert("<?php echo $mandatory_field;?>");return false;}
		 else if(cont == false){alert("<?php echo $mandatory_field;?>");return false;}
		 else if(cont.length > 160 ){alert("<?php echo $maxcharsize_alert;?>");return false;}
		 else{alert("<?php echo $datasaved;?>");return true;}
	}
	
	function editInfo(){
		var title = $("#form_sms #txtTitleEdt").val();
		 var cont = $("#form_sms #txtContentEdt").val();
		 if(title == false){alert("<?php echo $mandatory_field;?>");return false;}
		 else if(cont == false){alert("<?php echo $mandatory_field;?>");return false;}	
		 else if(cont.length > 160 ){alert("<?php echo $maxcharsize_alert;?>");return false;}
		 else{alert("<?php echo $dataupdated;?>");return true;}
	}
	
	function deleteInfo(){
		if ($("input[type=checkbox]:checked").length === 0) {
			alert('<?php echo $chkalert;?>');
		}
		else{
			var ans = confirm("<?php echo $cnfmalert;?>");
			if(ans == true){
				$('input[type=checkbox]:checked').each(function() { 
					var cid = $(this).val();
					$.post('<?php echo site_url('content/deleteContent');?>',{cid:cid},
					function(data){
						if(data == true){
							$("#row"+cid).remove();
						}
					});
				});
				alert('<?php echo $datadeleted;?>');
			}
		}
	}
	
	$(document).ready(function(){
		/*VOICE Model*/
		$("#btn_voice").click(function(){
			$("#filefld").attr("disabled",true);
			$("#previewHolder1").hide();
			$("#audio1 source").attr("src","");
			$("#record").attr("disabled",true);
			$("#lang1").attr("disabled",true);
			$("#lang2").attr("disabled",true);
			$("#txtToVoice").attr("disabled",true);
			$("#mic").attr("disabled",true);  
			$("#record").hide();
			$("#stop").hide();
			$("#delete").hide();
			$("#txtTitle").val("");
			$("#recordedFile").val("");
			$("#mic").hide();
			$(".voicerecContainer").html("");
			$(".cvoicetype").removeAttr("checked");
			$("#voicetype1").attr("checked","checked");
			$("#modal-2").toggle();
		});
		$("#close-model2").click(function(){
			$("#modal-2").toggle();
		});
		/*ADD SMS Model*/
		$("#btn_sms").click(function(){
			$("#modal-1").toggle();
		});
		$("#close-model1").click(function(){
			$("#modal-1").toggle();
		});
		
		/*Edit SMS Model*/
		$("#btn_edit_sms").click(function(){
			if ($("input[type=checkbox]:checked").length === 1) {
				var cid = $("input[type=checkbox]:checked").val();
				$.post('<?php echo site_url('content/getSMS');?>',{cid:cid},
				function(data){
					if(data != ""){
						for(i in data){
							var ctid = data[i]['content_id'];
							var title = data[i]['title'];
							var content = data[i]['content']; 
							$("#txtTitleEdt").val(title);
							$("#txtContentEdt").val(content);
							$("#cid").val(ctid);
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
	</script>
	
	<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				var html = '<audio controls id="audio1" >'+
						   '<source src="'+e.target.result+'" type="audio/mpeg" id="" >'+
						   '</audio>';
				$('#previewHolder1').html(html);
			}
		reader.readAsDataURL(input.files[0]);
		}
	}

	$("#filefld").change(function() {
		var allowed 	= {wav:"wav",mp3:"mp3"};
		var fpath	 	= $("#filefld").val();
		var file_size 	= $('#filefld')[0].files[0].size;
		var extn 		= fpath.split(".");
		var elen 		= extn.length;
		var ext 		= extn[elen-1];
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
				alert('<?php echo $invalidvoice;?>');
				$('#previewHolder1').html('');
				$("#filefld").val("");
			}
		}
	});
	
	function uploadFile(){
		var check = $("input:checked").val();
		var rad   = $("input[name='voicetype']:checked").length;
		var allowed = {wav:"wav",mp3:"mp3"};
		var title = $("#form_createVoice #txtTitle").val();
		var fpath = $("#form_createVoice #filefld").val();
		var rfile = $("#form_createVoice #recordedFile").val();
		var extn = fpath.split(".");
		var elen = extn.length;
		var ext = extn[elen-1];
		
		if(title == false){alert('<?php echo $mandatory_field;?>');$("#form_createVoice #txtTitle").focus();return false;}
		else if(rad != 1){
			alert('<?php echo $radioalert;?>');return false;
		}
		else{		
			   if(check == 1){
					if(fpath == ""){alert("<?php echo $mandatory_field;?>");$("#form_createVoice #filefld").focus();return false;}
					else{
						if (typeof allowed[ext] != 'undefined'){alert("<?php echo $datasaved;?>");return true;}
						else{alert('<?php echo $invalidvoice;?>');$("#filefld").val("");return false;}
					}
				}
				else if(check == 2){
					if(rfile == false){alert("<?php echo $recvoice_label;?>");return false;}
					else{alert("<?php echo $datasaved;?>");return true;}
				}
				else if(check == 3){
					if($("#txtToVoice").val() == false){alert("<?php echo $mandatory_field;?>");$("#txtToVoice").focus();return false;}
					else if($("input[name='generatedFile']").length == 0){alert("<?php echo $generatevoice;?>");return false;}
					else if($("input[name='generatedFile']").val() == ""){alert("<?php echo $generatevoice;?>");return false;}
					else{alert("<?php echo $datasaved;?>");return true;}
				}
			
		}
		
	}
	
	
	function generateVoice(){
		var lang = $("input[name=lang]:checked").val();
		var txt = $("#txtToVoice").val();
		if(txt != ''){
			$.post("<?php echo site_url("ajax/generateVoice");?>",{txt:txt,lang:lang},
			function(data){
				$("#generatedVoice").html(data);
			});
		}
		else{
			alert("<?php echo $mandatory_field;?>");$("#txtToVoice").focus();
		}
	}
	
	function activeTab(op, chk){
		if(op == 1){
			$("#filefld").attr("disabled",false);
			$("#record").attr("disabled",true);
			$("#lang1").attr("disabled",true);
			$("#lang2").attr("disabled",true);
			$("#txtToVoice").attr("disabled",true);
			$("#generatedVoice").html("");
			$("#txtToVoice").val("");
			$("#recordedFile").val("");
			$("#container").html("");
			$("#mic").hide();
			$("#record").hide();
			$("#stop").hide();
			$("#delete").hide();
			$("#preview").attr("src","");
			$("#previewHolder1").show();
		}
		if(op == 2){
			$("#filefld").attr("disabled",true);$("#filefld").val("");
			$("#record").attr("disabled",false);
			$("#lang1").attr("disabled",true);
			$("#lang2").attr("disabled",true);
			$("#txtToVoice").attr("disabled",true);
			$("#generatedVoice").html("");
			$("#txtToVoice").val("");
			$("#container").html("");
			$("#mic").hide();
			$("#record").show();
			$("#stop").show();
			$("#delete").show();
			$("#previewHolder1").hide();
		}
		if(op == 3){
			$("#filefld").attr("disabled",true);$("#filefld").val("");
			$("#record").attr("disabled",true);
			$("#lang1").attr("disabled",false);
			$("#lang2").attr("disabled",false);
			$("#txtToVoice").attr("disabled",false);
			$("#generatedVoice").html("");
			$("#txtToVoice").val("");
			$("#recordedFile").val("");
			$("#container").html("");
			$("#mic").show();
			$("#record").hide();
			$("#stop").hide();
			$("#delete").hide();
			$("#preview").attr("src","");
			$("#previewHolder1").hide();
		}
	}
	</script>
	
	<!--------- Voice recording ----->
	
	<script>
        // PostBlob method uses XHR2 and FormData to submit 
        // recorded blob to the PHP server
        function PostBlob(blob, fileType, fileName) {
            // FormData
            var formData = new FormData();
            formData.append(fileType + '-filename', fileName);
            formData.append(fileType + '-blob', blob);
			container.innerHTML = '';
            // progress-bar
            var hr = document.createElement('hr');
            container.appendChild(hr);
            var strong = document.createElement('strong');
            strong.id = 'percentage';
            strong.innerHTML = fileType + ' upload progress : ';
            container.appendChild(strong);
            var progress = document.createElement('progress');
            container.appendChild(progress);

            // POST the Blob using XHR2
            xhr('<?php echo site_url('content/saverec');?>', formData, progress, percentage, function(fileURL) {
                container.appendChild(document.createElement('hr'));
                var mediaElement = document.createElement(fileType);

                var source = document.createElement('source');
                var href = location.href.substr(0, location.href.lastIndexOf('/') + 1);
                source.src = fileURL;
				document.getElementById('recordedFile').value = fileURL;
                if (fileType == 'video') source.type = 'video/webm; codecs="vp8, vorbis"';
                if (fileType == 'audio') source.type = !!navigator.mozGetUserMedia ? 'audio/ogg' : 'audio/wav';
				
				mediaElement.appendChild(source);

                mediaElement.controls = true;
                container.appendChild(mediaElement);
                mediaElement.play();

                progress.parentNode.removeChild(progress);
                strong.parentNode.removeChild(strong);
                hr.parentNode.removeChild(hr);
            });
        }

        var record = document.getElementById('record');
        var stop = document.getElementById('stop');
        var deleteFiles = document.getElementById('delete');

        var audio = document.querySelector('audio');

        var recordVideo = document.getElementById('record-video');
        var preview = document.getElementById('preview');

        var container = document.getElementById('container');

        // if you want to record only audio on chrome
        // then simply set "isFirefox=true"
		// else use var isFirefox = !!navigator.mozGetUserMedia;
        var isFirefox = !!navigator.mozGetUserMedia;

        var recordAudio, recordVideo;
        record.onclick = function() {
            record.disabled = true;
            navigator.getUserMedia({
                audio: true,
                video: false
            }, function(stream) {
                preview.src = window.URL.createObjectURL(stream);
                preview.play();

                // var legalBufferValues = [256, 512, 1024, 2048, 4096, 8192, 16384];
                // sample-rates in at least the range 22050 to 96000.
                recordAudio = RecordRTC(stream, {
                    //bufferSize: 16384,
                    //sampleRate: 45000,
                    onAudioProcessStarted: function() {
                        if (!isFirefox) {
                            recordVideo.startRecording();
                        }
                    }
                });

                if (isFirefox) {
                    recordAudio.startRecording();
                }

                if (!isFirefox) {
                    recordVideo = RecordRTC(stream, {
                        type: 'video'
                    });
                    recordAudio.startRecording();
                }

                stop.disabled = false;
            }, function(error) {
				alert("<?php echo $nodevicefound;?>");return false;
                /*alert(JSON.stringify(error, null, '\t'));*/
            });
        };

        var fileName;
        stop.onclick = function() {
            record.disabled = false;
            stop.disabled = true;

            preview.src = '';

            fileName = Math.round(Math.random() * 99999999) + 99999999;

            if (!isFirefox) {
                recordAudio.stopRecording(function() {
                    PostBlob(recordAudio.getBlob(), 'audio', fileName + '.wav');
                });
            } /*else {
                recordAudio.stopRecording(function(url) {
                    preview.src = url;
                    PostBlob(recordAudio.getBlob(), 'video', fileName + '.webm');
                });
            }

            if (!isFirefox) {
                recordVideo.stopRecording(function() {
                    PostBlob(recordVideo.getBlob(), 'video', fileName + '.webm');
                });
            }*/

            deleteFiles.disabled = false;
        };

        deleteFiles.onclick = function() {
            deleteAudioVideoFiles();
        };

        function deleteAudioVideoFiles() {
            deleteFiles.disabled = true;
            if (!fileName) return;
            var formData = new FormData();
			var fnm = document.getElementById('recordedFile').value;
            formData.append('delete-file', fnm);
            xhr('<?php echo site_url('content/deleterec');?>', formData, null, null, function(response) {
                console.log(response);
            });
            fileName = null;
            container.innerHTML = '';
        }

        function xhr(url, data, progress, percentage, callback) {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    callback(request.responseText);
                }
            };

            if (url.indexOf('delete.php') == -1) {
                request.upload.onloadstart = function() {
                    percentage.innerHTML = 'Upload started...';
                };

                request.upload.onprogress = function(event) {
                    progress.max = event.total;
                    progress.value = event.loaded;
                    percentage.innerHTML = '<?php echo $uploadprogress;?> ' + Math.round(event.loaded / event.total * 100) + "%";
                };

                request.upload.onload = function() {
                    percentage.innerHTML = 'Saved!';
                };
            }

            request.open('POST', url);
            request.send(data);
        }

        window.onbeforeunload = function() {
            if (!!fileName) {
                deleteAudioVideoFiles();
                //return 'It seems that you\'ve not deleted audio/video files from the server.';
            }
        };
        </script>
</html>