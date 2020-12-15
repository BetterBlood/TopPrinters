<?php
/**
 * Auteur : Juliardo Guideiner
 * Date : 08.12.2020
 * Description : Page détail d'une imprimante
 */

    include "Database.php";
    include "functions.php";
    session_start();

    $database = new Database();
    $details = $database->getPrinterByID($_GET["idPrinter"]);

    if (isset($_POST["login"])) {
        login("home.php");
    }
    if (isset($_POST["logout"])) {
        logout("home.php");
    }

    //$printers = $database->getAllPrinters();

    function makePictureName($teacher)
    {
      $name = substr($teacher["teaFirstName"],0,3) . $teacher["teaLastName"] . ".jpg";
      return $name;
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Le mega site des imprimantes</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      table {
        border: 1px blue;
      }

      .us {
        border: 1px;
      }

      td {
        width: 260px
      }

      .list-group-item{
        width: 100%;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="jumbotron.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
      <a class="navbar-brand" href="#"><strong>Imprimax</strong></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">Accueil <span class="sr-only"></span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="printersList.php">Liste des imprimantes <span class="sr-only"></span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post"  action="#">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchValue">
          <button class="btn btn-dark my-2 my-sm-0" name="search" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <main role="main">

      <div class="modal fade" id="teacher" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Ajouter une imprimante</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="insertTeacher.php" method="post">
                <div class="form-group">
                  <label for="exampleFormControlInputFir">Nom du modèle</label>
                  <input type="text" class="form-control" id="exampleFormControlInputFir" name="name">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInputLast">Marque</label>
                  <input type="text" class="form-control" id="exampleFormControlInputLast" name="brand">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Fabricant</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="constructor">
                  </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="connection" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Se connecter</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="home.php" method="post">
                <div class="form-group">
                  <label for="exampleFormControlInputFir">Username</label>
                  <input type="text" class="form-control" id="exampleFormControlInputFir" name="username">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInputLast">Password</label>
                  <input type="password" class="form-control" id="exampleFormControlInputLast" name="password">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <input type="submit" name="login" class="btn btn-primary" value="Connexion">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="jumbotron" style="background-color: #e3f2fd;">
        <div class="container">
          <h1 class="display-3">Imprimax vous renseigne !</h1>
          <?php
            echo '<p>Voici les details techniques concernant le modèle d\'imprimante ' . $details["priModel"] . '</p>';
          ?>
          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <?php
                displayLoginSection();
            ?>
          </div>
        </div>
      </div>

      <div class="container">
            <?php
                echo '<h4>Détails technique du modèle ' . $details["priModel"] . '</h4><br>';
            ?>
            <div>
                <div class="atline">
                    <?php
                        echo '<ul class="list-group">
                                <li class="list-group-item"><table><td><strong>Nom du modèle : </strong></td><td>' . $details["priModel"] . '</td></table></li>
                                <li class="list-group-item"><table><td><strong>Marque : </strong></td><td>' . $details["marName"] . ' </td></table></li>
                                <li class="list-group-item"><table><td><strong>Fabricant : </strong></td><td> ' . $details["makName"] . ' </td></table></li>
                                <li class="list-group-item"><table><td><strong>Vitesse : </strong></td><td>' . $details["priPrintingSpeed"] . '</td></table></li>
                                <li class="list-group-item"><table><td><strong>Capacité en feuilles : </strong></td><td>' . $details["priCapacity"] . '</td></table></li>
                                <li class="list-group-item"><table><td><strong>Poids en kg : </strong></td><td>' . $details["priWeight"] . '</td></table></li>
                                <li class="list-group-item"><table><td><strong>Résolution : </strong></td><td>' . $details["priResolutionX"] . 'px, ' . $details["priResolutionY"] . 'px</td></table></li>
                                <li class="list-group-item"><table><td><strong>Dimensions : </strong></td><td>' . $details["priWidth"] . 'cm, ' . $details["priLength"] . 'cm, ' . $details["priHeight"] . 'cm</td></table></li>
                                <li class="list-group-item"><table><td><strong>Prix : </strong></td><td>' . $details["priPrice"] . ' CHF</td></table></li>
                                <li class="list-group-item"><table><td><strong>Technology : </strong></td><td>' . $details["idTechnology"] . '</td></table></li>
                            </ul>';
                    ?>
                </div>
            </div>
        <hr>
      </div>
    </main>
  </body>

  <footer class="container">
    <p>&copy; ETML, 2020</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>