<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>


<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    if ($username == NULL || $password == NULL || $email == NULL) {
        echo "<p class='bg-danger text-center'>Uzupełnik wymagane pola.</p>";
    } else {

        $username = mysqli_real_escape_string($connection, $username);
        $email    = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES('{$username}','{$email}','$password','subscriber')";
        $register_user_query = mysqli_query($connection, $query);
        if (!$register_user_query) {
            die("query zawiodło " . mysqli_error($connection) . '' . mysqli_errno($connection));
        }
        echo "<p class='bg-success text-center'>Konto zostało utowrzone.</p>";
    }
}

?>


<!-- Navigation -->

<?php include "include/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Rejestracja</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group border">
                                <label for="username" class="sr-only">Nazwa Użytkownik</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Nazwa Użytkownik*">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Adres e-mail*">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Hasło</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Hasło*">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Zarejestruj się">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "include/footer.php"; ?>