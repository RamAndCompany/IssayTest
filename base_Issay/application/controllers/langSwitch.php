<?php
/*session_start();*/
class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
	}
 
    function switchLanguage($language = "") {
		$curr_url = $_GET['url'];
		$language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
		//$_SESSION['site_lang'] = $language;
       redirect($curr_url);
	}
}