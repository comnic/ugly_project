<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 회원 승인에 관련되 Class
 * 
 * 로그인, 로그아웃, 회원가입, OAuth2 연동(facebook, Naver, kakao등), 회원 탈퇴
 * 
 */
class Auth extends MH_Controller {

	function __construct(){
		parent::__construct();

		$this->load->database();
		$this->load->model('member_model');
		
		$this->_segment = $this->uri->segment_array();		
	}

	/*
	 * login()
	 * 
	 * 로그인 화면을 보여준다.
	 */
	function login(){
		$this->_header();
		
		$this->load->view("login");
		
		$this->_footer();
	}
	
	/*
	 * authentication()
	 * 
	 * 로그인 체크.
	 */
	function authentication(){

		if($member = $this->member_model->get(array('email'=>$this->input->post('email')))){
			
		
			if(!function_exists('password_hash')){
				$this->load->helper('password');
			}
			if(
					$this->input->post('email') == $member->mb_email &&
					password_verify($this->input->post('password'), $member->mb_passwd)
			) {
				$this->session->set_userdata('is_login', true);
				$this->session->set_userdata('bs_mbidx', $member->mb_idx);
				$this->load->helper('url');
				redirect("/");
			} else {
				echo "불일치";
				$this->session->set_flashdata('message', '로그인에 실패 했습니다.');
				$this->load->helper('url');
				redirect('/auth/login');
			}
			
			
		}else{
			echo("일치하는 회원이 없습니다.");	
		}
	}

	 
	/*
	 * logout();
	 * 
	 * 로그아웃 처리.
	 */
	function logout(){
		$this->session->sess_destroy();
		$this->load->helper('url');
		redirect('/');
	}
	
	/*
	 * register()
	 * 
	 * EMail회원 등록을 위한 화면을 보여주고 처리 한다.
	 * 
	 */
	function register(){
		$this->_header();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', '이메일주소', 'required|valid_email|max_length[50]|is_unique[member_basic.mb_email]');
		$this->form_validation->set_rules('password', '비밀번호', 'required|min_length[6]|max_length[30]|matches[re_password]');
		$this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');
		$this->form_validation->set_rules('name', '이름', 'required|min_length[2]|max_length[20]');
		
		if($this->form_validation->run() === false){
        	$this->load->view('register');
    	} else {
        	if(!function_exists('password_hash')){
            	$this->load->helper('password');
        	}
        	$hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
 
        	$this->member_model->add(
        		array(
            		'email'=>$this->input->post('email'),
            		'password'=>$hash,
        			'name'=>$this->input->post('name')
        		)
        	);
 
        	$this->session->set_flashdata('message', '회원가입에 성공했습니다.');
        	$this->load->helper('url');
        	redirect('/');
    	}
 		
		
		
		$this->_footer();		
	}
	
	/*
	 * OAuth_sns_facebook()
	 * 
	 * 페이스북 로그인 연동.
	 * 최초 연동시 회원 가입 루틴을 따라 해당 정보를 저장 후 로그인 처리 한다.
	 */
	function OAuth_sns_facebook(){
		
	}

	/*
	 * OAuth_sns_naver()
	 * 
	 * 최초 연동시 회원 가입 루틴을 따라 해당 정보를 저장 후 로그인 처리 한다.
	 */
	function OAuth_sns_naver(){
	
	}
	
	/*
	 * OAuth_sns_kakao()
	 * 
	 * 최초 연동시 회원 가입 루틴을 따라 해당 정보를 저장 후 로그인 처리 한다.
	 */
	function OAuth_sns_kakao(){
	
	}
	
	
	
	
	/*
	 * 
	 */
	function _header(){
		$this->load->view('head');
	}
	
	/*
	 * 
	 */
	function _footer(){
	
	
	}
}

?>