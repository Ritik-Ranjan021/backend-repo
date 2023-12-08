<?php
  include_once('my_php_library/dbconf.php');

if( isset($_POST["sign_up"]) )	//if SIGN_UP button is clicked
{  
	//FETCH FORM DATA HERE
	$user_name = trim( $_POST["user_name"] );
	$user_type = trim( $_POST["user_type"] );
	$birth_date =trim( $_POST["birth_date"] );
	if(!empty($_POST["gender"])){   /* IF SELECTED*/
		$gender = $_POST["gender"] ;
	}	
	$contact1 = trim( $_POST["contact1"] );
	$address = trim( $_POST["address"] );
	$email = trim( $_POST["email"] );
	$user_id = trim( $_POST["user_id"] );
	$user_pass = password_hash( trim( $_POST["user_pass"] ) ,PASSWORD_DEFAULT);

  if( isset($_FILES["image"]) && !empty($_FILES["image"]["name"]) ){      
      //GETTING FILE ATTRIBUTES
      $file_name = $_FILES['image']['name'];
      $file_tmp  = $_FILES['image']['tmp_name'];
      $file_size = $_FILES['image']['size'];
      $mime_type = $_FILES['image']['type'];       
      $error = false;
      //EXTRACTING FILE EXTENSION
      $split_file = explode(".", $file_name) ;
      $file_ext = strtolower(end($split_file));
      //CREATING ARRAY OF PERMITTED FILE EXTENSIONS
      $allowed_ext = array('jpeg', 'jpg', 'png');  //Allowed file extensions      
      //IF, FILE EXTENSION IS NEITHER jpeg NOR jpg NOR png
      if( in_array($file_ext, $allowed_ext) === false){   header("location:user_signup.php?status=InvalidFileType!!!");  exit(); }
      //IF, FILE-SIZE MORE THAN 2MB
      if($file_size > (2048*1024)){   header("location:user_signup.php?status=TooBigFileSize!!!");  exit(); } 
      //SETTING FILE UPLOAD PATH IN SERVER
      $file_uploaded_path = "IMAGES/" . $user_id . "." . $file_ext ;      
      if( !file_exists($file_uploaded_path)){
          if( !move_uploaded_file($file_tmp, $file_uploaded_path) ){  header("location:user_signup.php?status=FileUploadIssue!!!");  exit();  }    
      }
      else{  header("location:user_signup.php?status=FileAlreadyExists!!!");  exit();  }      
  } 
  else{
    //SETTING FILE UPLOAD PATH for Blank profile IN SERVER
      $file_uploaded_path = "IMAGES/no_profile.png"  ;  
  }

  // Create connection
   $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
  // Check connection
   if ( !$conn ) {
       die("Connection failed: " . $conn->connect_error() );
   }
   $conn->autocommit(FALSE);  // Sets Autu-commit OFF  

   $sql = "INSERT INTO `user_profile`(`user_name`, `user_type`, `birth_date`, `gender`, `address`, `email`, `contact1`, `user_id`, `user_pass`, `photo`) VALUES ('".$user_name."','".$user_type."','".$birth_date."','".$gender."','".$address."','".$email."',".$contact1.",'".$user_id."','".$user_pass . "','" . $file_uploaded_path  ."')";  
   
   if( !$conn->query($sql) ) // IF any ERROR, when DATABASE INSERT OPERATION
   {
     die("Error INSERTING record : " . $conn->error . "<br />");
   }   

   $rows = $conn->affected_rows;      
   $conn->commit();  // Saves Database action permanently
   //Closes connection
   $conn->close(); 
   if($rows!=0){
   	header("location:user_signup.php?status=0"); //SUCCESS
   }
   else{
   	header("location:user_signup.php?status=1"); //TECHNICAL ISSUE
   }   
   exit();
   
   
}
 
?>