<?php
    //Encrypt Function
    function Encrypt($PlainText) {
      $ENCRYPTION_KEY='~The-key-is-Teamleader-Manasa@123~';
    // $ENCRYPTION_KEY = 'your-long-complex-password-here!!!';
      $ENCRYPTION_ALGORITHM = 'AES-256-CBC';
      $EncryptionKey = base64_decode($ENCRYPTION_KEY);
      $InitializationVector  = '12012211212312iv';
      $EncryptedText = openssl_encrypt($PlainText, $ENCRYPTION_ALGORITHM, 
      $EncryptionKey, 0, $InitializationVector);
      return base64_encode($EncryptedText . '::' . $InitializationVector);
      }
      
        // Decryption Funcions
    function Decrypt($CipherData) {
      $ENCRYPTION_KEY='~The-key-is-Teamleader-Manasa@123~';
      $ENCRYPTION_ALGORITHM = 'AES-256-CBC';
           $EncryptionKey = base64_decode($ENCRYPTION_KEY);
           list($Encrypted_Data, $InitializationVector ) = array_pad(explode('::', base64_decode($CipherData), 2), 2, null);
           return openssl_decrypt($Encrypted_Data, $ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
           }
?>