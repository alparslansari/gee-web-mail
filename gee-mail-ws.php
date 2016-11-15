<?php
$opmode = $_GET["opmode"];
$username = $_GET["username"];
$password = $_GET["password"];
//print_r($_GET);
$out = array();
//echo exec("./gee-mail-ws 11 22");

exec("./gee-mail-ws $opmode $username $password",$out,$retv);
print_r($out);
echo "ReturnV=".$retv;
?>

