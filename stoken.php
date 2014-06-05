<?php
// Usage: stoken.php?username=lrall&token=abc12300000&pin=123&debug

$file_root = "/var/www/stoken/";
$default_tokenrc = "/var/www/.stokenrc";

$token = "";
$username = "";
$pin = "";

$debug = false;

if (isset($_GET["debug"])) $debug=true;

if ( isset($_GET["username"]) || isset($_GET["token"]) || isset($_GET["pin"]) )
{
	if (!isset($_GET["username"])) die("Username not present.");
	if (!isset($_GET["token"])) die("Token not present.");
	if (!isset($_GET["pin"])) die("Pin not present.");
	
	if ($_GET["token"] == "null") die("Cannot accept null.");
	if ($_GET["pin"] == "null") die("Cannot accept null.")

	$token = $_GET["token"];
	$username = $_GET["username"];
	$pin = $_GET["pin"];

	if ($debug) echo "Token: $token<br />Username: $username<br />Pin: $pin<br />";
}

if ($token) $command = "echo ".$pin." | stoken --token=".$token." --stdin";
else $command = "stoken --rcfile=".$default_tokenrc;

if ($debug) echo $command."<br />";

$current_code = exec($command);

if (!$username) $username = "lastRSA";
$file = $file_root.$username.'.txt';

if ($debug) echo "File: $file<br />";

if (file_exists($file)) $file_code = file_get_contents($file);
else $file_code="";

if ($debug) echo "current code: ".md5($current_code)." <br>\n file code: $file_code \n<br />";

while(md5($current_code) == $file_code){
	if ($debug) echo "<br>sleeping....\n<br />";
	sleep(2);
	$current_code = exec($command);
	$file_code = file_get_contents($file);
	if ($debug) echo "current code: ".md5($current_code)." <br>\n file code: $file_code <br>\n";
}

file_put_contents($file, md5($current_code));
if ($debug) echo "Writing ".md5($current_code)." to ".$file."<br />\n";
if ($debug) echo "returning a code: ";

echo $current_code;

?>
