<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['content_image_path'] = "/static/images/content/";
$config['product_image_path'] = "/static/images/product/";
$config['review_image_path'] = "/static/images/review/";
$config['banner_image_path'] = "/static/images/banner/";

$config['facebook']['api_id'] = '769846103085318';
$config['facebook']['app_secret'] = 'ee922940b37ef309bcad0074337dceb7';
$config['facebook']['redirect_url'] = 'http://localhost:8888/beautystation/sns_login_facebook';
$config['facebook']['permissions'] = array(
		'email',
		'user_location',
		'user_birthday'
);

$config['kakao']['rest_api_key'] = '9ffdb326e3d9caa9031d64a7894cf54d';
$config['kakao']['redirect_url'] = urlencode('http://localhost:8888/beautystation/sns_login_kakao');

$config['naver']['consumer_key'] = 'eCgRaunJ2VhtNqheJVco';
$config['naver']['consumer_key_secret'] = 'wVz2ucPqX5';
$config['naver']['redirect_url'] = urlencode('/beautystation/sns_login_naver_callback');
