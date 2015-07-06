<?php 
class Ajax_model extends CI_Model {

    function __construct(){
        
    }
	function getShop($sid){
		$sql = "SELECT * FROM `m_shop` WHERE `SHOP_DISP_ID` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function loadBusStops($cid){
		$sql = "SELECT * FROM `m_busstop` WHERE `CLIENT_ID` = '".$cid."' ORDER BY `BUSSTOP_ID` ASC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function searchShop($did, $snm, $tel){
		if($did != ""){$condition1 = " AND `SHOP_DISP_ID` LIKE '".$did."%'";}else{$condition1 = "";}
		if($snm != ""){$condition2 = " AND `SHOP_NM` LIKE '".$snm."%'";}else{$condition2 = "";}
		if($tel != ""){$condition3 = " AND `TEL` LIKE '".$tel."%'";}else{$condition3 = "";}
		
		$sql = "SELECT * FROM `m_shop` WHERE 1 ".$condition1.$condition2.$condition3;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function searchClient($clid, $clnm, $tel, $sid){
		if($clid != ""){$condition1 = " AND `CLIENT_ID` LIKE '".$clid."%'";}else{$condition1 = "";}
		if($clnm != ""){$condition2 = " AND `CLIENT_NM` LIKE '".$clnm."%'";}else{$condition2 = "";}
		if($tel != ""){$condition3 = " AND `TEL` LIKE '".$tel."%'";}else{$condition3 = "";}
		if($sid != ""){$condition4 = " AND `SHOP_ID` LIKE '".$sid."%'";}else{$condition4 = "";}
		
		$sql = "SELECT * FROM m_client WHERE 1 ".$condition1.$condition2.$condition3.$condition4;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getStaffId(){
		/*$sql = "SELECT MAX(`STAFF_ID`)+1 AS STAFF_ID FROM `m_staff`";*/
		$sql = "SELECT MAX(CAST(`STAFF_ID` AS SIGNED))+1 AS STAFF_ID FROM `m_staff` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function getCustomerId(){
		$sql = "SELECT MAX(CAST(`CUSTOMERS_ID` AS SIGNED))+1 AS CUSTOMERS_ID FROM `m_customers` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getClientId(){
		$sql = "SELECT MAX(CAST(`CLIENT_ID` AS SIGNED))+1 AS CLIENT_ID FROM `m_client` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getCarId(){
		$sql = "SELECT MAX(CAST(`CAR_ID` AS SIGNED))+1 AS CAR_ID FROM `m_car` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function getEmployee($sid){
		$sql = "SELECT st.`STAFF_ID`, st.`STAFF_SEI_NM`, st.`STAFF_MEI_NM`, st.`SHOP_ID`, st.`BUMON_CD`, st.`TEL_NO`, st.`MAIL_ADDRESS`, bm.`BUMON_NM`, sh.`SHOP_DISP_ID`, sh.`SHOP_NM` FROM `m_staff` st LEFT JOIN `m_shop` sh ON sh.`SHOP_ID` = st.`SHOP_ID` LEFT JOIN `m_bumon` bm ON bm.`BUMON_CD` = st.`BUMON_CD` WHERE st.`STAFF_ID` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getSmartphone($tel){
		$sql = "SELECT s.`TEL_NO`, s.`TEL_NM`, s.`TEL_MEMO`, s.`SHOP_ID`, s.`VIDEO_FRAME_RATE`, s.`VIDEO_SIZE_W`, s.`VIDEO_SIZE_H`, s.`INSERT_USER`, s.`INSERT_DATE`, s.`UPDATE_USER`, s.`UPDATE_DATE`, sh.`SHOP_DISP_ID`, sh.`SHOP_NM`, sh.`SHOP_FURINM` FROM m_smartphone s LEFT JOIN m_shop sh ON s.SHOP_ID = sh.SHOP_ID WHERE s.`TEL_NO` = '".$tel."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function checkSmartphoneExist($tel){
		$sql = "SELECT * FROM  `m_smartphone` WHERE `TEL_NO` = '".$tel."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function checkPlanExist($clid, $day, $cid, $fcid){
		$sql = "SELECT * FROM `t_course_bin_plan` WHERE `CLIENT_ID` = '".$clid."' AND `DRIVEDAY` = '".$day."' AND `COURSE_ID` = '".$cid."' AND `COURSE_BIN_ID` = '".$fcid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function checkFCSettExist($clid, $day, $cid, $fcid, $bid, $time){
		$sql = "SELECT * FROM `t_course_bin_timetable` WHERE `CLIENT_ID` = '".$clid."' AND `DRIVEDAY` = '".$day."' AND `COURSE_ID` = '".$cid."' AND `COURSE_BIN_ID` = '".$fcid."' AND `BUSSTOP_ID` = '".$bid."' AND `COURSE_TIME`= '".$time."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getClient($cid){
		$sql = "SELECT * FROM `m_client` WHERE `CLIENT_ID` = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getVehicle($cid){
		$sql = "SELECT d.`CAR_ID`, d.`CAR_NM`, d.`CAR_NUM`, d.`PASSE_CNT`, d.`CAR_MEMO`, d.`CLIENT_ID`, d.`G_SENSOR_LEVEL`, d.`INSERT_USER`, d.`INSERT_DATE`, d.`UPDATE_USER`, d.`UPDATE_DATE`, m3.`CLIENT_NM` FROM m_car d LEFT JOIN m_client m3 ON d.CLIENT_ID = m3.CLIENT_ID WHERE d.`CAR_ID` = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getBusstopid(){
		$sql = "SELECT MAX(CAST(`BUSSTOP_ID` AS SIGNED))+1 AS BUSSTOP_ID FROM `m_busstop` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getBusstop($cid, $bid){
		$sql = "SELECT d.CLIENT_ID, m3.CLIENT_NM, d.BUSSTOP_ID, d.BUSSTOP_NM, d.LATITUDE, d.LONGITUDE FROM m_busstop d LEFT JOIN m_client m3 ON d.CLIENT_ID =  m3.CLIENT_ID WHERE d.CLIENT_ID = '".$cid."' AND d.BUSSTOP_ID = '".$bid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getEvacId(){
		$sql = "SELECT MAX(CAST(`SHELTER_ID` AS SIGNED))+1 AS SHELTER_ID FROM `m_shelter` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getEvacSett($cid, $sid){
		$sql = "SELECT d.CLIENT_ID, m3.CLIENT_NM, d.SHELTER_ID, d.SHELTER_NM, d.LATITUDE, d.LONGITUDE FROM m_shelter d LEFT JOIN m_client m3 ON d.CLIENT_ID =  m3.CLIENT_ID WHERE d.CLIENT_ID = '".$cid."' AND d.SHELTER_ID = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function loadCourses($clid){
		$sql = "SELECT * FROM `m_course` WHERE `CLIENT_ID` = '".$clid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function loadFlightCourses($cid, $clid){
		$sql = "SELECT * FROM `m_course_bin` WHERE `CLIENT_ID` = '".$clid."' AND `COURSE_ID` = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	
	function getCourseId(){
		$sql = "SELECT MAX(CAST(`COURSE_ID` AS SIGNED))+1 AS COURSE_ID FROM `m_course` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getCourse($clid, $cid){
		$sql = "SELECT d.CLIENT_ID, c.CLIENT_NM, d.COURSE_ID, d.COURSE_NM FROM m_course d LEFT JOIN m_client c ON d.CLIENT_ID = c.CLIENT_ID WHERE d.CLIENT_ID = '".$clid."' AND d.COURSE_ID = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getMapName($cid, $mid){
		$sql = "SELECT `MAP_NM` FROM `m_map` WHERE `MAP_ID` = '".$mid."' AND `CLIENT_ID` = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function getStaffName($sid, $bid){
		$sql = "SELECT `STAFF_SEI_NM`, `STAFF_MEI_NM` FROM `m_staff` WHERE `STAFF_ID` = '".$sid."' AND `BUMON_CD` = '".$bid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function getCourseBinId(){
		$sql = "SELECT MAX(CAST(`COURSE_BIN_ID` AS SIGNED))+1 AS COURSE_BIN_ID FROM `m_course_bin` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getCourseBin($clid, $cid, $bid){
		$sql = "SELECT d.CLIENT_ID, c.CLIENT_NM, d.COURSE_ID, s.COURSE_NM, d.COURSE_BIN_ID, d.COURSE_BIN_NM, d.MAP_ID, mp.MAP_NM, d.DRIVESOUGEI FROM m_course_bin d JOIN m_course s ON d.CLIENT_ID = s.CLIENT_ID AND d.COURSE_ID = s.COURSE_ID JOIN m_client c ON d.CLIENT_ID = c.CLIENT_ID LEFT JOIN m_map mp ON mp.MAP_ID = d.MAP_ID WHERE d.CLIENT_ID = '".$clid."' AND d.COURSE_ID = '".$cid."' AND d.COURSE_BIN_ID = '".$bid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function loadTodouFuken(){
		$sql = "SELECT * FROM `m_code` WHERE `CODE_DIV_SYS_NM` = 'TODOUFUKEN'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function loadZipDetails($pcd){
		$sql = "SELECT * FROM `m_jyusyo` WHERE `POST_CD` = '".$pcd."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getCustomer($cid){
		$sql = "SELECT d.CLIENT_ID, d.CLIENT_NM, d.CLIENT_FURINM, d.POST_CD, d.TODOUFUKEN_ID, d.JYUSYO1, d.JYUSYO2, d.JYUSYO3, d.JYUSYO4, d.TEL, d.FAX, c.CODE_ID_NM, d.SHOP_ID, m1.SHOP_DISP_ID, m1.SHOP_NM FROM m_client d LEFT JOIN m_code c ON c.CODE_ID = d.TODOUFUKEN_ID LEFT JOIN m_shop m1 ON m1.SHOP_ID = d.SHOP_ID WHERE d.CLIENT_ID = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getLoginUser($uid){
		$sql = "SELECT d.USER_ID, d.USER_NM, d.CLIENT_ID, m1.CLIENT_NM, d.PASSWORD, d.CHANGE_PASS, d.PG_AUTHORITY, c.CODE_ID_NM, d.DELETE_FLAG, d.SHOP_ID, m2.SHOP_NM, m2.SHOP_DISP_ID, d.MAIL_ADDRESS, d.AREA_ID, m3.AREA_NM FROM m_login_user d JOIN m_code c ON c.CODE_ID = d.PG_AUTHORITY AND c.CODE_DIV_SYS_NM = 'PG_AUTHORITY' LEFT JOIN m_client m1 ON d.CLIENT_ID = m1.CLIENT_ID LEFT JOIN m_shop m2 ON d.SHOP_ID = m2.SHOP_ID LEFT JOIN m_area m3 ON d.AREA_ID = m3.AREA_ID WHERE d.USER_ID = '".$uid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getBranchId(){
		$sql = "SELECT MAX(CAST(`SHOP_ID` AS SIGNED))+1 AS SHOP_ID FROM `m_shop` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function checkBranchExst($sid){
		$sql = "SELECT * FROM  `m_shop` WHERE `SHOP_DISP_ID` = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function checkBranchExstOnUp($sid, $did){
		$sql = "SELECT * FROM  `m_shop` WHERE `SHOP_DISP_ID` = '".$did."' AND `SHOP_ID` <> '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	function checkUserExst($uid){
		$sql = "SELECT * FROM  `m_login_user` WHERE `USER_ID` = '".$uid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function checkCntctIdExst($cid, $cno, $rbn){
		$sql = "SELECT * FROM `m_contract` WHERE `CLIENT_ID` = '".$cid."' AND `CONTRACT_NO` = '".$cno."' AND `CONTRACT_RENBAN` = '".$rbn."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getBranch($sid){
		$sql = "SELECT d.SHOP_ID, d.SHOP_DISP_ID, d.SHOP_NM, d.SHOP_FURINM, d.POST_CD, d.TODOUFUKEN_ID, c.CODE_ID_NM, d.JYUSYO1, d.JYUSYO2, d.JYUSYO3, d.JYUSYO4, d.TEL, d.FAX, ar.AREA_NM, bm.SHOP_BUMON_NM, d.SHOP_BUMON_ID, d.AREA_ID FROM m_shop d LEFT JOIN m_code c ON c.CODE_ID = d.TODOUFUKEN_ID AND c.CODE_DIV_SYS_NM = 'TODOUFUKEN' LEFT JOIN m_area ar ON d.AREA_ID = ar.AREA_ID LEFT JOIN m_shop_bumon bm ON d.SHOP_BUMON_ID = bm.SHOP_BUMON_ID WHERE d.SHOP_ID = '".$sid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getAreaId(){
		$sql = "SELECT MAX(CAST(`AREA_ID` AS SIGNED))+1 AS AREA_ID FROM `m_area` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getArea($aid){
		$sql = "SELECT * FROM `m_area` WHERE `AREA_ID` = '".$aid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getReportId(){
		$sql = "SELECT MAX(CAST(`REPORT_ID` AS SIGNED))+1 AS REPORT_ID FROM `m_report` WHERE 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function checkReportExst($cid, $rid){
		$sql = "SELECT * FROM  `m_report` WHERE `CLIENT_ID` = '".$cid."' AND `REPORT_ID` = '".$rid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getForm($cid, $rid){
		$sql = "SELECT d.CLIENT_ID, cl.CLIENT_NM, d.REPORT_ID, cd.CODE_ID_NM, d.FILE_NAME, d.FILE FROM m_report d JOIN m_code cd ON d.REPORT_ID = cd.CODE_ID AND cd.CODE_DIV_SYS_NM = 'REPORT_KBN' LEFT JOIN m_client cl ON d.CLIENT_ID = cl.CLIENT_ID WHERE d.`CLIENT_ID` = '".$cid."' AND d.`REPORT_ID` = '".$rid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getInfoDtls($did){
		$sql = "SELECT d.DATA_ID, d.CLIENT_ID, m1.CLIENT_NM, i.CODE_ID_NM, d.INFO_KBN, d.INFO_TITLE, d.INFO_BODY, d.STARTDAY, d.ENDDAY FROM m_information d JOIN m_client m1 ON d.CLIENT_ID = m1.CLIENT_ID LEFT JOIN m_code i ON d.INFO_KBN = i.CODE_ID AND `CODE_DIV_SYS_NM` = 'INFO_DIV' WHERE d.DATA_ID = '".$did."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getContractDtls($cid, $cno, $crb){
		$sql = "SELECT d.CLIENT_ID, m1.CLIENT_NM, d.CONTRACT_NO, d.CONTRACT_RENBAN, d.UKEOI_KBN, m2.CODE_ID_NM, d.START_DATE, d.YOTEI_END_DATE, d.END_DATE, d.PRICE FROM m_contract d LEFT JOIN m_client m1 ON d.CLIENT_ID = m1.CLIENT_ID LEFT JOIN m_code m2 ON d.UKEOI_KBN = m2.CODE_ID AND m2.`CODE_DIV_SYS_NM` LIKE 'UKEOI_KBN' WHERE d.CLIENT_ID = '".$cid."' AND d.CONTRACT_NO = '".$cno."' AND d.CONTRACT_RENBAN = '".$crb."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getBinTime($clid, $cid, $cbd, $bid, $ctm){
		$sql = "SELECT t.CLIENT_ID, m1.CLIENT_NM, t.COURSE_ID, c.COURSE_NM, t.COURSE_BIN_ID, b.COURSE_BIN_NM, t.BUSSTOP_ID, s.BUSSTOP_NM, t.COURSE_TIME FROM m_busstop s JOIN m_course_bin_timetable t ON s.CLIENT_ID = t.CLIENT_ID AND s.BUSSTOP_ID = t.BUSSTOP_ID JOIN m_course c ON c.CLIENT_ID = t.CLIENT_ID AND c.COURSE_ID = t.COURSE_ID JOIN m_course_bin b ON b.CLIENT_ID = t.CLIENT_ID AND b.COURSE_ID = t.COURSE_ID AND b.COURSE_BIN_ID = t.COURSE_BIN_ID LEFT JOIN m_client m1 ON t.CLIENT_ID = m1.CLIENT_ID WHERE t.CLIENT_ID = '".$clid."' AND t.COURSE_ID = '".$cid."' AND t.COURSE_BIN_ID = '".$cbd."' AND t.BUSSTOP_ID = '".$bid."' AND t.COURSE_TIME = '".$ctm."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getPlan($clid, $cid, $fcid, $day){
		$sql = "SELECT d.`CLIENT_ID`, d.`DRIVEDAY`, d.`COURSE_ID`, c.`COURSE_NM`, d.`COURSE_BIN_ID`, cb.`COURSE_BIN_NM`, d.`CAR_ID`, cr.`CAR_NM`, cr.`CAR_NUM`, d.`TEL_NO`, sm.`TEL_NM`, d.`STAFF_ID_DRIVER`, st.`STAFF_SEI_NM`, st.`STAFF_MEI_NM`, d.`STAFF_ID1`, st1.`STAFF_SEI_NM` AS STAFF_SEI_NM1, st1.`STAFF_MEI_NM` AS STAFF_MEI_NM1, d.`STAFF_ID2`, st2.`STAFF_SEI_NM` AS STAFF_SEI_NM2, st2.`STAFF_MEI_NM` AS STAFF_MEI_NM2, d.`STAFF_ID3`, st3.`STAFF_SEI_NM` AS STAFF_SEI_NM3, st3.`STAFF_MEI_NM` AS STAFF_MEI_NM3, d.`MAP_ID`, m.`MAP_NM`, d.`SPOT_STATUS`, mc.`CODE_ID_NM` AS SPOT_STATUS_NM, d.`DRIVE_STATUS`, ds.`CODE_ID_NM` AS DRIVE_STATUS_NM, d.`DRIVE_MEMO` FROM `t_course_bin_plan` d LEFT JOIN `m_course` c ON c.`COURSE_ID` = d.`COURSE_ID` AND c.`CLIENT_ID` = '".$clid."' LEFT JOIN `m_course_bin` cb ON cb.`COURSE_BIN_ID` = d.`COURSE_BIN_ID` AND cb.`COURSE_ID` = d.`COURSE_ID` AND cb.`CLIENT_ID` = '".$clid."' LEFT JOIN `m_car` cr ON cr.`CAR_ID` = d.`CAR_ID` LEFT JOIN `m_smartphone` sm ON sm.`TEL_NO` = d.`TEL_NO` LEFT JOIN `m_staff` st ON st.`STAFF_ID` = d.`STAFF_ID_DRIVER` LEFT JOIN `m_staff` st1 ON st1.`STAFF_ID` = d.`STAFF_ID1` LEFT JOIN `m_staff` st2 ON st2.`STAFF_ID` = d.`STAFF_ID2` LEFT JOIN `m_staff` st3 ON st3.`STAFF_ID` = d.`STAFF_ID3` LEFT JOIN `m_map` m ON m.`MAP_ID` = d.`MAP_ID` AND m.`CLIENT_ID` = '".$clid."' LEFT JOIN `m_code` mc ON mc.`CODE_ID` = d.`SPOT_STATUS` AND mc.`CODE_DIV_SYS_NM` = 'SPOT_STATUS' LEFT JOIN `m_code` ds ON ds.`CODE_ID` = d.`DRIVE_STATUS` AND ds.`CODE_DIV_SYS_NM` = 'DRIVE_STATUS' WHERE d.CLIENT_ID LIKE '".$clid."' AND d.`DRIVEDAY` = '".$day."' AND d.`COURSE_ID` = '".$cid."' AND d.`COURSE_BIN_ID` = '".$fcid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getPlanInd($clid, $cid, $fcid, $day){
		$sql = "SELECT * FROM `t_course_bin_plan` WHERE `CLIENT_ID` = '".$clid."' AND `DRIVEDAY` = '".$day."' AND `COURSE_ID` = '".$cid."' AND `COURSE_BIN_ID` = '".$fcid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getFCSett($clid, $cid, $fcid, $day, $bid, $time){
		$sql = "SELECT t.CLIENT_ID, t.COURSE_ID, c.COURSE_NM, t.COURSE_BIN_ID, b.COURSE_BIN_NM, t.BUSSTOP_ID, s.BUSSTOP_NM, t.COURSE_TIME, t.DRIVEDAY FROM t_course_bin_timetable t LEFT JOIN m_course c ON c.CLIENT_ID = t.CLIENT_ID And c.COURSE_ID = t.COURSE_ID AND t.CLIENT_ID = '".$clid."' LEFT JOIN m_course_bin b ON b.CLIENT_ID = t.CLIENT_ID AND b.COURSE_ID = t.COURSE_ID And b.COURSE_BIN_ID = t.COURSE_BIN_ID AND b.CLIENT_ID = '".$clid."' LEFT JOIN m_busstop s ON s.CLIENT_ID = t.CLIENT_ID And s.BUSSTOP_ID = t.BUSSTOP_ID AND s.CLIENT_ID = '".$clid."' AND t.DRIVEDAY = '".$day."' WHERE t.CLIENT_ID = '".$clid."' AND t.COURSE_ID = '".$cid."' AND t.COURSE_BIN_ID = '".$fcid."' AND t.BUSSTOP_ID = '".$bid."' AND t.COURSE_TIME = '".$time."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getNewsMail($did){
		$sql = "SELECT d.DATA_ID, d.CLIENT_ID, d.MAIL_KBN, c.CODE_ID_NM, d.MAIL_TITLE, d.MAIL_FROM, d.MAIL_HEADER, d.MAIL_FOOTER, d.MAIL_BODY, d.FILE_NAME1, d.FILE_NAME2, d.FILE_NAME3 FROM m_sendmail d JOIN m_code c On c.CODE_ID = d.MAIL_KBN AND c.`CODE_DIV_SYS_NM` = 'MAIL_KBN' WHERE d.DATA_ID = '".$did."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function getCustomerInfo($clid, $cid){
		$sql = "SELECT * FROM `m_customers` WHERE `CLIENT_ID`= '".$clid."' AND `CUSTOMERS_ID` = '".$cid."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		   return $query->result();
		}
		else{
			return false;
		}
	}
	
	function loadPassengers($clid, $pnm, $gp1, $gp2, $sts){
		if($pnm != ""){
			$condition1 = " AND `SEI_NM`  LIKE '".$pnm."' OR `MEI_NM` LIKE '".$pnm."'";
		}else{$condition1 = "";}
		if($gp1 != ""){
			$condition2 = " AND `GROUP_ID` = '".$gp1."'";
		}else{$condition2 = "";}
		if($gp2 != ""){
			$condition3 = " AND `GROUP_ID2` = '".$gp2."'";
		}else{$condition3 = "";}
		if($sts != ""){
			$condition4 = " AND `STATUS` = '".$sts."'";
		}else{$condition4 = "";}
		
		$sql = "SELECT * FROM `m_customers` WHERE `CLIENT_ID` = '".$clid."'".$condition1.$condition2.$condition3.$condition4;
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