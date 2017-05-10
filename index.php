<?php
session_start();
$captcha_auth = $_SESSION['captcha_auth'];
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="shinayoshi shinayoshi.net" />
    <meta name="author" content="shinayoshi" />

    <title>Top - net-tools</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="wrap">

      <div id="main" role="main" class="container">
        <div id="content">
          <div class="row">
            <div class="page-content col-md-12">
              <h1>net-tools</h1>
              <p>Your ip address is <?php echo $_SERVER["REMOTE_ADDR"]; ?></p>
              <div id="result"></div>
              <?php if (!$captcha_auth) { ?>
              <form class="form-inline" action="#" id="captcha_auth">
                <div class="form-group">
                  <img id="captcha" src="./securimage/securimage_show" alt="captcha" width="220" height="80" /><br />
                  <input type="text" class="form-control" id="captcha_code" placeholder="Input CAPTCHA text" name="captcha" tabindex="1" />
                  <input class="btn btn-default" type="button" id="execute" value="Submit" tabindex="2" />
                </div>
              </form>
              <?php } ?>
              <?php if (!$captcha_auth) { ?>
              <ul id="command" style="display: none;">
              <?php } else { ?>
              <ul id="command">
              <?php } ?>
                <li><a href="./ping">ping</a></li>
                <li><a href="./traceroute">traceroute</a></li>
                <li><a href="./dig">dig</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <hr />
          </div>
        </div>
      </div>

      <footer role="contentinfo">
        <div class="container">
          <p class="text-muted credits">
            Copyright (c) 2017 shinayoshi
          </p>
        </div>
      </footer>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/captcha.js"></script>
  </body>
</html>
