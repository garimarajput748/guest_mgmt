<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
  header("location: ./pages-login.php");
}
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");
?>
<main class="main" id="main">

</main>