<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>


<?php


if (isset($_POST['submit'])) {

    $to = "marti6553@gmail.com";
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];
    $header = "Od: " . $_POST['email'];

    mail($to, $subject, $body, $header);
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
                        <h1>Kontakt</h1>
                        <form role="form" action="" method="post" id="contact-form" autocomplete="off">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Adres e-mail">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Temat</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Temat">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Wyślij">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "include/footer.php"; ?>