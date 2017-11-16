<?php


$conn = mysql_connect("localhost", "avtovod", "1234");
$sel = mysql_select_db("database");
mysql_set_charset("utf8");

if (!$conn || !$sel)
{
	exit(mysql_error());
}


?>