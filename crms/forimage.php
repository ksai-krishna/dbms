<?php
echo "Filename: " . $_FILES['file']['name']."<br>";
echo "Type : " . $_FILES['file']['type'] ."<br>";
echo "Size : " . $_FILES['file']['size'] ."<br>";
echo "Temp name: " . $_FILES['file']['tmp_name'] ."<br>";
echo "Error : " . $_FILES['file']['error'] . "<br>";
?>
<html>
<form method="POST" enctype="multipart/form-data">
   <input type="file" name="file">
   <input type ="submit" value="submit">
</form>
</html>