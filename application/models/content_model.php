<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_model extends CI_Model{
	
	function __construct(){
		parent::__construct();	
	}
	
	function getList($kind, $cat, $page, $cntPerPage){
		$start = ($page-1) * $cntPerPage;
		
		$sqlWhere = " c_kind='$kind' AND c_active = 'Y' AND c_publish_date <= now() ";
		if($cat != 0 && $cat != "")
			$sqlWhere .= " AND cc_idx = '$cat' ";
		
		$query = $this->db->query("SELECT * FROM contents WHERE $sqlWhere ");
		$total_record = $query->num_rows();

		$query = $this->db->query("SELECT c_idx as idx, cc_idx as category, c_kind as kind, c_title as title, c_count as cnt, c_img as img FROM contents WHERE $sqlWhere ORDER BY c_idx DESC LIMIT $start, $cntPerPage");

		
		return array("items"=>$query->result_array(), "total"=>$total_record);
	}
	
	function getContent($idx){
		if($idx == 0){
			return $this->db->query("SELECT c_idx as idx, cc_idx as category, c_kind as kind, c_title as title, c_summary as summary, c_content as content, c_movie_link as movie_link, c_count as cnt FROM contents ORDER BY c_idx DESC LIMIT 1 ")->row_array();
		}
		else{
			$this->upCount($idx);
			return $this->db->query("SELECT c_idx as idx, cc_idx as category, c_kind as kind, c_title as title, c_summary as summary, c_content as content, c_movie_link as movie_link, c_count as cnt FROM contents WHERE c_idx='$idx' ORDER BY c_idx DESC")->row_array();
		}
	}
	
	function getBestContentsList(){
		return $this->db->query("SELECT c_idx as idx, c_title as title FROM contents WHERE c_active = 'Y' ORDER BY c_count DESC limit 10")->result_array();
	}
	
	private function upCount($idx){
		//이후 컨텐츠 보기 로그에 쌓아야 하며, 부정클릭에 대한 검증도 필요함.
		$this->db->query("UPDATE contents SET c_count = c_count+1 WHERE c_idx = '$idx'");
	}
}