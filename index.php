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
	      <p><a href="ping.php">ping</a></p>
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
  </body>
</html>
