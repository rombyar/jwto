<?php  if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
  

  // other reference: https://stackoverflow.com/a/31107989 ; https://stackoverflow.com/a/46620488
  function jwt_request($url, $post, $access_token =false)
  {

        /** reference : https://stackoverflow.com/a/48896992 */
        header('Content-Type: application/json'); // Specify the type of data

        /** Master SERVER REMPOA */
        $ch = curl_init($url); // Initialise cURL

        // $ch = curl_init("http://wg-master.rom.web.id/api/send"); // Initialise cURL
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".$access_token
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $result = curl_exec($ch); // Execute the cURL statement
        curl_close($ch); // Close the cURL connection

        return ($result); // Return the received data
  }
