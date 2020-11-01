<?php include "db.php" ?>
<?php session_start(); ?>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./index.php">HOME</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <?php
        $registration_class = '';
        $contact_class = '';
        $pageName = basename($_SERVER['PHP_SELF']);
        $registration = 'registration.php';
        $contact = 'contact.php';

        if ($pageName == $registration) {
          $registration_class = 'active';
        }
        if ($pageName == $contact) {
          $contact_class = 'active';
        }

        ?>
        <?php

        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
        ?>
          <li>
            <a href="admin/index.php">ADMIN</a>
          </li>
        <?php
        }
        ?>

        <?php
        if (!isset($_SESSION['user_role'])) {
        ?>
          <li class=<?php echo $registration_class ?>>
            <a href="./registration.php">Rejestracja</a>
          </li>
        <?php
        }
        ?>

        <li class=<?php echo $contact_class ?>>
          <a href="./contact.php">Kontakt</a>
        </li>

        <?php

        if (isset($_SESSION['user_role'])) {

          if (isset($_GET['p_id'])) {
            $post_id = $_GET['p_id'];
            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
          }
        }
        ?>

      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>