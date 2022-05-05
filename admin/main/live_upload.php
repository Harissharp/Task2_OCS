<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); 
include 'functions.php'; //Importing all the functions ive made 

?> 

<?php 
#Firstly i need to  POST the data to thuis form and make sure its sanitized and valid before entering the database 


$u_username=$_POST['name'];
$link=$_POST['link']; # this will no be santized as it requires 'illegal charaters'

echo $u_username;
echo $link;


#checking if the data is valid or not ( sanatizing)
$san_u_username=sanitize_vars($u_username);
if ($san_u_username[0] == True) {
  echo"check-1";
  $_SESSION['error']="The values entered contain illegal characters. Please keep to standard letters and numbers";
}else{
  echo "check-2";

  try{
    $sql = "INSERT INTO gibt_task_list_teacher (Task_Name, Description, Task_link, Type ,Teacher_name) VALUES ('$san_u_username[1]','NULL','$link', 'NULL', '$san_u_username[1]')";
    // use exec() because no results are returned

    echo "<br>".$sql."<br>";

    setupconnection_PDO($sql);
    echo "Inserted successfully";
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  #Inserting into table
}
header("Location: index.php");
?>
