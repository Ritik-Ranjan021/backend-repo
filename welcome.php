<?php
	session_start();
	if( !isset($_SESSION["user_id"]) ){
		session_unset();
   	  	session_destroy();
   	  	header("location:user_login.php?status=3"); //Un-Authorised Access Attempt
   	  	exit();
	}
	if(isset($_REQUEST["status"])){
	    if($_REQUEST["status"]==4){
	      $msg='<p style="color:green;">User Profile Updated Successfully...</p>';
	    }
	    else if($_REQUEST["status"]==5){
	      $msg='<p style="color:red;">User Profile Updated FAiled!!!</p>';
	    }   	    
	   
  	}
	
?>

<!DOCTYPE HTML>  
<html>
<head>
  <title>User home</title>
  <style>
  .error {color: #FF0000;}
  .box-model{ 
      border: 2px solid  red;   
      width: 100px;
      height: 100px;      
    }
    img{
      height: 100%;
      width: auto;      
    }
  </style>
</head>
<body>  
	<?php
		if(isset($msg)){
			echo "<p>$msg</p>";
		}

		echo '<div class="box-model"> 
			<img src="'. $_SESSION["photo"]  .'" alt="">
		</div>';

		echo "<p style=\"text-align:right;color:red;text-decoration:bold; background-color:aqua;font-size:larger;\">Welcome ". $_SESSION["user_name"] . "  <a href=\"./user_logout_action.php\">[Log Out]</a>". "  <a href=\"./user_profile_edit.php\">[Edit Profile]</a>" ."</p>";

		
	?>

</body>
</html>	


