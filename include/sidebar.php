<?php

/**
 * menu_name = is display menu in sidebar
 */
$sidebar_menu_arr = array(
  array("menu_name" => "Dashboard", "menu_link" => BASE_URL, "icon" => "bi bi-grid"),
  array("menu_name" => "My Guest", "menu_link" => BASE_URL . "guests/total-guests.php", "icon" => "bi bi-people"),
  array("menu_name" => "Event", "menu_link" => BASE_URL . "events/events.php", "icon" => "bi bi-calendar2-event")
);

?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    <?php
    foreach ($sidebar_menu_arr as $menu_details) {
      echo '<li class="nav-item">
          <a class="nav-link " href="' . $menu_details['menu_link'] . '">
            <i class="' . $menu_details['icon'] . '"></i>
            <span>' . $menu_details['menu_name'] . '</span>
          </a>
        </li>';
    }
    ?>
  </ul>

</aside><!-- End Sidebar-->