<? 

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: admin/submit.php
	
*/

session_start();

require("../engine/config.inc.php");
require("../engine/function.inc.php");
require("../engine/dbconnect.php"); 

$userTitle = $_SESSION['s_username'];
$newslimit = "1";
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

if(isset($userTitle)){
if($uType == "admin"){
	if($_POST['submit']){
		$title = $_POST['title'];
		$user = $_POST['user'];
		$message = $_POST['message'];
		if(!empty($title)) {
			$title = addslashes($title);
			$user = addslashes($user);
			$message = addslashes($message);
			$date = date("F j, Y");
			$date2 = mktime();
			$sql = "INSERT INTO stories (id, title, user, message, `date`, avatar) VALUES ('NULL','$title','$user','$message','$date','$avatar')";
			$query = mysql_query($sql) or die("Cannot query the database.<br>" . mysql_error());
			header("Location: submit.php?act=success");
		} else { 
			header("Location: submit.php?act=fail"); 
		}
	} else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SereneCMS (Write)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
	<? if($wysiwyg == "true") { ?>
	<!-- Visual Editor - TinyMCE -->
	<script language="javascript" type="text/javascript" src="../engine/jscripts/tiny_mce/tiny_mce.js"></script>
	<script language="javascript" type="text/javascript">
		tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "/example_data/example_full.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "example_data/example_link_list.js",
		external_image_list_url : "example_data/example_image_list.js",
		flash_external_list_url : "example_data/example_flash_list.js",
		file_browser_callback : "mcFileManager.filebrowserCallBack",
		theme_advanced_resize_horizontal : false,
		theme_advanced_resizing : true
		});
	</script>
	<!-- / -->
	<? } else if($wysiwyg == "false") { ?>
	<!-- Visual Editor Disabled -->
	<? } ?>
</head>
<div id="header">
	<? echo "$siteName"; ?>
</div>
<div id="nav">
	<a href="index.php">the hive</a>
	<a href="submit.php" class="active">write</a>
	<a href="themes.php">the look</a>
	<a href="users.php">users</a>
</div>
<div id="subnav">
	<a href="submit.php">publish</a>
	<a href="editnews.php">edit</a>
	<a href="links.php">links</a>
</div>
<div id="container">
	<h1 class="section">publish a story</h1>
	<? if($_GET['act'] == "success") { ?>
	<div class="sectionBox">
		<h2 class="alert">Story Successfully Published!</h2>
	</div>
	<? } if($_GET['act'] == "fail") { ?>
	<div class="sectionBox">
		<h2 class="alert">Story Action Failed!</h2>
	</div>
	<? } ?>
	<div class="sectionBox">
		<h2 class="alert">remember these important tips</h2>
		<div class="green">use correct grammar. no one likes to read a poorly written article.</div>
		<div class="white">research and provide articles used in your article.</div>
		<div class="green">use the visual editor to your advantage.</div>
	</div>
	<div class="sectionBox">
	<form name="news" method="post" action="<?php echo $PHP_SELF; ?>">
		<input class="title" type="text" name="title" size="50" class="story" size="71" /><br />
		<input type="hidden" name="user" value="<? echo "$userTitle"; ?>" />
		<textarea name="message" rows="15" cols="100" class="story"></textarea><br />
		<input class="submit" type="submit" name="submit" value="Submit">
	</form>
	</div>
</div>
<div id="footer">
	<a href="http://www.atriotic.com">&copy; 2006 Atriotic, LLC</a><br />
	<a href="http://www.atriotic.com/forum">Atriotic Support Forums</a>
</div>
</body>
</html>
<? }
} else if($uType == "user") {
	header("Location: ../index.php");
}
} else {
	header("Location: login.php");
} ?>