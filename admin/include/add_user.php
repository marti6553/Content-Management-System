<?php

if (isset($_POST['create_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    if ($username == NULL || $user_password == NULL || $user_email == NULL) {
        echo "<p class='bg-danger text-center'>Uzupełnik brakujące pola.</p>";
    } else {

        $username = mysqli_real_escape_string($connection, $username);
        $email    = mysqli_real_escape_string($connection, $user_email);
        $password = mysqli_real_escape_string($connection, $user_password);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password)";
        $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$email}','{$password}')";
        $create_user_query = mysqli_query($connection, $query);
        confirmQuery($create_user_query);

        echo "Użytkownik {$username} dodany - " . "<a href='./users.php'>Lista użytkowników</a>";
    }
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
        <label for="post_status">Rola</label>
        <select class="form-control" name="user_role" id="">
            <option value="subscriber">Wybierz</option>
            <option value="admin">Administrator</option>
            <option value="subscriber">Subskrybent</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags">Nazwa Użytkownika*</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email*</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Hasło*</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Stwórz">
    </div>

</form>