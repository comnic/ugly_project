<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Beauty Station</title>
<link href="/static/css/boilerplate.css" rel="stylesheet" type="text/css">

<!-- Bootstrap -->
<link href="/static/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<!-- link href="/static/lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" -->

<link href="/static/css/common.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/static/lib/jquery/jquery-1.11.2.min.js"></script>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/static/js/respond.min.js"></script>
<script src="/static/lib/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">

<div class="navbar navbar-fixed-top">

	<div id="topNavbar" class="navbar-inner">
		<div class="container">
	  
			<div class="nav pull-left">
				<a href="/"><img src="/static/images/top_logo.png"></a>
			</div>
	 
<ul class="nav pull-right">
    <?php
    if($this->session->userdata('is_login')){
    ?>
        <li><a href="/auth/logout">로그아웃</a></li>
    <?php
    } else {
    ?>
        <li><a href="/auth/login">로그인</a></li>
        <li><a href="/auth/register">회원가입</a></li>
    <?php
    }
    ?>
</ul> 		 
			<!-- Everything you want hidden at 940px or less, place within here -->
			<ul id="SNSList" class="collapse navbar-collapse navbar-nav pull-right">
	        	<li><a href="https://www.facebook.com/beautystation.tv" target="_blank"><img src="/static/images/icon_sns_fb.png"></a></li>
	        	<li><a href="#" target="_blank"><img src="/static/images/icon_sns_navertv.png"></a></li>
				<li><a href="#" target="_blank"><img src="/static/images/icon_sns_youtube.png"></a></li>
	          	<li><a href="#" target="_blank"><img src="/static/images/icon_sns_insta.png"></a></li>
			</ul>

	    </div>
	</div>
  
</div>
