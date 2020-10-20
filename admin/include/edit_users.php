<?php

if (isset($_GET['edit_user'])) {
  $the_user_id = $_GET['edit_user'];
}

$query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
$select_user_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_user_by_id)) {
  $user_id = $row['user_id'];
  $username = $row['username'];
  $user_firstname = $row['user_firstname'];
  $user_lastname = $row['user_lastname'];
  $user_email = $row['user_email'];
  $user_image = $row['user_image'];
  $user_role = $row['user_role'];
}

if (isset($_POST['edit_user'])) {

  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_role = $_POST['user_role'];
  $username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

  if ($username == NULL || $user_password == NULL || $user_email == NULL) {
    echo "<p class='bg-danger text-center'>Uzupełnik wymagane pola.</p>";
  } else {

    $username = mysqli_real_escape_string($connection, $username);
    $user_email    = mysqli_real_escape_string($connection, $user_email);
    $user_password = password_hash($user_password, PASSWORD_BCRYPT);

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$the_user_id} ";

    $edit_user_query = mysqli_query($connection, $query);
    confirmQuery($edit_user_query);
    echo "<p class='bg-success text-center'>Profil został zaktualizowany.</p>";
  }
}



?>



<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Imię</label>
    <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="post_status">Nazwisko</label>
    <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
    <label for="title">Rola</label>
    <select class="form-control" name="user_role" id="">

      <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>

      <?php

      if ($user_role == 'admin') {
        echo "<option value='subscriber'>subskrybent</option>";
      } else {
        echo  "<option value='admin'>administrator</option>";
      }

      ?>



    </select>

  </div>

  <!-- <div class="form-group">
        <label for="post_image">Miniatura Wpisu</label>
            <input type="file" name="image">
    </div> -->

  <div class="form-group">
    <label for="post_tags">Nazwa Użytkownika*</label>
    <input value="<?php echo $username ?>" type="text" class="form-control" name="username">
  </div>

  <div class="form-group">
    <label for="post_content">Email*</label>
    <input value="<?php echo $user_email ?>" type="email" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="post_content">Nowe Hasło*</label>
    <input type="password" class="form-control" name="user_password">
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Zapisz zmiany">
  </div>

</form>