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
          <h1 class="h3 mb-4 text-gray-800">Category Add</h1>
            <div class="row">
                <div class="col-12">
                    <form action='process/category.php' method='post' enctype='multipart/form-data' class='form'>
                        <div class="form-group row">
                            <label class='col-sm-2'>Title:</label>
                            <div class="col-sm-8">
                                <input type="text" name='title' id='title' placeholder='Enter category title' class="form form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class='col-sm-2'>Summary:</label>
                            <div class="col-sm-8">
                                <textarea name='summary' id='title' rows='5' style='resize:none;' placeholder='Enter summary' class="form form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class='col-sm-2'>Status:</label>
                            <div class="col-sm-8">
                            <select name="status" id="status" required class="form-control form-control-sm">
                                <option value='active'>Active</option>
                                <option value='inactive'>In-Active</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class='col-sm-2'>Image:</label>
                            <div class="col-sm-8">
                            <input type='file' name='image' accept='image/*'>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class='col-sm-2'></label>
                            <div class="col-sm-8">
                            <button type='submit' class='btn btn-danger'>
                            <i class='fa fa-trash'></i>
                            Reset
                            </button>
                            <button type='submit' class='btn btn-success'>
                            <i class='fa fa-paper-plane'></i>
                            Submit
                            </button>
                            </div>
                        </div>
                    </form>
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