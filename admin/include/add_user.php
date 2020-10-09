
<?php

if (isset($_POST['create_user'])) {

  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_role = $_POST['user_role'];

  // $user_ = $_FILES['image']['name'];
  // $user_ = $_FILES['image']['tmp_name'];

  $username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  // $user_ = date('Y-m-d');


      // move_uploaded_file($post_image_temp, "../images/$post_image" );

      $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_image, user_password, randSalt )";

      $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}',0,'{$user_password}','0')";

      $create_user_query = mysqli_query($connection, $query);

      confirmQuery($create_user_query);

}


 ?>



<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
      <label for="title">Imię</label>
          <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
      <label for="post_status">Nazwisko</label>
          <input type="text" class="form-control" name="user_lastname">
  </div>

    <div class="form-group">

      <select name="user_role" id="">

      <option value="subscriber">Wybierz</option>
      <option value="admin">Administrator</option>
      <option value="subscriber">Subskrybent</option>

      </select>

    </div>

    <!-- <div class="form-group">
        <label for="post_image">Miniatura Wpisu</label>
            <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">Nazwa Użytkownika</label>
            <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
            <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Hasło</label>
            <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit"  name="create_user" value="Stwórz">
    </div>

</form>
