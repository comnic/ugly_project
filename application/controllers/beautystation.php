<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beautystation extends MH_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->database();
	}
	
	public function index()
	{
		
		$this->load->library('facebook');
			
		$user = $this->facebook->get_user();
		
		$data['facebook_login_url'] = $this->facebook->login_url();
		$data['kakao_login_url'] = "https://kauth.kakao.com/oauth/authorize?client_id=".$this->config->item('rest_api_key', 'kakao')."&redirect_uri=".$this->config->item('redirect_url', 'kakao')."&response_type=code";
		$data['naver_login_url'] = "/beautystation/sns_login_naver";
		$this->load->view('head');
		$this->load->view('test', array("data"=>$data));
	}
	
	public function sns_login_facebook(){
// 		$sns = $this->input->get('sns');
// 		$next_url = $this->input->get('next_url');		
// 		$code = $this->input->get('code');
			
		$this->load->library('facebook');
			
		$user = $this->facebook->get_user(); 

		if( $user === false ){
			echo("<a href='".$this->facebook->login_url()."'>login</a>");
		}else{
			$this->load->model('member_model');
			$result = $this->member_model->getBySnsFacebook($user['id']);
			if($result->num_rows == 0){
				//등록되어 있지 않은 사용자.
				//DB에 해당 값을 등록한다.
				$this->member_model->addSns(array("kind"=>"facebook", "fbid"=>$user['id'], "fbname"=>$user['name']));
			}
			
			//로그인 처리 한다.
				
		}

	}
	
	public function sns_login_kakao(){
		$this->load->library('kakao');
		
		$user = $this->kakao->get_user();
		var_dump($user);
		
		if( $user === false ){
			echo("잠시후 다시 이용해 주세요!");
		}else{
			$this->load->model('member_model');
			$result = $this->member_model->getBySnsKakao($user->id);
			if($result->num_rows == 0){
				//등록되어 있지 않은 사용자.
				//DB에 해당 값을 등록한다.
				$this->member_model->addSns(array("kind"=>"kakao", "kkid"=>$user->id, "kkname"=>$user->properties->nickname, "kkprofileimage"=>$user->properties->profile_image));
			}
		
			//로그인 처리 한다.
		
		
		
		
		}
		
		
		
	}
	
	public function sns_login_naver(){
		$this->load->library('naver_oauth');
		
		$request = new Naver_oauth($this->config->item('consumer_key', 'naver'), $this->config->item('consumer_key_secret', 'naver'), $this->config->item('redirect_url', 'naver') );
		$request->set_state();
		$request->request_auth();
		
	}
	
	public function sns_login_naver_callback(){
		$this->load->library('naver_oauth');
		
		$request = new Naver_oauth($this->config->item('consumer_key', 'naver'), $this->config->item('consumer_key_secret', 'naver'), $this->config->item('redirect_url', 'naver') );
		$request->call_accesstoken();
		$request->get_uesr_profile();
	}
}