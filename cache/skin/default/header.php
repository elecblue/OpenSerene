<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
  <head>
  	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,300italic|Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
  	<meta charset="utf-8">
	<title><?php echo("$siteName"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	<?php serene_meta(); ?>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  </head>
<body>
<div id="wrap">
<div id="topbar">Today Is: <?php print date('d M y'); ?></div>