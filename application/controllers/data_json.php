<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_json extends MH_Controller {
	
	function __construct(){
		parent::__construct();
	
		$this->load->database();
		$this->load->model('data_model');
	
		$this->_segment = $this->uri->segment_array();
	
	}
	
	function getChannelList(){
		
		$data = $this->data_model->getChannelList("MV");

		echo(json_encode($data));
		
	}
	
}