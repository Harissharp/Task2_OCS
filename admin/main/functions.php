<?php

//Setting up a connection
/*useage {
  $conn=setupconnection_sqli();
}
*/

#INPUT: Varible  you want santizing 
#OUTPUT:result-Array: True/False[0],Var[1]
#Notes: The code returns the newly santize varible within the array in postion [1],
# TRUE= It has been sanitized; changes was made || 
#FALSE= Changes wasnt made , it was already sanitized or acceptable 

function sanitize_vars($var){
  $result = array();#initalizing array to store values in
  $new_var=htmlspecialchars($var);#HTML special charater santizing to make sure any html injections or  SQL fail to work 
  trim($new_var, ' /\|><.,:@~#:;{}[]()!`¬-'); # Ensuring removal of harmful characters.

  if ($var == $new_var) {
    array_push($result,False); #if they are the same after sanitzation: add False TO array 
  }
  else{                         #if it is diffrent: add True TO array
    array_push($result,True);
  }
  array_push($result,$new_var);
  return $result; # Returns the array back to user 
}

function setupconnection_sqli(){
  $servername = "localhost";
  $username = "119019";
  $password = "saltaire"; //Database details
  $dbname = "119019";
  $conn =mysqli_connect($servername,$username,$password,$dbname); // connceting to server 

  return $conn;// returns conn as its needed for testconnection_sqli()
}

#Input: SQL statment
#Output:Error Messages OR $stmt( return)
#Notes: $stmt contains the results of the query
#Errors will automatically echo
function setupconnection_PDO($sql){
  $host = "localhost";
  $username = "119019";
  $password = "saltaire"; #Database details
  $dbname = "119019";
  $dsn = "mysql:host=$host;dbname=$dbname"; 

  try{ // tests the connections
      $pdo = new PDO($dsn, $username, $password);
      $stmt = $pdo->query($sql); # Testing connection
      return $stmt;
       
      if($stmt === false){
        die("Error");
      }
       
    }catch (PDOException $e){
      echo $e->getMessage();
    }

                  
}


//tests the connection to see if it did succseed in connecting to database.
//returns error message if not.
#INPUT: your previous connection made by setupconnection_sqli()
#Output: Error it faces
#Notes: Mainly used for testing purposes 
function testconnection_sqli($conn){
  if (!$conn){
    die("Connection failed:".mysqli_connect_error());
  }

}
#INPUT: User ID and New ammount of points 
#OUTPUT: Error message or saying its been done 
#Notes:This doesnt not add onto existing. It simply overwrites the existing 

function  UpdateUserPoints($user_id,$new_points){
  $conn=setupconnection_sqli(); // connection details and connects us 
  testconnection_sqli($conn); // if theres an issue with connection this will report it 

  $sql = "UPDATE gibt_user_points SET Points_num = '$new_points' WHERE ID = $user_id;";# SQL line

  if (mysqli_query($conn, $sql)) {# Tests the qury and if it works: Record updated othweise  error is displayed
    $result = "Points have been updated";
  } else {
    $result ="Error updating record: " . mysqli_error($conn);
  }
  return $result;
  mysqli_close($conn); 

}
#INPUT: User_id *from session, current score , how many points are being awarded for the  activity
#OUTPUT:Will update the score by adding  points awarded to the score 
#NOTES: returns a message to say if it worked or not 
function UpdateUserScore($user_id,$current_score,$points_reward){
  $new_score=$current_score +$points_reward;

  $conn=setupconnection_sqli(); // connection details and connects us 
  testconnection_sqli($conn); // if theres an issue with connection this will report it 

  $sql = "UPDATE gibt_user_points SET Score = '$new_score' WHERE ID = $user_id;";# SQL line

  if (mysqli_query($conn, $sql)) {# Tests the qury and if it works: Record updated otherwise  error is displayed
    $result = "score have been updated";
  } else {
    $result = "Error updating record: " . mysqli_error($conn);
  }
  return $result;
  mysqli_close($conn); 
}

#INPUT: User_ID *from session 
#OUTPUT: Updates all the session vars to latests * according to database 
#Notes: 

/* admin page exclusive functions */

#Input: Null
#Output: Total Number of students Signed up 
#Notes: Uses SQLI connection method and is within function 
function total_students(){
  $sql="SELECT ID FROM gibt_user_logins;"; # SQL statment desgined to count number of entires in a DB.
  $conn=setupconnection_sqli();# Establish connection to the  database 
  testconnection_sqli($conn); # Tests the connection so any errors can be reported

  $result=mysqli_query($conn, $sql);

  $total= 0;
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $total += 1; # for each row  +1
  }

  mysqli_close($conn); 
  return $total;
}
  
#END TOTAL USERS 

#Input: Null
#Output: Total Number of points across all students 
#Notes: Uses SQLI connection method and is within function 
function total_points(){
  $sql = "SELECT * FROM gibt_user_points";
  $conn=setupconnection_sqli();
  testconnection_sqli($conn);

  $result = mysqli_query($conn,$sql);

  $total= 0;
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $total += $row['Points_num'];
  }
  return $total;
}

?>