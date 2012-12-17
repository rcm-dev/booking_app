<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_bookingAppCon = "localhost";
$database_bookingAppCon = "amannagappa";
$username_bookingAppCon = "root";
$password_bookingAppCon = "";
$bookingAppCon = mysql_pconnect($hostname_bookingAppCon, $username_bookingAppCon, $password_bookingAppCon) or trigger_error(mysql_error(),E_USER_ERROR); 
?>