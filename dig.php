<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="shinayoshi shinayoshi.net" />
    <meta name="author" content="shinayoshi" />

    <title>Dig - net-tools</title>

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
              <h2>Dig</h2>
              <form class="form-inline" action="#">
                <input type="hidden" id="command" value="dig" />
                <div class="form-group">
                  <label class="sr-only" for="hostname">FQDN or IP Address</label>
                  <input type="text" class="form-control" id="hostname" placeholder="FQDN or IP Address" name="hostname" tabindex="1" />
                </div>
                <input class="btn btn-default" type="button" id="execute" value="Submit" tabindex="2" />
              </form>
              <hr />
              <h2>Result</h2>
              <div id="result"></div>
              <hr />
              <p><a href="./index">Return to top</a></p>
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
    <script src="js/net-tools.js"></script>
  </body>
</html>
