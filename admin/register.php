<? 

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: admin/register.php
	
*/

session_start();

require("../engine/config.inc.php");
require("../engine/function.inc.php");

include("../engine/dbconnect.php"); 
include("skin/aheader.php");

$userTitle = $_SESSION['s_username'];

//Are they just getting here or submitting their info?
if (isset($_POST["username"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
	$email = $_POST["email"];
	$avatar = $_POST["avatar"];

//Was a field left blank?
if($username==NULL|$password==NULL|$cpassword==NULL|$email==NULL){
	echo "A field was left blank.";
} else {

//Do the passwords match?
if($password!=$cpassword){
	echo "Passwords do not match";
} else {

//Has the username or email been used?
	$checkuser = mysql_query("SELECT username FROM users WHERE username='$username'");
	$username_exist = mysql_num_rows($checkuser);

	$checkemail = mysql_query("SELECT email FROM users WHERE email='$email'");
	$email_exist = mysql_num_rows($checkemail);

if ($email_exist>0|$username_exist>0){
	echo "The username or email is already in use";
} else {

//Everything seems good, lets insert.
	$query = "INSERT INTO users (username, password, email, avatar) VALUES('$username','$password','$email','$avatar')";
		mysql_query($query) or die(mysql_error());
	echo "<div class=\"warning\">The user $username has been successfully registered.</div>";
			}
		}
	}
}

if(isset($userTitle)){
?>
<div id="announce"><img src="skin/images/warn.png" alt="" />&nbsp;Any users you register here will have full administrative access!</div>
<div id="welwrap">
	<div id="welicon"><img src="skin/images/register.png" alt="" /></div>
	<div id="weltext"><h1 class="pagewel">Register</h1></div>
</div>
<form action="register.php" method="POST">
<table>
	<tr>
		<td valign="top">Username:</td>
		<td valign="top"><input type="text" size="15" maxlength="25" name="username">
		</td>
	</tr>
	<tr>
		<td valign="top">Password:</td>
		<td valign="top"><input type="password" size="15" maxlength="25" name="password">
		</td>
	</tr>
	<tr>
		<td valign="top">Confirm Password:</td>
		<td valign="top"><input type="password" size="15" maxlength="25" name="cpassword">
		</td>
	</tr>
	<tr>
		<td valign="top">Email:</td> 
		<td valign="top"><input type="text" size="15" maxlength="255" name="email">
		</td>
	</tr>
	<tr>
		<td valign="top">
			<input type="submit" value="Register">
		</td>
	</tr>
</table>
</form>
<? 
} else {
echo "Please log in <a href=\"login.php\">here</a>. Only administrators can access the registration form!";
}
include("skin/afooter.php"); ?>