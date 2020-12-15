<?php
/**
 * Auteur : Juliardo Guideiner
 * Date : 08.12.2020
 * Description : Page des fonctions
 */

function displayLoginSection()
{
    if(isset($_SESSION["isConnected"]))
    {
      echo '<form method="post">
              <button type="submit" name="logout" class="btn btn-primary btn-lg">Logout</button>
            </form>';
    }
    else
    {
      echo '<div class="btn-group mr-2" role="group" aria-label="First group">
              <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#connection">Se connecter</button>
            </div>';
    }
}

function login($pageName)
{
    if($_POST["username"] == "admin" && $_POST["password"] == 1664)
    {
        $_SESSION["isConnected"] = 1;
        $_SESSION["username"] = $_POST["username"];
        header("location: " . $pageName);
    }
}

function logout($pageName)
{
    session_destroy();
    header("location: " . $pageName);
}
?>