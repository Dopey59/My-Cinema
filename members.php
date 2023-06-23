<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css"></rel>
      <title>My Cinema</title>
  </head>
  <style>th {color: red;} tr{color:black;} table{display: flex; justify-content: center;}  td {border: solid 3px black; padding: 10px;} .modify{align-item:center;} </style>
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
                    <li>
                        <a href="./members.html">Subs &#128269;</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
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
      $query = "SELECT *, subscription.name as \"nom\", user.id as \"user_id\"FROM user
      INNER JOIN membership on user.id = membership.id_user
      INNER JOIN subscription ON membership.id_subscription = subscription.id
      ";

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
                <th>Subscription</th>
                <th>Modifier</th>
                <th>Ajouter</th>
                <th>Supprimer</th>
                </tr>";
      foreach($row as $display){
        $firstname = $display['firstname'];
        $lastname = $display['lastname'];
        $sub = $display['nom'];
        $id = $display['user_id'];
        {
            $table .= "<tr>
                      <td>$firstname</td>
                      <td>$lastname</td>
                      <td>$sub</td>
                      <td> 
                      <select name=\"slct\" id=\"slct\">
                            <option value=\"\">Choisissez</option>
                            <option value=\"1\">VIP</option>
                            <option value=\"2\">Gold</option>
                            <option value=\"3\">Classic</option>
                            <option value=\"4\">Pass Day</option>
                      </select>
                      </td>
                      <form action=\"members.php?Firstname=".$_GET['Firstname']."&Lastname=".$_GET['Lastname']."\" method=\"post\">
                        <td> <button name=\"add\" value=\"$id\" class=\"modify\">Add</button> </td>
                      </form>
                      <td> <button name=\"modif\" class=\"supp\">Supp</button> </td>
                      </tr>";
          }
      }
      $table .= "</table>";
      echo $table;
      
      if(isset($_POST['add'])){
        $val = "UPDATE membership set id_subscription = '".$_POST['slct']."' WHERE id_user = ".$_POST['add']."";
        var_dump($val);
        $con->query($val);
        header("Location: members.php?Firstname=".$_GET['Firstname']."&Lastname=".$_GET['Lastname']."");
      }
    }
?>