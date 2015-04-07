
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="/favicon.ico">

<title>Soul Survivor Comms</title>

<script type="text/javascript" src="/plugins/jquery/jquery-1.9.1.min.js"></script>
<!-- Bootstrap core CSS -->
<link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/plugins/font-awesome-4.0.3/css/font-awesome.min.css"
	rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/css/signin.css" rel="stylesheet">
</head>

<body>

	<div class="container">

		<form class="form-signin">
			<div id="reg-step-login">
				<h2 class="form-signin-heading">Login</h2>
				<label for="inputPhoneNumber" class="sr-only">Phone Number</label> <input
					type="tel" id="inputPhoneNumber" name="phone"
					class="form-control" placeholder="Your Phone Number" required
					autofocus value=""> <label for="inputPassword" class="sr-only">Pin Code</label>
				<input type="password" name="password" id="inputPassword" class="form-control"
					placeholder="Password/PIN" required value=""> <input type="hidden"
					id="inputFingerprint" value="" />
				<button class="btn btn-lg btn-primary btn-block"
					id="activation-request">Login</button>
			</div>
			<div id="reg-step-loading" class="text-center hidden">
				<i class="fa fa-refresh fa-spin fa-5x"></i>
				<div class="progress">
				  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
				    <span class="sr-only">40% Complete (success)</span>
				  </div>
				</div>
				<h3>Awaiting response from server</h3>
				<small></small>
			</div>
			
			<div id="reg-step-message" class="text-center hidden">
				<i style="color: red;" class="fa fa-exclamation-triangle fa-5x"></i>
				<h3>Requesting a session...</h3>
				<small>This shouldn't take long...</small>
			</div>
		</form>

	</div>
	<!-- /container -->
	<script type="text/javascript" src="/js/fingerprint.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#inputFingerprint").val(new Fingerprint().get());

		$("#activation-request").click(function(e) {
			e.preventDefault();
			Auth.tryLogin($("#inputPhoneNumber").val(), $("#inputPassword").val());

		});
	});

Auth = new Object();
Auth.STATUS_USER_UNKNOWN=0;
Auth.STATUS_USER_NOT_ACTIVE=1;
Auth.STATUS_USER_UNAUTHENTICATED=2;
Auth.STATUS_USER_AUTHENTICATED=3;

Auth.tryLogin = function(phone_num, pass) {
	$.ajax({
		url: "/auth/check_status",
		type: "post",
		data: {phone: phone_num, password: pass},
		dataType: "json",
		success: function(data) {
			if (data.status == Auth.STATUS_USER_UNKNOWN) {
				Auth.showMessage("Please see Comms", "Your phone number is not known to our system");
			} else if (data.status == Auth.STATUS_USER_NOT_ACTIVE) {
				Auth.showLoading("Your Authentication Code: "+data.code, "Please see Comms to activate. Your code will renew every 30 seconds.");
				Auth.activationLoop(phone_num, pass);
			} else if (data.status == Auth.STATUS_USER_UNAUTHENTICATED) {
				Auth.showLoginScreen("Your password was not recognised");
			} else if (data.status == Auth.STATUS_USER_AUTHENTICATED) {
				Auth.showLoading("Logging In...", "Please wait, or refresh your page");
				Auth.Complete();
			}
		},
		error: function() {
			Auth.showMessage("Error Occurred", "Could not check login");
		}
	});
	if (Auth._activationLoopProgressTimeout) {
		clearTimeout(Auth._activationLoopProgressTimeout);
	}
	Auth.showLoading("Trying to Login", "Please wait...");
}

Auth._activationStart = new Date();
Auth._activationTimeout = 30000;
Auth._activationProgressInterval = 500;
Auth._activationLoopProgressTimeout = null;

Auth.activationLoop = function(phone_num, pass) {
	Auth._activationLoopCount = 0;
	Auth._activationStart = new Date();
	Auth._activationProgress(phone_num, pass);
}

Auth._activationProgress = function(phone_num, pass) {
	offset = (new Date())-Auth._activationStart;
	if (offset > Auth._activationTimeout) {
		Auth.tryLogin(phone_num, pass);
		return;
	}

	if ((Math.floor(offset) % 10) == 0) {
		Auth._interruptCheck(phone_num, pass);
	}
	
	percent = offset/Auth._activationTimeout*100;
	Auth._setProgress(percent);
	if (percent >= 100) {
		return;
	}
	Auth._activationLoopProgressTimeout = setTimeout(Auth._activationProgress.bind(null, phone_num, pass), Auth._activationProgressInterval);
}

Auth._interruptCheck = function(phone_num, pass) {
	$.ajax({
		url: "/auth/active_check",
		type: "post",
		data: {phone: phone_num, password: pass},
		dataType: "json",
		success: function(data) {
			if (data == true) {
				Auth.tryLogin(phone_num, pass);
			}
		}
	});
}

Auth._setProgress = function(perc) {
	$("#reg-step-loading .progress-bar").css("width", perc+"%");
}

Auth.showLoginScreen = function(message) {
	$("#reg-step-login h2").html(message);
	Auth._hideLoading();
	Auth._hideMessage();
	Auth._showLogin();
}

Auth.showLoading = function(title, message) {
	$("#reg-step-loading h3").html(title);
	$("#reg-step-loading small").html(message);
	Auth._hideLogin();
	Auth._hideMessage();
	Auth._showLoading();
}

Auth.showMessage = function(title, message) {
	$("#reg-step-message h3").html(title);
	$("#reg-step-message small").html(message);
	Auth._hideLogin();
	Auth._hideLoading();
	Auth._showMessage();
	
}

Auth._hideLogin = function() {
	if (!$("#reg-step-login").hasClass("hidden")) {
		$("#reg-step-login").addClass("hidden");
	}
}

Auth._showLogin = function() {
	if ($("#reg-step-login").hasClass("hidden")) {
		$("#reg-step-login").removeClass("hidden");
	}
}

Auth._hideMessage = function() {
	if (!$("#reg-step-message").hasClass("hidden")) {
		$("#reg-step-message").addClass("hidden");
	}
}

Auth._showMessage = function() {
	if ($("#reg-step-message").hasClass("hidden")) {
		$("#reg-step-message").removeClass("hidden");
	}
}

Auth._hideLoading = function() {
	if (!$("#reg-step-loading").hasClass("hidden")) {
		$("#reg-step-loading").addClass("hidden");
	}
}

Auth._showLoading = function() {
	if ($("#reg-step-loading").hasClass("hidden")) {
		$("#reg-step-loading").removeClass("hidden");
	}
}

Auth.Complete = function() {
	window.location = "/";
}
	</script>
</body>
</html>
