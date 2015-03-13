<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}

define("KAKAO_TOKEN_API_URL", "https://kauth.kakao.com/oauth/token");
define("KAKAO_GET_USER_API_URL", "https://kapi.kakao.com/v1/user/me");
define("KAKAO_TOKEN_INFO_API_URL", "https://kapi.kakao.com/v1/user/access_token_info");

class Kakao{
	var $ci;
	var $helper;
	var $session;
	var $accessToken;
	var $refreshToken;
	
	var $rest_api_key;
	var $redirect_url;
	
	
	public function __construct() {
		$this->ci =& get_instance();
		// Initialize the variables
		$this->rest_api_key = $this->ci->config->item('rest_api_key', 'kakao');
		$this->redirect_url = $this->ci->config->item('redirect_url', 'kakao');

		if ( $this->ci->session->userdata('kakao_token') ) {
			//유효한 토큰인지 확인.
			$this->accessToken = $this->ci->session->userdata('kakao_token');
			
			if(!$this->validateToken()){				
				echo("토큰이 유효하지 않아 재요청함.");
				$this-getAccessToken();
			}
		}else{
			$this-getAccessToken();
		}
	}


	/**
	 * Returns the login URL.
	 */
	public function login_url() {
		$login_url = "";
		return $login_url;
	}
	
	/**
	 * Returns the current user's info as an array.
	 */
	public function get_user() {
		if ( $this->accessToken ) {
			/**
			 * Retrieve User’s Profile Information
			 */
			
			$opts = array(
					CURLOPT_URL => KAKAO_GET_USER_API_URL,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => false,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HTTPHEADER => array(
							"Authorization: Bearer " . $this->accessToken
					)
			);
			
			$curlSession = curl_init();
			curl_setopt_array($curlSession, $opts);
			$userInfoJson = curl_exec($curlSession);
			curl_close($curlSession);

			$user = json_decode($userInfoJson);
			
			return $user;
		}
		return false;
	}
	
	public function validateToken(){
		$opts = array(
				CURLOPT_URL => KAKAO_TOKEN_INFO_API_URL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTPHEADER => array(
						"Authorization: Bearer " . $this->accessToken
				)
		);
		
		$curlSession = curl_init();
		curl_setopt_array($curlSession, $opts);
		$tokenInfoJson = curl_exec($curlSession);
		curl_close($curlSession);
		
		$tokenInfo = json_decode($tokenInfoJson);
		if($tokenInfo->expiresInMillis >= 0)
			return true;
		else
			return false;
		
	}
	
	public function getAccessToken(){
		
		if(isset($_GET['code'])){
			$code   = $_GET["code"];
				
			$params = sprintf( 'grant_type=authorization_code&client_id=%s&redirect_uri=%s&code=%s', $this->rest_api_key, $this->redirect_url, $code);
			$opts = array(
					CURLOPT_URL => KAKAO_TOKEN_API_URL,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $params,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HEADER => false
			);
		
			$curlSession = curl_init();
			curl_setopt_array($curlSession, $opts);
			$accessTokenJson = curl_exec($curlSession);
			curl_close($curlSession);
		
			$accessTokenArray = json_decode($accessTokenJson);
		
			//var_dump($accessTokenArray);
		
			$this->refreshToken = $accessTokenArray->refresh_token;
			$this->accessToken = $accessTokenArray->access_token;
		
			$this->ci->session->set_userdata('kakao_token', $this->accessToken);
		
		}else{
			$this->accessToken = "";
		
		}		
		
	}
	
}