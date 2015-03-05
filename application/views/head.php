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
 
      <!-- Everything you want hidden at 940px or less, place within here -->
      <ul id="SNSList" class="collapse navbar-collapse navbar-nav pull-right">
        	<li><a href="https://www.facebook.com/beautystation2" target="_blank"><img src="/static/images/icon_sns_fb.png"></a></li>
			<li><a href="#" target="_blank"><img src="/static/images/icon_sns_pinterest.png"></a></li>
          	<li><a href="#" target="_blank"><img src="/static/images/icon_sns_insta.png"></a></li>
        </ul>

    </div>
  </div>
  
</div>

<nav id="topChannelList" class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">채널목록</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
<?php 
	foreach($data['channels']['items'] as $item){
?>
           	<li><a href="/movie_list/index/<?php echo($item['cc_idx']);?>"><h5><span class="glyphicon glyphicon-facetime-video"></span> <?php echo($item['cc_title']);?> <?php if($item['new_cnt'] > 0){ ?><span class="badge"><?php echo($item['new_cnt']);?></span><?php }?></h5></a></li>
<?php 
}
?>          
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
