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


#INPUT: Array + value  /// value = what your looking for('hello',7,True etc)
#OUTPUT: the ammount of Value there was within the Array
#NOTES: 
function num_in_array($array,$search) {
  $total=0;
  foreach ($array as $i) { // itterates over each value within array and checks it against the search value  
    if ($i == $search){
      $total=$total+1;// if the check is match the total increments 
    }
  }
  return $total;
}

#INPUT: Item Price and Users current value
#OUTPUT:IF the user can afford it as well as what new balance will be 
#OUTPUT ARRAY IN TRUE EVENT:  True[0], New Points[1]
#OUTPUT ARRAY IN FALSE EVENT: False[0]
#Notes:True or False is to indicate wether or not to proceed with updating/ buying proceedure 
function CanUserBuyCheck($item_price,$user_balance){
  $results=array(); 
  if ($item_price <= $user_balance ) {
    array_push( $results  , True);
    $new_points=$user_balance - $item_price ;
    array_push( $results  , $new_points );
  }
  else{
    array_push( $results  , False);
  }
  return  $results ;
}

#INPUT: User ID and New ammount of points 
#OUTPUT: Error message or saying its been done 
#Notes:

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
function UpdateSessionVars($user_id){
  $sql = "SELECT * FROM gibt_user_points WHERE ID = '$user_id';";# SQL line
  $stmt=setupconnection_PDO($sql);

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $_SESSION["User_name"] = $row['Username'];
    $_SESSION["User_points"] = $row['Points_num'];
    $_SESSION["User_score"] = $row['Score'];
  }

  $sql = "SELECT * FROM gibt_user_logins WHERE ID = '$user_id';";# SQL line
  $stmt=setupconnection_PDO($sql);
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $_SESSION["Nickname"] = $row['Nickname'];;
  }
}

?>