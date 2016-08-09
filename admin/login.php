<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: admin/login.php
	
*/

session_start();

require("../engine/config.inc.php");
require("../engine/function.inc.php");
require("../engine/dbconnect.php"); 

# Initial Settings Query
$baseQuery = mysql_query("SELECT * FROM settings");
$fArray = mysql_fetch_array($baseQuery);

# Settings Definitions
$siteName = $fArray['title'];
$wysiwyg = $fArray['wysiwyg'];

if ($_POST['username']) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	if ($password==NULL) {
		header("Location: login.php?act=error");
	} else {
	$query = mysql_query("SELECT username,password FROM users WHERE username = '$username'") or die(mysql_error());
	$data = mysql_fetch_array($query);

	if($data['password'] != $password) {
		header("Location: login.php?act=error");
	} else {
		$query = mysql_query("SELECT username,password FROM users WHERE username = '$username'") or die(mysql_error());
		$row = mysql_fetch_array($query);
		$_SESSION['s_username'] = $row['username'];
		header("Location: index.php");					
		}
	}
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Dashboard Login &mdash; <?= "$siteName";?> | OpenSerene</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
</head>
<body>
<div id="header">
	<?php echo "$siteName"; ?>
</div>
<div id="container">
	<h1 class="section">login</h1>
	<div class="sectionBox">
		<form action='login.php' method='post'>
		<table>
			<tr>
				<td>Username:</td>
				<td><input type='text' size='15' maxlength='25' name='username'>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type='password' size='15' maxlength='25' name='password'>
				</td>
			</tr>
			<tr>
				<td align="center">
					<input type="submit" value="Login"  class="submit">
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>
<?php } ?>
<div id="footer">
	POWERED BY <a href="http://github.com/vicegirls/OpenSerene">OPENSERENE</a><br />
	<a href="http://vicegirls.us">A VICEGIRLS JOINT</a>
</div>
</body>
</html>