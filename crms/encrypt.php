<html>
<head>
<title>Encrypt and Decrypt</title>
</head>
<body>
<form method="POST">
<input type="text" name="text">
<input type="submit" name="e" value="Encrypt">
<input type="submit" name="d" value="Decrypt">
</form>
</body>
</html>
<?php
require_once('encrypt_decrypt.php');
if(isset($_POST['e']))
{
$id=$_POST['text'];
echo "Original text is $id "; 
echo"&nbsp;&nbsp&nbsp&nbsp ";
echo "Encrypted text is &nbsp &nbsp";
$id=Encrypt($id);
echo "$id";
}
if(isset($_POST['d']))
{
$id=$_POST['text'];
echo "Original text is &nbsp ";
echo "$id";
// echo"&nbsp;&nbsp&nbsp&nbsp ";
echo " Decrypted text is &nbsp";
$id=decrypt($id);
echo "$id";
}
?>