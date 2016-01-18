<?php

function connect()
{
	mysql_connect("localhost","root","");
	mysql_select_db("game");
}

function protect($string)
{
	return mysql_real_escape_string(strip_tags(addslashes($string)));
}
function output($string)
{
	echo "<div class=\"output\">".$string."</div>";
}
?>