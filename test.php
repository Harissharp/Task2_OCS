<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  #src: https://www.tutorialspoint.com/how-to-display-errors-in-php-file#:~:text=The%20quickest%20way%20to%20display,configuration%20found%20in%20your%20php

include 'functions.php';

echo " This Page is for testing fucntions and other modules";
echo "<br>";
/*
$answer=CanUserBuyCheck(200,500);
var_dump($answer);

echo $answer[0];

if ($answer[0]==True) {
	echo $answer[1];
}
*/
$test="Hello/";
$result=sanitize_vars($test);
echo $result;

?>
