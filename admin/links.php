<? 

// SereneCMS Administration Panel
// Created by Atriotic, LLC
// Author: N. Matt
// File :: Index (Admin)

session_start();

require("../engine/config.inc.php");
require("../engine/function.inc.php");
require("../engine/dbconnect.php"); 

$userTitle = $_SESSION['s_username'];

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

# Page Related Querys
$gLinks = mysql_query("SELECT * FROM links ORDER BY id ASC");

if(isset($userTitle)){
if($uType == "admin"){
	if($_POST['submit']){
		$title = $_POST['title'];
		$url = $_POST['url'];
		$name = $_POST['name'];
		$upd = "INSERT INTO links (id,name,url,title) VALUES (NULL,'$name','$url','$title');";
		mysql_query($upd) or die(mysql_error());
		header("Location: links.php?act=success");
	}
	if($_POST['editl']){
		$nTitle = $_POST['title'];
		$nURL = $_POST['url'];
		$nName = $_POST['name'];
		$id = $_POST['id'];
		$upd = array();
		$upd[] = "UPDATE `links` SET `title`='$nTitle' WHERE `id`='$id';";
		$upd[] = "UPDATE `links` SET `url`='$nURL' WHERE `id`='$id';";
		$upd[] = "UPDATE `links` SET `name`='$nName' WHERE `id`='$id';";
		foreach($upd as $query){
			mysql_query($query) or die(mysql_error());
		}
		header("Location: links.php?act=success");
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		$delete = "DELETE FROM `links` WHERE `id`='$id';";
		mysql_query($delete) or die(mysql_error());
		header("Location: links.php?act=success");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SereneCMS (Links)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
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
	<h1 class="section">manage your links</h1>
	<? if($_GET['act'] == "success") { ?>
	<div class="sectionBox">
		<h2 class="alert">Link Related Action Successful!</h2>
	</div>
	<? } if($_GET['act'] == "fail") { ?>
	<div class="sectionBox">
		<h2 class="alert">Link Related Action Failed!</h2>
	</div>
	<? }
	if(isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$eQuery = mysql_query("SELECT * FROM links WHERE id='$id';");
		$eArray = mysql_fetch_array($eQuery);
	?>
	<div class="sectionBox">
		<h2 class="subsect">edit a link</h2>
		<form action="links.php" name="editlink" method="post">
			<table>
				<tr>
					<td>Name:</td>
					<td><input type="text" name="name" class="smtext" value="<?= $eArray['name']; ?>" /></td>
				</tr>
				<tr>
					<td>URL:</td>
					<td><input type="text" name="url" class="smtext" value="<?= $eArray['url']; ?>" /></td>
				</tr>
				<tr>
					<td>Title:</td>
					<td><input type="text" name="title" class="smtext" value="<?= $eArray['title']; ?>" /></td>
				</tr>
				<tr>
					<td><input type="hidden" name="id" value="<?= $eArray['id']; ?>" /></td>
					<td><input type="submit" name="editl" value="Edit Link" class="submit" /></td>
				</tr>
			</table>
		</form>
	</div>
	<? } ?>
	<div class="sectionBox">
	<h2 class="subsect">your current links</h2>
	<table style="width: 100%;">
		<tr>
			<th style="text-align: left;">ID</th>
			<th style="text-align: left;">Name</th>
			<th style="text-align: left;">URL</th>
			<th style="text-align: left;">Title</th>
			<th>&nbsp;</th>
		</tr>
		<? while($lRow = mysql_fetch_array($gLinks)) {
		if($color == 'FFF') {
            $color = 'f0f7e2';
        } else {
            $color = 'FFF';
        } ?>
		<tr style="background-color: #<?= $color; ?>; color: #4c4c4c; font-size: 14px;">
			<td><?= $lRow['id']; ?></td>
			<td><?= $lRow['name'];?></td>
			<td><?= $lRow['url']; ?></td>
			<td><?= $lRow['title']; ?></td>
			<td style="text-align: right;"><a href="?edit=<?= $lRow['id']; ?>">Edit</a> | <a href="?delete=<?= $lRow['id']; ?>">Delete</a></td>
		</tr>
		<? } ?>
	</table>
	</div>
	<div class="sectionBox">
		<h2 class="subsect">add a link</h2>
		<form action="links.php" method="post">
			<table>
				<tr>
					<td>Name:</td>
					<td><input type="text" name="name" class="smtext" /></td>
				</tr>
				<tr>
					<td>URL:</td>
					<td><input type="text" name="url" class="smtext" /></td>
				</tr>
				<tr>
					<td>Title:</td>
					<td><input type="text" name="title" class="smtext" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Add Link" class="submit" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<div id="footer">
	<a href="http://www.atriotic.com">&copy; 2006 Atriotic, LLC</a><br />
	<a href="http://www.atriotic.com/forum">Atriotic Support Forums</a>
</div>
</body>
</html>
<? 
	} else if($uType == "user") {
		header("Location: ../index.php");
	}
} else {
	header("Location: login.php");
} ?>