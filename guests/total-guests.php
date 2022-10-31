<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
  header("location: ./pages-login.php");
}
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");
$sql = "SELECT * FROM guest_list";
$result = $conn->query($sql);
$guest_data = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $guest_data[] = $row;
  }
} else {
  $no_data =  "No Record Found :)";
}
$conn->close();
?>
<main class="main" id="main">
  <div class="my-guest container">
    <h1 class="text-center">Guest List</h1>
    <div class="row py-3">
      <div class="col-lg-12 ml-5">
        <a href="<?php echo BASE_URL; ?>guests/add-guest.php"><button type="submit" class="mb-3 add-guest-btn"><i class="bi bi-plus"></i>Add New Guest</button></a>
        <a href="<?php echo BASE_URL; ?>guests/delete-guest.php"><button type="submit" class="mb-3 add-guest-btn float-end">Remove Guest<i class="bi bi-dash"></i></button></a>
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <div class="table-responsive">
              <table id="guest-table" style="width:100%" class="table table-striped table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>Relationship</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($guest_data as $data) { ?>
                    <tr class="text-center">
                      <td><?php echo $data['guest_id']; ?></td>
                      <td><?php echo $data['guest_name']; ?></td>
                      <td><?php echo $data['guest_mobile']; ?></td>
                      <td><?php echo $data['guest_address']; ?></td>
                      <td><?php echo $data['relationship']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div class="text-center"><?php if (isset($no_data)) echo $no_data; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
require_once(SITE_ROOT_DIR_PATH . "include/footer.php");
?>