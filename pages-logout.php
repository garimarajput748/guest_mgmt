<?php
require_once(__DIR__ . "/path.php");
require_once(CLASSES_DIR . "/utilities.php");
session_start();
session_destroy();
utilities::showPage("pages-login.php");
