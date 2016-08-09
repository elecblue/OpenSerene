<?php

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: admin/themes.php
	
*/

session_start();

require("../engine/config.inc.php");
require("../engine/function.inc.php");
require("../engine/dbconnect.php"); 

/*function remove_directory($dir) {
	if ($handle = opendir("$dir")) {
		while (false !== ($item = readdir($handle))) {
		    if ($item != "." && $item != "..") {
				if (is_dir("$dir/$item")) {
					remove_directory("$dir/$item");
				} else {
					unlink("$dir/$item");
				}
		    }
	    }
    closedir($handle);
    rmdir($dir);
	header("Location: themes.php?act=success");
   }
}*/

$userTitle = $_SESSION['s_username'];

# Initial Settings Query
$baseQuery = mysql_query("SELECT * FROM settings");
$fArray = mysql_fetch_array($baseQuery);

# Settings Definitions
$siteName = $fArray['title'];
$cTheme = $fArray['theme'];

$dir = "../cache/skin/";

$cThemeDir = "../cache/skin/$cTheme/";

if($_POST['themechange']){
	$themeswitch = $_POST['themeswitch'];
	$themesw = "UPDATE `settings` SET `theme` = '$themeswitch';";
	mysql_query($themesw) or die(mysql_error());
	header("Location: themes.php?act=success");
}

if($_POST['themedel']){
	$theme = $_POST['themeswitch'];
	remove_directory("../cache/skin/$theme");
}

if(isset($userTitle)){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Themes &mdash; <?= "$siteName";?> | OpenSerene</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css" media="all">@import "global.css";</style>
</head>
<div id="header">
	<?php echo "$siteName"; ?>
</div>
<div id="nav">
	<a href="index.php">Dashboard</a>
	<a href="submit.php">Write</a>
	<a href="themes.php" class="active">Appearance</a>
	<a href="users.php">User Management</a>
</div>
<div id="subnav">
	<a href="http://github.com/vicegirls/OpenSerene">Find Themes</a>
</div>
<div id="container">
	<h1 class="section">Manage Appearance</h1>
	<?php if($_GET['act'] == "success") { ?>
	<div class="sectionBox">
		<h2 class="alert">Theme Managed Successfully!</h2>
	</div>
	<?php } if($_GET['act'] == "fail") { ?>
	<div class="sectionBox">
		<h2 class="alert">Theme Action Failed!</h2>
	</div>
	<?php } ?>
	<div class="sectionBox">
		<h2 class="subsect">change theme</h2>
		<form action="themes.php" method="post">
			<select name="themeswitch" style="width: 150px;">
			<option style="border-bottom: 1px dashed #444; background: #FCFCFC; margin-bottom: 5px;"><?php echo "$cTheme"; ?></option>
			<?php
			if(is_dir($dir)) {
				foreach(glob("../cache/skin/*") as $theme) {
					if(($theme != ".") and ($theme != "..") and ($theme != "../cache/skin/index.html")){
						$fixed1 = str_replace("../cache/skin/","","$theme");
						echo("<option value=\"$fixed1\">$fixed1</option>");
					}
				}
			}
			?>
			</select>
			<input type="submit" value="Change Theme" class="submit" name="themechange" />
			<input type="submit" value="Delete Theme" name="themedel" class="submit" />
		</form>
	</div>
	<div class="sectionBox">
		<h2 class="subsect">theme information</h2>
		<?php 
		if(is_dir($cThemeDir)){
			foreach(glob("../cache/skin/*") as $skins)
			{
				if(is_dir($skins))
				{
					$screenshot = "$skins/screenshot.png";
					$aboutxml = "$skins/about.xml";
						echo "<div class=\"themeInfo\">";
						echo "<table>";
						echo "<tr>";
						echo "<td valign=\"top\">";
						if(file_exists($screenshot)){
							echo "<img src=\"$screenshot\" class=\"screenshot\" alt=\"\" />";
						} else {
							echo "<img src=\"images/no_screen.png\" class=\"screenshot\" alt=\"\" />";
						}
						echo "<div><a href=\"editor.php?dir=$skins/header.php\"><img src=\"images/edittheme.gif\" alt=\"\" /></a></div>";
						echo "</td>";
						echo "<td valign=\"top\">";
						echo "<div class=\"about\">";
						if(file_exists($aboutxml)){
							include("$aboutxml");
						} else {
							echo "No about file found.";
						}
						echo "</div>";
						echo "</td>";
						echo "</tr>";
						echo "</table>";
					echo "</div>";
				}
			}
		} ?>
	</div>
</div>
<div id="footer">
	POWERED BY <a href="http://github.com/vicegirls/OpenSerene">OPENSERENE</a><br />
	<a href="http://vicegirls.us">A VICEGIRLS JOINT</a>
</div>
</body>
</html>
<?php 	} else if(!isset($userTitle)) {
		header("Location: login.php");
} ?>