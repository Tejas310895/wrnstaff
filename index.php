<?php 
session_start();
if(!isset($_SESSION['employee_id'])){
        
  echo "<script>window.open('login.php','_self')</script>";
  
}else{

include("includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Team Karwars Grocery</title>
    <!-- base:css -->
    <link rel="stylesheet" href="dashboard/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="dashboard/vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="dashboard/vendors/select2/select2.min.css">
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
		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <i class="mdi mdi-face text-success" style="font-size:2rem;"></i>
                    <span class="nav-profile-name">
                      <?php 
                      $employee_id = $_SESSION['employee_id'];
                      $get_employee_name = "select * from employees where employee_id='$employee_id'";
                      $run_employee_name = mysqli_query($con,$get_employee_name);
                      $row_employee_name = mysqli_fetch_array($run_employee_name);
                      $employee_name = $row_employee_name['employee_name'];
                      
                      echo $employee_name;
                      ?>
                    </span>
                    <span class="online-status"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item" href="logout.php">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
                </li>
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.png" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo.png" alt="logo"/></a>
            </div>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item <?php if(isset($_GET['dashboard'])){echo "active";} ?>">
                <a class="nav-link" href="index.php?dashboard">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item <?php if(isset($_GET['order_new'])){echo "active";}elseif(isset($_GET['order_old'])){echo "active";} ?>">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-cube-outline menu-icon"></i>
                    <span class="menu-title">Orders</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul>
                          <li class="nav-item"><a class="nav-link" href="index.php?order_new">Generate Order</a></li>
                          <li class="nav-item"><a class="nav-link" href="index.php?order_old">Modify Order</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item <?php if(isset($_GET['reports'])){echo "active";} ?>">
                  <a href="index.php?reports" class="nav-link reports">
                    <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    <span class="menu-title">Reports</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
            </ul>
        </div>
      </nav>
    </div>
    </div>
    <!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<?php 
                
                if(isset($_GET['dashboard'])){
                    
                    include("dashboard.php");
                    
                  }

                  if(isset($_GET['order_new'])){
                    
                    include("order_new.php");
                    
                  }

                  if(isset($_GET['order_old'])){
                    
                    include("order_old.php");
                    
                  }

                  if(isset($_GET['reports'])){
                    
                    include("reports.php");
                    
                  }

                ?>
			<!-- content-wrapper ends -->
			<!-- partial:partials/_footer.html -->
				<!-- <footer class="footer fixed-bottom p-0">
          <div class="footer-wrap">
            <div class="d-sm-flex justify-content-center">
              <span class="text-muted d-block text-center d-sm-inline-block">WERNEAR THECHNOLOGIES</span> -->
              <!-- <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span> -->
              <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span> -->
            <!-- </div>
          </div>
        </footer> -->
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
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
    <script src="dashboard/vendors/chart.js/Chart.min.js"></script>
    <script src="dashboard/vendors/progressbar.js/progressbar.min.js"></script>
		<script src="dashboard/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="dashboard/vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="dashboard/vendors/justgage/justgage.js"></script>
    <script src="dashboard/vendors/select2/select2.min.js"></script>
    <script src="dashboard/js/select2.js"></script>
    <!-- Custom js for this page-->
    <script src="dashboard/js/dashboard.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>

<?php } ?>