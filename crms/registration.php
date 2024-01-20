<!DOCTYPE html>
<html>
<title>User Registration</title>
<link rel="icon" href="./icons/user.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
session_start();
if(isset($_POST['s'])){
include("config.php");
require_once('encrypt_decrypt.php');
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $u_name=Encrypt($_POST['name']);
        $u_id=Encrypt($_POST['email']);
        $u_pass=Encrypt($_POST['password']);
        $u_addr=Encrypt($_POST['adress']);
        $a_no=Encrypt($_POST['aadhar_number']);
        $gen=Encrypt($_POST['gender']);
        $mob=Encrypt($_POST['mobile_number']);
        $n=1;
        $i=mysqli_query($conn,"SELECT SUBSTRING(u_name, 3) AS u_name FROM user");
            
      $reg="insert into user values('$u_name','$u_id','$u_pass','$u_addr','$a_no','$gen','$mob')";
      $res=mysqli_query($conn,$reg);
        if(!$res)
        {
        $message2 = "This Mail Id or Aadhar number is already used. ";
        echo "<script type='text/javascript'>alert('$message2');</script>";
    }
            else
    {
        $message = "User Registered Successfully";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>
  window.setTimeout(function() {
      window.location = 'home.php';
    }, 1);
  </script>";
//	 header("location:userlogin.php");
    }
    }
}
?>
  
<script>
     function f1()
        {
            var sta=document.getElementById("name1").value;
            var sta1=document.getElementById("email1").value;
            var sta2=document.getElementById("pass").value;
            var sta3=document.getElementById("addr").value;
            var sta4=document.getElementById("aadh").value;
            var sta5=document.getElementById("mobno").value;
	   
  var x=sta.trim();
  var x1=sta1.indexOf(' ');
  var x2=sta2.indexOf(' ');
  var x3=sta3.trim();
  var x4=sta4.indexOf(' ');
	var x5=sta5.indexOf(' ');
	if(sta!="" && x==""){
		document.getElementById("name1").value="";
		document.getElementById("name1").focus();
		  alert("Space Not Allowed");
        }
        
         else if(sta1!="" && x1>=0){
    document.getElementById("email1").value="";
    document.getElementById("email1").focus();
      alert("Space Not Allowed");
        }
        else if(sta2!="" && x2>=0){
    document.getElementById("pass").value="";
    document.getElementById("pass").focus();
      alert("Space Not Allowed");
        }
        else if(sta3!="" && x3==""){
    document.getElementById("addr").value="";
    document.getElementById("addr").focus();
      alert("Space Not Allowed");
        }
        else if(sta4!="" && x4>=0){
    document.getElementById("aadh").value="";
    document.getElementById("aadh").focus();
      alert("Space Not Allowed");
        }
        else if(sta5!="" && x5>=0){
    document.getElementById("mobno").value="";
    document.getElementById("mobno").focus();
      alert("Space Not Allowed");
        }
}
</script>    
    
<head>
<style>
.reg
{
color:white;
text-align:center;
font-size:28px;
}
</style>





<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<link href="complainer_page.css" rel="stylesheet" type="text/css" media="all" />


</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="registration.php">Registration</a></li>
       </ul>
    </div>
  </div>
</nav>
	<br>
<div class="video" style="margin-top: 5%"> 
	<div class="center-container">
		 <div class="bg-agile">
		<p class="reg" >Register</p>
			<br><br>
				
			<div class="login-form">	
				<form action="#" method="post">				
				<p style="color:#dfdfdf">Full Name</p><input type="text"  name="name"  required="" id="name1" onfocusout="f1()" />
					<p style="color:#dfdfdf">Email-Id</p><input type="email"  name="email"  required="" id="email1" onfocusout="f1()"/>
                    <p style="color:#dfdfdf">Password</p><input type="text"  name="password"  placeholder="8 Character minimum" pattern=".{8,}" id="pass" onfocusout="f1()"/>
					<p style="color:#dfdfdf">Home Adress</p><input type="text"  name="adress"  required="" id="addr" onfocusout="f1()"/>
					<p style="color:#dfdfdf">Aadhar Number</p><input type="text"  name="aadhar_number" minlength="12" maxlength="12" required pattern="[123456789][0-9]{11}" id="aadh" onfocusout="f1()"/>
					<div class="left-w3-agile">
						<p style="color:#dfdfdf">Gender</p><select class="form-control" name="gender">
							<option>Male</option>
							<option>Female</option>
							<option>Others</option>
						</select>
					</div>
					<div class="right-agileits">
						<p style="color:#dfdfdf">Mobile</p><input type="text"  name="mobile_number" required pattern="[6789][0-9]{9}" minlength="10" maxlength="10" id="mobno" onfocusout="f1()"/>
					</div>

		
		<input type="submit" value="Submit" name="s">
				</form>	
			</div>	
		</div>
	</div>	
</div>	
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>