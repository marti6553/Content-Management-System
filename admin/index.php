<?php include "include/admin_header.php" ?>

<div id="wrapper">



    <!-- Navigation -->


    <?php include "include/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">


                    <h1 class="page-header">
                        Panel Administracyjny

                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="far fa-file-alt fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php echo $post_count = recordCount('posts'); ?></div>

                                    <div>Posty</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">Zobacz Szczegóły</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


                                    <div class='huge'><?php echo $comments_count = recordCount('comments'); ?></div>


                                    <div>Komentarze</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">Zobacz Szczegóły</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php echo $users_count = recordCount('users'); ?></div>

                                    <div> Użytkownicy</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">Zobacz Szczegóły</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php echo $categories_count = recordCount('categories'); ?></div>

                                    <div>Kategorie</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">Zobacz Szczegóły</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php

            $post_count = recordCount('posts');
            $published_count = checkStatus('posts', 'post_status', 'published');
            $draft_count = checkStatus('posts', 'post_status', 'draft');
            $comments_count = recordCount('comments');
            $unapproved_count = checkStatus('comments', 'comment_status', 'unapproved');
            $users_count = recordCount('users');
            $subscriber_count = checkStatus('users', 'user_role', 'subscriber');
            $categories_count = recordCount('categories');

            ?>




            <div class="row">

                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['', 'Ilość'],

                            <?php

                            $element_text = ['Posty', 'Posty zatwierdzone', 'Posty niezatwierdzone', 'Komentarze', 'Komentarze niezatwierdzone', 'Użytkownicy', 'Subskrybenci', 'Kategorie'];
                            $element_count = [$post_count, $published_count, $draft_count, $comments_count, $unapproved_count, $users_count, $subscriber_count, $categories_count];

                            for ($i = 0; $i < 8; $i++) {
                                echo "['{$element_text[$i]}'" . ", " . "$element_count[$i]" . "],";
                            }

                            ?>

                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php" ?>