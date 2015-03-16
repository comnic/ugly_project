<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_model extends CI_Model{
	
	function __construct(){
		parent::__construct();	
	}
	
	function getList($kind, $cat, $page, $cntPerPage){
		$start = ($page-1) * $cntPerPage;
		
		$sqlWhere = " c_kind = ". $this->db->escape($kind) . " AND c_active = 'Y' AND c_publish_date <= now() ";
		if($cat != 0 && $cat != "")
			$sqlWhere .= " AND cc_idx = '$cat' ";

		//전체 레코드수를 구한다. pagination을 위해.
		$this->db->where($sqlWhere, NULL, FALSE);
		$this->db->from('contents');
		$total_record = $this->db->count_all_results();
		
		//컨텐츠 리스트를 구한다.
		$this->db->select('c_idx as idx, cc_idx as category, c_kind as kind, c_title as title, c_count as cnt, c_img as img')
			->from('contents')
			->where($sqlWhere, NULL, FALSE)
			->order_by("c_idx", "desc")
			->limit($cntPerPage, $start);
		
		$query = $this->db->get();

		return array("items"=>$query->result_array(), "total"=>$total_record);
	}
	
	function getContent($idx){
		if(!isset($idx) || $idx == "")
			return false;

		/*
		 * 첫 페이지에서 최근 영상 하나를 먼저 띄우기 위해 사용했던 구문
		 * 현재 사용하지 않음.
		 * 
		if($idx == 0){
			
			//idx값이 0으로 넘어오면 최근 컨텐츠의 정보를 구한다.
			$this->db->select('c_idx as idx, cc_idx as category, c_kind as kind, c_title as title, c_summary as summary, c_content as content, c_movie_link as movie_link, c_count as cnt')
			->from('contents')
			->order_by("c_idx", "desc")
			->limit(1);
			
			$query = $this->db->get();
				
			return $query->row_array();
		}
		else{
		*/
			//먼저 c_count값을 1증가 시킨다.
			$this->upCount($idx);
			
			//idx해당 컨텐츠 정보를 구한다.
			$this->db->select('c_idx as idx, cc_idx as category, c_kind as kind, c_title as title, c_summary as summary, c_content as content, c_movie_link as movie_link, c_count as cnt')
			->from('contents')
			->where('c_idx', $idx)
			->order_by("c_idx", "desc");
			
			$query = $this->db->get();
				
			return $query->row_array();
		//}
	}
	
	function getBestContentsList(){
		$this->db->select('c_idx as idx, c_title as title')
		->from('contents')
		->where('c_active', 'Y')
		->order_by("c_count", "desc")
		->limit(10);
			
		$query = $this->db->get();
		
		return $query->result_array();
		
		//return $this->db->query("SELECT c_idx as idx, c_title as title FROM contents WHERE c_active = 'Y' ORDER BY c_count DESC limit 10")->result_array();
	}
	
	private function upCount($idx){
		//이후 컨텐츠 보기 로그에 쌓아야 하며, 부정클릭에 대한 검증도 필요함.
// 		$this->db->where('c_idx', $idx);
// 		$this->db->set('c_count', 'c_count+1', FALSE);
// 		$this->db->update('contents');

		$this->db->query("UPDATE contents SET c_count = c_count+1 WHERE c_idx = ".$this->db->escape($idx));
	}
}