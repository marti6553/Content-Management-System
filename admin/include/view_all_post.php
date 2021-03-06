<?php

if (isset($_POST['chcekBoxArray'])) {
    foreach ($_POST['chcekBoxArray'] as $postId) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':

                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postId}' ";
                $select_categories_id = mysqli_query($connection, $query);
                break;
            case 'draft':

                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postId}' ";
                $select_draft_id = mysqli_query($connection, $query);
                break;
            case 'delete':

                $query = "DELETE FROM posts WHERE post_id = '{$postId}' ";
                $select_delete_id = mysqli_query($connection, $query);
                break;

            case 'clone':

                $query = "SELECT * FROM posts WHERE post_id = '{$postId}' ";
                $select_clone_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($select_clone_id)) {
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";

                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}', now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                $copy_query = mysqli_query($connection, $query);
                confirmQuery($copy_query);
                break;

            case 'reset_count':

                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = '{$postId}' ";
                $select_reset_count = mysqli_query($connection, $query);
                break;
        }
    }
}
?>


<form action="" method='post'>

    <table class="table table-bordered table-hover">
        <div>
            <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px 0px 15px 0px">

                <select class="form-control" name="bulk_options" id="">
                    <option value="">Wybierz Opcje</option>
                    <option value="published">Zatwierdz</option>
                    <option value="draft">Wstrzymaj</option>
                    <option value="delete">Usuń</option>
                    <option value="clone">Klonuj</option>
                    <option value="reset_count">Resetuj licznik wyświetleń</option>

                </select>

            </div>

            <div class="col-xs-4 btnstyle">

                <input type="submit" name="submit" class="btn btn-success" value="Zastosuj">
                <a class="btn btn-primary" href="posts.php?source=add_post">Dodaj post</a>

            </div>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox">
                </th>
                <th>ID</th>
                <th>Użytkownik</th>
                <th>Tytuł</th>
                <th>Kategoria</th>
                <th>Status</th>
                <th>Miniatura</th>
                <th>Tagi</th>
                <th>Komentarze</th>
                <th>Dodano</th>
                <th></th>
                <th></th>
                <th>Wyświetlenia</th>

            </tr>
        </thead>

        <tbody>

            <?php

            // $query = "SELECT * FROM posts ORDER BY post_id DESC";

            $query =  "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
            $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
            $query .= "FROM posts ";
            $query .= "LEFT JOIN categories ON posts.post_category_id=categories.cat_id ORDER BY posts.post_id DESC";

            $select_post = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_post)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];
                $cat_title = $row['cat_title'];



                echo "<tr>";
            ?>

                <td><input class='checkBoxes' type='checkbox' name='chcekBoxArray[]' value='<?php echo $post_id; ?>'></td>

            <?php

                echo "<td>$post_id</td>";




                if (!empty($post_author)) {
                    echo "<td>$post_author</td>";
                } elseif (!empty($post_user)) {
                    echo "<td>$post_user</td>";
                }









                echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";

                echo "<td>$cat_title</td>";

                if ($post_status == 'published') {
                    echo "<td class= bg-success>Zatwierdzony</td>";
                } else {
                    echo "<td class= bg-warning>Niezatwierdzony</td>";
                }

                echo "<td><img width='100' src='../images/$post_image'</td>";
                echo "<td>$post_tags</td>";

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $sent_comment_query = mysqli_query($connection, $query);
                $count_comments = mysqli_num_rows($sent_comment_query);

                echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";




                echo "<td>$post_date</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edytuj</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Na pewno chcesz usunąć ten post?'); \" href='posts.php?delete={$post_id}'>Usuń</a></td>";
                echo "<td>$post_views_count</td>";
                echo "</tr>";
            }

            ?>

        </tbody>
    </table>
</form>

<?php

if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}



?>