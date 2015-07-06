<?php 
class Content_model extends CI_Model {

    function __construct(){
        
    }
	
	
	function saveVoice($arr){ 
		$res = $this->db->insert('isy_content', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	function saveSMS($arr){ 
		$res = $this->db->insert('isy_content', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	function updateFileStatus($arr, $cid){ 
		$where = "`content_id` = '".$cid."'";
		$res = $this->db->update('isy_content', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function getAllContents($type){
		$this->load->library('session');
		$udata = $this->session->all_userdata();
		$uid = $udata['user_id'];
		
		$sql = "SELECT * FROM `isy_content` WHERE `category` = '".$type."' AND `uid` = '".$uid."' ORDER BY `content_id` DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getSMS($cid){
		$sql = "SELECT * FROM `isy_content` WHERE `content_id` = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function updateContent($arr, $cid){ 
		$where = "`content_id` = '".$cid."'";
		$res = $this->db->update('isy_content', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteContent($id){ 
		$this->db->where('content_id', $id);
		$res = $this->db->delete('isy_content'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function getContentFromSchedule($sid){
		$sql = "SELECT * FROM `isy_schedule` sh LEFT JOIN `isy_content` c ON c.`content_id` = sh.`content_id` WHERE sh.`schedule_id` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
}
?>