<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rules extends MH_Controller {

	public function index()
	{
		
	}
	
	public function service(){
		$this->load->view("head");
		$this->load->view("rules_service");
		$this->load->view("footer");
	}
	
	public function privacy(){
		$this->load->view("head");
		$this->load->view("rules_privacy");
		$this->load->view("footer");
	}
}
