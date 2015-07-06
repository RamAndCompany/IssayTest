<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH."controllers/PHP_Text2Speech.class.php";

class Content extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
        if (!$this->session->userdata('user_id')){ 
            redirect('/indexpage/index/', 'refresh');
        }
		if (!$this->session->userdata('site_lang')){ 
           $this->lang->load("japanese","japanese");
		}
		else{
			$lang = $this->session->userdata('site_lang');
			$this->lang->load($lang,$lang);
		}
		
    }
	
	public function index(){
		$data['url'] 			= current_url();
		$data['title'] 			= $this->lang->line("proj_title");
		$data['content_title'] 	= $this->lang->line("content_title");
		$data['sms'] 			= $this->lang->line("sms");
		$data['calls'] 			= $this->lang->line("calls");
		/*Menu*/
		$data['dash_title'] 	= $this->lang->line("dash_title");
		$data['sms'] 			= $this->lang->line("sms");
		$data['calls'] 			= $this->lang->line("calls");
		$data['callschedule_title'] 	= $this->lang->line("callschedule_title");
		$data['call_history'] 			= $this->lang->line("call_history");
		$data['send_sms'] 				= $this->lang->line("send_sms");
		$data['sms_history'] 			= $this->lang->line("sms_history");
		$data['master_content'] 		= $this->lang->line("master_content");
		$data['voice_label'] 			= $this->lang->line("voice_label");
		$data['sms_text'] 				= $this->lang->line("sms_text");
		$data['member_manage'] 			= $this->lang->line("member_manage");
		$data['user_management'] 		= $this->lang->line("user_management");
		$data['edit_profile'] 			= $this->lang->line("edit_profile");
		$data['logout'] 				= $this->lang->line("logout");
		$data['group_menu'] 			= $this->lang->line("category");
		$data['membergroup_menu'] 		= $this->lang->line("member_groups");
		$data['changepwd_menu'] 		= $this->lang->line("change_pwd");
		$data['back_btn'] 				= $this->lang->line("back_btn");
		$data["page"]	= "content";
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		
		$this->load->model('Content_model');
		$this->load->view('includes/inner_header.php', $data);
		$this->load->view('content.php');
	}
	
	public function content_home(){
		$data['url'] 			= current_url();
		$data['title'] 			= $this->lang->line("proj_title");
		$data['content_title'] 	= $this->lang->line("content_title");
		$data['contentlist_title'] 	= $this->lang->line("content_title");
		$data['sms'] 			= $this->lang->line("sms");
		$data['calls'] 			= $this->lang->line("calls");
		$data['title_label'] 	= $this->lang->line("title_label");
		$data['filenm_label'] 	= $this->lang->line("filenm_label");
		$data['voicechk_label'] = $this->lang->line("voicechk_label");
		$data['istested_label'] = $this->lang->line("istested_label");
		
		$data['uploadfl_label'] = $this->lang->line("uploadfl_label");
		$data['selectfl_label'] = $this->lang->line("selectfl_label");
		$data['recvoice_label'] = $this->lang->line("recvoice_label");
		$data['txtvoicel_label']= $this->lang->line("txtvoicel_label");
		$data['text_label'] 	= $this->lang->line("text_label");
		$data['chkalert'] 		= $this->lang->line("chkalert");
		
		$data['edit_sms_title'] 	= $this->lang->line("edit_sms_title");
		$data['addnew_sms_title'] 	= $this->lang->line("addnew_sms_title");
		$data['edit_voice_title'] 	= $this->lang->line("edit_voice_title");
		$data['addnew_voice_title'] = $this->lang->line("addnew_voice_title");
		
		$data['addnew_btn'] 	= $this->lang->line("addnew_btn");
		$data['edit_btn'] 		= $this->lang->line("edit_btn");
		$data['update_btn'] 	= $this->lang->line("update_btn");
		$data['delete_btn'] 	= $this->lang->line("delete_btn");
		$data['uploadmem_btn'] 	= $this->lang->line("uploadmem_btn");
		
		/*Menu*/
		$data['dash_title'] 	= $this->lang->line("dash_title");
		$data['sms'] 			= $this->lang->line("sms");
		$data['calls'] 			= $this->lang->line("calls");
		$data['callschedule_title'] 	= $this->lang->line("callschedule_title");
		$data['call_history'] 			= $this->lang->line("call_history");
		$data['send_sms'] 				= $this->lang->line("send_sms");
		$data['sms_history'] 			= $this->lang->line("sms_history");
		$data['master_content'] 		= $this->lang->line("master_content");
		$data['voice_label'] 			= $this->lang->line("voice_label");
		$data['sms_text'] 				= $this->lang->line("sms_text");
		$data['member_manage'] 			= $this->lang->line("member_manage");
		$data['user_management'] 		= $this->lang->line("user_management");
		$data['edit_profile'] 			= $this->lang->line("edit_profile");
		$data['logout'] 				= $this->lang->line("logout");
		$data['group_menu'] 			= $this->lang->line("category");
		$data['membergroup_menu'] 		= $this->lang->line("member_groups");
		$data['changepwd_menu'] 		= $this->lang->line("change_pwd");
		$data['back_btn'] 				= $this->lang->line("back_btn");
		$data['mandatory_field'] 		= $this->lang->line("mandatory_field");
		
		$data['invalidvoice'] 			= $this->lang->line("invalidvoice");
		$data['uploadprogress'] 		= $this->lang->line("uploadprogress");
		$data['nodevicefound'] 			= $this->lang->line("nodevicefound");
		
		$data['delete_btn'] 			= $this->lang->line("delete_btn");
		$data['record_label'] 			= $this->lang->line("record_label");
		$data['stoplay_label'] 			= $this->lang->line("stoplay_label");
		$data['selectlang_label'] 		= $this->lang->line("selectlang_label");
		$data['generatevoice'] 			= $this->lang->line("generatevoice");
		$data['save_btn'] 				= $this->lang->line("save_btn");
		$data['cnfmalert'] 				= $this->lang->line("cnfmalert");
		$data['chkonealert'] 			= $this->lang->line("chkonealert");
		$data['recvoice_label'] 		= $this->lang->line("recvoice_label");
		$data['maxfilesize'] 			= $this->lang->line("maxfilesize");
		$data['maxcharsize'] 			= $this->lang->line("maxcharsize");
		$data['maxfilesize_alert'] 		= $this->lang->line("maxfilesize_alert");
		$data['maxcharsize_alert'] 		= $this->lang->line("maxcharsize_alert");
		$data['radioalert'] 			= $this->lang->line("radioalert");
		$data['datasaved'] 				= $this->lang->line("datasaved");
		$data['dataupdated'] 			= $this->lang->line("dataupdated");
		$data['datadeleted'] 			= $this->lang->line("datadeleted");
		$data['enteredcharsize'] 		= $this->lang->line("enteredcharsize");
		$data["page"]					= "content";
		
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		
		$this->load->model('Content_model');
		
		if(isset($_GET['type'])){$type = $_GET['type'];}
		else{$type = '';}
		
		$data['url'] = current_url().'?type='.$type;
		
		$content = $this->Content_model->getAllContents($type);
		$data['contents'] = $content;
		
		$this->load->view('includes/header.php', $data);
		$this->load->view('list_content.php');
	}
	
	public function saveVoice(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		
		$title = $_POST['txtTitle'];
		$type = $_POST['type'];
		$voicetype = $_POST['voicetype'];
		$this->load->model('Content_model');
		$tfnm = '';
		if($voicetype == '1'){
			if(isset($_FILES['filefld']['name']) && $_FILES['filefld']['name'] != ""){
					$fname = $_FILES['filefld']['name'];
					$tpath = $_FILES['filefld']['tmp_name'];
					$ext = explode(".", $fname);
					$ext = $ext[count($ext)-1];
					$file = "voice_".rand(1111,9999).".".$ext;
					$path = APPPATH.'views/voice/'.$file;
					move_uploaded_file($tpath, $path);
					$data1 = array("title"=>$title, "filename"=>$file, "category"=>$type, "uid"=>$uid);
					$rid = $this->Content_model->saveVoice($data1);
				
			}else{$file = '';}
			
			$tfnm = $file;
		}
		
		if($voicetype == '2'){
			if(isset($_POST['txtToVoice'])){$text = $_POST['txtToVoice'];}
			else{$text = '';}
			if(isset($_POST['recordedFile']) && $_POST['recordedFile'] != ""){
				$rfl = trim($_POST['recordedFile']);
				$rfnm = explode("/",$rfl);
				$rfnm = $rfnm[count($rfnm)-1];
				copy('/var/www/greenorchidprojects.com/public_html/issay/application/views/voice/records/'.$rfnm, '/var/www/greenorchidprojects.com/public_html/issay/application/views/voice/'.$rfnm);
				$data1 = array("title"=>$title, "filename"=>$rfnm, "category"=>$type, "uid"=>$uid);
				$rid = $this->Content_model->saveVoice($data1);
				$tfnm = $rfnm;
			}
		}
		
		if($voicetype == '3'){
			$text = $_POST['txtToVoice'];
			$rcFile = $_POST['generatedFile'];
			$exp = explode("/", $rcFile);
			$rfile = $exp[3];
			$fnm = date('YmdHis').'.wav';
			rename("/var/www/greenorchidprojects.com/public_html/issay/application/views/voice/".$rfile, "/var/www/greenorchidprojects.com/public_html/issay/application/views/voice/".$fnm);
			$data1 = array("title"=>$title, "filename"=>$fnm, "category"=>$type, "uid"=>$uid);
			$rid = $this->Content_model->saveVoice($data1);
			$tfnm = $fnm;
		}
		
		if($tfnm != ""){
			copy('/var/www/greenorchidprojects.com/public_html/issay/application/views/voice/'.$tfnm, '/var/lib/asterisk/sounds/uploadedFiles/'.$tfnm);
		
		/*CREATE GSM FILES*/
			$gsmURL = "http://119.18.52.168/asterisk/convert.php?filename=".$tfnm;
			$gch = curl_init();  
            curl_setopt($gch, CURLOPT_URL, $gsmURL);  
            curl_setopt($gch, CURLOPT_AUTOREFERER, true);  
            curl_setopt($gch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");  
            curl_setopt($gch, CURLOPT_HEADER, 0);  
            curl_setopt($gch, CURLOPT_RETURNTRANSFER, true);  
            curl_setopt($gch, CURLOPT_TIMEOUT, 10);  
            $output = curl_exec($gch);  
            curl_close($gch);  
		/*GSM ENDS*/
		}
		redirect('/content/content_home?type=calls', 'refresh');
	}
	
	public function saveSMS(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		
		$title = $_POST['txtTitle'];
		$content = $_POST['txtContent'];
		$this->load->model('Content_model');
		$data = array("title"=>$title,"content"=>$content, "category"=>'sms', "uid"=>$uid);
		$rid = $this->Content_model->saveSMS($data);
		redirect('/content/content_home?type=sms', 'refresh');
	}
	
	public function uploadMembers(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Content_model');
		/*************File Upload *************/
		if(isset($_FILES['filefld']['name'])){
			if($_FILES['filefld']['name'] != ""){
			$fname = $_FILES['filefld']['name'];
			
			$tpath = $_FILES['filefld']['tmp_name'];
			$ext = explode(".", $fname);
			$ext = $ext[count($ext)-1];
			$file = "file_".rand(1111,9999).".".$ext;
			$path = APPPATH.'views/files/'.$file;
			move_uploaded_file($tpath, $path);
			
			$csv_file = APPPATH.'views/files/'.$file;
			$filename = $csv_file;
			if(!file_exists($filename) || !is_readable($filename))
				return FALSE;
			$delimiter=',';
			$header = NULL;
			$data2 = array();
			if (($handle = fopen($filename, 'r')) !== FALSE)
			{
				$i=1;
				while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
				{
					if(!empty($row)){
						
							if(empty($row[0])){
								$data['message'] = "Name field is missing in uploaded file!!!";
								$data['alertclass'] = "alert-error";
							}
							else if(empty($row[1])){
								$data['message'] = "Mobile no. field is missing in uploaded file!!!";
								$data['alertclass'] = "alert-error";
							}
							else if(empty($row[2])){
								$data['message'] = "Email field is missing in uploaded file!!!";
								$data['alertclass'] = "alert-error";
							}
							else{
								$uname = $row[0];
								$mobno = $row[1];
								$email = $row[2];
								$data2 = array("member_name"=>$uname, "phone_no"=>$mobno, "email"=>$email);
								$this->Content_model->saveMembers($data2);
							}
						
					}
				$i++;
				}
				fclose($handle);
			}
			
			
		}
		}
		redirect('/member/index', 'refresh');
	}
	
	public function saveMember(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Content_model');
		$uname = $_POST['txtNm'];
		$mobno = $_POST['txtPh'];
		$email = $_POST['txtEml'];
		$data2 = array("member_name"=>$uname, "phone_no"=>$mobno, "email"=>$email, "uid"=>$udata['user_id']);
		$this->Content_model->saveMembers($data2);
		redirect('/member/index', 'refresh');
	}
	public function getSMS(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Content_model');
		$cid = $_POST['cid'];
		$sms = $this->Content_model->getSMS($cid);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($sms);
	}
	public function getMember(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Content_model');
		$mid = $_POST['mid'];
		$member = $this->Content_model->getMember($mid);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($member);
	}
	
	public function updateContent(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Content_model');
		$cid = $_POST['cid'];
		$title = $_POST['txtTitleEdt'];
		$content = $_POST['txtContentEdt'];
		$data2 = array("title"=>$title, "content"=>$content);
		$this->Content_model->updateContent($data2,$cid);
		redirect('/content/content_home?type=sms', 'refresh');
	}
	
	public function deleteContent(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Content_model');
		$cid = $_POST['cid'];
		$res = $this->Content_model->deleteContent($cid);
		if($res == true)echo true;
		else echo false;
	}
	
	public function saverec(){
		foreach(array('audio') as $type) {
			if (isset($_FILES["${type}-blob"])) {
			
				 
				echo base_url().'application/views/voice/records/';
				$fileName = $_POST["${type}-filename"];
				$uploadDirectory = 'application/views/voice/records/'.$fileName;
				
				if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
					echo(" problem moving uploaded file");
				}
				
				echo($fileName);
			}
		}
	}
	
	public function deleterec(){
		if (isset($_POST['delete-file'])) {
			$fileName = 'application/views/voice/records/'.$_POST['delete-file'];
			if(!unlink($fileName)) {
				echo(' problem deleting files.');
			}
			else {
				echo(' both wav/webm files deleted successfully.');
			}
		}
	}
	
}

