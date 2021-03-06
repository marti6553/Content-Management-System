<?php

if (isset($_GET['p_id'])) {
  $the_post_id = $_GET['p_id'];
}


$query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
  $post_id = $row['post_id'];
  $post_user = $row['post_user'];
  $post_title = $row['post_title'];
  $post_category_id = $row['post_category_id'];
  $post_status = $row['post_status'];
  $post_image = $row['post_image'];
  $post_content = $row['post_content'];
  $post_tags = $row['post_tags'];
  $post_comment_count = $row['post_comment_count'];
  $post_date = $row['post_date'];
}

if (isset($_POST['update_post'])) {

  $post_author = $_POST['post_author'];
  $post_title = $_POST['post_title'];
  $post_category_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
  $post_content = $_POST['post_content'];
  $post_tags = $_POST['post_tags'];

  move_uploaded_file($post_image_temp, "../images/$post_image");

  if (empty($post_image)) {
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_image = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_image)) {
      $post_image = $row['post_image'];
    }
  }



  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$post_title}', ";
  $query .= "post_category_id = '{$post_category_id}', ";
  $query .= "post_date = now(), ";
  $query .= "post_author = '{$post_author}', ";
  $query .= "post_status = '{$post_status}', ";
  $query .= "post_tags = '{$post_tags}', ";
  $query .= "post_content = '{$post_content}', ";
  $query .= "post_image = '{$post_image}' ";
  $query .= "WHERE post_id = {$the_post_id} ";

  $update_post = mysqli_query($connection, $query);

  confirmQuery($update_post);

  echo "<p class='bg-success text-center'>Post został zaktualizowany.<br><a href='posts.php'>Wszystkie posty</a><br><a href='../post.php?p_id={$the_post_id}'>Zobacz post</a></p>";
}

?>


<form action="" method="post" enctype="multipart/form-data">


  <div class="form-group">
    <label for="title">Tytuł Wpisu</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
  </div>

  <div class="form-group">
    <label for="title">Kategoria Wpisu</label>
    <select class="form-control" name="post_category" id="">

      <?php

      $query = "SELECT * FROM categories";
      $select_categories = mysqli_query($connection, $query);

      confirmQuery($select_categories);

      while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        if ($cat_id == $post_category_id) {
          echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
        } else {
          echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
      }
      ?>

    </select>

  </div>

  <div class="form-group">
    <label for="title">Autor Wpisu</label>
    <select class="form-control" name="post_author">


      <?php echo "<option value='{$username}'>{$post_user}</option>"; ?>

      <?php

      $query = "SELECT * FROM users";
      $select_all_users = mysqli_query($connection, $query);

      confirmQuery($select_all_users);

      while ($row = mysqli_fetch_assoc($select_all_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        echo "<option value='{$username}'>{$username}</option>";
      }

      ?>

    </select>
  </div>

  <div class="form-group">
    <label for="title">Status Wpisu</label>
    <select class="form-control" name="post_status" id="">
      <?php
      if ($post_status == 'draft') {
        echo "<option value='draft'>Niezatwierdzony</option>";
      } else {
        echo "<option value='published'>Zatwierdzony</option>";
      }

      if ($post_status == 'published') {
        echo "<option value='draft'>Niezatwierdzony</option>";
      } else {
        echo "<option value='published'>Zatwierdzony</option>";
      }


      ?>
    </select>
  </div>

  <div class="form-group">
    <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Tagi Wpisu</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Zawartość Wpisu</label>
    <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    <style>
      .ck-editor__editable_inline {
        min-height: 250px;
      }
    </style>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Zapisz zmiany">
  </div>

</form>


<script src="./js/scripts.js"></script>