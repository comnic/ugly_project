<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie_list extends MH_Controller {

	private $_category = 0;
	private $_page = 1;
	private $_idx = "1";
	
	private $_cntPerPage = 8;
	
	private $_segment;
	
	function __construct(){
		parent::__construct();
	
		$this->load->database();
		$this->load->model('content_model');
		$this->load->model('data_model');

		$this->_segment = $this->uri->segment_array();
	
	}
	
	public function index()
	{
		if(count($this->_segment) >= 3){
			$this->_category = $this->_segment[3];
		}
		
		$this->load->view('head');
		
		$data['category'] = $this->_category;
				
		$data['page'] = $this->_page;
		$data['cntPerPage'] = $this->_cntPerPage;

		$data['channels'] = $this->data_model->getChannelList("MV");
		
		$data['best'] = $this->content_model->getBestContentsList();
		
		$this->load->view('main', array("data"=>$data));
		
		$this->load->view('footer');
	}

	public function get_content_ajax()
	{
		if(count($this->_segment) < 3){
			echo("잘못된 접근입니다.");
			return false;
		}
			
		$cidx = $this->_segment[3];

		$data = $this->content_model->getContent($cidx);
		
		$this->load->helper('url');
		
		$data['content'] = auto_link(str_replace("\n", "<br>", $data['content']), 'both', TRUE);
		
		$this->load->view('content_info_json', array("data"=>$data));
		
	}
	
	function get_content_list(){
		if(count($this->_segment) < 4){
			$this->_category = 0;
			$this->_page = 1;
		}else{
			$this->_category = $this->_segment[3];
			$this->_page = $this->_segment[4];
		}
		
		$data = $this->content_model->getList("MV", $this->_category, $this->_page, $this->_cntPerPage);
		$data['page'] = $this->_page;
		$data['cntPerPage'] = $this->_cntPerPage;
		
		$this->load->view('content_list_json', array("data"=>$data));
	}
	
	function get_best_content(){
		$data = $this->content_model->getBestContentsList();
		$this->load->view('output_json', array("data"=>$data));
	}
}