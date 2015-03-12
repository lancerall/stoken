<?php

if (isset($_POST["username"])) $username=$_POST["username"];
if (isset($_POST["password"])) $password=$_POST["password"];
if (isset($_POST["pin"])) $pin=$_POST["pin"];
$outputFile="output/".$username.".txt";

print "Username: ".$username."<br />";
print "Password: ".$password."<br />";
print "PIN: ".$pin."<br />";

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "OK";
    } else {
        echo "Not ok.";
    }

$out=shell_exec("java -jar TokenConverter.jar $target_file -p $password -o $outputFile");

$out.=shell_exec("stoken import --token=$(cat output/$username.txt) --rcfile=/var/www/html/stoken/output/$username.stokenrc -p $password --new-password= ");
$out.=shell_exec("stoken setpin --new-pin=$pin --rcfile=/var/www/html/stoken/output/$username.stokenrc");

echo $out;

// $out=shell_exec("stoken import --file=");
// $out=shell_exec("stoken setpin");
// $out=shell_exec("stoken setpass");

?>