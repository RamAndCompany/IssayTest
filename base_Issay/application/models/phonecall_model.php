<?php 
class Phonecall_model extends CI_Model {

    function __construct(){
        
    }
	
	function saveSchedule($arr){ 
		$res = $this->db->insert('isy_schedule', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	function saveMemberSchedule($arr){ 
		$res = $this->db->insert('isy_schedule_members', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}	
	function saveGroupSchedule($arr){ 
		$res = $this->db->insert('isy_schedule_group', $arr); 
		if ($res){
		   return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	function updateSchedule($arr, $sid){ 
		$where = "`schedule_id` = '".$sid."'";
		$res = $this->db->update('isy_schedule', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function deleteMemberSchedule($id){ 
		$this->db->where('schedule_id', $id);
		$res = $this->db->delete('isy_schedule_members'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	function deleteMemberGroups($id){ 
		$this->db->where('schedule_id', $id);
		$res = $this->db->delete('isy_schedule_group'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function checkMemberSchedule($mid, $sid){
		$sql = "SELECT * FROM `isy_schedule_members` WHERE `schedule_id` = '".$sid."' AND `member_id` = '".$mid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function getAllScheduledMembers($sid){
		$sql = "SELECT sh.`sch_mem_id`, sh.`member_id`, m.`member_name`, m.`last_name`, m.`country_code`, m.`phone_no`, m.`email`  FROM `isy_schedule_members` sh LEFT JOIN `isy_members` m ON m.`member_id` = sh.`member_id` WHERE sh.`schedule_id` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getAllScheduledMembersOnly($sid){
		$sql = "SELECT sh.`member_id`, m.`member_name`, m.`last_name`, m.`country_code`, m.`phone_no`, m.`email`  FROM `isy_schedule_members` sh LEFT JOIN `isy_members` m ON m.`member_id` = sh.`member_id` WHERE sh.`schedule_id` = '".$sid."' AND sh.`group_id` = 0";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getScheduledFile($sid){
		$sql = "SELECT sh.`schedule_id`, sh.`content_id`, sh.`schedule_title`, sh.`schedule_date`, sh.`is_group`, sc.`title`, sc.`filename`, sc.`content`, sc.`is_tested` FROM `isy_schedule` sh LEFT JOIN `isy_content` sc ON sc.`content_id` = sh.`content_id` WHERE sh.`schedule_id` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getScheduledContent($sid){
		$sql = "SELECT * FROM `isy_schedule` WHERE `schedule_id` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getScheduledData($sid){
		$sql = "SELECT sh.`schedule_id`, sh.`schedule_title`, sh.`content_id`, sh.`schedule_date`, sh.`is_group`, sh.`time_opt`, sc.`title`, sc.`filename`, sc.`content`, sc.`is_tested` FROM `isy_schedule` sh LEFT JOIN `isy_content` sc ON sc.`content_id` = sh.`content_id` WHERE sh.`schedule_id` = '".$sid."' AND sh.`schedule_date` <> '0000-00-00 00:00:00'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getReadySchedules($date){
		$sql = "SELECT sh.`schedule_id`, sh.`content_id`, sh.`schedule_date`, sc.`title`, sc.`filename`, sc.`content`, sc.`is_tested` FROM `isy_schedule` sh LEFT JOIN `isy_content` sc ON sc.`content_id` = sh.`content_id` WHERE sh.`schedule_status` = '0' AND sh.`type`='call' AND sh.`schedule_date` <= '".$date."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function updateScheduleStatus($arr, $sid){ 
		$where = "`schedule_id` = '".$sid."'";
		$res = $this->db->update('isy_schedule', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	function updateDeliveryStatus($arr, $sid){ 
		$where = "`sch_mem_id` = '".$sid."'";
		$res = $this->db->update('isy_schedule_members', $arr, $where);
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
	
	function getScheduledroup($sid){
		$sql = "SELECT * FROM `isy_schedule_group` sg LEFT JOIN `isy_category` c ON c.`category_id` = sg.`group_id` WHERE sg.`schedule_id` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	/**** DASH & HISTORY DATA *****/
	function getLast5CALLhistory($data){
		$sql = "SELECT sh.`schedule_id`, sh.`schedule_title`, sh.`schedule_date`, sh.`creation_date`, sh.`schedule_status`, sh.`uid`, sh.`type`, sh.`is_group`, cn.`content_id`, cn.`title`, cn.`filename` FROM `isy_schedule` sh LEFT JOIN `isy_content` cn ON cn.`content_id` = sh.`content_id` WHERE sh.`uid` = '".$data['uid']."' AND sh.`type` = 'call' AND sh.`schedule_status` <> 10 AND sh.`schedule_date` BETWEEN '".$data['sdate']."' AND '".$data['edate']."' ORDER BY sh.`schedule_id` DESC LIMIT 0, 5";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getTotalSchedulingCount($data){
		$sql = "SELECT count(*) AS tcount FROM `isy_schedule` WHERE `uid` = '".$data['uid']."' AND `schedule_date` BETWEEN '".$data['sdate']."' AND '".$data['edate']."' AND `type` = 'call' AND `schedule_status` <> '10'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getTotalCallSubmittedCount($data){
		$sql = "SELECT count(*) AS scount FROM `isy_schedule` WHERE `uid` = '".$data['uid']."' AND `schedule_date` BETWEEN '".$data['sdate']."' AND '".$data['edate']."' AND `type` = 'call' AND `schedule_status` = '1'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getTotalCallPendingCount($data){
		$sql = "SELECT count(*) AS pcount FROM `isy_schedule` WHERE `uid` = '".$data['uid']."' AND `schedule_date` BETWEEN '".$data['sdate']."' AND '".$data['edate']."' AND `type` = 'call' AND `schedule_status` = '0'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getCallStatus($data){
		$sql = "SELECT count(*) AS scount FROM `isy_schedule_members` sm LEFT JOIN `isy_schedule` s ON s.`schedule_id` = sm.`schedule_id` WHERE sm.`delivery_status` = '".$data['callSts']."' AND sm.`uid` = '".$data['uid']."' AND s.`schedule_date` BETWEEN '".$data['sdate']."' AND '".$data['edate']."' AND s.`type` = '".$data['type']."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getCallHistory($data){
		if($data['sdate'] != "" && $data['edate'] != ""){$cond1 = " AND sh.`schedule_date` BETWEEN '".$data['sdate']."' AND '".$data['edate']."'";}
		else{$cond1='';}
		
		if($data['phone'] != ""){$cond2 = " AND m.`phone_no` = '".$data['phone']."'";}
		else{$cond2 = "";}
		
		if($data['category'] != ""){$cond3 = "  AND sh.`schedule_id` = (SELECT `schedule_id` FROM `isy_schedule_group` WHERE `group_id` = '".$data['category']."' AND `schedule_id` = sh.`schedule_id`)";}
		else{$cond3 = "";}/*AND sh.`group_id` = '".$data['category']."'*/
		
		if($data['status'] != ""){$cond4 = " AND sh.`schedule_status` = '".$data['status']."'";}
		else{$cond4 = "";}
		
		$sql = "SELECT sh.`schedule_id`, sh.`schedule_title`, sh.`schedule_date`, sh.`creation_date`, sh.`schedule_status`, sh.`uid`, sh.`type`, sh.`is_group`, cn.`content_id`, cn.`title`, cn.`filename` FROM `isy_schedule` sh LEFT JOIN `isy_content` cn ON cn.`content_id` = sh.`content_id` WHERE sh.`uid` = '".$data['uid']."' AND sh.`type` = 'call' AND sh.`schedule_status` <> 10 ".$cond1.$cond2.$cond3.$cond4."  ORDER BY sh.`schedule_id` DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getCallHistoryDash($uid, $sid){
		$sql = "SELECT sm.`sch_mem_id`, sm.`delivery_status`, sh.`schedule_id`, sh.`schedule_title`, sh.`schedule_date`, sh.`content_id`, sh.`schedule_status`, sh.`is_group`,   sh.`uid`, sh.`type`, m.`member_id`, m.`member_name`, m.`last_name`, m.`country_code`, m.`phone_no`, m.`email`, cd.`disposition` AS callstatus, cd.`calldate`, cd.`duration`, cd.`billsec`, cn.`title`, cn.`filename` FROM `isy_schedule_members` sm LEFT JOIN `isy_schedule` sh ON sh.`schedule_id` = sm.`schedule_id` LEFT JOIN `isy_members` m ON m.`member_id` = sm.`member_id` LEFT JOIN `cdr` cd ON cd.`call_id` = sm.`sch_mem_id` AND  cd.`scheduleid` = '".$sid."' LEFT JOIN `isy_content` cn ON cn.`content_id` = sh.`content_id` WHERE sm.`uid` = '".$uid."' AND sh.`type` = 'call' AND sh.`schedule_status` <> '10' AND sh.`schedule_id` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	/**** PI GRAPH DATA *****/
	
	function getCallCountPiGraph($data){
		$sql = "SELECT COUNT(*) AS tcount FROM `isy_schedule_members` m LEFT JOIN `cdr` cd ON cd.`call_id` = m.`sch_mem_id` LEFT JOIN `isy_schedule` s ON s.`schedule_id` = m.`schedule_id` WHERE m.`uid` = '".$data['uid']."' AND cd.`disposition` = '".$data['status']."' AND cd.`calldate` BETWEEN '".$data['sdate']."' AND '".$data['edate']."' AND s.`type` = 'call'";
		//echo $sql;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function getCallCountPiGraphPending($data){
		$sql = "SELECT COUNT(*) AS tcount FROM `isy_schedule_members` m LEFT JOIN `cdr` cd ON cd.`call_id` = m.`sch_mem_id` LEFT JOIN `isy_schedule` s ON s.`schedule_id` = m.`schedule_id` WHERE m.`uid` = '".$data['uid']."' AND m.`delivery_status` = '".$data['status']."' AND s.`schedule_date` BETWEEN '".$data['sdate']."' AND '".$data['edate']."' AND s.`type` = 'call'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function deleteFromCDR($id){ 
		$this->db->where('call_id', $id);
		$res = $this->db->delete('cdr'); 
		if ($res){
		   return true;
		}
		else{
			return false;
		}
	}
}
?>