<!doctype html>
<html lang="it">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

  </head>
  <body class="bg-light m-0">
    <div class="container-fluid px-0">
      <div class="row mx-0">
        <div class="col-12 p-0">
          <header class="navbar navbar-dark bg-dark fw-bold shadow">
            <a class="navbar-brand" href="">
            <span class="far fa-building fs-2 mx-2" aria-hidden="true"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                    Agenzia Assicurativa
            </a>
          </header>
        </div>
      </div>

      <?php
        if(isset($templateParams["name"])){
          require($templateParams["name"]);
        }
      ?>

    </div>
  </body>
</html>
