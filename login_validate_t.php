<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  #src: https://www.tutorialspoint.com/how-to-display-errors-in-php-file#:~:text=The%20quickest%20way%20to%20display,configuration%20found%20in%20your%20php
session_start();
include 'functions.php';//Importing all the functions ive made 


$u_password=$_POST['u_password'];# posting over the data to be checked
$u_username=$_POST['u_username'];

#checking if the data is valid or not ( sanatizing)
$san_u_password=sanitize_vars($u_password);#san= sanatized
$san_u_username=sanitize_vars($u_username);

if ($san_u_username[0] == True ||$san_u_password[0] == True) {
  echo"check-1";
  $_SESSION['error']="The values entered contain illegal characters. Please keep to standard letters and numbers";

}else{
  echo "check-2";

  $sql = "SELECT * FROM gibt_admin_logins;";
  $stmt=setupconnection_PDO($sql);
  var_dump($stmt);

  echo"<br> <p> From san </p>";
  echo $san_u_password[1];
  echo $san_u_username[1];
  echo"<br> ";

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    #Testing
    echo"<br> <p> From databse </p>";
    echo $row['ID'];
    var_dump($row['Username']) ;
    var_dump($row['Password']) ;
    echo"<br> ";


    if($row['Username']==$san_u_username[1] AND $row['Password']==$san_u_password[1]){
      $id=$row['ID'];
      $_SESSION['ID']=$id;

      header("Location: /shipley/119019/A_OCS_Tutoring/mentor/admin/main/");
      exit();
    }else {
    $_SESSION['error']="Login Not Found, Please try again";
    echo $_SESSION['error'];
    header("Location: login.php");
    exit();

    }
  }

  
}
?>