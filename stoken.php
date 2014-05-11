<?php
$current_code = exec("stoken --rcfile=/var/www/.stokenrc");
#echo "<br>";
#echo "\n";
$file = '/var/www/lastRSA.txt';
$file_code = file_get_contents($file);
#echo "current code: $current_code <br>\n file code: $file_code";
while($current_code == $file_code){
 #  echo "<br>sleeping....";
   sleep(2);
   $current_code = exec("stoken --rcfile=/var/www/.stokenrc");
 #  echo "<br>";
 #  echo "\n";   
   $file_code = file_get_contents($file);
 #  echo "current code: $current_code <br>\n file code: $file_code <br>\n";
}
#echo "<br>\nreturning a code: ";
file_put_contents($file, $current_code);
echo $current_code;
?>
