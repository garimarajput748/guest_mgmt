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
<div class="my-guest container">
    <h1 class="text-center">Invitation Cards</h1>
    <div class="row py-3">
      <div class="col-lg-4 ml-5">
        <div class="card">
          <img src="<?php echo ASSETS_HTTP;?>img\envelop1.jpg" class="card-img-top" alt="send invitation">
          <div class="card-body">
            <h5 class="card-title text-center">Send Invitation</h5>
            <p class="card-text text-center">Send Invitation from here to your loved once.</p>
            <div class="text-center"><a href="<?php echo BASE_URL; ?>guests/total-guests.php" class="btn btn-primary">Send Invitation</a></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 ml-5">
        <div class="card">
          <img src="<?php echo ASSETS_HTTP;?>img\envelop.jpg" class="card-img-top" alt="received invitation">
          <div class="card-body">
            <h5 class="card-title text-center">Received Invitation</h5>
            <p class="card-text text-center">See the Invitation's you received.</p>
            <div class="text-center"><a href="#" class="btn btn-primary">Received Invitation</a></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 ml-5">
        <div class="card">
          <img src="<?php echo ASSETS_HTTP;?>img\design-cards.jpg" class="card-img-top" alt="Design Cards">
          <div class="card-body">
            <h5 class="card-title text-center">Design Cards</h5>
            <p class="card-text text-center">You can select any design for invitation from here.</p>
            <div class="text-center"><a href="#" class="btn btn-primary">Invitation Cards</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>