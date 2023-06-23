<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css"></rel>
      <title>My Cinema</title>
  </head>
  <style>th {color: red;} tr{color:black; margin: 15px;} table{display: flex; justify-content: center;}  td {border: solid 3px black; padding: 10px;}</style>
    <body>
    <header>
        <div class="nav">
            <div class="nav__title">
                <h1>My Cinema</h1>
            </div>
            <img  class="nav__popcorn" src="./assets/popcorn.png">
            <div class="navbar">
                <ul>
                    <li>
                        <a href="./index.html">Home </a>
                    </li>
                    <li>
                        <a href="./login.php">Login &#9881;</a>
                    </li>
                    <li>
                        <a href="./user.html">Search users &#127902;</a>
                    </li>
                    <li>
                        <a href="./projection.php"> Dates | Projections &#127902;</a>
                    </li>
                    <li>
                        <a href="./seances.html">Movies &#128269;</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <style> table {display: flex; justify-content: center; padding: 10%;} th {color: red; }</style>
    </body>
</html>


<?php
// Créer une connexion
@include 'connectdb.php';

// Récupère les informations du formulaire
if (count($_GET) !== 0) {
    $firstname = $_GET['Firstname'];
    $lastname = $_GET['Lastname'];

// Système de recherche
      $query = "SELECT * FROM user
      WHERE 1";

      if (!empty($firstname)) {
        $query .= " AND user.firstname LIKE '%$firstname%' ";
      }
      if (!empty($lastname)) {
        $query .= " AND user.lastname LIKE '%$lastname%' ";
      }
      $result = $con->query($query);
// Système d'affichage des données trouver selon les requêtes

      $row = $result->fetch_all(MYSQLI_ASSOC);
      $table = "";
      $table .= "<table>";
      $table .= "<tr>
                <th>Firstname</th>
                <th>Lastname</th>
                </tr>";
      foreach($row as $display){
        $firstname = $display['firstname'];
        $lastname = $display['lastname'];
        {
            $table .= "<tr>
                      <td>$firstname</td>
                      <td>$lastname</td>
                      </tr>";
  
          }
      }
      $table .= "</table>";
      echo $table;
    }
?>