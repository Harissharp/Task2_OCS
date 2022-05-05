<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  #src: https://www.tutorialspoint.com/how-to-display-errors-in-php-file#:~:text=The%20quickest%20way%20to%20display,configuration%20found%20in%20your%20php


/*starting session and importaning function.php */
session_start();
include 'functions.php';

/*    ---------TEST DATA -------------
#setting session vars
$_SESSION["User_id"] = "1";
$_SESSION["User_name"] = "Haris";
$_SESSION["User_points"] = "500";
$_SESSION["User_score"] = "1500";
$_SESSION["Nickname"] = "Music";
 ----------Test data End ------------*/
 UpdateSessionVars($_SESSION['ID']); # Updates the session vars 

#---------MAIN----------------
$item_name = $_POST['item_name'];
$price = $_POST['Price'];

$result_can_user=CanUserBuyCheck($price,$_SESSION['User_points']); # stores if the user can buy the item or not

if ($result_can_user[0]==True) {
	$return_updatePoints=UpdateUserPoints($_SESSION['User_id'],$result_can_user[1]); # Takes user ID from the  session var , the 1 index holds the already subtracted and newly calcated points
	$_SESSION["Buy_returnMessage"]="The Purchase has been made. <br> Your new points ammount is:".$return_updatePoints;
	header("Location: shop.php");
}else{
	$_SESSION["Buy_returnMessage"]="You do not have enough Points <br> You have:".$_SESSION['User_points'];
	header("Location: shop.php");
}


#---------END MAIN----------------
?>