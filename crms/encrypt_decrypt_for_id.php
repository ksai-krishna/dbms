<?php
include('config.php');
    //Encrypt Function
    $h=0;
    mysqli_query($conn,"INSERT INTO id(code) VALUES ('$h') ");
    $query=mysqli_query($conn,"SELECT id FROM id ORDER BY id DESC LIMIT 1");
    $row=mysqli_fetch_array($query);
    $id=$row['id'];
    $_SESSION['id']=$id;
    function Encryptid($PlainText) {
      $ENCRYPTION_KEY='~The-key-is-Teamleader-Manasa@123~';
    // $ENCRYPTION_KEY = 'your-long-complex-password-here!!!';
      $ENCRYPTION_ALGORITHM = 'AES-256-CBC';
      $EncryptionKey = base64_decode($ENCRYPTION_KEY);
      $InitializationVector  = '12012211212312iv';
      $EncryptedText = openssl_encrypt($PlainText, $ENCRYPTION_ALGORITHM, 
      $EncryptionKey, 0, $InitializationVector);
      $n=base64_encode($EncryptedText . '::' . $InitializationVector);
      $id=$_SESSION['id'];
      $n=$id.$n;
      return $n;
      }
      
        // Decryption Funcions
    function Decryptid($CipherData) {
      $CipherData=substr($CipherData,3);
      $ENCRYPTION_KEY='~The-key-is-Teamleader-Manasa@123~';
      $ENCRYPTION_ALGORITHM = 'AES-256-CBC';
           $EncryptionKey = base64_decode($ENCRYPTION_KEY);
           list($Encrypted_Data, $InitializationVector ) = array_pad(explode('::', base64_decode($CipherData), 2), 2, null);
           return openssl_decrypt($Encrypted_Data, $ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
           }
?>