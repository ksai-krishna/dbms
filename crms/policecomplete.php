<!DOCTYPE html>
<html>
<head>
<title>Police Homepage</title>
<link rel="icon" href="./icons/pol.jpg">
	
    <style>

td{
text-align:center;
}

</style>
    <?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:policelogin.php");
        include("config.php");
        $p_id=$_SESSION['pol'];
        $result=mysqli_query($conn,"SELECT c_id,type_crime,d_o_c,location,mob,u_addr FROM complaint natural join user where p_id='$p_id' and pol_status='Case Closed' order by c_id desc");
        $r=mysqli_query($conn,"SELECT LAST(case_update) AS fnl_rpt FROM update_case");
        $p_id=$_SESSION['pol'];
        $result1=mysqli_query($conn,"SELECT location FROM police where p_id='$p_id'");
        $q2=mysqli_fetch_assoc($result1);
        $location=$q2['location'];   
    if(isset($_POST['s2']))
    {
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $cid=$_POST['crid'];
        $_SESSION['cid']=$cid;
	      $stat="Assigned" ;
        $qu=mysqli_query($conn,"select p_id,inc_status,location from complaint where c_id='$cid'");
        $q1=mysqli_query($conn,"insert into complaint (inc_status,p_id) values('$stat,'$p_id') where c_id='$cid'");
        $q=mysqli_fetch_array($qu);
        $inc_st=$q['inc_status'];
        $loc=$q['location'];
	      $pid=$q['p_id'];
        if(strcmp("$loc","$location")!=0)
        {
            $msg="Invalid case id ";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }       
      	else if(strcmp("$inc_st","Unassigned")==0)
        {   
            header("location:police_complainDetails.php");
	            $res=mysqli_query($conn,"update complaint set inc_status='Assigned',pol_status='In Process',p_id='$p_id' where c_id='$cid' ");           
        }
        else if($pid==$p_id){
            header("location:police_complainDetails.php");
        }
	      else{
              $mes="This case is assigned to another Police Officer.";
              echo "<script type='text/javascript'> alert('$mes'); </script>";
            }
	     
    }
    }
    
    $query="select * from complaint where location='$location' order by c_id desc";
    $result=mysqli_query($conn,$query);  
    ?>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="style1.css">	
    <script>

function take()
{
window.location.href="http://localhost/crms/police_complainDetails.php" ;
}


     function f1()
        {
          var sta2=document.getElementById("ciid").value;
          var x2=sta2.indexOf(' ');
     if(sta2!="" && x2>=0)
     {
        document.getElementById("ciid").value="";
        alert("Blank Field not Allowed");
      }       
}
</script>
</head>
<body style="background-color: #dfdfdf">
	<nav  class="navbar navbar-default navbar-fixed-top">
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
        <li><a href="../ocrms"><span></span> Officialss Login</a></li>
        <li ><a href="policelogin.php">Police Login</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">	
<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Add a criminal<span class="caret"></span></a>
        <ul class="dropdown-menu">
    <li><a href="regcrmnl_p.php">Add a criminal</a></li>
  <li><a href="criminal_details.php">View Criminals</a></li>
        </ul>
        <li>
  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">View Complaints<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="Assigned_complain.php">Assigned Complaints</a></li>
        <li><a href="police_pending_complain.php">Pending Complaints</a></li>
          <li><a href="police_complete.php">Completed Complaints</a></li>
          

        </ul>        
   	
        <li><a href="p_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
 </nav>
    
    <form style="margin-top: 7%; margin-left: 40%;" method="post">
      <input type="text" name="crid" style="width: 250px; height: 30px; background-color:white;" placeholder="&nbsp Complaint id" id="crid" required="" onfocusout="f1()">
        <div>
      <input class="button" type="submit" value="Take up case" name="s2" style="margin-top: 10px; margin-left: 11%;">      </div>
    </form>            
 <div style="padding:50px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
      <tr>
        <th scope="col">Complaint Id</th>
        <th scope="col">Type of Crime</th>
        <th scope="col">Date of Crime</th>
        <th scope="col" style="text-align:center ">Description</th>
        <th scope="col">Location</th>
        <th scope="col">Complaint Status</th>
        <th scope="col">Police ID</th>
      </tr>
    </thead>

            <?php
              while($rows=mysqli_fetch_array($result)){

             ?> 

            <tbody style="background-color: white; color: black;">
      <tr>	
        <td><?php echo $rows['c_id'];?></td>
        <td><?php echo $rows['type_crime'];?></td>     
        <td><?php echo $rows['d_o_c'];?></td>  
        <td><?php echo $rows['description'];?></td>
        <td><?php echo $rows['location'];?></td>
        <td><?php echo $rows['inc_status']; ?></td>
        <td ><?php echo $rows['p_id']; ?></td>
	</tr>
    </tbody>
    
    <?php
    } 
    ?>
  
</table>
 </div>
    <div style="position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   height: 30px;
   background-color: rgba(0,0,0,0.8);
   color: white;
   text-align: center;">	
  <h4 style="color: white;">&copy <b>2018 Crime Portal | All Right Reserved</b></h4>
</div>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>