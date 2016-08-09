<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: admin/settings.php
	
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

# Specific Page Definitions
$id = $fArray['id'];
$cTitle = $fArray['title'];
$cSubT = $fArray['subtitle'];
$cSURL = $fArray['siteurl'];
$cPath = $fArray['sitepath'];
$cUpOpt = $fArray['uploadopt'];
$cComOpt = $fArray['commentopt'];
$cEditor = $fArray['wysiwyg'];
$cUrchin = $fArray['urchin'];
$cDesc = $fArray['descript'];
$cKey = $fArray['keywords'];
$cAuthor = $fArray['author'];

if(isset($userTitle)){
if($uType == "admin") {

if($_POST['submit']){
	$id = $_POST['id'];
	$nTitle = $_POST['title'];
	$nSubT = $_POST['subtitle'];
	$nSURL = $_POST['siteurl'];
	$nPath = $_POST['sitepath'];
	$nUpOpt = $_POST['uploadopt'];
	$nComOpt = $_POST['commentopt'];
	$nEditor = $_POST['editoropt'];
	$nUrchin = $_POST['urchinopt'];
	$upd = array();
	$upd[] = "UPDATE `settings` SET `title`='$nTitle';";
	$upd[] = "UPDATE `settings` SET `subtitle`='$nSubT';";
	$upd[] = "UPDATE `settings` SET `siteurl`='$nSURL';";
	$upd[] = "UPDATE `settings` SET `sitepath`='$nPath';";
	$upd[] = "UPDATE `settings` SET `uploadopt`='$nUpOpt';";
	$upd[] = "UPDATE `settings` SET `commentopt`='$nComOpt';";
	$upd[] = "UPDATE `settings` SET `wysiwyg`='$nEditor';";
	$upd[] = "UPDATE `settings` SET `urchin`='$nUrchin';";
	foreach($upd as $sql){
		mysql_query($sql) or die(mysql_error());
	}
	header("Location: settings.php?act=success");
}

if($_POST['metaupd']){
	$description = $_POST['descript'];
	$keywords = $_POST['keywords'];
	$author = $_POST['author'];
	$upd = array();
	$upd[] = "UPDATE `settings` SET `descript`='$description';";
	$upd[] = "UPDATE `settings` SET `keywords`='$keywords';";
	$upd[] = "UPDATE `settings` SET `author`='$author';";
	foreach($upd as $sql){
		mysql_query($sql) or die(mysql_error());
	}
	header("Location: settings.php?act=success");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Settings &mdash; <?= "$siteName";?> | OpenSerene</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
</head>
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
	<h1 class="section">Settings</h1>
	<?php if($_GET['act'] == "success") { ?>
	<div class="sectionBox">
		<h2 class="alert">Settings Successfully Updated!</h2>
	</div>
	<?php } if($_GET['act'] == "fail") { ?>
	<div class="sectionBox">
		<h2 class="alert">Settings Update Failed!</h2>
	</div>
	<?php } ?>
	<div class="sectionBox">
		<h2 class="subsect">general site settings</h2>
		<form action="settings.php" method="post">
		<table>
			<tr>
				<td>Site Title:</td>
				<td><input type="text" value="<?php echo "$cTitle"; ?>" name="title" class="smtext" /></td>
			</tr>
			<tr>
				<td>Site Subtitle:</td>
				<td><input type="text" value="<?php echo "$cSubT"; ?>" name="subtitle" class="smtext" /></td>
			</tr>
			<tr>
				<td>Site URL:</td>
				<td><input type="text" value="<?php echo "$cSURL"; ?>" name="siteurl" class="smtext" /> (Critical!)</td>
			</tr>
			<tr>
				<td>Site Path:</td>
				<td><input type="text" value="<?php echo "$cPath"; ?>" name="sitepath" class="smtext" /> (Critical!)</td>
			</tr>
			<tr>
				<td>Allow Uploads?</td>
				<td>
					<select name="uploadopt">
						<option value="<?php echo "$cUpOpt"; ?>" class="currentopt"><?php if($cUpOpt == "true") { ?>Yes<?php } else { ?>No<?php } ?></option>
						<option value="true">Yes</option>
						<option value="false">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Allow Comments?</td>
				<td>
					<select name="commentopt">
						<option value="<?php echo "$cComOpt"; ?>" class="currentopt"><?php if($cComOpt == "true") { ?>Yes<?php } else { ?>No<?php } ?></option>
						<option value="true">Yes</option>
						<option value="false">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Use Visual Editor?</td>
				<td>
					<select name="editoropt">
						<option value="<?php echo "$cEditor"; ?>" class="currentopt"><?php if($cEditor == "true") { ?>Yes<?php } else { ?>No<?php } ?></option>
						<option value="true">Yes</option>
						<option value="false">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Log Use?</td>
				<td>
					<select name="urchinopt">
						<option value="<?php echo "$cUrchin"; ?>" class="currentopt"><?php if($cUrchin == "true") { ?>Yes<?php } else { ?>No<?php } ?></option>
						<option value="true">Yes</option>
						<option value="false">No</option>
					</select>
					(This allows us to keep knowledge of SereneCMS users, nothing is transmitted but number count.)
				</td>
			</tr>
			<tr>
				<td><input type="hidden" value="<?php echo "$id"; ?>" name="id" /></td>
				<td><input type="submit" value="Change Settings" name="submit" class="submit" /></td>
			</tr>
		</table>
		</form>
	</div>
	<div class="sectionBox">
		<h2 class="subsect">meta generator</h2>
		<p>Meta tags help search engine spiders do their work. Whatever is in these meta tags is what may be displayed to the users of the search engines to find your
		website. Be short and sweet! The meta function will display other information, but this is the information you should control yourself.</p>
		<form action="settings.php" method="post">
		<table>
			<tr>
				<td>Site Description:</td>
				<td><input type="text" value="<?php echo "$cDesc"; ?>" name="descript" class="smtext" /></td>
			</tr>
			<tr>
				<td>Site Keywords:</td>
				<td><input type="text" value="<?php echo "$cKey"; ?>" name="keywords" class="smtext" /> (Example: serene, cms, meta, tags)</td>
			</tr>
			<tr>
				<td>Site Author:</td>
				<td><input type="text" value="<?php echo "$cAuthor"; ?>" name="author" class="smtext" /></td>
			</tr>
			<tr>
				<td><input type="hidden" value="<?php echo "$id"; ?>" name="id" /></td>
				<td><input type="submit" value="Edit Meta" name="metaupd" class="submit" /></td>
			</tr>
		</table>
		</form>
	</div>
</div>
<div id="footer">
	POWERED BY <a href="http://github.com/vicegirls/OpenSerene">OPENSERENE</a><br />
	<a href="http://vicegirls.us">A VICEGIRLS JOINT</a>
</div>
</body>
</html>
<?php 	} else if($uType == "user") {
		header("Location: ../index.php");
	}
} else if(!isset($userTitle)) {
	header("Location: login.php");
} 

?>