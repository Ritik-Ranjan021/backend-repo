<?php
	session_start();
	if( !isset($_SESSION["user_id"]) ){
		session_unset();
   	  	session_destroy();
   	  	header("location:user_login.php?status=3"); //Un-Authorised Access Attempt
   	  	exit();
	}

	if( isset($_POST["edit_profile"]) ){//if submit button clicked	 
		//FETCH FORM DATA HERE	
		$user_id = $_SESSION["user_id"]	;
		$birth_date =trim( $_POST["birth_date"] );			
		$contact1 = trim( $_POST["contact1"] );
		$address = trim( $_POST["address"] );
		$email = trim( $_POST["email"] );		
	//SET DATABASE PARAMETERS
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
	    $conn->autocommit(FALSE);  // Sets Autu-commit OFF
	     $sql = "UPDATE `user_profile` SET `birth_date`='". $birth_date ."',`address`='". $address . "',`email`='". $email ."',`contact1`=". $contact1 ." WHERE user_id='" . $user_id . "'";  
	    if( !$conn->query($sql) ) // IF any ERROR, when DATABASE INSERT OPERATION
	    {
	     die("Error UPDATING record : " . $conn->error . "<br />");
	    }   
	    $rows = $conn->affected_rows;      
	    $conn->commit();  // Saves Database action permanently
	   //Closes connection
	    $conn->close(); 
	    if($rows==1){
	   		header("location:welcome.php?status=4"); //USER PROFILE UPDATEd SUCCESSFULLY
	    }
	    else{
	   		header("location:welcome.php?status=5"); //USER PROFILE UPDATEd FAILS
	    }   
	    exit();
    }

?>