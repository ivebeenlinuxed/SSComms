<?php 
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
	return;
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>SS Comms</title>
<link rel="stylesheet" type="text/css" href="/plugins/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/plugins/boiler/css/main.css" />
<link rel="stylesheet" type="text/css" href="/plugins/font-awesome-4.0.3/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="/plugins/toastr/toastr.css" />
<meta name="viewport" content="width=device-width">

<script type="text/javascript" src="/plugins/jquery/jquery-1.9.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="/plugins/boiler/widget/search_expression/search_expression.css" />
<link rel="stylesheet" type="text/css" href="/plugins/boiler/css/maxi-modal.css" />
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">SS Comms</a>
			
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="/home/activation">Activations</a></li>
				<li><a href="/api/person">People</a></li>
				<li><a href="/api/equipment">Equipment</a></li>
				<li><a href="/api/team">Teams</a></li>
				<li><a href="/api/equipment_category">Equipment Category</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/auth/logout">Logout</a></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
		</div>
	</nav>
	<div class="container" id="main-container">
