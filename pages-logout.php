<?php
require_once(__DIR__. "/path.php");
require_once(SITE_ROOT_DIR_PATH . "/utilities.php");
session_start();
session_destroy();
utilities::showPage("pages-login.php");
?>