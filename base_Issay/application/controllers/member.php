<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH."controllers/PHP_Text2Speech.class.php";

class Member extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
		$this->load->library('Classes/PHPExcel');
		
        if (!$this->session->userdata('site_lang')){ 
           $this->lang->load("japanese","japanese");
		}
		else{
			$lang = $this->session->userdata('site_lang');
			$this->lang->load($lang,$lang);
		}
		
		$udata = $this->session->all_userdata();
		if(!isset($udata['user_id'])){redirect('/indexpage/index/', 'refresh');}
    }
	
	public function index(){
		$data['url'] = current_url();
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		
		$data['member_title'] 		= $this->lang->line("member_title");
		$data['name_label'] 		= $this->lang->line("name_label");
		$data['phone_label'] 		= $this->lang->line("phone_label");
		$data['email_label'] 		= $this->lang->line("email_label");
		$data['country_label'] 		= $this->lang->line("country_label");
		$data['edit_mem_title'] 	= $this->lang->line("edit_mem_title");
		$data['addnew_mem_title'] 	= $this->lang->line("addnew_mem_title");
		
		$data['selectfl_label'] 	= $this->lang->line("selectfl_label");
		$data['uploadfl_label'] 	= $this->lang->line("uploadfl_label");
		$data['filetypesmsg'] 		= $this->lang->line("filetypesmsg");
		
		$data['addnew_btn'] 	= $this->lang->line("addnew_btn");
		$data['edit_btn'] 		= $this->lang->line("edit_btn");
		$data['delete_btn'] 	= $this->lang->line("delete_btn");
		$data['update_btn'] 	= $this->lang->line("update_btn");
		$data['save_btn'] 		= $this->lang->line("save_btn");
		$data['uploadmem_btn'] 	= $this->lang->line("uploadmem_btn");
		$data['chkalert'] 			= $this->lang->line("chkalert");
		$data['memberlist_title'] 	= $this->lang->line("member");
		
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
		
		$data['chkonealert'] 			= $this->lang->line("chkonealert");
		$data['invalidfile'] 			= $this->lang->line("invalidfile");
		$data['mandatory_field'] 		= $this->lang->line("mandatory_field");
		
		$data["mandatory_name"]	= $this->lang->line("mandatory_name");
		$data["mandatory_phone"]= $this->lang->line("mandatory_phone");
		$data["invalid_phone"]	= $this->lang->line("invalid_phone");
		$data["mandatory_email"]= $this->lang->line("mandatory_email");
		$data["invalid_email"]	= $this->lang->line("invalid_email");
		$data["invalid_name"]	= $this->lang->line("invalid_name");
		$data["alreadyexst"]	= $this->lang->line("alreadyexst");
		
		$data["datasaved"]	 = $this->lang->line("datasaved");
		$data["dataupdated"] = $this->lang->line("dataupdated");
		$data["category"] = $this->lang->line("category");
		$data["datadeleted"] = $this->lang->line("datadeleted");
		$data["cnfmalert"] 	 = $this->lang->line("cnfmalert");
		$data["page"]	= "member";
		$data["filecontentsmsg"] = $this->lang->line("filecontentsmsg");
		$data["mandatory"] = $this->lang->line("mandatory");
		$data["uploadmem_btn"] = $this->lang->line("uploadmem_btn");
		$data['maxfilesize'] 			= $this->lang->line("maxfilesize");
		$data['maxcharsize'] 			= $this->lang->line("maxcharsize");
		$data['maxfilesize_alert'] 		= $this->lang->line("maxfilesize_alert");
		$data['maxcharsize_alert'] 		= $this->lang->line("maxcharsize_alert");
		$this->load->model('Member_model');
		
		$users = $this->Member_model->getAllMembers($uid);
		$data['users'] = $users;
		
		$mgroups = $this->Member_model->getAllCategories($uid);
		$data['mgroups'] = $mgroups;
				
		$this->load->view('includes/header.php', $data);
		$this->load->view('member.php');
	}
	
	public function uploadMembers(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Member_model');
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
			$filepath  = APPPATH.'views/files/'.$file;
			$filterArr = array(); 
			$message = '';
			/********* CSV FILE UPLOAD **********/
			if($ext == 'csv'){
				$filename = $filepath;
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
								$regex = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 
								if(trim($row[0]) == ""){
									$message = "Name field is missing in uploaded file!!!";
								}
								else if($row[1] == ""){
									$message = "Phone no. field is missing in uploaded file!!!";
								}
								else if(strlen($row[1])<8){
									$message = "phone number must be greater than 8!!!";
								} 
								else if(strlen($row[1])>15){
									$message = "phone number must be less than 12!!!";
								}
								else if(!preg_match("/^[0-9\ ]+$/", $row[1])) {
									 $message = "Invalid phone number!!!";
								}
								/*else if(empty($row[2])){
									$message = "Email field is missing in uploaded file!!!";
								}
								else if (!preg_match($regex, $row[2])) {
									 $message = "Invalid email format";
								}*/
								else{
									$uname = $row[0];
									$mobno = $row[1];
									$email = $row[2];
									$code  = '81';
									$data2 = array("member_name"=>$uname, "phone_no"=>$mobno, "email"=>$email, "uid"=>$uid, "country_code"=>$code);
									$check = $this->Member_model->checkPhoneno($uid, $mobno);
									if($check == false){
										$mid = $this->Member_model->saveMembers($data2);
										if($_POST['category'] != ''){
											$cid = $_POST['category'];
											$data3 = array("category_id"=>$cid, "member_id"=>$mid);
											$res = $this->Member_model->savemembergroup($data3);
										}
									}
								}
								
							
						}
					$i++;
					}
					fclose($handle);
				}
			}
			
			/********xls FILES**********/
			if($ext == 'xls'){
				$inputFileName = $filepath;
				try {
					$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				} 
				catch (Exception $e) {
					die("Error loading file: ".$e->getMessage()."<br />\n");
				}
						//All data from excel
						$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
						if(!empty($sheetData)){
							foreach($sheetData as $sdata){
								$uname = trim($sdata["A"]);
								$mobno= trim($sdata["B"]);
								$email= trim($sdata["C"]);
								
								$regex = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 
								if(trim($uname) == ""){
									$message = "Name field is missing in uploaded file!!!";
								}
								else if($mobno == ""){
									$message = "Phone no. field is missing in uploaded file!!!";
								}
								else if(strlen($mobno)<8){
									$message = "phone number must be greater than 8!!!";
								} 
								else if(strlen($mobno)>15){
									$message = "phone number must be less than 12!!!";
								}
								else if(!preg_match("/^[0-9\ ]+$/", $mobno)) {
									 $message = "Invalid phone number!!!";
								}
								/*else if(empty($row[2])){
									$message = "Email field is missing in uploaded file!!!";
								}
								else if (!preg_match($regex, $row[2])) {
									 $message = "Invalid email format";
								}*/
								else{
									$code = '81';
									$data4 = array("member_name"=>$uname, "phone_no"=>$mobno, "email"=>$email, "uid"=>$uid, "country_code"=>$code);
									$check = $this->Member_model->checkPhoneno($uid, $mobno);
									if($check == false){
										$mid = $this->Member_model->saveMembers($data4);
										if($_POST['category'] != ''){
											$cid = $_POST['category'];
											$data5 = array("category_id"=>$cid, "member_id"=>$mid);
											$res = $this->Member_model->savemembergroup($data5);
										}
									}
								}
							}
						}
			}
			/**Xls ends**/
			
			/********xlsx FILES**********/
			if($ext == 'xlsx'){
				$inputFileName = $filepath;
				//  Read your Excel workbook
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
				} catch (Exception $e) {
					die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
					. '": ' . $e->getMessage());
				}

				//  Get worksheet dimensions
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();

				//  Loop through each row of the worksheet in turn
				for ($row = 1; $row <= $highestRow; $row++) {
					//  Read a row of data into an array
					$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
					NULL, TRUE, FALSE);
					foreach($rowData as $rdata){
						if($rdata[0] != NULL){$uname = $rdata[0];}else{$uname="";}
						if($rdata[1] != NULL){$mobno = $rdata[1];}else{$mobno="";}
						if($rdata[2] != NULL){$email = $rdata[2];}else{$email="";}
								
								$regex = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 
								if(trim($uname) == ""){
									$message = "Name field is missing in uploaded file!!!";
								}
								else if($mobno == ""){
									$message = "Phone no. field is missing in uploaded file!!!";
								}
								else if(strlen($mobno)<8){
									$message = "phone number must be greater than 8!!!";
								} 
								else if(strlen($mobno)>15){
									$message = "phone number must be less than 12!!!";
								}
								else if(!preg_match("/^[0-9\ ]+$/", $mobno)) {
									 $message = "Invalid phone number!!!";
								}
								/*else if(empty($row[2])){
									$message = "Email field is missing in uploaded file!!!";
								}
								else if (!preg_match($regex, $row[2])) {
									 $message = "Invalid email format";
								}*/
								else{
									$code = '81';
									$data4 = array("member_name"=>$uname, "phone_no"=>$mobno, "email"=>$email, "uid"=>$uid, "country_code"=>$code);
									$check = $this->Member_model->checkPhoneno($uid, $mobno);
									if($check == false){
										$mid = $this->Member_model->saveMembers($data4);
										if($_POST['category'] != ''){
											$cid = $_POST['category'];
											$data5 = array("category_id"=>$cid, "member_id"=>$mid);
											$res = $this->Member_model->savemembergroup($data5);
										}
									}
								}
					}
				}
			}
			/**Xlsx ends**/
		}
		}
		redirect('/member/index', 'refresh');
	}
	
	public function saveMember(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Member_model');
		$uname = $_POST['txtNm'];
		$code  = $_POST['code'];
		$mobno = $_POST['txtPh'];
		$email = $_POST['txtEml'];
		$data2 = array("member_name"=>$uname, "phone_no"=>$mobno, "email"=>$email, "uid"=>$udata['user_id'], "country_code"=>$code);
		$this->Member_model->saveMembers($data2);
		redirect('/member/index', 'refresh');
	}
	
	public function getMember(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Member_model');
		$mid = $_POST['mid'];
		$member = $this->Member_model->getMember($mid);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($member);
	}
	
	public function checkPhoneno(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Member_model');
		$phone = $_POST['phone'];
		if(isset($_POST['mid'])){$mid = $_POST['mid'];}
		else{$mid = '';}
		$member = $this->Member_model->checkPhoneno($uid, $phone, $mid);
		if(!empty($member)){echo true;}
		else{echo false;}
	}
	
	public function updateMember(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Member_model');
		$mid = $_POST['mid'];
		$uname = $_POST['txtNmEdt'];
		if(isset($_POST['codeEdt'])){$code  = $_POST['codeEdt']; }else{$code = '';}
		$mobno = $_POST['txtPhEdt'];
		$email = $_POST['txtEmlEdt'];
		$data2 = array("member_name"=>$uname, "phone_no"=>$mobno, "email"=>$email, "uid"=>$udata['user_id'], "country_code"=>$code);
		$this->Member_model->updateMember($data2,$mid);
		redirect('/member/index', 'refresh');
	}
	
	public function deleteMember(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Member_model');
		$mid = $_POST['mid'];
		$res = $this->Member_model->deleteMember($mid);
		if($res == true){
			$this->Member_model->deleteMemberFromSchedule($mid);
			$this->Member_model->deleteMemberFromGroup($mid);
			echo true;
		}
		else echo false;
	}
	
	public function category(){
		$data['url'] = current_url();
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		
		$data['member_title'] 		= $this->lang->line("member_title");
		$data['name_label'] 		= $this->lang->line("name_label");
		$data['phone_label'] 		= $this->lang->line("phone_label");
		$data['email_label'] 		= $this->lang->line("email_label");
		$data['country_label'] 	= $this->lang->line("country_label");
		$data['edit_mem_title'] 	= $this->lang->line("edit_mem_title");
		$data['addnew_mem_title'] 	= $this->lang->line("addnew_mem_title");
		
		$data['category_label'] 	= $this->lang->line("category");
		$data['category_add'] 	= $this->lang->line("category_add");
		
		$data['addnew_btn'] 	= $this->lang->line("addnew_btn");
		$data['edit_btn'] 		= $this->lang->line("edit_btn");
		$data['delete_btn'] 	= $this->lang->line("delete_btn");
		$data['uploadmem_btn'] 	= $this->lang->line("uploadmem_btn");
		$data['chkalert'] 	= $this->lang->line("chkalert");
		$data['memberlist_title'] 	= $this->lang->line("member");
		
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
		$data["datasaved"]	 = $this->lang->line("datasaved");
		$data["dataupdated"] = $this->lang->line("dataupdated");
		$data["datadeleted"] = $this->lang->line("datadeleted");
		$data["cnfmalert"] 	 = $this->lang->line("cnfmalert");
		
		$data["alreadyexst"] = $this->lang->line("alreadyexst");
		$data["mandatory_name"]	= $this->lang->line("mandatory_name");
		$data['chkonealert'] 	= $this->lang->line("chkonealert");
		
		$data['addnew_btn'] 	= $this->lang->line("addnew_btn");
		$data['edit_btn'] 		= $this->lang->line("edit_btn");
		$data['delete_btn'] 	= $this->lang->line("delete_btn");
		$data['update_btn'] 	= $this->lang->line("update_btn");
		$data['save_btn'] 		= $this->lang->line("save_btn");
		$data['nodata'] 		= $this->lang->line("nodata");
		$data['addtogroup_btn'] 		= $this->lang->line("addtogroup_btn");
		$data['remfromgroup_btn'] 		= $this->lang->line("remfromgroup_btn");
		$data['step_select_mem'] 		= $this->lang->line("step_select_mem");
		$data['added_members'] 			= $this->lang->line("added_members");
		$data['chkalertgm'] 			= $this->lang->line("chkalertgm");
		$data['chkalertam'] 			= $this->lang->line("chkalertam");
		$data["page"]	= "category";
		$this->load->model('Member_model');
		
		$categories = $this->Member_model->getAllCategories($uid);
		$data['categories'] = $categories;
		
		$allusers = $this->Member_model->getAllMembers($uid);
		$data['allusers'] = $allusers;
		
		$this->load->view('includes/header.php', $data);
		$this->load->view('category.php');
	}
	
	public function saveCategory(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Member_model');
		$cnm = $_POST['category'];
		
		$data2 = array("category_name"=>$cnm, "uid"=>$udata['user_id']);
		$gid = $this->Member_model->saveCategory($data2);
		if(!empty($gid)){
			if(!empty($_POST['member'])){
				foreach($_POST['member'] as $mid){
					$data2 = array("category_id"=>$gid, "member_id"=>$mid);
					$res = $this->Member_model->savemembergroup($data2);
				}
			}
		}
		redirect('/member/category', 'refresh');
	}
	
	public function deleteCategory(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Member_model');
		$cid = $_POST['mid'];
		$res = $this->Member_model->deleteCategory($cid);
		if($res == true){
			$this->Member_model->deleteMemberCategory($cid);
			$this->Member_model->deleteScheduleMemberCategory($cid);
			$this->Member_model->deleteScheduleMember($cid);
			echo true;
		}
		else echo false;
	}
	
	public function getCategory(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Member_model');
		$cid = $_POST['mid'];
		$member = $this->Member_model->getCategory($cid);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($member);
	}
	
	public function updateCategory(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Member_model');
		$cnm = $_POST['category'];
		$cid = $_POST['gid'];
		$data2 = array("category_name"=>$cnm, "uid"=>$udata['user_id']);
		$res = $this->Member_model->updateCategory($data2, $cid);
		if($res == true){
			$this->Member_model->deleteGroupMembers($cid);
			if(!empty($_POST['member'])){
				foreach($_POST['member'] as $mid){
					$data2 = array("category_id"=>$cid, "member_id"=>$mid);
					$res = $this->Member_model->savemembergroup($data2);
				}
			}
		}
		redirect('/member/member_category?category='.$cid, 'refresh');
	}
	
	public function member_category(){
		$data['url'] = current_url();
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		
		$data['member_groups'] 		= $this->lang->line("member_groups");
		$data['name_label'] 		= $this->lang->line("name_label");
		$data['phone_label'] 		= $this->lang->line("phone_label");
		$data['email_label'] 		= $this->lang->line("email_label");
		$data['country_label'] 		= $this->lang->line("country_label");
		$data['edit_mem_title'] 	= $this->lang->line("edit_mem_title");
		$data['addnew_mem_title'] 	= $this->lang->line("addnew_mem_title");
		
		$data['category_label'] 	= $this->lang->line("category");
		$data['category_add'] 		= $this->lang->line("category_add");
		
		$data['addnew_btn'] 		= $this->lang->line("addnew_btn");
		$data['addtogroup_btn'] 	= $this->lang->line("addtogroup_btn");
		$data['remfromgroup_btn'] 	= $this->lang->line("remfromgroup_btn");
		$data['edit_btn'] 			= $this->lang->line("edit_btn");
		$data['delete_btn'] 		= $this->lang->line("delete_btn");
		$data['uploadmem_btn'] 		= $this->lang->line("uploadmem_btn");
		$data['chkalert'] 			= $this->lang->line("chkalert");
		$data['memberlist_title'] 	= $this->lang->line("member");
		
		/*Menu*/
		$data['dash_title'] 		= $this->lang->line("dash_title");
		$data['sms'] 				= $this->lang->line("sms");
		$data['calls'] 				= $this->lang->line("calls");
		$data['callschedule_title'] = $this->lang->line("callschedule_title");
		$data['call_history'] 		= $this->lang->line("call_history");
		$data['send_sms'] 			= $this->lang->line("send_sms");
		$data['sms_history'] 		= $this->lang->line("sms_history");
		$data['master_content'] 	= $this->lang->line("master_content");
		$data['voice_label'] 		= $this->lang->line("voice_label");
		$data['sms_text'] 			= $this->lang->line("sms_text");
		$data['member_manage'] 		= $this->lang->line("member_manage");
		$data['user_management'] 	= $this->lang->line("user_management");
		$data['edit_profile'] 		= $this->lang->line("edit_profile");
		$data['logout'] 			= $this->lang->line("logout");
		
		$data['group_menu'] 			= $this->lang->line("category");
		$data['membergroup_menu'] 		= $this->lang->line("member_groups");
		$data['changepwd_menu'] 		= $this->lang->line("change_pwd");
		$data['back_btn'] 				= $this->lang->line("back_btn");
		
		$data['step_select_mem'] 		= $this->lang->line("step_select_mem");
		$data['added_members'] 			= $this->lang->line("added_members");
		$data['chkalertgm'] 			= $this->lang->line("chkalertgm");
		$data['chkalertam'] 			= $this->lang->line("chkalertam");
		$data['group'] 					= $this->lang->line("group");
		$data['alreadyexst'] 			= $this->lang->line("alreadyexst");
		$data['update_btn'] 			= $this->lang->line("update_btn");
		$data['mandatory_name'] 		= $this->lang->line("mandatory_name");
		$data['datasaved'] 				= $this->lang->line("datasaved");
		$data["page"]					= "category";
		
		$this->load->model('Member_model');
		
		if(isset($_REQUEST['category'])){
			$cid = $_REQUEST['category'];
			
			$categories = $this->Member_model->getCategory($cid);
			$data['categories'] = $categories;
			
			$allusers = $this->Member_model->getAllMembersNotInGroup($uid, $cid);
			$data['allusers'] = $allusers;
			
			$selusers = $this->Member_model->getAllGroupMembers($cid);
			$data['selusers'] = $selusers;
		}
		$this->load->view('includes/header.php', $data);
		$this->load->view('member_category.php');
	}
	
	public function savemembergroup(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Member_model');
		$cid = $_POST['gid'];
		$mid = $_POST['mid'];
		$data2 = array("category_id"=>$cid, "member_id"=>$mid);
		/*$this->Member_model->deletemembergroup($cid, $mid);*/
		$res = $this->Member_model->savemembergroup($data2);
		if($res == true)echo true;
		else echo false;
	}
	
	public function deletemembergroup(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->model('Member_model');
		$cid = $_POST['gid'];
		$mid = $_POST['mid'];
		$data2 = array("category_id"=>$cid, "member_id"=>$mid);
		$res = $this->Member_model->deletemembergroup($cid, $mid);
		if($res == true)echo true;
		else echo false;
	}
	
	public function checkMembersGroup(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Member_model');
		$gid = $_POST['gid'];
		$res = $this->Member_model->getAllGroupMembers($gid);
		if(!empty($res)){echo true;}
		else{echo false;}
	}
	
	public function checkGroupExst(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Member_model');
		$gp = $_POST['gp'];
		if(isset($_POST['gid'])){$mid = $_POST['gid'];}
		else{$mid = '';}
		$member = $this->Member_model->checkGroupExst($uid, $gp, $mid);
		if(!empty($member)){echo true;}
		else{echo false;}
	}
}

