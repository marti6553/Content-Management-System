<?php include "db.php" ?>

<div class="col-md-4">

  <!-- Blog Search Well -->

  <div class="well">
    <h4>Wyszukaj</h4>
    <form action="search" method="post">
      <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
          <button name="submit" class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </form> <!-- search form  -->


    <!-- /.input-group -->
  </div>


  <!-- Login -->
  <?php
  if (isset($_SESSION['user_role'])) {
  ?>
    <div class="well">
      <h4 class='text-center'>Zalogowany jako <?php echo $_SESSION['username']; ?></h4>
      <h6 class='text-center'>Ranga <?php echo $_SESSION['user_role']; ?></h6>
      <form action="">
        <div class='text-center'>
          <a class="btn btn-primary" href=".\admin\include\logout.php">Wyloguj</a>
        </div>
      </form>
    </div>
  <?php
  } else {
  ?>
    <div class="well">
      <h4>Logowanie</h4>
      <form action="include/login.php" method="post">
        <div class="form-group">
          <input name="username" type="text" class="form-control" placeholder="Login">
        </div>
        <div class="input-group">
          <input name="password" type="password" class="form-control" placeholder="Hasło">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" name="login">Zaloguj się</button>
          </span>
        </div>
      </form>
    </div>
  <?php } ?>






  <!-- Blog Categories Well -->
  <div class="well">

    <?php

    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $query);


    ?>



    <h4>Dostępne Kategorie: </h4>
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled">
          <?php

          while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
          }
          ?>
        </ul>
      </div>



    </div>
    <!-- /.row -->
  </div>

  <!-- Side Widget Well -->
  <?php include "widget.php" ?>

</div>