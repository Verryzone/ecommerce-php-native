<?php 
include_once("../engine/config.php");
if(isset($_SESSION['user_token'])) {
    header("Location: ../");
}

// echo "token : ".$_SESSION['user_token'];
// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../themes/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../themes/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../themes/assets/vendor/fonts/boxicons.css" />
      <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../themes/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../themes/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../themes/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../themes/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../themes/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../themes/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../themes/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->
    <?php 
    if(isset($_GET['section'])) {
        $section = $_GET['section'];
        include_once("$section.php");
    } else {
        include_once 'login.php';
    }
    ?>
    <!-- / Content -->

    <!-- Modal Notifikasi -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <div class="d-flex align-items-center">
              <div id="notif_icon"></div>
              <h5 class="modal-title fw-bold" id="notificationModalLabel">Notifikasi</h5>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p id="notificationMessage">Pesan notifikasi akan muncul di sini.</p>
          </div>
          <div class="modal-footer">
            <!-- <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div> -->
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../themes/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../themes/assets/vendor/libs/popper/popper.js"></script>
    <script src="../themes/assets/vendor/js/bootstrap.js"></script>
    <script src="../themes/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../themes/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../themes/assets/js/main.js"></script>
    <script src="../scripts/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>