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

      $query = "SELECT * FROM posts";
      $select_all_post_query = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($select_all_post_query)) {

        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 500);
        $post_status = $row['post_status'];


        if ($post_status !== 'published') {
          echo "<h1> Wygląda na to, że niczego tu nie ma :(</h1>";
        } else {
      ?>

          <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
          </h1>

          <!-- First Blog Post -->
          <h2>
            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
          </h2>

          <span class="glyphicon glyphicon-time"></span> Dodano <?php echo $post_date ?> przez <a href="index.php"><?php echo $post_author ?></a>

          <hr>
          <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
          <hr>
          <p><?php echo $post_content ?></p>
          <a class="btn btn-primary" href="#">Rozwiń<span class="glyphicon glyphicon-chevron-right"></span></a>

          <hr>

      <?php }
      } ?>



    </div>

    <!-- Blog Sidebar Widgets Column -->

    <?php include "include/sidebar.php" ?>

  </div>
  <!-- /.row -->

  <hr>

  <?php include "include/footer.php" ?>