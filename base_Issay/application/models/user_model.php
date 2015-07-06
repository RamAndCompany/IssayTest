<?php 
class User_model extends CI_Model {

    function __construct(){
        
    }
	
	function login($data){
		$sql = "SELECT * FROM `isy_login` WHERE `username` = '".$data['uname']."' AND `password` = md5('".$data['passw']."')";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getUserDetails($uid){
		$sql = "SELECT * FROM `isy_login` WHERE `username` = '".$uid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	
	function updateLogin($arr, $uid){ 
		$where = "`username` = '".$uid."'";
		$res = $this->db->update('isy_login', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	
	
	
	
	
	
	
	
	function saveUploadedFile($arr){ 
		$res = $this->db->insert('uploaded_files', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	function saveUsers($arr){ 
		$res = $this->db->insert('users', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	function getAllUsers($fid){
		$sql = "SELECT * FROM `users` WHERE `file_id` = '".$fid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function updateUserSchedule($arr, $uid){ 
		$where = "`user_id` = '".$uid."'";
		$res = $this->db->update('users', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function saveVoiceRecords($arr){ 
		$res = $this->db->insert('voice_table', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	function updateUserVoice($arr, $fid){ 
		$where = "`file_id` = '".$fid."'";
		$res = $this->db->update('users', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function updateFileVoice($arr, $fid){ 
		$where = "`file_id` = '".$fid."'";
		$res = $this->db->update('uploaded_files', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function updateFileSchedule($arr, $fid){ 
		$where = "`file_id` = '".$fid."'";
		$res = $this->db->update('uploaded_files', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function updateUserScheduleDT($arr, $fid){ 
		$where = "`file_id` = '".$fid."'";
		$res = $this->db->update('users', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function getScheduledFile($fid){
		$sql = "SELECT * FROM `uploaded_files` uf LEFT JOIN `voice_table` vt ON vt.`voice_id` =  uf.`voice_id` WHERE `file_id` = '".$fid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function updateFileScheduleStatus($arr, $fid){ 
		$where = "`file_id` = '".$fid."'";
		$res = $this->db->update('uploaded_files', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	/*function getAllUsers(){
		$sql = "SELECT * FROM `isy_login` WHERE `type` <> '0'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}*/
}
?>