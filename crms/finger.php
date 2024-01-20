<html>
   <head>
      <title>Matching images</title>
   </head>
   <body>
<form action='#' method="post"enctype='multipart/form-data'  >
   <input type="text" name="id">
<input type=file name="file" >
<input type="submit" name="s">
</form>
</body>
</html>

<?php

         if(isset($_POST['s'])){
include("config.php");

 if($_SERVER["REQUEST_METHOD"]=="POST")
    {
//$cid=$_POST['crid'];
$type=$_POST['id'];
        $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if( in_array($imageFileType,$extensions_arr) ){
           
            if(move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name)){
               
                $image_base64 = base64_encode(file_get_contents('upload/'.$name) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                $r=mysqli_query($conn,"SELECT * FROM criminal_images where img='$image' " );
                $row1=mysqli_fetch_array($r);
                if($row1)
                {
                  $message1 = "This fingerprint is already existing in the database.This is consired as fake finerprint.";
                  echo "<script type='text/javascript'>alert('$message1');</script>";                
               }            
               $r=mysqli_query($conn,"SELECT * FROM criminal_images where img='$image' " );
               $row=mysqli_fetch_array($r);
               if($row)
               {
                 $message1 = "This criminal is found";
                 echo "<script type='text/javascript'>alert('$message1');</script>";
                 $id=$row['c_no'];
                 echo "<script type='text/javascript'>alert('$id');</script>";
              }
              else{
               $query = "insert into criminal_images(img,file_name,c_no) values('".$image."','".$name."',$type)";
               mysqli_query($conn,$query) or die(mysqli_error($conn));
               $message1 = "This criminal fingerprint was registered in the database";
               echo "<script type='text/javascript'>alert('$message1');</script>";
              }
               //  while($rows=mysqli_fetch_array($ro)){
               //    $img = $rows['img'];
               //    if($img==$image)
               //    {
               //       $message1 = "This fingerprint is already existing in the database";
               //       echo "<script type='text/javascript'>alert('$message1');</script>";
               //    }
                  
                $img=$row['img'];        
                
              }
       		}
             
        }
      }

   ?>
