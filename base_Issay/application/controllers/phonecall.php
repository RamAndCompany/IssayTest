<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH."controllers/PHP_Text2Speech.class.php";

class Phonecall extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
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
	
	public function history(){
		$data['url'] = current_url();
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		if(isset($udata['user_id'])){
			$uid = $udata['user_id'];
			$this->load->helper('url');
			$this->load->helper('form');
			$data['title'] = $this->lang->line("proj_title");
			
			$data['member_title'] 		= $this->lang->line("calls").' : '.$this->lang->line("history_title");
			$data['log_title'] 			= $this->lang->line("calls").' : '.$this->lang->line("history_title");
			$data['calllog_title'] 		= 'Call Log';
			$data['name_label'] 		= $this->lang->line("name_label");
			$data['phone_label'] 		= $this->lang->line("phone_label");
			$data['email_label'] 		= $this->lang->line("email_label");
			$data['status_label'] 		= $this->lang->line("status_label");
			$data['edit_mem_title'] 	= $this->lang->line("edit_mem_title");
			$data['addnew_mem_title'] 	= $this->lang->line("addnew_mem_title");
			
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
			
			/*Status*/
			$data["status_completed"]  = $this->lang->line("status_completed");
			$data["status_failed"]	   = $this->lang->line("status_failed");
			$data["status_inprogress"] = $this->lang->line("status_inprogress");
			$data["status_congestion"] = $this->lang->line("status_congestion");
			$data["status_noanswer"] = $this->lang->line("status_noanswer");
			$data["status_busy"] = $this->lang->line("status_busy");
			$data['status_pending']		= $this->lang->line("status_pending");
			
			$data["viewdetails_label"] = $this->lang->line("viewdetails_label");
			
			$data['hour'] 				= $this->lang->line("hour");
			$data['minute'] 			= $this->lang->line("minute");
			
			$data['from_date'] 			= $this->lang->line("from_date");
			$data['to_date'] 			= $this->lang->line("to_date");
			$data['from_time'] 			= $this->lang->line("from_time");
			$data['to_time'] 			= $this->lang->line("to_time");
			$data['search_btn'] 			= $this->lang->line("search_btn");
			$data['result'] 			= $this->lang->line("result");
			$data['schedule_dt'] 		= $this->lang->line("schedule_dt");
			$data['group'] 				= $this->lang->line("group");
			$data['call_duration'] 		= $this->lang->line("call_duration");
			
			$data['nodata'] 				= $this->lang->line("nodata");
			
			$data['serial_label']		= $this->lang->line("serial_label");
			$data['cmp_title_label']	= $this->lang->line("cmp_title_label");
			$data['creation_dt']		= $this->lang->line("creation_dt");
			$data['details']			= $this->lang->line("details");
			$data['preview']			= $this->lang->line("preview");
			
			$data['loading']			= $this->lang->line("loading");
			$data['resend_btn']			= $this->lang->line("resend_btn");
			$data['startenddatecheck']	= $this->lang->line("startenddatecheck");
			$data['invalid_date']		= $this->lang->line("invalid_date");
			$data['timealert']			= $this->lang->line("timealert");
			
			$this->load->model('Member_model');
			$this->load->model('Phonecall_model');
			$data["page"]	= "callhistory";
			if(isset($_POST['sdate']) && $_POST['sdate'] !=""){
				  $sdt 	= explode("/", $_POST['sdate']);
				  if($_POST['hr'] == ""){$hr = '00';}else{$hr=$_POST['hr'];}
				  if($_POST['mnt'] == ""){$mnt = '00';}else{$mnt=$_POST['mnt'];}
				  $sdate 	= $sdt[0].'-'.$sdt[1].'-'.$sdt[2].' '.$hr.':'.$mnt.':00';
			}else{$sdate = '';}
			
			if(isset($_POST['edate']) && $_POST['edate'] != ""){
				  $edt 	= explode("/", $_POST['edate']);
				  if($_POST['thr'] == ""){$thr = '23';}else{$thr=$_POST['thr'];}
				  if($_POST['tmnt'] == ""){$tmnt = '59';}else{$tmnt=$_POST['tmnt'];}
				  $edate 	= $edt[0].'-'.$edt[1].'-'.$edt[2].' '.$thr.':'.$tmnt.':00';
			}else{$edate = '';}
			
			if(isset($_POST['phone'])){
				  $phone = $_POST['phone'];
			}else{$phone = '';}
			
			if(isset($_POST['category'])){
				  $group = $_POST['category'];
			}else{$group = '';}
			
			if(isset($_POST['status'])){
				  $status = $_POST['status'];
			}else{$status = '';}
			
			$data1 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate, "phone"=>$phone, "category"=>$group, "status"=>$status);
			$callHistory = $this->Phonecall_model->getCallHistory($data1);
			$data['callHistory'] = $callHistory;
			
			$mgroups = $this->Member_model->getAllCategories($uid);
			$data['mgroups'] = $mgroups;
			
			$this->load->view('includes/header.php', $data);
			$this->load->view('call_history.php');
		}
		else{
			redirect('/indexpage/index/', 'refresh');
		}
	}
	
	public function step1(){
		$data['url'] = current_url();
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		if(isset($udata['user_id'])){
			$uid = $udata['user_id'];
			$this->load->helper('url');
			$this->load->helper('form');
			$data['title'] = $this->lang->line("proj_title");
			$data['callschedule_title'] = $this->lang->line("callschedule_title");
			$data['country_label'] 	= $this->lang->line("country_label");
			$data['name_label'] 		= $this->lang->line("name_label");
			$data['phone_label'] 		= $this->lang->line("phone_label");
			$data['email_label'] 		= $this->lang->line("email_label");
			$data['make_selection'] 	= $this->lang->line("make_selection");
			$data['category'] 			= $this->lang->line("category");
			$data['member'] 			= $this->lang->line("member");
			
			$data["step_select_mem"]	= $this->lang->line("step_select_mem");
			$data["step_select_fl"]		= $this->lang->line("step_select_fl");
			$data["step_select_text"]	= $this->lang->line("step_select_text");
			$data["step_scheduling"]	= $this->lang->line("step_scheduling");
			$data["step_confirmation"]	= $this->lang->line("step_confirmation");
			$data["step_testcall"]		= $this->lang->line("step_testcall");
			$data["step_testsms"]		= $this->lang->line("step_testsms");
			$data["step_finish"]		= $this->lang->line("step_finish");
			/*Menu*/
			$data['dash_title'] 		= $this->lang->line("dash_title");
			$data['sms'] 				= $this->lang->line("sms");
			$data['calls'] 				= $this->lang->line("calls");
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
			$data['continue_btn'] 			= $this->lang->line("continue_btn");
			$data['nodata'] 				= $this->lang->line("nodata");
			$data['chkalert'] 				= $this->lang->line("chkalert");
			$data['nomembersgroup'] 		= $this->lang->line("nomembersgroup");
			$data["page"]	= "callsteps";
			
			$this->load->model('Member_model');
			$this->load->model('Phonecall_model');
			$users = $this->Member_model->getAllMembers($uid);
			$data['musers'] = $users;
			
			$mgroups = $this->Member_model->getAllCategories($uid);
			$data['mgroups'] = $mgroups;
			
			if(isset($_GET['sid']) && $_GET['sid'] != ""){
				$sgroups = $this->Phonecall_model->getScheduledroup($_GET['sid']);
				$data['sgroups'] = $sgroups;
				
				$smembers = $this->Phonecall_model->getAllScheduledMembersOnly($_GET['sid']);
				$data['susers'] = $smembers;
			}
			
			$this->load->view('includes/header.php', $data);
			$this->load->view('phone_step1.php');
		}
		else{
			redirect('/indexpage/index/', 'refresh');
		}
	}
	
	public function step1Action(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		
		$this->load->model('Phonecall_model');
		$this->load->model('Member_model');
		$cdt = date('Y-m-d H:i:s');
		
		if(isset($_POST['sid']) && $_POST['sid'] != ""){
			$sid = $_POST['sid'];
		}
		else{
			$arr = array("schedule_id"=>NULL,"uid"=>$uid,"type"=>"call", "schedule_status"=>'10', "creation_date"=>$cdt);
			$sid = $this->Phonecall_model->saveSchedule($arr);
		}
		
		$this->Phonecall_model->deleteMemberSchedule($sid);	
		$this->Phonecall_model->deleteMemberGroups($sid);	
		
		if(!empty($_POST['check'])){
			$users = $_POST['check'];
			foreach($users as $user){
				$mid = $user;
				$data = array("schedule_id"=>$sid, "member_id"=>$mid, "group_id"=>"", "delivery_status"=>'0', "uid"=>$uid);
				$this->Phonecall_model->saveMemberSchedule($data);
			}
		}
		if(!empty($_POST['check1'])){	
			$categories = $_POST['check1'];
			$arr = array("is_group"=>'1'); 
			$this->Phonecall_model->updateSchedule($arr, $sid);
			
			foreach($categories as $cid){
				$data = array("schedule_id"=>$sid, "group_id"=>$cid, "uid"=>$uid);
				$this->Phonecall_model->saveGroupSchedule($data);
					$users = $this->Member_model->getAllGroupMembers($cid);
					if(!empty($users)){
						foreach($users as $user){
							$mid = $user->member_id;
							$memcheck = $this->Phonecall_model->checkMemberSchedule($mid, $sid);
							if(!empty($memcheck)){}
							else{
								$data = array("schedule_id"=>$sid, "member_id"=>$mid, "group_id"=>$cid, "delivery_status"=>'0', 'uid'=>$uid);
								$this->Phonecall_model->saveMemberSchedule($data);
							}
						}
					}
			}
			
		}	
		redirect('/phonecall/step2?sid='.$sid, 'refresh');
	}
	
	public function step1GroupAction(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->model('Phonecall_model');
		$this->load->model('Member_model');
		if(isset($_POST['category'])){
			$cid = $_POST['category'];
			$arr = array("schedule_id"=>NULL,"uid"=>$uid,"type"=>"call", "schedule_status"=>'10', "is_group"=>'1', "group_id"=>$cid); 
			$sid   = $this->Phonecall_model->saveSchedule($arr);
			$users = $this->Member_model->getAllGroupMembers($cid);
			foreach($users as $user){
				$mid = $user->member_id;
				$data = array("schedule_id"=>$sid, "member_id"=>$mid, "delivery_status"=>'0', 'uid'=>$uid);
				$this->Phonecall_model->saveMemberSchedule($data);
			}
			
			redirect('/phonecall/step2?sid='.$sid, 'refresh');
		}
		else{
			redirect('/phonecall/step1', 'refresh');
		}
	}
	
	public function step2(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		
		$this->load->model('Content_model');
		$content = $this->Content_model->getAllContents('calls');
		$data['contents'] = $content;
		
		$data['url'] = current_url().'?sid='.$_GET['sid'];
		
		$data['title'] = $this->lang->line("proj_title");
		$data['callschedule_title'] = $this->lang->line("callschedule_title");
		$data["step_select_mem"]	= $this->lang->line("step_select_mem");
		$data["step_select_fl"]		= $this->lang->line("step_select_fl");
		$data["step_select_text"]	= $this->lang->line("step_select_text");
		$data["step_scheduling"]	= $this->lang->line("step_scheduling");
		$data["step_confirmation"]	= $this->lang->line("step_confirmation");
		$data["step_testcall"]		= $this->lang->line("step_testcall");
		$data["step_testsms"]		= $this->lang->line("step_testsms");
		$data["step_finish"]		= $this->lang->line("step_finish");
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
		$data['continue_btn'] 				= $this->lang->line("continue_btn");
		$data['make_selection'] 		= $this->lang->line("make_selection");
		
		$data["page"]	= "callsteps";
		
		$data['title_label'] 		= $this->lang->line("title_label");
		$data['filenm_label'] 		= $this->lang->line("filenm_label");
		$data['preview'] 			= $this->lang->line("preview");
		$data["selectone"]	= $this->lang->line("selectone");
		if(isset($_GET['sid'])){
			$this->load->model('Sms_model');
			$res = $this->Sms_model->getScheduledContent($_GET['sid']);
			$data['schdata'] = $res;
		}
		$this->load->view('includes/header.php', $data);
		$this->load->view('phone_step2.php');
	}
	
	public function step2Action(){
		if(!empty($_POST['check'])){
			$this->load->model('Phonecall_model');
			$sid = $_POST['sid'];
			$fileid = $_POST['check'];
			$data = array("content_id"=>$fileid);
			$this->Phonecall_model->updateSchedule($data, $sid);
			redirect('/phonecall/step3?sid='.$sid, 'refresh');
		}
		else{
			redirect('/phonecall/step1', 'refresh');
		}
	}
	
	public function step3(){
		$data['url'] = current_url().'?sid='.$_GET['sid'];
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		$data['callschedule_title'] = $this->lang->line("callschedule_title");
		$data["step_select_mem"]	= $this->lang->line("step_select_mem");
		$data["step_select_fl"]		= $this->lang->line("step_select_fl");
		$data["step_select_text"]	= $this->lang->line("step_select_text");
		$data["step_scheduling"]	= $this->lang->line("step_scheduling");
		$data["step_confirmation"]	= $this->lang->line("step_confirmation");
		$data["step_testcall"]		= $this->lang->line("step_testcall");
		$data["step_testsms"]		= $this->lang->line("step_testsms");
		$data["step_finish"]		= $this->lang->line("step_finish");
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
		$data['continue_btn'] 		= $this->lang->line("continue_btn");
		$data['select_year'] 		= $this->lang->line("select_year");
		$data['select_month'] 		= $this->lang->line("select_month");
		$data['select_hour'] 		= $this->lang->line("select_hour");
		$data['select_minute'] 		= $this->lang->line("select_minute");
		$data['select_day'] 		= $this->lang->line("select_day");
		$data['sdatelessmsg'] 		= $this->lang->line("sdatelessmsg");
		$data['futuresch'] 			= $this->lang->line("futuresch");
		$data['now'] 	= $this->lang->line("now");
		$data['hour'] 	= $this->lang->line("hour");
		$data['minute'] = $this->lang->line("minute");
		$data['year'] 	= $this->lang->line("year");
		$data['month'] 	= $this->lang->line("month");
		$data["page"]	= "callsteps";
		
		if(isset($_GET['sid'])){
			$this->load->model('Phonecall_model');
			$res = $this->Phonecall_model->getScheduledData($_GET['sid']);
			$data['schdata'] = $res;
		}
		
		$this->load->view('includes/header.php', $data);
		$this->load->view('phone_step3.php');
	}
	
	
	public function step3Action(){
		$sid = $_POST['sid'];
		if(isset($_POST['stype']) && $_POST['stype'] == 'now'){
			$dtm = date('Y-m-d H:i:s');
		}
		else{
			$yr = $_POST['cmbCalYear'];
			$mn = $_POST['cmbCalMonth'];
			$hr = $_POST['hr'];
			$mnt = $_POST['mnt'];
			$dt = $_POST['cdate'];
			$dtm = $dt.' '.$hr.':'.$mnt.':00';
		}
		$this->load->model('Phonecall_model');
		$data1 = array("schedule_date"=>$dtm, "time_opt"=>$_POST['stype']);
		$this->Phonecall_model->updateSchedule($data1, $sid);
		redirect('/phonecall/step4?sid='.$sid, 'refresh');
	}
	
	public function step4(){
		$data['url'] = current_url().'?sid='.$_GET['sid'];
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		$data['title_label'] 		= $this->lang->line("title_label");
		$data['name_label'] 		= $this->lang->line("name_label");
		$data['phone_label'] 		= $this->lang->line("phone_label");
		$data['email_label'] 		= $this->lang->line("email_label");
		$data['voice_label'] 		= $this->lang->line("voice_label");
		$data['voice_check'] 		= $this->lang->line("voice_check");
		$data['schedule_dt'] 		= $this->lang->line("schedule_dt");
		$data['confirm_btn'] 		= $this->lang->line("confirm_btn");
		$data['reschedule_btn'] 	= $this->lang->line("reschedule_btn");
		$data['mandatory'] 			= $this->lang->line("mandatory");
		
		$data['category'] 			= $this->lang->line("category");
		$data['member'] 			= $this->lang->line("member");
		
		$data['callschedule_title'] = $this->lang->line("callschedule_title");
		$data["step_select_mem"]	= $this->lang->line("step_select_mem");
		$data["step_select_fl"]		= $this->lang->line("step_select_fl");
		$data["step_select_text"]	= $this->lang->line("step_select_text");
		$data["step_scheduling"]	= $this->lang->line("step_scheduling");
		$data["step_confirmation"]	= $this->lang->line("step_confirmation");
		$data["step_testcall"]		= $this->lang->line("step_testcall");
		$data["step_testsms"]		= $this->lang->line("step_testsms");
		$data["step_finish"]		= $this->lang->line("step_finish");
		/*Menu*/
		$data['dash_title'] 			= $this->lang->line("dash_title");
		$data['sms'] 					= $this->lang->line("sms");
		$data['calls'] 					= $this->lang->line("calls");
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
		$data['continue_btn'] 				= $this->lang->line("continue_btn");
		$data['skip_btn'] 		= $this->lang->line("skip_btn");
		$data['test_btn'] 		= $this->lang->line("test_btn");
		$data['select_year'] 				= $this->lang->line("select_year");
		$data['select_month'] 				= $this->lang->line("select_month");
		$data['select_hour'] 				= $this->lang->line("select_hour");
		$data['select_minute'] 				= $this->lang->line("select_minute");
		$data['testcallmsg'] 				= $this->lang->line("testcallmsg");
		$data['test_call'] 				= $this->lang->line("test_call");
		$data["page"]	= "callsteps";
		$data["invalid_phone"]	= $this->lang->line("invalid_phone");
		$sid = $_GET['sid'];
		$this->load->model('Phonecall_model');
		$files = $this->Phonecall_model->getScheduledFile($sid);
		$data['file'] = $files;
		foreach($files as $fl);
		
		if($fl->schedule_title != ''){
			$data['shTitle'] = $fl->schedule_title;
		}else{$data['shTitle'] ='';}
		
		if($fl->is_group == '1'){
			$groups = $this->Phonecall_model->getScheduledroup($sid);
			$data['groups'] = $groups;
		}
		
		$members = $this->Phonecall_model->getAllScheduledMembersOnly($sid);
		$data['users'] = $members;
		
		$this->load->view('includes/header.php', $data);
		$this->load->view('phone_step4.php');
	}
	
	public function step4Action(){
		$sid = $_POST['sid'];
		$title = $_POST['sch_title'];
		$this->load->model('Phonecall_model');
		$data1 = array("schedule_title"=>$title);
		$this->Phonecall_model->updateSchedule($data1, $sid);
		redirect('/phonecall/step6?sid='.$sid, 'refresh');
	}
	public function step5(){
		$data['url'] = current_url().'?sid='.$_GET['sid'];
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] 				= $this->lang->line("proj_title");
		$data['callschedule_title'] = $this->lang->line("callschedule_title");
		$data["step_select_mem"]	= $this->lang->line("step_select_mem");
		$data["step_select_fl"]		= $this->lang->line("step_select_fl");
		$data["step_select_text"]	= $this->lang->line("step_select_text");
		$data["step_scheduling"]	= $this->lang->line("step_scheduling");
		$data["step_confirmation"]	= $this->lang->line("step_confirmation");
		$data["step_testcall"]		= $this->lang->line("step_testcall");
		$data["step_testsms"]		= $this->lang->line("step_testsms");
		$data["step_finish"]		= $this->lang->line("step_finish");
		$data['test_call'] 			= $this->lang->line("test_call");
		$data['title_label'] 		= $this->lang->line("title_label");
		$data['skip_btn'] 		= $this->lang->line("skip_btn");
		$data['test_btn'] 		= $this->lang->line("test_btn");
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
		$data['continue_btn'] 				= $this->lang->line("continue_btn");
		$data['testcallmsg'] 				= $this->lang->line("testcallmsg");
		$data["page"]	= "callsteps";
		
		$sid = $_REQUEST['sid'];
		
		$this->load->model('Phonecall_model');
		$file = $this->Phonecall_model->getScheduledFile($sid);
		$data['file'] = $file;
		
		$this->load->view('includes/header.php', $data);
		$this->load->view('phone_step5.php', $data);
	}
	
	/*
	For making test call
	*/
	public function step5TestAction(){
		$sid 	= $_POST['sid'];
		$cid = $_POST['cid'];
		$code = $_POST['code'];
		$phno = $code.$_POST['txtPhTst'];
		$filenm = $_POST['filenm'];
		if($filenm != ""){$filenm = substr($filenm,0,-4);}
		else{$filenm = '';}
		
		$this->load->model('Content_model');
		$res = '';
		$call = new Phonecall();
		$res = $call->phoneCallAPI($phno, $filenm, '0', '0', '0'); 
			if($res == true){
				$data = array("is_tested"=>'1');
				$this->Content_model->updateFileStatus($data, $cid);
				echo true;
			}
			else{
				echo false;
			}
	}
	
	public function step6(){
		$data['url'] = current_url().'?sid='.$_GET['sid'];
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		$data['callschedule_title'] = $this->lang->line("callschedule_title");
		$data["step_select_mem"]	= $this->lang->line("step_select_mem");
		$data["step_select_fl"]		= $this->lang->line("step_select_fl");
		$data["step_select_text"]	= $this->lang->line("step_select_text");
		$data["step_scheduling"]	= $this->lang->line("step_scheduling");
		$data["step_confirmation"]	= $this->lang->line("step_confirmation");
		$data["step_testcall"]		= $this->lang->line("step_testcall");
		$data["step_testsms"]		= $this->lang->line("step_testsms");
		$data["step_finish"]		= $this->lang->line("step_finish");
		/*Menu*/
		$data['dash_title'] 		= $this->lang->line("dash_title");
		$data['sms'] 				= $this->lang->line("sms");
		$data['calls'] 				= $this->lang->line("calls");
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
		$data['continue_btn'] 				= $this->lang->line("continue_btn");
		$data['finish_message'] 		= $this->lang->line("finish_message");
		$data["page"]	= "callsteps";
		
		$sid = $_GET['sid'];
		$this->load->view('includes/header.php', $data);
		$this->load->view('phone_step6.php', $data);
	}
	
	public function finishschedule(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->model('Phonecall_model');
		$cdt = date('Y-m-d H:i:s');
		$result = $this->Phonecall_model->getScheduledData($_GET['sid']);
		foreach($result as $res);
		if($res->time_opt == 'now'){$sdt = $cdt;}else{$sdt = $res->schedule_date;}
		$arr = array("schedule_status"=>'0', "creation_date"=>$cdt, "schedule_date"=>$sdt);
		$this->Phonecall_model->updateSchedule($arr, $_GET['sid']);
		redirect('/phonecall/step7', 'refresh'); 
		
	}
	
	public function step7(){
		$data['url'] = current_url();
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		$data['callschedule_title'] = $this->lang->line("callschedule_title");
		$data["step_select_mem"]	= $this->lang->line("step_select_mem");
		$data["step_select_fl"]		= $this->lang->line("step_select_fl");
		$data["step_select_text"]	= $this->lang->line("step_select_text");
		$data["step_scheduling"]	= $this->lang->line("step_scheduling");
		$data["step_confirmation"]	= $this->lang->line("step_confirmation");
		$data["step_testcall"]		= $this->lang->line("step_testcall");
		$data["step_testsms"]		= $this->lang->line("step_testsms");
		$data["step_finish"]		= $this->lang->line("step_finish");
		/*Menu*/
		$data['dash_title'] 		= $this->lang->line("dash_title");
		$data['sms'] 				= $this->lang->line("sms");
		$data['calls'] 				= $this->lang->line("calls");
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
		$data['continue_btn'] 				= $this->lang->line("continue_btn");
		
		$data['call_success'] 			= $this->lang->line("call_success");
		$data['return_call'] 			= $this->lang->line("return_call");
		$data["page"]	= "callsteps";
		
		$this->load->view('includes/header.php', $data);
		$this->load->view('phone_step7.php', $data);
	}
	
	public function schedule(){
		/*$this->load->model('Phonecall_model');
		$date = date('Y-m-d H:i');
		$schedules = $this->Phonecall_model->getReadySchedules($date);	
		if(!empty($schedules)){
			foreach($schedules as $sch){
				$sid 	= $sch->schedule_id;
				$filenm = $sch->filename;
				if($filenm !=""){$filenm = explode(".", $filenm);$filenm = $filenm[0];}
				else{$filenm = '';}
				
				$members = $this->Phonecall_model->getAllScheduledMembers($sid);
				if(!empty($members)){
					$i=1;
					foreach($members as $mem){
						$smid = $mem->sch_mem_id;
						$mid  = $mem->member_id;
						$phno = $mem->phone_no;
						$code = $mem->country_code;
						$phno = $code.$phno;
						$call = new Phonecall();
						$res = $call->phoneCallAPI($phno, $filenm, $mid, $smid, $sid);
						if($res == true){
							$data = array("delivery_status"=>'1', "call_account"=>'58380256', "call_send_date"=>date('Y-m-d H:i:s'));
							$this->Phonecall_model->updateDeliveryStatus($data, $smid);
							if(count($members) == $i){
								$sdata = array("schedule_status"=>'1');
								$this->Phonecall_model->updateScheduleStatus($sdata, $sid);
							}
							mail('sabirveli@gmail.com','call scheduling: cron test', 'call send');
							mail('tonyvarghese1984@gmail.com','call scheduling: cron test', 'call send');
						}
						else{
							echo "Failed !!!";
						}
					$i++;
					}
			  }
			}
		}*/
	}
	
	public function resend(){
		$this->load->model('Phonecall_model');
		$this->load->model('Member_model');
		$this->load->model('Content_model');
		$smid = $_POST['smid'];
		$sid  = $_POST['sid'];
		$member  = $this->Member_model->getMemberFromSchedule($smid);
		foreach($member as $mem);
		$content = $this->Content_model->getContentFromSchedule($sid);
		foreach($content as $ct);
		$filenm = $ct->filename;
		$mid = $mem->member_id;
		$phno = $mem->phone_no;
		$code = $mem->country_code;
		$phno = $code.$phno;
		$membercount = $this->Member_model->getTotalMemberStatusFromMemSchedule($sid);
		foreach($membercount as $mc);
		$msum = $mc->msum;
		$mcount = $mc->mcount;
		
		$call = new Phonecall();
		$res = $call->phoneCallAPI($phno, $filenm, $mid, $smid, $sid);
		if($res == true){
			$this->Phonecall_model->deleteFromCDR($smid);
			$data = array("delivery_status"=>'1');
			$this->Phonecall_model->updateDeliveryStatus($data, $smid);
			if($msum == $mcount){
				$sdata = array("schedule_status"=>'1');
				$this->Phonecall_model->updateScheduleStatus($sdata, $sid);
			}
			echo true;
		}
		else{echo false;}
	}
	
	public function phoneCallAPI($no, $filename, $uid, $smid, $schid){
		/* "http://218.251.250.2/makeCall.php?number=817012183178&filename=demo-thanks&userId=70&account=58380256&call_id=430&scheduleid=230";*/
		$url 		= 'http://218.251.250.2/makeCall.php?';
		$number		= $no;
		$filename	= $filename;
		$account = '55775674';
		$request	= $url.'number='.$no.'&filename='.$filename.'&userId='.$uid.'&account='.$account.'&call_id='.$smid.'&scheduleid='.$schid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
}

