
<?php

function users_online()
{

  if (isset($_GET['onlineusers'])) {

    global $connection;

    if (!$connection) {

      session_start();
      include("../include/db.php");

      $time = time();
      $session = session_id();
      $time_out_in_secounds = 60;
      $time_out = $time - $time_out_in_secounds;

      $query = "SELECT * FROM users_online WHERE session = '$session'";
      $send_query = mysqli_query($connection, $query);
      $count = mysqli_num_rows($send_query);

      if ($count == NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUE('$session','$time')");
      } else {
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
      }
      $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
      echo mysqli_num_rows($users_online_query);
    }
  } //get request isset()
}

users_online();


function confirmQuery($result)
{

  global $connection;

  if (!$result) {
    die("QUERY FAILD: " . mysqli_error($connection));
  }
}


function insert_categories()
{

  global $connection;

  if (isset($_POST['submit'])) {

    $cat_title = $_POST['cat_title'];

    if ($cat_title == "" || empty($cat_title)) {
      echo "To pole nie może być puste!";
    } else {

      $query = "INSERT INTO categories(cat_title) ";
      $query .= "VALUE('{$cat_title}') ";

      $create_category_query = mysqli_query($connection, $query);

      if (!$create_category_query) {
        die('Queery zawiodło' . mysqli_error($connection));
      }
    }
  }
}


function findAllCategories()
{

  global $connection;

  $query = "SELECT * FROM categories ORDER BY cat_id";
  $select_categories = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?edit={$cat_id}'</a>Edytuj</td>";
    echo "<td><a onClick=\"javascript: return confirm('Na pewno chcesz usunąć tę kategorię?'); \" href='categories.php?delete={$cat_id}'</a>Usuń</td>";
  }
}


function delete_categories()
{

  global $connection;

  if (isset($_GET['delete'])) {
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_categories = mysqli_query($connection, $query);
    header("Location: categories.php");
  }
}


/**** ADMIN DASHBOARD STATS COUNTERS ****/

function recordCount($table)
{
  global $connection;

  $query = "SELECT * FROM " . $table;
  $select_all_post = mysqli_query($connection, $query);
  $result = mysqli_num_rows($select_all_post);
  confirmQuery($result);
  return $result;
}

function checkStatus($table, $column, $status)
{
  global $connection;

  $query = "SELECT * FROM $table WHERE $column = '$status'";
  $select_all_published = mysqli_query($connection, $query);
  $result = mysqli_num_rows($select_all_published);
  confirmQuery($select_all_published);
  return $result;
}
