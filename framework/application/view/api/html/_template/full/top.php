<?php 
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
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
<link rel="stylesheet" type="text/css" href="/css/feed.css" />
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
				<li><a href="/live">Live View</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Team <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/api/person">Person List</a></li>
						<li><a href="/api/team">Teams List</a></li>
						<li><a href="/api/duty_role">Duty Roles List</a></li>
					    <li><a href="/home/activation">Device Activations</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Equipment <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/api/equipment">Equipment List</a></li>
						<li><a href="/api/equipment_category">Equipment Categories</a></li>
					    <li><a href="/">Check In/Out</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Venues <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/api/venue">Venue List</a></li>
						<li><a href="/programme">Event Programme</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Delegates <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/api/church">Church List</a></li>
						<li><a href="/api/camp_location">Camping Areas</a></li>
						<li><a href="/api/camp_location">Upload Information</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="/api/incident">Incident List</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/safety/manager">Edit Safety Check Form</a></li>
						<li><a href="/admin/config">System Configuration</a></li>
						<li><a href="/admin/tag">Tags</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
					</form>
					<li><a href="/auth/logout">Logout</a></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
		</div>
	</nav>
	<div class="container" id="main-container">
