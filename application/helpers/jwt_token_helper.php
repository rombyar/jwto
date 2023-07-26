<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

  function token_request($codeName)
  {
      /** Mulai Membuat sebuah Token */
      $ci =& get_instance();
      $kunci = "GantiEncryptionKey"; // Ini akan menjadi kunci untuk membuka akses API >> config/config.php/encryption_key
      $tokenId = base64_encode(randomBytes(32));
      $issuedAt = time();
      $token = [
        'iat' => $issuedAt,         // Issued at: time when the token was generated
        'jti' => $tokenId,          // Json Token Id: an unique identifier for the token
        'iss' => $codeName,       // Issuer
        'userWeb' => $codeName, // userid from the users table
      ];
      $access_token = JWT::encode($token, $kunci); //This is the output token
      return $access_token;
  }
