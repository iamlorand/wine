<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9">
	<title>{PAGE_TITLE}</title>
	<link rel="apple-touch-icon" href="{SITE_URL}/images/apple-touch-icon.png">
	<meta name="keywords" content="{PAGE_KEYWORDS}" >
	<meta name="description" content="{PAGE_DESCRIPTION}" >
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="canonical" href="{CANONICAL_URL}" >
	<link rel="stylesheet" href="{TEMPLATES_URL}/css/frontend/style.css" type="text/css" >
	<link rel="stylesheet" href="{SITE_URL}/externals/fonts/stylesheet.css" type="text/css" >	
	<script src="{SITE_URL}/externals/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{TEMPLATES_URL}/js/frontend/main.js"></script>
	<!--[if lt IE 9]>
	<script src="{TEMPLATES_URL}/js/frontend/html5shim.js"></script>
	<![endif]-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div id="wrapper">
		<header>
			<div id="header-content" class="clearfix">
				<div id="logo">
					<h1><a href="{SITE_URL}/">{SITE_NAME}</a></h1>
				</div>
				{MENU_TOP}
			</div>
		</header>
		<div id="body">
			<div id="content">
				<h1>{PAGE_CONTENT_TITLE}</h1>
				{MESSAGE_BLOCK}
				{MAIN_CONTENT}
			</div>
			<div class="clear"></div>
		</div>
		<div id="push"></div>
	</div>
	<footer>
		<div id="footer-content">
			{MENU_FOOTER}
		</div>
		<div class="debugger">
			{DEBUGGER}
		</div>
	</footer>
</body>
</html>