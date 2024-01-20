<!DOCTYPE html>
<html>
<title>Criminal Registration</title>
<link rel="icon" href="./icons/criminal.jpg">

<?php
session_start();
if(isset($_POST['s'])){
    $con=mysqli_connect('localhost','root','','crime_portal');
    if(!$con)
    {
        die('could not connect: '.mysqli_error());
    }
	    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
             	   
        $name=$_POST['name'];
//	$crid=$_POST['crid'];
	$mail=$_POST['email'];
	$address=$_POST['adrs'];
        $desc=$_POST['desc'];
	$age=$_POST['dob'];
	$num=$_POST['num'];
	//$_SESSION['toc']=$type_crime;
        $d_o_c=$_POST['doc']; 
     	$cap=$_POST['captcha'];
	$rc=$_SESSION['captcha1'];
	$n=1;
	if($cap!=$rc)
	{
        $message1 = "The Entered Captcha is wrong";
        echo "<script type='text/javascript'>alert('$message1');</script>";

	$n=0;
	}

	
	   $var=strtotime(date("Ymd"))-strtotime($d_o_c);
    	if($var>0 && $n)
    {
          
      $comp="INSERT into criminal_details(name,age,mobile_number,c_no,address,email,doc) values('$name','$age','$num','$crid','$address','$mail','$d_o_c')";
      mysqli_select_db($con,"crime_portal"); 
      $res=mysqli_query($con,$comp);    
      if(!$res)
      {
        $message1 = "Criminal is already there in the database";
        echo "<script type='text/javascript'>alert('$message1');</script>";
      }
      else
      {
          $message = "Criminal Registered Successfully";
          echo "<script type='text/javascript'>alert('$message');</script>";
      }
    }
    else
    {
     $message = "Enter Valid Date";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }
}
?>  

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
<link rel="stylesheet" href="style1.css">
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
	        <li><a href="police_pending_complain.php">Police Home Page </a></li>
        <li class="active"><a href="regcrmnl.php">Registration </a></li>
       </ul>
    </div>
  </div>
</nav>
	
<div class="video" style="margin-top: 5%"> 
	<div class="center-container">
		 <div class="bg-agile">

		<p class="reg" style="color:white">Add a Criminal </p>
			<br><br>
			<div class="login-form">
				<form action="#" method="post" enctype='multipart/form-data'>			

		<p style="color:#dfdfdf">Enter Full Name of the Criminal</p><input type="text"  name="name"  required="" id="email" onfocusout="f1()"/>
<!--		<p style="color:#dfdfdf">Criminal id</p><input type="text"  name="crid"  required="" id="email" onfocusout="f1()"/> -->
		<p style="color:#dfdfdf">Enter Jail Name</p><input type="text"  name="jln"  required="" id="email" onfocusout="f1()"/>
		<p style="color:#dfdfdf">Address</p><textarea  name="adrs" rows="20" cols="50" placeholder="Type the Criminal's address " onfocusout="f1()" id="desc" required></textarea>
		<p style="color:white">Age  </p> <input type="text"  name="dob"  required="" id="email" onfocusout="f1()"/>



			<div class="left-w3-agile">
						<p style="color:#dfdfdf">Gender</p><select class="form-control" name="gender">
							<option>Male</option>
							<option>Female</option>
								<option>Others</option>
						</select>
					</div>
					<div class="right-agileits">
			<p style="color:#dfdfdf">     Mobile Number</p><input type="text"  name="num"  required="" id="email" onfocusout="f1()"/>

					</div>
<div class="left-w3-agile">
<p style="color:#dfdfdf">Relation</p><select class="form-control" name="relation">
							<option>Mother</option>
							<option>Father</option>
							<option>Brother</option>
							<option>Sister</option>
							<option>Aunt</option>
							<option>Uncle</option>
							<option>Brother in law</option>
							<option>Son</option>
							<option>Daughter</option>
							<option>Friend</option>
							<option>Grand Mother</option>
							<option>Grand Father</option>
							<option>Husband/Wife</option>
						</select>
</div>
c
<div class="right-agileits">
<p style="color:#dfdfdf">Identity Proof</p><select class="form-control" name="idproof">
							<option>Aadhar Card</option>
							<option>Driving Licence</option>
							<option>Pan Card</option>
							<option>Passport</option>
							<option>Voter ID</option>
						</select>
</div>

		   

<br><p style="color:#dfdfdf">Upload Criminals image</p><br>
	<input type="file" name="file" />   

<br>
<?php

$r=md5(random_bytes(64));
$c=substr($r, 0, 6);
$_SESSION['cap']=$c;
?>




<div class="left-w3-agile">
<!-- <p style="color:grey">Enter Captcha</p><input type="text"  name="aadhar_number" placeholder="Aadhar Number" required="" disabled value=<?php echo "$c"; ?>> -->
<p style="color:grey">Enter Captcha</p><?php  include("./captcha/captcha.php");?>
</div>
<div class="right-agileits">
<p style="color:grey">Here</p><input type="text" name="captcha" required="">
</div>


	
					<input type="submit" value="Submit" name="s">
				</form>	
			</div>	
		</div>
	</div>	
</div>	


    <?php
         if(isset($_POST['s'])){ 
	 $con=mysqli_connect('localhost','root','','crime_portal');
    if(!$con)
    {
        die('could not connect: '.mysqli_error());
    }





 if($_SERVER["REQUEST_METHOD"]=="POST")
    {
//$cid=$_POST['crid'];
$mail=$_POST['email'];
$q1="Select c_no from criminal_details where email='$mail' " ;
$r1=mysqli_query($con,$q1);
$row=mysqli_fetch_array($r1);
$cid=$row['c_no'];
$_SESSION['cid']=$cid;


        $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if( in_array($imageFileType,$extensions_arr) ){
            if(move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name)){
                $image_base64 = base64_encode(file_get_contents('upload/'.$name) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;   
                $query = "insert into criminal_images(img,file_name,c_no) values('".$image."','".$name."',$cid)";
                mysqli_query($con,$query) or die(mysqli_error($con));
            }
        }    
}   
}
   ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>