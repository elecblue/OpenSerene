<? 

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
	<title>SereneCMS (Admin)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
	<? if($urch == "true") { ?><script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">
		_uacct = "UA-87659-4";
		urchinTracker();
	</script><? } else if($urch == "false") { ?>
	<!-- Powered By SereneCMS -->
	<? } ?>
</head>
<body>
<div id="header">
	<? echo "$siteName"; ?>
</div>
<div id="nav">
	<a href="index.php" class="active">the hive</a>
	<a href="submit.php">write</a>
	<a href="themes.php">the look</a>
	<a href="users.php">users</a>
</div>
<div id="subnav">
	<a href="index.php">dashboard</a>
	<a href="settings.php">settings</a>
	<a href="http://www.atriotic.com/forum">update</a>
	&nbsp;&nbsp;<a href="logout.php"><i>logout</i></a>
</div>
<div id="container">
	<h1 class="section">welcome to serenecms, <? echo "$userTitle"; ?></h1>
	<div class="sectionBox">
		<h2 class="alert">everything seems to be running smoothly, captain!</h2>
		<div class="green">current version: <? echo $cms['version']; ?></div>
		<div class="white">active support: <a href="http://www.atriotic.com/forum">yes, lifetime license</a>.</div>
		<div class="green">bug reports: twelve recently, all fixed automatically</div>
	</div>
	<div class="sectionBox">
		<h2 class="subsect">recently posted stories</h2>
		<? while($r=mysql_fetch_array($getnews)){
			extract($r);
				echo("<b>".nl2br_skip_html($title)."</b><br />");
			}
		?>
	</div>
</div>
<div id="footer">
	<a href="http://www.atriotic.com">&copy; 2006 Atriotic, LLC</a><br />
	<a href="http://www.atriotic.com/forum">Atriotic Support Forums</a>
</div>
</body>
</html>
<? } else {
	header("Location: ../index.php");
	}
} else if(!isset($userTitle)) {
	header("Location: login.php");
} ?>