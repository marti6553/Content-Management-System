<?php include "include/db.php" ?>
<?php include "include/header.php" ?>
<?php include "admin/functions.php" ?>


<!-- Navigation -->

<?php include "include/navigation.php" ?>


<!-- Page Content -->

<div class="container">

  <div class="row">


    <!-- Blog Entries Column -->

    <div class="col-md-8">

      <?php

      if (isset($_GET['p_id'])) {
        $post_id = $_GET['p_id'];

        $view_query = "UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id = $post_id ";
        $send_query = mysqli_query($connection, $view_query);
        if (!$send_query) {
          die("query zawiodło " . mysqli_error($connection) . '' . mysqli_errno($connection));
        }


        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
          $query = "SELECT * FROM posts WHERE post_id = $post_id ";
        } else {
          $query = "SELECT * FROM posts WHERE post_id = $post_id AND post_status = 'published' ";
        }

        $select_all_post_query = mysqli_query($connection, $query);

        if (mysqli_num_rows($select_all_post_query) < 1) {

          echo "<h1 class='text-center'>Brak postów do wyświetlenia!</h1>";
        } else {

          while ($row = mysqli_fetch_assoc($select_all_post_query)) {

            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
      ?>



            <!-- First Blog Post -->

            <h2>
              <a href="#"><?php echo $post_title ?></a>
            </h2>

            <span class="glyphicon glyphicon-time"></span> Dodano <?php echo $post_date ?> przez <a href="index.php"><?php echo $post_author ?></a>

            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>


            <hr>

          <?php }





          ?>


          <!-- Blog Comments -->

          <?php

          if (isset($_POST['create_comment'])) {
            $the_post_id = $_GET['p_id'];
            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];

            if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

              $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
              $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

              $create_comment_query = mysqli_query($connection, $query);
              confirmQuery($create_comment_query);


              $success_message = "Twój komentarz oczekuje na akceptacje!";
            } else {

              $error_message = "Aby dodać komentarz musisz wypełnić wszystkie pola!";
            }
          }
          ?>


          <!-- Comments Form -->

          <?php

          if (isset($error_message)) {
            echo "<p class='bg-danger text-center text-danger'>$error_message</p>";
          }

          if (isset($success_message)) {
            echo "<p class='bg-success text-center text-success'>$success_message</p>";
          }

          ?>

          <div id="comments" class="well">
            <h4>Zostaw Komentarz:</h4>
            <form action="" method="post" role="form">
              <div class="form-group">
                <label for="Author">Autor</label>
                <input type="text" name="comment_author" class="form-control">
              </div>
              <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="comment_email" class="form-control">
              </div>
              <div class="form-group">
                <label for="comment">Komentarz</label>
                <textarea name="comment_content" class="form-control" rows="3"></textarea>
              </div>

              <button type="submit" name="create_comment" onclick="scrollToComments()" class="btn btn-primary">Zapisz</button>

              <script>
                function scrollToComments() {
                  window.location = '#comments';
                }
              </script>

            </form>
          </div>

          <hr>


          <!-- Posted Comments -->

          <?php

          $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
          $query .= "AND comment_status = 'approved' ";
          $query .= "ORDER BY comment_id DESC ";
          $select_comment_query = mysqli_query($connection, $query);
          confirmQuery($select_comment_query);

          while ($row = mysqli_fetch_assoc($select_comment_query)) {
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];
            $comment_author = $row['comment_author'];

          ?>

            <div class="media">
              <a class="pull-left" href="#">
                <div style="width: 60px; height: 60px; background: gray; "></div>
              </a>
              <div class="media-body">
                <h4 class="media-heading"><?php echo $comment_author ?>
                  <small><?php echo $comment_date ?></small>
                </h4>
                <?php echo $comment_content ?>
              </div>
            </div>

      <?php }
        }
      } else {

        header("Location: index.php");
      } ?>

      <!-- Comment -->

    </div>

    <!-- Blog Sidebar Widgets Column -->

    <?php include "include/sidebar.php" ?>

  </div>


  <!-- /.row -->


  <hr>

  <?php include "include/footer.php" ?>