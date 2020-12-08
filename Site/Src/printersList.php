<?php
/**
 * Auteur : Juliardo Guideiner
 * Date : 08.12.2020
 * Description : Page listant les imprimantes
 */

  include "Database.php";
  include "functions.php";
  session_start();

  $database = new Database();


  $printers = array();
  if(isset($_GET["grundschutz"]))
  {
    if($_GET["grundschutz"] == "mark")
    {
      $printers = $database->getSomePrintersByMark();
    } 
    else if ($_GET["grundschutz"] == "maker")
    {
      $printers = $database->getSomePrintersByMaker();
    }
  }
  else
  {
    $printers = $database->getAllPrinters();
  }

  $marks = $database->getPrintersMark();
  $makers = $database->getPrintersMaker();

  if (isset($_POST["login"])) {
    login("printersList.php");
  }
  if (isset($_POST["logout"])) {
      logout("printersList.php");
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


      .us {
        border: 1px;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
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
            <a class="nav-link" href="#">Liste des imprimantes <span class="sr-only">(current)</span></a>
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
              <form action="#" method="post">
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

      <div class="modal fade" id="modify" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Se connecter</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="#" method="post">
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="jumbotron" style="background-color: #e3f2fd;">
        <div class="container">
          <h1 class="display-3">Imprimax vous renseigne !</h1>
          <p>Dans cette section, sont listées toutes les imprimantes que nous proposons. Il est possible de les trier par dates, prix, capacité, etc...</p>
          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <?php
                displayLoginSection();
            ?>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <table width=100% frame=void rules=rows>
            <tr>
              <h3>         
                <th><a href="">Modèle</a></th>
                <th><a href="printersList.php?grundschutz=maker">Fabricant</a></th>
                <th><a href="printersList.php?grundschutz=mark">Marque</a></th>
                <th><a href="">Poids</a></th>
              </h3>
            </tr>
            <?php

              foreach($printers as $printer)
              {
                $selectedMaker;
                $selectedMark;
                foreach($makers as $maker)
                {
                  if($maker["idMaker"] == $printer["idMaker"])
                  {
                    $selectedMaker = $maker; 
                  }
                }
                foreach($marks as $mark)
                {
                  if($mark["idMark"] == $printer["idMark"])
                  {
                    $selectedMark = $mark; 
                  }
                }
                echo '<tr>
                        <td>' . $printer["priModel"] . '</td>
                        <td>' . $selectedMaker["makName"] . '</td>
                        <td>' . $selectedMark["marName"] . '</td>
                        <td>' . $printer["priWeight"] . '</td>
                        <td><a href="details.php?idPrinter=' . $printer["idPrinter"] . '" class="fa fa-search fa-2x btn-outline-secondary"></a></td>
                      </tr>';
                echo '<hr>';
              }
            
            ?>
          </table>
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