<?php 

    session_start();
    include("includes/db.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Karwars MGMT Signin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="dashboard/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="dashboard/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="dashboard/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/falcon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
        <div class="col-lg-6 login-half-bg">
            <img src="images/logo.png" alt="" class="img-thumbnail bg-transparent mx-auto d-block border-0">
          </div>
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <h4 class="font-weight-bold">Good Morning Staff!</h4>
                <blockquote class="blockquote text-left p-0 border-0">
                    <p class="mb-0">“The future depends on what you do today.”</p>
                    <footer class="blockquote-footer"><cite>Mahatma Gandhi</cite></footer>
                </blockquote>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" name="employee_email" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="employee_pass"  class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password">                        
                  </div>
                </div>
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
                <div class="my-3">
                  <button type="submit" name="employee_login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >LOGIN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="dashboard/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="dashboard/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>

<?php 

    if(isset($_POST['employee_login'])){

        $employee_email = mysqli_real_escape_string($con,$_POST['employee_email']);

        $employee_pass = mysqli_real_escape_string($con,$_POST['employee_pass']);

        $get_employee = "select * from employees where employee_email='$employee_email' AND employee_pass='$employee_pass'";

        $run_employee = mysqli_query($con,$get_employee);

        $row_employee = mysqli_fetch_array($run_employee);

        $count = mysqli_num_rows($run_employee);

        if($count==1){

            $employee_id = $row_employee['employee_id'];

            $_SESSION['employee_id']=$employee_id;

            echo "<script>alert('Logged in. Welcome Back')</script>";

            echo "<script>window.open('index.php?dashboard','_self')</script>";

        }else{

            echo "<script>alert('Email or Password is Worng')</script>"; 

        }

    }

?>
