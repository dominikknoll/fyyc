<?php

require 'instagram.class.php';

echo("1");

// Initialize class
$instagram = new Instagram(array(
  'apiKey'      => '8371be1b02054549bde08e22f582cc05',
  'apiSecret'   => '946359bfbdcb4d4ab3c9ec9172d0740d',
  'apiCallback' => "http://127.0.0.1/API's/instagram/example/success.php"
));




// Receive OAuth code parameter
$code = $_GET['code'];



// Check whether the user has granted access
if (true) {

   //Store user access token
  $instagram->setAccessToken("36880628.8371be1.200adb20b4fd45e3ac5c94fb9eea7765");

  // Now you can call all authenticated user methods
   //Get all user likes
  $likes = $instagram->getUserLikes();

 //  Display all user likes
  foreach ($likes->data as $entry) {
    echo "<img src=\"{$entry->images->thumbnail->url}\">";
  }
echo("4");

} else {
	echo("5");

  // Check whether an error occurred
  if (true === isset($_GET['error'])) {
    echo 'An error occurred: '.$_GET['error_description'];
    echo("6");

  }
echo("7");

}

echo("8");


?>