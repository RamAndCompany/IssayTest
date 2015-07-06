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
	
	function getAllMembers(){
		/*$sql = "SELECT * FROM `isy_members` WHERE 1 ORDER BY `member_id` ASC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}*/
	}
	
	function getAllCategories(){
		/*$sql = "SELECT * FROM `isy_members` WHERE 1 ORDER BY `member_id` ASC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}*/
	}
}
?>