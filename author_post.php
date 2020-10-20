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

            if (isset($_GET['author'])) {
                $the_post_author = $_GET['author'];
            }
            ?>

            <h1 class="page-header text-center">
                Przeglądasz wszystkie posty użytkownika <p> <?php echo $the_post_author ?>

            </h1>

            <?php
            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
            $select_all_post_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_post_query)) {

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_id = $row['post_id']
            ?>

                <!-- First Blog Post -->

                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>

                <span class="glyphicon glyphicon-time"></span> Dodano <?php echo $post_date ?> przez <?php echo $post_author ?></a>

                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a href="post.php?p_id=<?php echo $post_id; ?>" class="btn btn-primary" href="#">Rozwiń<span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } ?>



        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "include/sidebar.php" ?>

    </div>


    <!-- /.row -->


    <hr>

    <?php include "include/footer.php" ?>