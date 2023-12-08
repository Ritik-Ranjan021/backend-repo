<!DOCTYPE HTML>  
<html>
<head>
  <title>User Registration</title>
  <script >
    
    /*FUNCTION TO PREVIEW IMAGE ON BROWSE*/
    function showPreview(event){
      if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("image-preview");
        preview.src = src; 
        document.getElementById("info").innerHTML = event.target.files[0].name ;
      }
    }
  </script>

  <style>
    .error {color: #FF0000;}
    .lable-text{
      font-weight: bold;

    }

    .flex-model{
      width: 50%;
      height: 50%;
      border: 2px solid  black; 
      display: flex;
      flex-wrap: wrap;
      border-radius: 25px;

    }
    
    .box-model{ 
      border: 2px solid  red;   
      width: 200px;
      height: 200px;
      margin: 5px;
    }

    img{
      height: 100%;
      width: auto;      
    }
    .button{
      border: 2px solid green;
      background-color: black;
      color: white;
      border-radius: 5px;
    }

    .button:hover{
      background-color: blue;
      font-weight: bold;
    }

    
  </style>
</head>

<body> 
  <center><div><h2>User Registration </h2> </div></center>
  <center>
  <div class="flex-model">    
    <!--CHILD DIV#1 -->
    <div>      
      
      <form id="frmSignUp"  method="post" action="user_signup_action.php"  enctype="multipart/form-data">  
        <table> 
          <tr><td class="error" colspan="2" style="text-align:center;" ><i>(*) required field</i></td></tr>
          <tr><td class="lable-text">User Name(*)</td><td><input type="text" name="user_name" value="" > </td></tr>
          <tr><td class="lable-text">User Type(*)</td><td><select name="user_type" id="user_type">
                                          <option value="Administrator" >Administrator</option>
                                          <option value="Student" selected>Student</option>
                                          <option value="Teacher" >Teacher</option>
                                          <option value="Clerk" >Clerk</option>
                                        </select>   </td></tr>
          <tr><td class="lable-text">Birth Date(*)</td><td><input type="date" name="birth_date" value="" > </td></tr>
          <tr><td class="lable-text">Gender(*)</td><td><input type="radio" name="gender" id="male"  value="Male">Male
                                     <input type="radio" name="gender" id="female"  value="Female">Female
                                     <input type="radio" name="gender" id="transgender"  value="Transgender">Transgender 
                                  </td></tr>
          <tr><td class="lable-text">Contact No(*)</td><td><input type="text" name="contact1" value="" >  </td></tr>
          <tr><td class="lable-text">Address(*)</td><td><input type="text" name="address" value="" >  </td></tr>
          <tr><td class="lable-text">Email(*)</td><td><input type="text" name="email" value="" > </td></tr>
          <tr><td class="lable-text">User ID#(*)</td><td><input type="text" name="user_id" value="" > </td></tr>
          <tr><td class="lable-text">New Password(*)</td><td><input type="password" name="user_pass" value="" required  
            > </td></tr>
          <tr><td class="lable-text">Conirm Password(*)</td><td><input type="password" name="user_confirm_pass" value="" required><span id="cnf_feeback">good</span> </td></tr>
          <tr><td class="lable-text">Upload Photo</td><td><input type="file" name="image" accept="image/*" onchange="showPreview(event);"> </td></tr>
          <tr><td colspan="2" style="text-align:right;"><input type="submit" class="button" name="sign_up" value="Sign-Up"></td></tr>
        </table>
        
      </form>
    </div> 
    <!--CHILD DIV#2 -->   
    <div class="box-model">
        <img id="image-preview" >
    </div>
  </div>

  <script>
    const form1 = document.getElementById("frmSignUp");
    const passwd = document.getElementByName("user_pass");
    const cnfPasswd = document.getElementByName("user_confirm_pass");
    const feedback = document.getElementById("cnf_feeback");
    let isPasswdMatch= false;
    feedback.innerHTML="WoW!!!";

    cnfPasswd.adEventListener("input", () =>{ 
      if(passwd.value !+ cnfPasswd.value){
        feedback.innerHTML="Password MIS-MATCH!!!";
        isPasswdMatch = false;
      }
      else{
        feedback.innerHTML = "Password MATCHED...";
        isPasswdMatch = true;
      }
     });

    /* ON FORM SUBMISSION*/
    form1.onsubmit= function(){
      if(!isPasswdMatch){
        alert("Wait! Password didn't match.");
        cnfPasswd.focus();
        return false;
      }
      return true;
    };
  </script> 

<?php
  if(isset($_REQUEST["status"])){
    if($_REQUEST["status"]=="0"){
      $msg='<p style="color:green;">User Registration Done Successfully...</p>';
    }
    else if($_REQUEST["status"]=="1"){
      $msg='<p style="color:red;">User Registration FAILS!!!</p>';      
    }
    else{
      $msg='<p style="color:red;">' . $_REQUEST["status"] .   '</p>';
    }
    echo $msg;
  }
?>
  </body>
</html>

