<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_profile = mysqli_query($connection, $query);
    confirmQuery($select_user_profile);

    while ($row = mysqli_fetch_assoc($select_user_profile)) {
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }

    if (isset($_POST['update_profile'])) {

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['user_email'];

        if ($user_email == NULL) {

            echo "<p class='bg-danger text-center'>Uzupełnik wymagane pola.</p>";
        } else {

            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_role = '{$user_role}', ";
            $query .= "user_email = '{$user_email}' ";
            $query .= "WHERE user_id = {$user_id} ";

            $edit_user_query = mysqli_query($connection, $query);
            confirmQuery($edit_user_query);
            echo "<p class='bg-success text-center'>Profil został zaktualizowany.</p>";
        }
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
        <label>Rola</label>
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

    <div class="form-group">
        <label for="post_content">Email*</label>
        <input value="<?php echo $user_email ?>" type="email" class="form-control" name="user_email">
    </div>




    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_profile" value="Zapisz zmiany">
    </div>
</form>