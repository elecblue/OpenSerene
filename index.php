<?php

// SereneCMS
// Atriotic, LLC
// General Index File

require("engine/config.inc.php");
require("engine/function.inc.php");
require("engine/template.inc.php");

include("engine/dbconnect.php");

$themeQuery = mysql_query("SELECT * FROM settings");
$tArray = mysql_fetch_array($themeQuery);
$themedir = $tArray['theme'];

include("cache/skin/$themedir/header.php");

serene_post("b","p");

echo "<a href=\"news.php\">Archives</a>";

include("cache/skin/$themedir/footer.php");
?>