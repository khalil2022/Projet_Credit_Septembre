
<?php
session_start();
require_once '../../controllers/formationC.php';


$formationsController = new FormationController();
$formations = $formationsController->getAll();

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

if ($filter === 'participating') {
    $formations = $formationsController->getParticipatingFormations($_SESSION['user_id']);
} elseif ($filter === 'wishlist') {
    $formations = $formationsController->getWishlistFormations($_SESSION['user_id']);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>WebLearnHub</title>
    <meta
      name="description"
      content="Cardio is a free one page template made exclusively for Codrops by Luka Cvetinovic"
    />
    <meta
      name="keywords"
      content="html template, css, free, one page, gym, fitness, web design"
    />
    <meta name="author" content="Luka Cvetinovic for Codrops" />
    <!-- Favicons (created with http://realfavicongenerator.net/)-->
    <link
      rel="apple-touch-icon"
      sizes="57x57"
      href="img/favicons/apple-touch-icon-57x57.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="60x60"
      href="img/favicons/apple-touch-icon-60x60.png"
    />
    <link
      rel="icon"
      type="image/png"
      href="img/favicons/favicon-32x32.png"
      sizes="32x32"
    />
    <link
      rel="icon"
      type="image/png"
      href="img/favicons/favicon-16x16.png"
      sizes="16x16"
    />
    <link rel="manifest" href="img/favicons/manifest.json" />
    <link rel="shortcut icon" href="img/favicons/favicon.ico" />
    <meta name="msapplication-TileColor" content="#00a8ff" />
    <meta
      name="msapplication-config"
      content="img/favicons/browserconfig.xml"
    />
    <meta name="theme-color" content="#ffffff" />
    <!-- Normalize -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- Owl -->
    <link rel="stylesheet" type="text/css" href="css/owl.css" />
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/font-awesome-4.1.0/css/font-awesome.min.css"
    />
    <!-- Elegant Icons -->
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/eleganticons/et-icons.css"
    />
    <!-- Main style -->
    <link rel="stylesheet" type="text/css" href="css/cardio.css" />
  </head>

  <body>
    <div class="preloader">
      <img src="img/loader.gif" alt="Preloader image" />
    </div>
    <nav class="navbar">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"
            ><img
              src="img/img_logo.png"
              data-active-url="img/img_logo.png"
              style="height:70px;width:70px;"
              alt=""
          /></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right main-nav">
            <li><a href="#intro">Home</a></li>
            <li><a href="#formations">Formations</a></li>
            <?php if (!isset($_SESSION['username'])) : ?>
            <li>
              <a
                href="../back/register.php"
                data-toggle="modal"
                data-target="#modal1"
                class="btn btn-blue"
                >Sign Up</a
              >
            </li>
            <li>
              <a
                href="../back/login.php"
                class="btn btn-blue"
                >Sign In</a
              >
            </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])) : ?>
            <li>
              <a
                href="../back/logout.php"
                class="btn btn-blue"
                >Log Out</a
              >
            </li>
            <?php endif; ?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <header id="intro" >
      <div class="container">
        <div class="table">
          <div class="header-text">
            <div class="row">
              <div class="col-md-12 text-center">
                <h3 class="light white">Empower Your Potential.</h3>
                <h1 class="white typed">Unleash Boundless Opportunities.</h1>
                <span class="typed-cursor">|</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="container" style="padding-bottom:180px;padding-top:30px">
        <div class="row">
            <div class="col-md-4">
                <!-- Search Bar -->
                <div class="form-group">
                    <input type="text" class="form-control" id="searchTitle" onkeyup="doSearch()" placeholder="Search...">
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <!-- Select Dropdown -->
                <div class="form-group">
                    <select class="form-control" id="formationFilter" name="filter" onchange="updateFilter()">
                        <option value="all">All Formations</option>
                        <option value="participating" <?php echo ($filter === 'participating') ? 'selected' : ''; ?>>Participating</option>
                        <option value="wishlist" <?php echo ($filter === 'wishlist') ? 'selected' : ''; ?>>Wishlist</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <section id="formations">
      <div class="cut cut-top"></div>
     
      <div class="container">
        
        <div class="row intro-tables" id="show">
          
        <?php foreach ($formations as $formation): ?>
          <div class="col-md-4">
            <div class="intro-table intro-table-hover">
              <h5 class="white heading hide-hover"><?= $formation['title'] ?></h5>
              <div class="bottom">
                <h4 class="white heading small-heading no-margin regular">
                <?= $formation['description'] ?>
                </h4>
                <h4 class="white heading small-heading no-margin regular">
                <?= $formation['startDate'] ?> - <?= $formation['endDate'] ?>
                </h4>
                <h4 class="white heading small-pt">Type: <?= $formation['name'] ?></h4>
                <?php if (isset($_SESSION['username'])) : ?>
                <?php if ($formationsController->isParticipating($_SESSION['user_id'],$formation['id'])) : ?>
                <a href="participate_request.php?formation_id=<?=$formation['id'] ?>&action=unparticipe" class="btn btn-red-fill expand" >Left</a>
                <?php else : ?>
                <a href="participate_request.php?formation_id=<?=$formation['id'] ?>&action=participe" class="btn btn-white-fill expand">Join</a>
                <?php endif; ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['username'])) : ?>
                <?php if ($formationsController->isFavoris($_SESSION['user_id'],$formation['id'])) : ?>
                <a href="favoris_request.php?formation_id=<?=$formation['id'] ?>&action=unfavoris" class="btn  expand" style="color:red" ><i class="fa fa-heart"></i></a></a>
                <?php else : ?>
                <a href="favoris_request.php?formation_id=<?=$formation['id'] ?>&action=favoris" class="btn  expand"><i class="fa fa-heart"></i></a></a>
                <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="row bottom-footer text-center-mobile">
          <div class="col-sm-8">
            <p>&copy; 2023 All Rights Reserved. Powered by Khalil Jaber</p>
          </div>
          <div class="col-sm-4 text-right text-center-mobile">
            <ul class="social-footer">
              <li>
                <a href="http://www.facebook.com/pages/Codrops/159107397912"
                  ><i class="fa fa-facebook"></i
                ></a>
              </li>
              <li>
                <a href="http://www.twitter.com/codrops"
                  ><i class="fa fa-twitter"></i
                ></a>
              </li>
              <li>
                <a href="https://plus.google.com/101095823814290637419"
                  ><i class="fa fa-google-plus"></i
                ></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <!-- Holder for mobile navigation -->
    <div class="mobile-nav">
      <ul></ul>
      <a href="#" class="close-link"><i class="arrow_up"></i></a>
    </div>
    <!-- Scripts -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/typewriter.js"></script>
    <script src="js/jquery.onepagenav.js"></script>
    <script src="js/main.js"></script>

    <script>
    function updateFilter() {
        const formationFilter = document.getElementById("formationFilter");
        const selectedValue = formationFilter.value;

        // Update the URL with the selected filter
        const url = new URL(window.location.href);
        url.searchParams.set('filter', selectedValue);
        window.location.href = url.toString();
    }
    function doSearch(){
        var sch=$("#searchTitle").val();
        $.ajax({
                url: "search.php",
                data:{title: sch},
                type: "POST",
                success: function(data){
                    $('#formations').html(data).show();
                        }
                    });
      }
          
</script>
  </body>
</html>
