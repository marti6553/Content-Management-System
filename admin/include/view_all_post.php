<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Autor</th>
            <th>Tytuł</th>
            <th>Kategoria</th>
            <th>Status</th>
            <th>Miniatura</th>
            <th>Tagi</th>
            <th>Komentarze</th>
            <th>Data</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>

        <?php

        $query = "SELECT * FROM posts";
        $select_post = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_post)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";

            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
            $select_categories_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
            }
            echo "<td>$cat_title</td>";

            if ($post_status == 'published') {
                echo "<td class= bg-success>Zatwierdzony</td>";
            } else {
                echo "<td class= bg-warning>Niezatwierdzony</td>";
            }

            echo "<td><img width='100' src='../images/$post_image'</td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edytuj</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Usuń</a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>

<?php

if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}



?>