<?
function DecryptThis($CipherData) {
        $ENCRYPTION_KEY='your-long-complex-password-here!!!';
        $ENCRYPTION_ALGORITHM = 'AES-256-CBC';
        $EncryptionKey = base64_decode($ENCRYPTION_KEY);
        list($Encrypted_Data, $InitializationVector ) = array_pad(explode('::', base64_decode($CipherData), 2), 2, null);
        return openssl_decrypt($Encrypted_Data, $ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
        }
if(isset($_POST['s']))
{
$id=$_POST['text'];
echo "decrypted text is ";
$id=DecryptThis($id);
echo "$id";
}
?>
<html>
<head>
<title>Decrypt</title>
</head>
<body>
<form method="POST">
<input type="text" name="text">
<input type="submit" name="s">
</form>
</body>
</html>