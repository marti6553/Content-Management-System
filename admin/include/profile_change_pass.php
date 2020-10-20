<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if (isset($_POST['update_pass'])) {


        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_query = mysqli_query($connection, $query);
        if (!$select_user_query) {
            die("query zawiodło " . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_array($select_user_query)) {
            $db_user_password = $row['user_password'];
        }




        $user_password = $_POST['user_password'];
        $user_new_password = $_POST['user_new_password'];
        $user_new_password2 = $_POST['user_new_password2'];


        if ($user_new_password != $user_new_password2) {
            echo "<p class='bg-danger text-center'>Nowe hasła różnią się.</p>";
        } else {
            if ($user_new_password === $user_new_password2 && password_verify($user_password, $db_user_password) === true) {

                $user_new_password = password_hash($user_new_password, PASSWORD_BCRYPT);

                $query = "UPDATE users SET user_password = '{$user_new_password}' WHERE username = '{$username}'";
                $change_pass_query = mysqli_query($connection, $query);
                confirmQuery($change_pass_query);
                echo "<p class='bg-success text-center'>Hasło zostało zaktualizowane.</p>";
            } else {
                echo "<p class='bg-danger text-center'>Twoje hasło było nieprawidłowe.</p>";
            }
        }
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_content">Bieżące Hasło*</label>
        <input value="" type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="post_content">Nowe Hasło*</label>
        <input value="" type="password" class="form-control" name="user_new_password">
    </div>

    <div class="form-group">
        <label for="post_content">Powtórz Hasło*</label>
        <input value="" type="password" class="form-control" name="user_new_password2">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_pass" value="Zapisz zmiany">
    </div>
</form>