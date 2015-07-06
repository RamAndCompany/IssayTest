<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loginuser extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		$this->load->library('session');
        if (!$this->session->userdata('USER_ID')){ 
            //redirect('/indexpage/index/', 'refresh');
        }
    }
	public function index(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		if(isset($udata['USER_ID'])){
			if($udata['logged_client'] != ""){$lclient = $udata['logged_client'];}
			else{$lclient = "";}
			if($udata['logged_client_nm'] != ""){$lclientnm = $udata['logged_client_nm'];}
			else{$lclientnm = "";}
			
			$data['lclient'] = $lclient;
			$data['lclientnm'] = $lclientnm;
			
			$this->load->model('Common_model');
			$data['areas'] = $this->Common_model->getAreas();
			$sysname = 'PG_AUTHORITY';
			$data['pglevels'] = $this->Common_model->getFromCode($sysname);
			$this->load->model('Basicinfo_model');
			$param = array('');
			$sid = $this->input->post('txtShop_Id');
			if($lclient != ""){
				$cid = $lclient;
			}
			else{
				$cid = $this->input->post('txtClient_Id');
			}
			
			$cnm = $this->input->post('txtClient_Nm');
			$uid = $this->input->post('txtUser_Id');
			$unm = $this->input->post('txtUser_Nm');
			
			$param = array("sid"=>$sid, "cid"=>$cid, "cnm"=>$cnm, "uid"=>$uid, "unm"=>$unm);
			
			$data['result'] = $this->Basicinfo_model->list_loginuser($param);
			$this->load->helper('url');
			$this->load->helper('form');
			$data['title'] = 'ログインユーザー管理';
			$this->load->view('includes/head', $data);
			$this->load->view('login_user_management_Mst003.php');
		}
		else{
			redirect('/indexpage/index/', 'refresh');
		}
	}
	
	public function saveUser(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$userid = $udata['USER_ID'];
		
		$this->load->model('Basicinfo_model');
		
		$uid = $this->input->post('uid');
		$unm = $this->input->post('unm');
		$pas = $this->input->post('pas');
		$pga = $this->input->post('pga');
		$cid = $this->input->post('cid');
		$cnm = $this->input->post('cnm');
		$sdp = $this->input->post('sdp');
		$sid = $this->input->post('sid');
		$snm = $this->input->post('snm');
		$eml = $this->input->post('eml');
		$ara = $this->input->post('ara');
		
		$param = array("USER_ID"=>$uid, "CLIENT_ID"=>$cid, "USER_NM"=>$unm, "PG_AUTHORITY"=>$pga, "CHANGE_PASS"=>date('Y-m-d'), "SHOP_ID"=>$sid, "AREA_ID"=>$ara, "MAIL_ADDRESS"=>$eml, "DELETE_FLAG"=>'0', "INSERT_USER"=>$userid);
		
		$result = $this->Basicinfo_model->save_user($param, $pas);
		if($result == true){echo true;}
		else{echo false;}
		
	}
	
	public function deleteLoginuser(){
		$this->load->model('Basicinfo_model');
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$userid = $udata['USER_ID'];
		
		$ids = $_POST;
		foreach($ids as $id){
			$cid = $id;
			$this->Basicinfo_model->deleteLoginuser($cid);
		}
		
		redirect('/loginuser/index/', 'refresh');
	}
	
	public function updateUser(){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$userid = $udata['USER_ID'];
		
		$this->load->model('Basicinfo_model');
			
		$uid = $this->input->post('uid');
		$unm = $this->input->post('unm');
		$pas = $this->input->post('pas');
		$pga = $this->input->post('pga');
		$cid = $this->input->post('cid');
		$cnm = $this->input->post('cnm');
		$sdp = $this->input->post('sdp');
		$sid = $this->input->post('sid');
		$snm = $this->input->post('snm');
		$eml = $this->input->post('eml');
		$ara = $this->input->post('ara');
		
		$param = array("USER_ID"=>$uid, "CLIENT_ID"=>$cid, "USER_NM"=>$unm, "PG_AUTHORITY"=>$pga, "CHANGE_PASS"=>date('Y-m-d'), "SHOP_ID"=>$sid, "AREA_ID"=>$ara, "MAIL_ADDRESS"=>$eml, "DELETE_FLAG"=>'0', "UPDATE_USER"=>$userid);
		
		$result = $this->Basicinfo_model->updateLoginuser($param, $uid, $pas);
		if($result == true){echo true;}
		else{echo false;}
		
	}
}

