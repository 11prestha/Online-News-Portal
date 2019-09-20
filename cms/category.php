<?php require "../config/init.php"; 
  require 'inc/checklogin.php';
?>

<?php require "inc/header.php"; ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php require "inc/sidebar.php"; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php require "inc/top-nav.php" ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Category List
          <a href="category-form.php" class="btn btn-success float-right"><i class='fa fa-plus'></i> Add Category</a>
          </h1>
          <hr>
          <div class="row">
            <div class="col-12">
                <table class='table'>
                    <thead class='thead-dark'>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                        $category = new Category();
                        $category_all = $category->getAllRows();
                        if($category_all){
                          foreach($category_all as $key=>$cat_data){
                            ?>
                            <tr>
                              <td><?php echo $key+1; ?></td>
                              <td><?php echo $cat_data->title; ?></td>
                              <td>
                                <span class="badge badge-<?php echo ($cat_data->status == 'active') ? 'success' :'danger'; ?>">
                                <?php echo ucfirst($cat_data->status); ?>
                                </span>
                              </td>
                              <td>
                                <?php
                                  if($cat_data->image != ""){
                                    ?>
                                    <img src="<?php echo UPLOAD_URL.'/category/'.$cat_data->image; ?>" alt="" class="img img-fluid img-thumbnail" style="max-width:50px;">
                                    <?php
                                  }else{
                                    echo "No Image";
                                  }
                                ?>
                              </td>
                              <td> Edit/Delete </td>
                            </tr>
                            <?php
                          }
                        }
                      ?>
                    </tbody>
                </table>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php require "inc/copy.php"; ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php require "inc/footer.php"; ?>