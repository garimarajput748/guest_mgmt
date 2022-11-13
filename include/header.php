<?php
define("DEBUG_MODE", TRUE);
if (defined("DEBUG_MODE") && DEBUG_MODE === true) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

require_once(dirname(__DIR__) . "/path.php");
require_once(CLASSES_DIR . "/utilities.php");

session_start();
if (!isset($_SESSION["email"])) utilities::showPage("pages-login.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Guests Management</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo IMAGES_HTTP; ?>favicon.png" rel="icon">
  <link href="<?php echo IMAGES_HTTP; ?>apple-touch-icon.png" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo VENDOR_HTTP; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo VENDOR_HTTP; ?>bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo VENDOR_HTTP; ?>boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo VENDOR_HTTP; ?>quill/quill.snow.css" rel="stylesheet">
  <link href="<?php echo VENDOR_HTTP; ?>quill/quill.bubble.css" rel="stylesheet">
  <link href="<?php echo VENDOR_HTTP; ?>remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo VENDOR_HTTP; ?>simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo ASSETS_HTTP; ?>css/style.css" rel="stylesheet">
  <script src="<?php echo VENDOR_HTTP; ?>jquery-3.6.1.min.js"></script>
  <!--CSS For datatables -->
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">


  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <?php
  require_once(SITE_ROOT_DIR_PATH . "include/navbar.php");
  ?>