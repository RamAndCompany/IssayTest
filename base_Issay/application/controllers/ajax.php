<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH."controllers/PHP_Text2Speech.class.php";
class Ajax extends CI_Controller {
	
	public function generateVoice(){
		$text = $_POST['txt'];
		$lang = $_POST['lang'];
		$t2s = new PHP_Text2Speech; 
		$vpth = $t2s->speak("$text", $lang);
		$voice = '<audio controls="controls" autoplay="autoplay" id="audio1" > 
					<source src="'.base_url().$vpth.'" type="audio/mp3" />    
				  </audio>
				  <input type="hidden" name="generatedFile" name="generatedFile" value="'.$vpth.'" />
				  ';
		echo $voice;
	}
	
	
	
	public function loadBusStops(){
		$cid = $this->input->post('cid');
		$this->load->model('Ajax_model');
		$result = $this->Ajax_model->loadBusStops($cid);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}
	
	public function getBinTime(){
		$clid = $this->input->post('clid');
		$cid = $this->input->post('cid');
		$cbd = $this->input->post('cbd');
		$bid = $this->input->post('bid');
		$ctm = $this->input->post('ctm');
		$this->load->model('Ajax_model');
		$result = $this->Ajax_model->getBinTime($clid, $cid, $cbd, $bid, $ctm);
		if(!empty($result)){
			foreach($result as $res){
				$time = rtrim(chunk_split(substr($res->COURSE_TIME,-6),2,':'),':');
				echo $res->CLIENT_ID."|+|".$res->CLIENT_NM."|+|".$res->COURSE_ID.'|+|'.$res->COURSE_NM.'|+|'.$res->COURSE_BIN_ID."|+|".$res->COURSE_BIN_NM."|+|".$res->BUSSTOP_ID."|+|".$res->BUSSTOP_NM."|+|".$time."|+|".$res->COURSE_TIME;
			}
		}
		else{echo false;}
	}
	
	
	
}

