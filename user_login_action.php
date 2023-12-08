<?php
	session_start();
	//DATABASE OPERATION
	if( isset($_POST["sign_in"]) )	//if submit button clicked
	{  
	  $user_id = trim( $_POST["user_id"] );
	  $user_pass =  trim( $_POST["user_pass"] );	  
	  include_once('my_php_library/dbconf.php');
	// Create connection
	   $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	// Check connection
	   if ( !$conn ) {
	       die("Connection failed: " . $conn->connect_error() );
	   }
	   // sql to SELECT from table
	   $sql_query = "SELECT user_name,user_id,user_pass,user_type,photo FROM user_profile where user_id='".$user_id."'";

	  $result = $conn->query($sql_query); //Returns the result set
	  if ($result->num_rows > 0) {
	  	while($row = $result->fetch_assoc()) {
     		if( password_verify($user_pass, $row['user_pass']) == true){  			
     			$user_name= $row['user_name'] ;
     			$user_type= $row['user_type'];
          		$photo = $row['photo'];
     			$status=0;//LOGIN SUCCESS
          
     		} 
     		else{
     			$status=1;//LOGIN FAILED
      
     		}
  		}
	  }
	  else{
	  	$status=1;//LOGIN FAILED
      
	  }
	  $result->free_result();  //Free the result set
   	  $conn->close();	//Closes connection

   	  if($status==0){
   	  	
   	  	$_SESSION["user_name"] = $user_name ;
   	  	$_SESSION["user_type"] = $user_type ;
   	  	$_SESSION["user_id"]   = $user_id  ;
   	  	$_SESSION["photo"]   = $photo  ; 	  	
        
        header("location:welcome.php?status=0");		 
   	  	exit();
   	  }
   	  else{
   	  	session_unset();
   	  	session_destroy();
   	  	header("location:user_login.php?status=1"); //Invalid User or Password 
   	  	exit();
   	  }
   	  
	}
?>