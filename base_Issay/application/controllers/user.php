<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH."controllers/PHP_Text2Speech.class.php";

class User extends CI_Controller {
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
		 if (!$this->session->userdata('user_id')){ 
            redirect('/indexpage/index/', 'refresh');
        }
    }
	
	public function profile(){
		$data['url'] = current_url();
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		
		$data['user_title'] 		= $this->lang->line("user_title");
		$data['name_label'] 		= $this->lang->line("name_label");
		$data['phone_label'] 		= $this->lang->line("phone_label");
		$data['email_label'] 		= $this->lang->line("email_label");
		$data['country_label'] 	= $this->lang->line("country_label");
		$data['edit_mem_title'] 	= $this->lang->line("edit_mem_title");
		$data['addnew_mem_title'] 	= $this->lang->line("addnew_mem_title");
		
		$data['addnew_btn'] 	= $this->lang->line("addnew_btn");
		$data['edit_btn'] 		= $this->lang->line("edit_btn");
		$data['update_btn'] 	= $this->lang->line("update_btn");
		$data['delete_btn'] 	= $this->lang->line("delete_btn");
		$data['uploadmem_btn'] 	= $this->lang->line("uploadmem_btn");
		$data['uploadimg_label'] 	= $this->lang->line("uploadimg_label");
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
		    
		
		$data['mandatory_name'] 	= $this->lang->line("mandatory_name");
		$data['mandatory_phone'] 	= $this->lang->line("mandatory_phone");
		$data['invalid_phone'] 		= $this->lang->line("invalid_phone");
		$data['mandatory_email'] 	= $this->lang->line("mandatory_email");
		$data['invalid_email'] 		= $this->lang->line("invalid_email");
		
		$data["dataupdated"] = $this->lang->line("dataupdated");
		$data["page"]	= "profile";
		$data['usernm_label'] 				= $this->lang->line("usernm_label");
		$this->load->model('User_model');
		
		$users = $this->User_model->getUserDetails($uid);
		$data['user'] = $users;
		
		$this->load->view('includes/header.php', $data);
		$this->load->view('user.php');
	}
	
	public function updateProfile(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->model('User_model');
		$cnm = $_POST['txtNm'];
		$phn = $_POST['txtPh'];
		$eml = $_POST['txtEml'];
		
		$data2 = array("customer_name"=>$cnm, "customer_mail"=>$eml, "customer_phone"=>$phn);
		$this->User_model->updateLogin($data2,$uid);
		redirect('/user/profile', 'refresh');
	}
	
	public function changepwd(){
		$data['url'] = current_url();
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		if($uid != ''){
		$this->load->helper('url');
		$this->load->helper('form');
		$data['title'] = $this->lang->line("proj_title");
		
		$data['user_title'] 		= $this->lang->line("chngpwd_title");
		$data['password_label'] 		= $this->lang->line("password_label");
		$data['cpassword_label'] 		= $this->lang->line("cpassword_label");
		
		$data['addnew_btn'] 	= $this->lang->line("addnew_btn");
		$data['edit_btn'] 		= $this->lang->line("edit_btn");
		$data['update_btn'] 	= $this->lang->line("update_btn");
		$data['delete_btn'] 	= $this->lang->line("delete_btn");
		$data['uploadmem_btn'] 	= $this->lang->line("uploadmem_btn");
		$data['uploadimg_label'] 	= $this->lang->line("uploadimg_label");
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
		
		$data["dataupdated"] = $this->lang->line("dataupdated");
		$data["mandatory_field"] = $this->lang->line("mandatory_field");
		$data["pwdsnotmatch_field"] = $this->lang->line("pwdsnotmatch_field");
		$data["page"]	= "changepassword";
		$this->load->model('User_model');
		
		$users = $this->User_model->getUserDetails($uid);
		$data['user'] = $users;
		
		$this->load->view('includes/header.php', $data);
		$this->load->view('changepwd.php');
		}
		else{
			redirect('/indexpage/login', 'refresh');
		}
	}
	
	public function updatePassword(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		$this->load->model('User_model');
		$pwd = $_POST['txtPwd'];
		$data2 = array("password"=>md5($pwd));
		$this->User_model->updateLogin($data2,$uid);
		redirect('/user/changepwd', 'refresh');
	}
	
}

