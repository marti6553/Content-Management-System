<?php

$servername = "localhost";
$username = "root";
$password = "";

$connection = mysqli_connect($servername, $username, $password, 'cms');

if (!$connection) {
  echo "Nie łącze z bazą!";
}
mysqli_query($connection, "SET NAMES 'utf8'");
