<?php
require_once("../../dbConn/db.php");
$sql = "CREATE TABLE  IF NOT EXISTS `guest_list` (
          `guest_id` int(100) NOT NULL AUTO_INCREMENT,
          `guest_name` varchar(50) NOT NULL,
          `guest_mobile` int(10) NOT NULL,
          `guest_address` varchar(100) NOT NULL,
          PRIMARY KEY (`guest_id`)
        )";
$result = $conn->query($sql);