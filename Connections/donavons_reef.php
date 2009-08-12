<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_donavons_reef = "localhost";
$database_donavons_reef = "donavonsreefdb";
$username_donavons_reef = "root";
$password_donavons_reef = "";
$donavons_reef = mysql_pconnect($hostname_donavons_reef, $username_donavons_reef, $password_donavons_reef) or trigger_error(mysql_error(),E_USER_ERROR); 
?>