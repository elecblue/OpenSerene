<?

/*

	OpenSerene
	
	Version: 0.1.0 (Bender)
	
	File: engine/function.inc.php
	
*/

require("config.inc.php");
include("dbconnect.php");

//This function generates HTML out of BBCode, without this, you cannot use BBCode!
function bbcode($string)
{
	$BBCode = array(
			"&" => "&amp;",
			"<" => "&lt;",
			">" => "&gt;",
			"[b]" => "<b>",
			"[/b]" => "</b>",
			"[i]" => "<i>",
			"[/i]" => "</i>",
			"[u]" => "<u>",
			"[/u]" => "</u>",
			"[img]" => "<img src='",
			"[/img]" => "' />");
	$parsedtext = str_replace(array_keys($BBCode), array_values($BBCode), $string);
return $parsedtext;
} 

//This function tranforms \n into <br /> for validity and style. This is designed for PHP4, and is not used in PHP5.
function nl2br_skip_html($string)
{
	$BBCode = array(
			"&" => "&amp;",
			"<" => "&lt;",
			">" => "&gt;",
			"[b]" => "<b>",
			"[/b]" => "</b>",
			"[i]" => "<i>",
			"[/i]" => "</i>",
			"[u]" => "<u>",
			"[/u]" => "</u>",
			"[img]" => "<img src='",
			"[/img]" => "' />");
			
   // remove any carriage returns (mysql)
   $string = str_replace("\r", '', $string);

   // replace any newlines that aren't preceded by a > with a <br />
   $string = preg_replace('/(?<!>)\n/', "<br />\n", $string);
   
   //Strip the Slashes of Message Content
   $string = stripslashes($string);

   return $string;
}

function remove_directory($dir) {
	if ($handle = opendir("$dir")) {
		while (false !== ($item = readdir($handle))) {
		    if ($item != "." && $item != "..") {
				if (is_dir("$dir/$item")) {
					remove_directory("$dir/$item");
				} else {
					unlink("$dir/$item");
					echo "removing $dir/$item<br>\n";
				}
		    }
	    }
    closedir($handle);
    rmdir($dir);
    header("Location: themes.php?act=success");
   }
}

?>
