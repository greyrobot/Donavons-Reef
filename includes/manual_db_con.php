<?php
$con = mysql_connect("localhost", "root");
if (!$con) die("Cannot Connect to DB: ".mysql_error());
mysql_select_db("donavonsreefdb", $con) or die(mysql_error());
?>