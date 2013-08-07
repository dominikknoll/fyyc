<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Charset -->
    <meta charset="utf-8">

    <!-- Meta -->
    <title>Instagram - OAuth Login</title>

    <!-- CSS -->
    <style type="text/css">
      * {
        margin: 0px;
        padding: 0px;
      }

      a.button {
        background: url(instagram-login-button.png) no-repeat transparent;
        cursor: pointer;
        display: block;
        height: 29px;
        margin: 50px auto;
        overflow: hidden;
        text-indent: -9999px;
        width: 200px;
      }

      a.button:hover {
        background-position: 0 -29px;
      }
    </style>
  </head>
  <body>

    <?php
      require 'instagram.class.php';
      
      // Setup class
      $instagram = new Instagram(array(
        'apiKey'      => '8371be1b02054549bde08e22f582cc05',
        'apiSecret'   => '946359bfbdcb4d4ab3c9ec9172d0740d',
        'apiCallback' => "http://127.0.0.1/API's/instagram/example/success.php" // must point to success.php
      ));
      
      // Display the login button
      $loginUrl = $instagram->getLoginUrl();
      echo "<a class=\"button\" href=\"$loginUrl\">Sign in with Instagram</a>";
    ?>

  </body>
</html>