<? 

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: user/register.php
	
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

//Are they just getting here or submitting their info?
if (isset($_POST["username"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
	$email = $_POST["email"];
	$avatar = $_POST["avatar"];
	$usertype = $_POST['usertype'];

	//Was a field left blank?
	if($username==NULL|$password==NULL|$cpassword==NULL|$email==NULL){
		header("Location: register.php?act=error");
	} else {

	//Do the passwords match?
	if($password!=$cpassword){
		header("Location: register.php?act=error");
	} else {

	//Has the username or email been used?
	$checkuser = mysql_query("SELECT username FROM users WHERE username='$username'");
	$username_exist = mysql_num_rows($checkuser);

	$checkemail = mysql_query("SELECT email FROM users WHERE email='$email'");
	$email_exist = mysql_num_rows($checkemail);

	if ($email_exist>0|$username_exist>0){
		header("Location: register.php?act=error");
	} else {

	//Everything seems good, lets insert.
	$query = "INSERT INTO users (type, username, password, email, avatar) VALUES('$usertype','$username','$password','$email','$avatar')";
	mysql_query($query) or die(mysql_error());
		$message = "Thanks For Registering at $siteName, $username!\n\n";
		$message.= "The information below is what you will log in with. Keep this information in a safe place!\n\n";
		$message.= "Username: $username\n";
		$message.= "Password: $password\n\n";
		$message.= "If you lose your password, you may have to email an administrator to have it reset.\n\n";
		$message.= "Thanks,\n$siteName";
		$subject = "$siteName Registration";
		$headers = "From: $siteName <$siteEmail>";
		mail($email,$subject,$message,$headers);
	header("Location: register.php?act=success");
			}
		}
	}
}

if(isset($userTitle) && $uType == "admin"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><? echo "$siteName"; ?> (Global Register)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
</head>
<div id="header">
	<? echo "$siteName"; ?>
</div>
<div id="nav">
	<a href="index.php" class="active">user</a>
	<a href="../admin">admin</a>
</div>
<div id="subnav">
	<a href="../admin">profile</a>
	<a href="register.php">register</a>
	&nbsp;&nbsp;<a href="../admin/logout.php"><i>logout</i></a>
</div>
<div id="container">
	<h1 class="section">register global user</h1>
	<? if($_GET['act'] == "success") { ?>
	<div class="sectionBox">
		<h2 class="alert">You've successfully registered and an email has been sent with your information.</h2>
	</div>
	<? } if($_GET['act'] == "fail") { ?>
	<div class="sectionBox">
		<h2 class="alert">Registration Failed.</h2>
	</div>
	<? } ?>
	<div class="sectionBox">
		<form action="register.php" method="post">
		<table>
			<tr>
				<td valign="top">Username:</td>
				<td valign="top"><input type="text" size="15" maxlength="25" name="username" class="smtext" /></td>
			</tr>
			<tr>
				<td valign="top">Password:</td>
				<td valign="top"><input type="password" size="15" maxlength="25" name="password" class="smtext" /></td>
			</tr>
			<tr>
				<td valign="top">Confirm Password:</td>
				<td valign="top"><input type="password" size="15" maxlength="25" name="cpassword" class="smtext" /></td>
			</tr>
			<tr>
				<td valign="top">Email:</td> 
				<td valign="top"><input type="text" size="15" maxlength="255" name="email" class="smtext" /></td>
			</tr>
			<tr>
				<td valign="top">User Type:</td> 
				<td valign="top">
					<select name="usertype">
						<option value="admin">Administrator</option>
						<option value="user">Normal User</option>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<input type="submit" value="Register" class="submit" />
				</td>
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
<? } else if(!isset($userTitle)) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><? echo "$siteName"; ?> (Register)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
</head>
<div id="header">
	<? echo "$siteName"; ?>
</div>
<div id="nav">
	<a href="index.php" class="active">user</a>
</div>
<div id="subnav">
	<a href="#">register</a>
</div>
<div id="container">
	<h1 class="section">register</h1>
	<? if($_GET['act'] == "success") { ?>
	<div class="sectionBox">
		<h2 class="alert">You've successfully registered and an email has been sent with your information.</h2>
	</div>
	<? } if($_GET['act'] == "fail") { ?>
	<div class="sectionBox">
		<h2 class="alert">Registration Failed.</h2>
	</div>
	<? } ?>
	<div class="sectionBox">
		<form action="register.php" method="post">
		<table>
			<tr>
				<td valign="top">Username:</td>
				<td valign="top"><input type="text" size="15" maxlength="25" name="username" class="smtext" /></td>
			</tr>
			<tr>
				<td valign="top">Password:</td>
				<td valign="top"><input type="password" size="15" maxlength="25" name="password" class="smtext" /></td>
			</tr>
			<tr>
				<td valign="top">Confirm Password:</td>
				<td valign="top"><input type="password" size="15" maxlength="25" name="cpassword" class="smtext" /></td>
			</tr>
			<tr>
				<td valign="top">Email:</td> 
				<td valign="top"><input type="text" size="15" maxlength="255" name="email" class="smtext" /></td>
			</tr>
			<tr>
				<td valign="top">
					<input type="submit" value="Register" class="submit" />
				</td>
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
<? } ?>