<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model{
	
	function __construct(){
		parent::__construct();	
	}
	
	
	function gets()
	{
		return $this->db->query("SELECT * FROM member_basic")->result();
	}
	
	function get($option)
	{
		$query = $this->db->get_where('member_basic', array('mb_email'=>$option['email']));
		
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	function add($option)
	{
		$this->db->set('mb_email', $option['email']);
		$this->db->set('mb_passwd', $option['password']);
		$this->db->set('mb_name', $option['name']);
		$this->db->set('mb_reg_date', 'NOW()', false);
		$this->db->insert('member_basic');
		$result = $this->db->insert_id();
		
		return $result;
	}
	
	function addSns($option)
	{
		if($option['kind'] == 'facebook'){
			$this->db->set('mb_facebook_id', $option['fbid']);
			//$this->db->set('mb_profile_photo', "https://graph.facebook.com/".$option['fbid']."/picture");
			$this->db->set('mb_name', $option['fbname']);
			$this->db->set('mb_last_login', 'NOW()', false);
			$this->db->set('mb_reg_date', 'NOW()', false);
			$this->db->insert('member_basic');
			$result = $this->db->insert_id();
		}else if($option['kind'] == 'kakao'){
			$this->db->set('mb_kakao_id', $option['kkid']);
			//$this->db->set('mb_profile_photo', "https://graph.facebook.com/".$option['fbid']."/picture");
			$this->db->set('mb_name', $option['kkname']);
			$this->db->set('mb_profile_photo', $option['kkprofileimage']);
			$this->db->set('mb_last_login', 'NOW()', false);
			$this->db->set('mb_reg_date', 'NOW()', false);
			$this->db->insert('member_basic');
			$result = $this->db->insert_id();
			
		}else if($option['kind'] == 'naver'){
			
			
		}

		return $result;
	}
	
	function getByEmail($option){
		$result = $this->db->get_where('member_basic', array('mb_email'=>$option['email']))->row();
		
		return $result;
	}
	
	function getBySnsFacebook($fbid){
		$result = $this->db->get_where('member_basic', array('mb_facebook_id'=>$fbid));
		
		return $result;
	}

	function getBySnsKakao($kkid){
		$result = $this->db->get_where('member_basic', array('mb_kakao_id'=>$kkid));
	
		return $result;
	}

	function getBySnsNaver($nvid){
		$result = $this->db->get_where('member_basic', array('mb_naver_id'=>$nvid));
	
		return $result;
	}
	
}