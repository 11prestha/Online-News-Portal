<?php require "../config/init.php"; 
 //$styles= '<link rel="stylesheet" href="'.CMS_CSS.'/custom.css">';
 if(isset($_SESSION, $_SESSION['token']) && !empty($_SESSION['token'])){
   redirect('dashboard.php', 'success', 'You are already logged in.');
 }

 if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])){
  redirect('dashboard.php', 'success', 'Welcome back to Admin Panel.');
}
?>
<?php require "inc/header.php"; ?>
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    
                  </div>
                  <form class="user" method="post" action="process/login.php">
                    <div class="form-group">
                      <input name="email" required type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input name="password" required type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input name="remember_me" type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <?php flash(); ?>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
<?php require "inc/footer.php" ?>
