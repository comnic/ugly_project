
<style>
html{height:100%;}

ol, ul, li{list-style:none;}
a{text-decoration:none;}


.login_list{width:337px;margin:23px auto 0;}
.login_list li{margin:0 0 7px;border-radius:2px;}
.login_list .naver{border-bottom:1px solid #18b014;background:#26cc09 url(../../static/images/icon_naver.png) no-repeat 9px 50%;}
.login_list .facebook{border-bottom:1px solid #4f6faf;background:#527bd4 url(../../static/images/icon_fb.png) no-repeat 10px 50%;}
.login_list .phone{border-bottom:1px solid #75787f;background:#7f828a url(../../static/images/icon_phone.png) no-repeat 13px 50%;}
.login_list .email{border-bottom:1px solid #75787f;background:#7b8195 url(../../static/images/icon_email.png) no-repeat 11px 50%;}
.login_list li a{display:block;padding:0;height:51px;line-height:51px;color:#fff;font-size:14px;text-align:center;}

.email-login-form{display: none;}
.active{display: block;}

</style>
<script>
$(document).ready(function(){
	$(".email").click(function(){
		$(".email-login-form").toggleClass("active");
	});
});

</script>
<ul class="login_list">
      <li class="naver"><a href="naver/oauth_login.php">네이버로 로그인</a></li>
      <li class="facebook"><a href="https://www.facebook.com/dialog/oauth?client_id=769846103085318&amp;redirect_uri=http%3a%2f%2fwww.beautystation.co.kr%2ftest%2foauth%2f?facebook%26next_url%3d">페이스북으로 로그인</a></li>      
      <li class="email"><a href="#">이메일로 로그인</a></li>
      <li class="email-login-form">
      
      
	<form class="form-horizontal" action="/auth/authentication" method="post">

		<div class="modal-body">


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
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" value="로그인" />
		</div>
	</form>
      
      
      </li>
</ul>


	


<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '769846103085318',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '('+response.id+')!';
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email,user_friends" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
