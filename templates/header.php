<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PizzaPalace</title>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/code.js"></script>
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body class="purple lighten-5">
    <!-- Desktop Nav -->
    <nav>
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo center">Pizza Palace</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="left hide-on-small-and-down">
                <li><a href="#">Menu</a></li>
                <li><a href="#">About</a></li>
                <li><a href="signup.php">Account</a></li>
            </ul>
        </div>
    </nav>

    <!-- Mobile Nav -->
    <ul class="sidenav" id="mobile-demo">
    <li><a href="#">Menu</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Account</a></li>
    </ul>