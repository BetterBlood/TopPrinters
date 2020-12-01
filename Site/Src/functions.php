<?php
/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : various utilities and functions to use throughout the code
 */


/**
 * Concatenation of author's name and surname
 * @param array $table
 * @param int $index
 * @return string
 */
function findAutName(array $table, int $index): string
{
    return $table[$index - 1]["autName"] . " " . $table[$index - 1]["autSurname"];
}

function displayLoginSection()
{
    if(isset($_SESSION["isConnected"]))
    {
      echo '<form method="post">
              <div class="form-group" >
              <label for="username">Connecté en tant qu\'administrateur</label>
              </div>
              <button type="submit" name="logout" class="btn btn-primary">Logout</button>
            </form>
            <div class="btn-group mr-2" role="group" aria-label="First group">
              <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#teacher">Ajouter une imprimante</button>
            </div>';
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