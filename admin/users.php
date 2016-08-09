<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: admin/users.php
	
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
$uQuery2= mysql_query("SELECT * FROM users ORDER BY id ASC");
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
	if($uType == "admin") {
	if($_POST['editu']){
		$nType = $_POST['nType'];
		$id = $_POST['id'];
		$upd = array();
		$upd[] = "UPDATE `users` SET `type`='$nType' WHERE `id`='$id';";
		foreach($upd as $query){
			mysql_query($query) or die(mysql_error());
		}
		header("Location: users.php?act=success");
	}
	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		$delete = "DELETE FROM `users` WHERE `id`='$id';";
		mysql_query($delete) or die(mysql_error());
		header("Location: users.php?act=success");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>User Management &mdash; <?= "$siteName";?> | OpenSerene</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
</head>
<body>
<div id="header">
	<?php echo "$siteName"; ?>
</div>
<div id="nav">
	<a href="index.php">Dashboard</a>
	<a href="submit.php">Write</a>
	<a href="themes.php">Appearance</a>
	<a href="users.php" class="active">User Management</a>
</div>
<div id="subnav">
	<?php if(isset($_GET['edit'])){ ?><a href="users.php">Quit Editing</a><?php } ?>
	<a href="../user/register.php">Register User</a>
</div>
<div id="container">
	<h1 class="section">User Management</h1>
	<?php if($_GET['act'] == "success") { ?>
	<div class="sectionBox">
		<h2 class="alert">User Related Action Successful!</h2>
	</div>
	<?php } if($_GET['act'] == "fail") { ?>
	<div class="sectionBox">
		<h2 class="alert">User Related Action Failed!</h2>
	</div>
	<?php }
	if(isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$query = mysql_query("SELECT * FROM users WHERE id='$id';");
		$eArray = mysql_fetch_array($query);
	?>
	<div class="sectionBox">
		<h2 class="subsect">Editing User &mdash; <?= $eArray['username']; ?> (<?php if($eArray['type'] == "admin") { echo "Administrator"; } else { echo "Normal User"; } ?>)</h2>
		<form action="users.php" name="edituser" method="post">
			<table>
				<tr>
					<td>Member Type:</td>
					<td>
						<select name="nType">
							<option value="admin">Administrator</option>
							<option value="user">Normal User</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="hidden" name="id" value="<?= $eArray['id']; ?>" /></td>
					<td><input type="submit" name="editu" value="Edit User" class="submit" /></td>
				</tr>
			</table>
		</form>
	</div>
	<?php } ?>
	<div class="sectionBox">
	<h2 class="subsect">Registered Users</h2>
	<table style="width: 100%;">
		<tr>
			<th style="text-align: left;">ID</th>
			<th style="text-align: left;">UserName</th>
			<th style="text-align: left;">Member Type</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($nRow = mysql_fetch_array($uQuery2)) {
		if($color == 'FFF') {
            $color = 'f0f7e2';
        } else {
            $color = 'FFF';
        } ?>
		<tr style="background-color: #<?= $color; ?>; color: #4c4c4c; font-size: 14px;">
			<td><?= $nRow['id']; ?></td>
			<td><?= $nRow['username'];?></td>
			<td><?php if($nRow['type'] == "admin") { echo "Administrator"; } else { echo "Normal User"; } ?></td>
			<td style="text-align: right;"><a href="?edit=<?= $nRow['id']; ?>">Edit</a> | <a href="?delete=<?= $nRow['id']; ?>">Delete</a></td>
		</tr>
		<?php } ?>
	</table>
	</div>
</div>
<div id="footer">
	POWERED BY <a href="http://github.com/vicegirls/OpenSerene">OPENSERENE</a><br />
	<a href="http://vicegirls.us">A VICEGIRLS JOINT</a>
</div>
</body>
</html>
<?php } else {
	header("Location: ../index.php");
	}
} else if(!isset($userTitle)) {
	header("Location: login.php");
} ?>