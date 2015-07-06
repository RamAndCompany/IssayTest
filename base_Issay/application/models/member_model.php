<?php 
class Member_model extends CI_Model {

    function __construct(){
        
    }
	
	
	function saveMembers($arr){ 
		$res = $this->db->insert('isy_members', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	function getAllMembers($uid){
		$sql = "SELECT * FROM `isy_members` WHERE `uid` = '".$uid."' ORDER BY `member_id` DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function checkPhoneno($uid, $phone, $mid=''){
		if($mid != ''){$cond = " AND `member_id` <> '".$mid."'";}
		else{$cond = '';}
		$sql = "SELECT * FROM `isy_members` WHERE `uid` = '".$uid."' AND `phone_no` = '".$phone."'".$cond;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getMember($mid){
		$sql = "SELECT * FROM `isy_members` WHERE `member_id` = '".$mid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function updateMember($arr, $mid){ 
		$where = "`member_id` = '".$mid."'";
		$res = $this->db->update('isy_members', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteMember($id){ 
		$this->db->where('member_id', $id);
		$res = $this->db->delete('isy_members'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function getAllCategories($uid){
		$sql = "SELECT * FROM `isy_category` WHERE `uid` = '".$uid."' ORDER BY `category_id` DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function saveCategory($arr){ 
		$res = $this->db->insert('isy_category', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	function deleteCategory($id){ 
		$this->db->where('category_id', $id);
		$res = $this->db->delete('isy_category'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteMemberCategory($id){ 
		$this->db->where('category_id', $id);
		$res = $this->db->delete('isy_member_category'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteScheduleMemberCategory($id){ 
		$this->db->where('group_id', $id);
		$res = $this->db->delete('isy_schedule_group'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteScheduleMember($id){ 
		$this->db->where('group_id', $id);
		$res = $this->db->delete('isy_schedule_members'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteMemberFromSchedule($id){ 
		$this->db->where('member_id', $id);
		$res = $this->db->delete('isy_schedule_members'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteMemberFromGroup($id){ 
		$this->db->where('member_id', $id);
		$res = $this->db->delete('isy_member_category'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function getCategory($cid){
		$sql = "SELECT * FROM `isy_category` WHERE `category_id` = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function updateCategory($arr, $cid){ 
		$where = "`category_id` = '".$cid."'";
		$res = $this->db->update('isy_category', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function getAllMembersNotInGroup($uid, $cid){
		$sql = "SELECT * FROM `isy_members` WHERE uid='".$uid."' AND `member_id` NOT IN (SELECT `member_id` FROM `isy_member_category` WHERE `category_id` = '".$cid."') ORDER BY `member_id` DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getAllGroupMembers($cid){
		$sql = "SELECT * FROM `isy_member_category` c LEFT JOIN `isy_members` m ON m.`member_id` = c.`member_id` WHERE `category_id` = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function deletemembergroup($cid, $mid){ 
		$where = "`category_id` = '".$cid."' AND `member_id` = '".$mid."'"; 
		$res = $this->db->delete('isy_member_category', $where); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteGroupMembers($cid){ 
		$this->db->where('category_id', $cid);
		$res = $this->db->delete('isy_member_category'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function savemembergroup($arr){ 
		$res = $this->db->insert('isy_member_category', $arr); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function checkGroupExst($uid, $gp, $cid=''){
		if($cid != ''){$cond = " AND `category_id` <> '".$cid."'";}
		else{$cond = '';}
		$sql = "SELECT * FROM `isy_category` WHERE `uid` = '".$uid."' AND `category_name` = '".$gp."'".$cond;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getMemberFromSchedule($smid){
		$sql = "SELECT * FROM `isy_schedule_members` sm LEFT JOIN `isy_members` m ON m.`member_id` = sm.`member_id` WHERE `sch_mem_id` = '".$smid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getTotalMemberStatusFromMemSchedule($sid){
		$sql = "SELECT SUM(`delivery_status`) AS msum, COUNT(`member_id`) AS mcount FROM `isy_schedule_members` WHERE `schedule_id` = '".$sid."'";
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