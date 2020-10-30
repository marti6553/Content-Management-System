<?php include "include/db.php" ?>
<?php include "include/header.php" ?>

<!-- Navigation -->

<?php include "include/navigation.php" ?>

<!-- Page Content -->

<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->

    <div class="col-md-8">

      <?php

      if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
        $post_query_count = "SELECT * FROM posts";
      } else {
        $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
      }

      $find_count = mysqli_query($connection, $post_query_count);
      $count = mysqli_num_rows($find_count);

      if ($count < 1) {

        echo "<h1 class='text-center'>Brak postów do wyświetlenia!</h1>";
      } else {


        $count = ceil($count / 5);

        if (isset($_GET['page'])) {
          $page = $_GET['page'];
        } else {
          $page = "";
        }

        if ($page == "" || $page == 1) {
          $page_1 = 0;
        } else {
          $page_1 = ($page * 5) - 5;
        }


        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
          $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1, 5";
        } else {
          $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_1, 5";
        }

        $select_all_post_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_post_query)) {

          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
          $post_user = $row['post_user'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_content = substr($row['post_content'], 0, 500);
          $post_status = $row['post_status'];

      ?>

          <!-- First Blog Post -->
          <h2>
            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
          </h2>

          <span class="glyphicon glyphicon-time"></span> Dodano <?php echo $post_date; ?> przez <a href="author_post.php?author=<?php echo $post_user; ?>"><?php echo $post_user; ?></a>

          <hr>
          <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
          <hr>
          <p><?php echo $post_content ?></p>
          <a href="post.php?p_id=<?php echo $post_id; ?>" class="btn btn-primary" href="#">Rozwiń<span class="glyphicon glyphicon-chevron-right"></span></a>

          <hr>

      <?php
        }
      } ?>



    </div>

    <!-- Blog Sidebar Widgets Column -->

    <?php include "include/sidebar.php" ?>

  </div>
  <!-- /.row -->

  <hr>

  <ul class="pager">
    <?php
    for ($i = 1; $i <= $count; $i++) {

      if ($i == $page) {
        echo "<li><a class='activ_link' href='index.php?page=$i'>{$i}</a></li>";
      } else {
        echo "<li><a href='index.php?page=$i'>{$i}</a></li>";
      }
    }


    ?>
  </ul>



  <?php include "include/footer.php" ?>