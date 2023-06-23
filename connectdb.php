<?php
//database cnx
$con = mysqli_connect('localhost', 'root','new_root', 'cinema');
if (!$con){
    die(my_sqli_error("Error"+$con));
}
?> 
