<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CMS Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="../index.php">HOME SITE</a></li>


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../admin/include/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fas fa-mail-bulk"></i> Posty <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">Wszystkie Posty</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post">Dodaj Post</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Kategorie</a>
            </li>
            <li class="">
                <a href="comments.php"><i class="far fa-comments"></i> Komentarze</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fas fa-users"></i> Użytkownicy <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="./users.php">Wszyscy Użytkownicy</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Dodaj Użytkownika</a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="profile.php"><i class="fas fa-id-card"></i> Profile</a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>