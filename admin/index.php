<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: admin/index.php
	
*/

session_start();

require("../engine/config.inc.php");
require("../engine/function.inc.php");
require("../engine/dbconnect.php"); 

$userTitle = $_SESSION['s_username'];
$newslimit = "5";
$getnews = mysql_query("SELECT * FROM stories ORDER BY id DESC LIMIT $newslimit");

# User Type Query
$uQuery = mysql_query("SELECT * FROM users WHERE username='$userTitle'") or die(mysql_error());
$uRow = mysql_fetch_array($uQuery);

# User Type Definitions
$uType = $uRow['type']; // Either "admin" or "user" 

# Initial Settings Query
$baseQuery = mysql_query("SELECT * FROM settings");
$fArray = mysql_fetch_array($baseQuery);

# Settings Definitions
$siteName = $fArray['title'];
$wysiwyg = $fArray['wysiwyg'];
$urch = $fArray['urchin'];

if(isset($userTitle)){
	if($uType == "admin") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Dashboard &mdash; <?= "$siteName";?> | OpenSerene</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
	<?php if($urch == "true") { ?><script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">
		_uacct = "UA-87659-4";
		urchinTracker();
	</script><?php } else if($urch == "false") { ?>
	<!-- Powered By SereneCMS -->
	<?php } ?>
</head>
<body>
<div id="header">
	<?php echo "$siteName"; ?>
</div>
<div id="nav">
	<a href="index.php" class="active">Dashboard</a>
	<a href="submit.php">Write</a>
	<a href="themes.php">Appearance</a>
	<a href="users.php">User Management</a>
</div>
<div id="subnav">
	<a href="index.php">Home</a>
	<a href="settings.php">Settings</a>
	<a href="http://github.com/vicegirls/OpenSerene">Update</a>
	&nbsp;&nbsp;<a href="logout.php"><i>Logout</i></a>
</div>
<div id="container">
	<h1 class="section">Dashboard</h1>
	<div class="sectionBox">
		<h2 class="alert">everything seems to be running smoothly, captain!</h2>
		<div class="green">current version: <?php echo $cms['version']; ?></div>
		<div class="white">active support: <a href="http://www.atriotic.com/forum">yes, lifetime license</a>.</div>
		<div class="green">bug reports: twelve recently, all fixed automatically</div>
	</div>
	<div class="sectionBox">
		<h2 class="subsect">recently posted stories</h2>
		<?php while($r=mysql_fetch_array($getnews)){
			extract($r);
				echo("<b>".nl2br_skip_html($title)."</b><br />");
			}
		?>
	</div>
</div>
<div id="footer">
	POWERED BY <a href="http://github.com/vicegirls/OpenSerene">OPENSERENE</a><br />
	LOGGED IN AS <?= "$userTitle"; ?> (<a href="logout.php">LOGOUT</a>)
</div>
</body>
</html>
<?php } else {
	header("Location: ../index.php");
	}
} else if(!isset($userTitle)) {
	header("Location: login.php");
} ?>