<?php
	session_start();
	if( !isset($_SESSION["user_id"]) ){
		session_unset();
   	session_destroy();
   	header("location:user_login.php?status=3"); //Un-Authorised Access Attempt
   	exit();
	}

	$user_id = $_SESSION["user_id"] ;	  
	define("DB_SERVER",  'localhost:3306') ;
	define("DB_DATABASE",  'imca_practice') ;
	define("DB_USER",  'practice') ;
	define("DB_PASSWORD",  'imca123') ; 
	// Create connection
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if ( !$conn ) {
	    die("Connection failed: " . $conn->connect_error() );
	}
	   // sql to SELECT from table
	$sql_query = "SELECT `user_name`, `user_type`, `birth_date`, `gender`, `address`, `email`, `contact1`, `user_id` FROM `user_profile` WHERE user_id='" . $user_id . "'";	
	$result = $conn->query($sql_query); //Returns the result set
	$user_data = array();
	if ($result->num_rows > 0) {
	 	while($row = $result->fetch_assoc()) {
     		$user_data[]=$row['user_name'];
     		$user_data[]=$row['user_type'];
     		$user_data[]=$row['birth_date'];
     		$user_data[]=$row['gender'];
     		$user_data[]=$row['address'];
     		$user_data[]=$row['email'];
     		$user_data[]=$row['contact1'];
     		$user_data[]=$row['user_id'];
  		}
	}
	else{
	  	$status=1;//LOGIN FAILED
	}
	$result->free_result();  //Free the result set
   	$conn->close();	//Closes connection
?>

<!DOCTYPE HTML>  
<html>
<head>
  <title>User Profile Update</title>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>  
  <p style="text-align:left;color:red;font-weight:bold; background-color:aqua;font-size:larger;">User profile Update: <?php echo  "<span style='color:blue;'>[$user_data[7]] </span>";?></p> 
  <form method="post" action="user_profile_edit_action.php">       
      User Name: <input type="text" name="user_name" value="<?php echo $user_data[0];?>" readonly>  
      <br><br>   
      User Type: <input type="text" name="user_type" value="<?php echo $user_data[1];?>" readonly>
      <br><br> 
      Birth Date<span class="error">(*) </span>: <input type="date" name="birth_date" value="<?php echo $user_data[2];?>" >
      <br><br> 
      Gender:  <input type="text" name="gender" value="<?php echo $user_data[3];?>" readonly>
      <br /><br />
      
      Address<span class="error">(*) </span>: <input type="text" name="address" value="<?php echo $user_data[4];?>" required>  
      <br><br>      
      Email<span class="error">(*) </span>: <input type="text" name="email" value="<?php echo $user_data[5];?>" required>  
      <br><br>
      Contact No<span class="error">(*) </span>: <input type="text" name="contact1" value="<?php echo $user_data[6];?>" >  
      <br><br>           
      <a href="./welcome.php">[Back]</a>&nbsp;&nbsp;<input type="submit" name="edit_profile" value="Update Profile">      
  </form>  
</body>
</html>