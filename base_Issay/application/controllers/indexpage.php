<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH."controllers/PHP_Text2Speech.class.php";

class Indexpage extends CI_Controller {
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
		 
    }
	public function index(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		if(!isset($udata['user_id'])){
			$this->load->library('session');
			$udata = $this->session->all_userdata();
			$this->load->helper('url');
			$this->load->helper('form');
			$data['title'] 		= $this->lang->line("proj_title");
			$data['login_btn'] 	= $this->lang->line("login_btn");
			$data['userid'] 	= $this->lang->line("userid");
			$data['password'] 	= $this->lang->line("password");
			$data['url'] 			= current_url();
			if(isset($udata['log_error']) && $udata['log_error'] == true){$data['error'] = $this->lang->line("logerror");}
			else{$data['error'] = '';}
			$this->load->view('login.php', $data);
		}
		else{
			redirect('/indexpage/dashboard/', 'refresh');
		}
	}
	
	public function login(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		if(!isset($udata['user_id'])){
			$uname = $this->input->post('username');
			$passw = $this->input->post('password');
			$this->load->model('User_model');
			$data = array("uname"=>$uname, "passw"=>$passw);
			$result = $this->User_model->login($data);
			$error = array();
			$row = array();
			if(!empty($result)){
				$utype = $result[0]->type;
				$row = array("user_id"=>$uname, "type"=>$utype);
				$this->session->unset_userdata($error);
				$this->session->set_userdata($row);
				redirect('/indexpage/dashboard/', 'refresh');
			}
			else{
				$this->session->unset_userdata($row);
				$error = array("log_error"=>true);
				$this->session->set_userdata($error);
				redirect('/indexpage/index/', 'refresh');
			}
		}

	}
	
	public function dashboard(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		if(isset($udata['user_id'])){
			$uid = $udata['user_id'];
			$this->load->helper('url');
			$this->load->helper('form');
			
			$data['title'] = $this->lang->line("proj_title");
			$data['total_label'] 		= $this->lang->line("total_label");
			$data['send_label'] 		= $this->lang->line("send_label");
			$data['failed_label'] 		= $this->lang->line("failed_label");
			$data["pending_label"] 		= $this->lang->line("pending_label");
			$data["completed_label"] 	= $this->lang->line("completed_label");
			$data['inprogress_label'] 	= $this->lang->line("inprogress_label");
			$data['phone_label'] 		= $this->lang->line("phone_label");
			$data['serial_label'] 		= $this->lang->line("serial_label");
			$data['status_label'] 		= $this->lang->line("status_label");
			$data['title_label'] 		= $this->lang->line("title_label");
			$data['cmp_title_label'] 	= $this->lang->line("cmp_title_label");
			$data['url']   				= current_url();
			$data["schedule_dt"] 		= $this->lang->line("schedule_dt");
			$data["creation_dt"] 		= $this->lang->line("creation_dt");
			$data["graph"] 				= $this->lang->line("graph");
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
			$data['last_status'] 			= $this->lang->line("last_status");
			
			$data['group_menu'] 			= $this->lang->line("category");
			$data['membergroup_menu'] 		= $this->lang->line("member_groups");
			$data['changepwd_menu'] 		= $this->lang->line("change_pwd");
			$data['back_btn'] 				= $this->lang->line("back_btn");
			
			/*Status*/
			$data["status_completed"]  = $this->lang->line("status_completed");
			$data["status_pending"]	   = $this->lang->line("status_pending");
			$data["status_failed"]	   = $this->lang->line("status_failed");
			$data["status_inprogress"] = $this->lang->line("status_inprogress");
			$data["viewdetails_label"] = $this->lang->line("viewdetails_label");
			
			$data['name_label'] 		= $this->lang->line("name_label");
			$data['phone_label'] 		= $this->lang->line("phone_label");
			$data['email_label'] 		= $this->lang->line("email_label");
			
			$data["preview"] 		   = $this->lang->line("preview");
			$data["details"] 		   = $this->lang->line("details");
			$data["nodata"] 		   = $this->lang->line("nodata");
			$data["resend_btn"] 	   = $this->lang->line("resend_btn");
			$data["loading"] 	  	   = $this->lang->line("loading");
			$data["view_more"] 	  	   = $this->lang->line("view_more");
			
			$data["totalcall_label"] 	  	  = $this->lang->line("totalcall_label");
			$data["submittedcall_label"] 	  = $this->lang->line("submittedcall_label");
			$data["pendingcall_label"] 	  	  = $this->lang->line("pendingcall_label");
			
			$data["totalsms_label"] 	  	  = $this->lang->line("totalsms_label");
			$data["submittedsms_label"] 	  = $this->lang->line("submittedsms_label");
			$data["pendingsms_label"] 	  	  = $this->lang->line("pendingsms_label");
			
			$data["totalans_label"] 	  	  = $this->lang->line("totalans_label");
			$data["totalnotans_label"] 	  	  = $this->lang->line("totalnotans_label");
			$data["totalfailed_label"] 	  	  = $this->lang->line("totalfailed_label");
			$data["totalpendcalls_label"] 	  	  = $this->lang->line("totalpendcalls_label");
			
			$data["call_last_status"] 	  	  = $this->lang->line("call_last_status");
			$data["sms_last_status"] 	  	  = $this->lang->line("sms_last_status");
			
			$data["smslog"]			= $this->lang->line("smslog");
			$data["calllog"]		= $this->lang->line("calllog");
			$data["totalsmslog"]	= $this->lang->line("totalsmslog");
			$data["totalcalllog"]	= $this->lang->line("totalcalllog");
			$data["scheduled_label"]= $this->lang->line("scheduled_label");
			
			$data["total_announce"]		= $this->lang->line("total_announce");
			$data["submitted_announce"]	= $this->lang->line("submitted_announce");
			$data["scheduled_announce"]	= $this->lang->line("scheduled_announce");


			$data["page"]	= "dashboard";
			
			$cy 	= date('Y');
			$cm 	= date('m');
			$sdate 	= $cy.'-'.$cm.'-'.'1';
			$edate 	= $cy.'-'.$cm.'-'.'31';
			/**** SMS DETAILS ******/
			$this->load->model('Sms_model');
			$data1 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate);
			$smsHistory = $this->Sms_model->getLast5SMShistory($data1);
			$data['smsHistory'] = $smsHistory;
					/*SMS Line graph*/
					$data2 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate);
					$smsTotalCount 		= $this->Sms_model->getTotalSchedulingCount($data2);
					$smsSubmittedCount 	= $this->Sms_model->getTotalSMSSubmittedCount($data2);
					$smsPendingCount 	= $this->Sms_model->getTotalSMSPendingCount($data2);
					$data['smsTotalCount'] 		= $smsTotalCount;
					$data['smsSubmittedCount'] 	= $smsSubmittedCount;
					$data['smsPendingCount'] 	= $smsPendingCount;
					
					/*SMS PI graph*/
					$data6 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate, "status"=>"");
					$totalSMS 		= $this->Sms_model->getSMSCountPiGraph($data6);
					$data6 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate, "status"=>"1");
					$totalSendSMS 	= $this->Sms_model->getSMSCountPiGraph($data6);
					$data6 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate, "status"=>"0");
					$totalPendingSMS 	= $this->Sms_model->getSMSCountPiGraph($data6);
					$data['totalSMSPi'] 		= $totalSMS;
					$data['totalSendSMSPi'] 	= $totalSendSMS;
					$data['totalPendingSMSPi']= $totalPendingSMS;
					
			/**** CALL DETAILS ******/
			$this->load->model('Phonecall_model');
			$data1 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate);
			$callHistory = $this->Phonecall_model->getLast5CALLhistory($data1);
			$data['callHistory'] = $callHistory;
					/*CALL PI graph*/
					$data4 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate);
					$callTotalCount = $this->Phonecall_model->getTotalSchedulingCount($data4);
					$callSubmittedCount = $this->Phonecall_model->getTotalCallSubmittedCount($data4);
					$callPendingCount = $this->Phonecall_model->getTotalCallPendingCount($data4);
					$data['callTotalCount'] 	= $callTotalCount;
					$data['callSubmittedCount'] = $callSubmittedCount;
					$data['callPendingCount'] 	= $callPendingCount;
					
					/*CALL PI graph*/
					$data5 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate, "status"=>"ANSWERED");
					$totalAnswered 		= $this->Phonecall_model->getCallCountPiGraph($data5);
					$data5 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate, "status"=>"NO ANSWER");
					$totalNotAnswered 	= $this->Phonecall_model->getCallCountPiGraph($data5);
					$data5 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate, "status"=>"FAILED");
					$totalFailedCalls 	= $this->Phonecall_model->getCallCountPiGraph($data5);
					$data5 = array("uid"=>$uid, "sdate"=>$sdate, "edate"=>$edate, "status"=>"0");
					$totalPendingCalls 	= $this->Phonecall_model->getCallCountPiGraphPending($data5);
					$data['totalAnswered'] 		= $totalAnswered;
					$data['totalNotAnswered'] 	= $totalNotAnswered;
					$data['totalFailedCalls'] 	= $totalFailedCalls;
					$data['totalPendingCalls'] 	= $totalPendingCalls;
					
			$this->load->view('includes/header.php', $data);
			$this->load->view('dashboard.php');
		}
		else{
			redirect('/indexpage/index/', 'refresh');
		}
	}
	public function firstpage(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		$data['url']   = current_url();
		$this->load->view('includes/header.php', $data);
		$this->load->view('home.php');
	}
		
		
	public function logout(){
		$this->load->library('session');
		$row = array();
		$this->session->unset_userdata($row);
		$this->session->sess_destroy();
		redirect('/indexpage/index/', 'refresh');
	}
	
	public function dashdata(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		if(isset($udata['user_id'])){
			$uid = $udata['user_id'];
			$shid = $this->input->post('shid');
			$op   = $this->input->post('op');
			if($op == 'call'){
				$this->load->model('Phonecall_model');
				$result = $this->Phonecall_model->getCallHistoryDash($uid, $shid);
			}
			if($op == 'sms'){
				$this->load->model('Sms_model');
				$result = $this->Sms_model->getSMSHistoryDash($uid, $shid);
			}
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($result);
		}
	}
}

