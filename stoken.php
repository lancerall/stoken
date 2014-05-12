<?php
// Usage: stoken.php?username=lrall&token=abc12300000...

$token = "";
$username = "";

if (isset($_GET["token"]) && !isset($_GET["username"])) die("Token was provided but username not present.");
if (!isset($_GET["token"]) && isset($_GET["username"])) die("Username was provided but token not present.");
if (isset($token) && isset($username)) {
	$token = $_GET["token"];
	$username = $_GET["username"];
}

if ($token) $command = "stoken --token=".$token;
else $command = "stoken --rcfile=/var/www/.stokenrc";

$current_code = exec($command);

if ($username) $file = '/var/www/'.$username.'.txt';
else $file = '/var/www/lastRSA.txt';

if (file_exists($file)) $file_code = file_get_contents($file);
else $file_code="";

if (isset($_GET["debug"])) echo "current code: $current_code <br>\n file code: $file_code \n<br />";
while($current_code == $file_code){
	if (isset($_GET["debug"])) echo "<br>sleeping....\n<br />";
	sleep(2);
	$current_code = exec($command);
	$file_code = file_get_contents($file);
	if (isset($_GET["debug"])) echo "current code: $current_code <br>\n file code: $file_code <br>\n";
}
if (isset($_GET["debug"])) echo "<br>\nreturning a code: ";
file_put_contents($file, $current_code);
echo $current_code;
?>
