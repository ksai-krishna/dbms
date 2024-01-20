<html> 
<title>Complainer Home Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<link rel="icon" href="./icons/user.png">
<style>	
            img{
                position:relative;
                top:5px;
            }
</style>
<?php
session_start();
include("config.php");
require_once('encrypt_decrypt.php');
date_default_timezone_set("Asia/Kolkata");
if(!isset($_SESSION['x']))
        header("location:userlogin.php");
        
   	    $u_id=$_SESSION['u_id'];
        $result=mysqli_query($conn,"SELECT * FROM user where u_id='$u_id' ");
        $q2=mysqli_fetch_array($result);
        $a_no=Decrypt($q2['a_no']);
        $msg="Invalid Visitor id";
        $mob1=Decrypt($q2['mob']);
        $u_name=Decrypt($q2['u_name']);
        $result=mysqli_query($conn,"SELECT c_id FROM complaint ORDER BY time_of_complaint DESC LIMIT 1");
        $q2=mysqli_fetch_array($result);
        $c_id=Decrypt($q2['c_id']);
        $c_id=encrypt($c_id+1);
        $c_id1=Decrypt($c_id);
        
if(isset($_POST['s'])){
   if($_SERVER["REQUEST_METHOD"]=="POST")
    {
$desc=Encrypt($_POST['description']);
$location=Encrypt($_POST['nearest_pol_station']);
$type_crime=Encrypt($_POST['type_crime']);
$d_o_c=Encrypt($_POST['d_o_c']);
$ano=Encrypt($a_no);
$mob=Encrypt($mob1);
$a_no1=Encrypt($a_no);
$cid1=Encrypt($c_id);
$loc=Encrypt($_POST['location_of_crime']);
// $desc=$_POST['description'];
$location=Encrypt($_POST['nearest_pol_station']);
// $type_crime=$_POST['type_crime'];
// $d_o_c=$_POST['d_o_c'];
$n=1;
//$_SESSION['toc']=$type_crime;
    $var=strtotime(date("Ymd"))-strtotime($d_o_c);
$comp="INSERT into complaint(c_id,a_no,location,type_crime,d_o_c,description,mob,l_o_c) values('$c_id','$a_no1','$location','$type_crime','$d_o_c','$desc','$mob','$loc')";
  $res=mysqli_query($conn,$comp);
  
      if(!$res)
      {
        $message1 = "Complaint already filed";
        echo "<script type='text/javascript'>alert('$message1');</script>";
      }
      else
      {
          $message = "Complaint Registered Successfully";
          echo "<script type='text/javascript'>alert('$message');</script>";
          echo "<script>
  window.setTimeout(function() {
      window.location = 'complainer_page.php';
    }, 0.5);
  </script>";
          $_SESSION['cmp_id']=$c_id;
      }
    }
    
    else
    {
     $message = "Enter Valid Date";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    }
?>
    
 <script>
     function captcha()
     {
     }
     function f1()
        {
 
          var sta1=document.getElementById("desc").value;
           var x1=sta1.trim();
          if(sta1!="" && x1==""){
          document.getElementById("desc").value="";
          document.getElementById("desc").focus();
          alert("Space Found");
        }
}
 </script>
   
<head>
    
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

	<link href="complainer_page.css" rel="stylesheet" type="text/css" media="all" />
	<link href="style1.css" rel="stylesheet" />
</head>

<body style="background-size: cover;
    background-image: url(home_bg1.jpeg);
    background-position: center;" >
	<nav  class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><b>Home</b></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li ><a href="userlogin.php">User Login</a></li>
        <li class="active"><a href="complainer_page.php">User Home</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="complainer_page.php">Log new complaint</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Schedule a visit <span class="caret"></span></a> 
        <ul class="dropdown-menu">
        <li><a href="pappointment.php">Schedule a visit </a></li>
          <li><a href="appointment_status.php">View Status</a></li>

        </ul>
      
        
        <li><a href="complainer_complain_history.php">Complaint History</a></li>
        <li><a href="logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
 </nav>

<div class="video" style="margin-top: 5%"> 
<br>
	<div class="center-container">
		 <div class="bg-agile">		
			<div class="login-form"><p><h2 style="color:gray">Welcome <?php echo "$u_name" ?></h2></p>
                         <p><h2>Log New Complain</h2></p><br>	
		<form action="" method="POST" enctype="multipart/form-data">
			<p style="color: gray">Complaint ID</p> <input type="text"  name="cno"  required="" disabled value=<?php echo "$c_id1"; ?>>
			
			    <div class="left-w3-agile">
			<p style="color: gray">Aadhar Number</p>
			<input type="text"  name="aadhar_number" placeholder="Aadhar Number" required="" disabled value=<?php echo "$a_no"; ?>>
			</div>
			<div class="right-agileits">
			<p style="color:gray ">Mobile Number</p><input type="text"  name="mobile_number" placeholder="Mobile Number" required="" disabled value=<?php echo "$mob1"; ?>>
			</div>
      <p style="color:gray ">Location of crime</p><input type="text"  name="location_of_crime" placeholder="Enter location of crime" required="" >
			
      <div class="top-w3-agile" style="color: gray">Nearest Police station
			
			 <select class="form-control" name="nearest_pol_station" style="width: 290px;">
						<?php
                        $loc=mysqli_query($conn,"select location from police_station");
                        while($row=mysqli_fetch_array($loc))
                        {
                            ?>
                               <option> <?php echo $row[0]; ?> </option>
                            <?php
                        }
                        ?>
					
				    </select>
				</div>
<!--		<p style="color: gray">Case Id</p>
			<input type="text"  name="cid" placeholder="Please enter a unique caseid" required="" > -->
                   
			<div class="top-w3-agile" style="color: gray">Type of Crime
			<select class="form-control" name="type_crime" style="width: 290px;">
			<option>Theft</option>
			<option>Robbery</option>
                        <option>Pick Pocket</option>
                        <option>Murder</option>
                       	<option>Rape</option>
                        <option>Molestation</option>
                        <option>Kidnapping</option>
                        <option>Missing Person</option>
				</select>
				</div>
        <?php
     date_default_timezone_set('Asia/Kolkata');
      $c = date("Y-m-d");
     ?>
					<div class="Top-w3-agile" style="color: gray">
					Date Of Crime : &nbsp &nbsp  
						<input style="background-color: #313131;color: gray" type="date" name="d_o_c" max="<?=$c?>" required>
					</div>
					<br>
					<div class="top-w3-agile" style="color: gray">
					Description
		<textarea  name="description" rows="20" cols="50" placeholder="Describe the incident in details with time" onfocusout="f1()" id="desc" required></textarea>

<br>
<p style="color:grey">Upload If you have evidence</p>
<br>
  <input type="file" name="file" />
  <br>




        </div>
        
		<input type="submit" value="Submit" name="s" >
				</form>	
			</div>
		</div>
	</div>	
</div>	
 <?php
         if(isset($_POST['s'])){
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
        
        $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif","mp4");
        if( in_array($imageFileType,$extensions_arr) ){
            if(move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name)){
                $image_base64 = base64_encode(file_get_contents('upload/'.$name) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                $c_id1=Encrypt($c_id1);
                $query=mysqli_query($conn,"insert into evidence(img,file_name,c_id) values('".$image."','".$name."','$c_id1')");
                $c_id=0;
                
            }

        }
    
}   
}
//$_SESSION['n1']=$n;

//$s1=strcmp($cap3,$c);


   ?>
<div style="position: relative;
   left: 0;
   bottom: 0;
   width: 100%;
   height: 30px;
   background-color: rgba(0,0,0,0.8);
   color: white;
   text-align: center;">
  <h4 style="color: white;">&copy <b>Crime Portal 2022</b></h4>
</div>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>