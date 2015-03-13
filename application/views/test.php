
<style>
html{height:100%;}

ol, ul, li{list-style:none;}
a{text-decoration:none;}


.login_list{width:337px;margin:23px auto 0;}
.login_list li{margin:0 0 7px;border-radius:2px;}
.login_list .naver{border-bottom:1px solid #18b014;background:#26cc09 url(../../static/images/icon_naver.png) no-repeat 9px 50%;}
.login_list .facebook{border-bottom:1px solid #4f6faf;background:#527bd4 url(../../static/images/icon_fb.png) no-repeat 10px 50%;}
.login_list .kakao{border-bottom:1px solid #ffde00;background:#ffef3f url(../../static/images/icon_kakao.png) no-repeat 10px 50%;}
.login_list .phone{border-bottom:1px solid #75787f;background:#7f828a url(../../static/images/icon_phone.png) no-repeat 13px 50%;}
.login_list .email{border-bottom:1px solid #75787f;background:#7b8195 url(../../static/images/icon_email.png) no-repeat 11px 50%;}
.login_list li a{display:block;padding:0;height:51px;line-height:51px;color:#fff;font-size:14px;text-align:center;}

.email-login-form{display: none;}
.active{display: block;}


</style>
</head>
<body>
<script>
$(document).ready(function(){
	$(".email").click(function(){
		$(".email-login-form").toggleClass("active");
	});
});

</script>
<ul class="login_list">
      <li class="naver"><a href="<?php echo($data['naver_login_url']);?>">네이버로 로그인</a></li>
      <li class="facebook"><a href="<?php echo($data['facebook_login_url']);?>">페이스북으로 로그인</a></li>
      <li class="kakao"><a href="<?php echo($data['kakao_login_url']);?>">카카오로 로그인</a></li>
      <li class="email"><a href="#">이메일로 로그인</a></li>
      <li class="email-login-form">
      
      
	<form class="form-horizontal" action="/auth/authentication" method="post">

		<div>


			<div class="control-group">
				<label class="control-label" for="email">이메일</label>
				<div class="controls">
					<input type="text" name="email" id="email" placeholder="이메일">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password">비밀번호</label>
				<div class="controls">
					<input type="password" name="password" id="password" placeholder="Password">
				</div>
			</div>



		</div>
		<div>
			<input type="submit" class="btn btn-primary" value="로그인" />
		</div>
		<div>
			<a href="/auth/register/">회원가입</a>
		</div>
	</form>
      
      
      </li>
</ul>
