<?php ob_start(); ?>
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
            <small>Autor</small>
          </h1>


          <div class="col-xs-6">

            <?php insert_categories(); ?>


            <form action="" method="post">
              <div class="form-group">
                <label for="cat_title">Dodaj kategorię</label>
                <input class="form-control" type="text" name="cat_title">
              </div>
              <div class="form-group">
                <input class="btn btn-primery" type="submit" name="submit" value="Dodaj kategorię">
              </div>

            </form>

            <?php //UPDATE AND INCLUDE QUERY

            if (isset($_GET['edit'])) {

              $cat_id = $_GET['edit'];
              include "include/update_categories.php";
            }

            ?>



          </div>
          <!-- Add Category Form -->

          <div class="col-xs-6">

            <?php



            ?>


            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tytuł Kategorii</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>


                <!-- FIND ALL CATEGORIES QUERRY -->
                <?php findAllCategories(); ?>


                <!-- DELETE CATEGORIES QUERRY -->
                <?php delete_categories(); ?>


              </tbody>
            </table>


          </div>




        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "include/admin_footer.php" ?>