<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 
 * 
 */
class Admin extends CI_Controller {


	function __construct(){
		parent::__construct();
	
		/*
		$this->load->database();
		$this->load->model('member_model');
	
		$this->_segment = $this->uri->segment_array();
		*/
	}
	
	public function index(){
		$this->load->view('dashboard');
	}
	
	public function dashboard(){
		$this->load->view('dashboard');
	}
	
}