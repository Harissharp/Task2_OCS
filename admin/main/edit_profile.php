<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); 
include 'functions.php'; //Importing all the functions ive made 

?> 

<?php 
#Firstly i need to  POST the data to thuis form and make sure its sanitized and valid before entering the database 

$id=$_POST['ID'];
$u_password=$_POST['u_password'];
$u_username=$_POST['name'];
$nickname=$_POST['nickname'];
$points=$_POST['points'];
$add_points=$_POST['add_points'];
$score=$_POST['score'];



#checking if the data is valid or not ( sanatizing)
$san_id=sanitize_vars($id);
$san_u_password=sanitize_vars($u_password);#san= sanatized
$san_u_username=sanitize_vars($u_username);
$san_nickname=sanitize_vars($nickname);
$san_points=sanitize_vars($points);
$san_add=sanitize_vars($add_points);
$san_score=sanitize_vars($score);

#checks all varaibles  at once using OR ( also usable as  || )
if ($san_u_username[0] == True ||$san_u_password[0] == True ||$san_id[0] == True ||$san_nickname[0] == True ||$san_points[0] == True ||$san_add[0] == True) {
  echo"check-1";
  $_SESSION['error']="The values entered contain illegal characters. Please keep to standard letters and numbers";
}else{
  echo "check-2";

  $new_score=$san_score[1] + $san_add[1];
  $new_points=$san_points[1]+$san_add[1];
  # The check for invalid inputs have been done making the inputs safe to work with. We can now move onto the SQL 
  # List of tables that effect Students. 
  #There can be multile instances so having all instances changes makes it  
  #much easier to manage and keep consistent. 

  /* User Login changes */
  $sql = "UPDATE gibt_user_logins SET Username = '$san_u_username[1]', Password= '$san_u_password[1]', Nickname = '$san_nickname[1]' WHERE ID = '$id';";
  $stmt=setupconnection_PDO($sql);
  $stmt->connection = null;
  echo"Change on table logins is done";

  /*  Login changes */
  $time=date('d F, Y (l)');
  $sql = "UPDATE gibt_user_points SET Username = '$san_u_username[1]', Score= '$new_score', Points_num = '$new_points' WHERE ID = '$id';";
  $stmt=setupconnection_PDO($sql);
  echo"Change on table Points is done";

  header("Location: index.php");
}
?>