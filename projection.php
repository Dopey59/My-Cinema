<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css"></rel>
      <title>My Cinema</title>
  </head>
  <style>th {color: red;} tr{color:black;} table{display: flex; justify-content: center;}  td {border: solid 3px black; padding: 10px;}</style>

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
                        <a href="./logsprgm/login_form.php">Login &#9881;</a>
                    </li>
                    <li>
                        <a href="./user.html">Search users &#127902;</a>
                    </li>
                    <li>
                        <a href="./projection.html"> Dates | Projections &#127902;</a>
                    </li>
                    <li>
                        <a href="./seances.html">Movies &#128269;</a>
                    </li>
                    <li>
                        <a href="./members.html">Subs  &#128269;</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</html>

<?php
// Créer une connexion
@include 'connectdb.php';
// Vérifier la connexion
if ($mysqli->connect_error) {
  die("<strong>Connexion a échouée: </strong>" . $mysqli->connect_error);
}
// Récupère les informations
if (count($_GET) !== 0) {
    $title = $_GET['title'];
    $date_begin = $_GET['date'];


// Système de recherche
      $query = "SELECT * FROM movie 
      INNER JOIN movie_schedule ON movie.id = movie_schedule.id_movie
      ";

      if (!empty($title)) {
        $query .= " AND movie.title LIKE '%$title%' ";
      }

       if (!empty($date_begin)) {
         $query .= " AND movie_schedule.date_begin LIKE '%$date_begin%' ";
      }
     
      $result = $con->query($query);
// Système d'affichage des données trouver selon les requêtes
      $row = $result->fetch_all(MYSQLI_ASSOC);
      echo "Dates found: " . count($row) . "<br/><br/>";
      $table = "";
      $table .= "<table>";
      $table .= " <tr>
                <th>Avaible dates</th>
                <th>Title Movie</th>
                </tr>";
      foreach($row as $display){
        $title = $display['title'];
         $date_begin = $display['date_begin'];
        {
          $table .= "<tr>
                    <td>$date_begin</td>
                    <td>$title</td>
                    </tr>";

        }
    }
    $table .= "</table>";
    echo $table;
}
?>