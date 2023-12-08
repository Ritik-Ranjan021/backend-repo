<!DOCTYPE HTML>  
<html>
<head>
  <title>User LogIn</title>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>  
  <h2>User Log-In</h2>
  <p><span class="error">* required field</span></p>
  <form method="post" action="user_login_action.php">
  	User ID: <input type="text" name="user_id" value="" required>
    <br><br>      
    Password: <input type="password" name="user_pass" value="" required>
    <br><br>  
    
    <input type="submit" name="sign_in" value="Sign-In">  
</form>
<p> New User? <a href="./user_signup.php">Register</a></p>
<p> <a href="./forgot_password.php">Forgot Password</a></p>

<?php
  if(isset($_REQUEST["status"])){
    if($_REQUEST["status"]==1){
      $msg='<p style="color:red;">Invalid User Name or Password!!!</p>';
    }
    else if($_REQUEST["status"]==2){
      $msg='<p style="color:green;">User Loged-Out Successfully...</p>';
    }   
    else if($_REQUEST["status"]==3){
      $msg='<p style="color:red;">Un-Authorised Access Attempt!!!</p>';
    }
    echo $msg;
  }
?>
</body>
</html>