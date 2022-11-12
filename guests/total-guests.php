<?php
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");

// query for showing the data from database
$guest_data = array();
$sql = "SELECT * FROM guest_list";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $guest_data[] = $row;
  }
} else {
  $sql = "ALTER TABLE guest_list AUTO_INCREMENT = 1";
  $conn->query($sql);
  $no_data =  "No Record Found :)";
}

// query for delete data from database
if (!empty($_GET['action'] )&& $_GET['action'] == 'delete') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM guest_list WHERE guest_id = $id";
    $result = $conn->query($sql);
    if ($result) $mesg = "Record deleted successfully";
    else $mesg_err =  "Error deleting record";
  }
}
$conn->close();

//  for send invitation to selected guest 
if (!empty($_GET['action']) && $_GET['action'] == 'sendinvitation') {
  $sendInvitation =  '<button type="submit" class="mb-3 add-btn" name="invitation">Send Invitation <i class="bi bi-postage-heart"></i></button>';
}

if (isset($_POST['invitation'])) {
  if (!empty($_POST['check'])) {
    $selectedPersons = $_POST['check'];
  }
}


?>
<main class="main" id="main">
  <div class="my-guest container">
    <h1 class="text-center">Guest List</h1>
    <div class="row py-3">
      <div class="col-lg-12 ml-5">
        <a href="<?php echo BASE_URL; ?>guests/add-guest.php"><button type="submit" class="mb-3 add-btn"><i class="bi bi-plus"></i>Add New Guest</button></a>
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <form method="POST">
              <div class="table-responsive">
                <table id="guest-table" style="width:100%" class="table table-striped table-bordered">
                  <thead>
                    <tr class="text-center">
                      <th>Sr. No.</th>
                      <th>Name</th>
                      <th>Mobile Number</th>
                      <th>Address</th>
                      <th>Relationship</th>
                      <th>Edit / Delete</th>
                      <th>Select All <input type="checkbox" name="chk-all" value="chk-all" onchange="checkAll(this)"></th>
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
                        <td>
                          <a href="<?php BASE_URL ?>update-guest.php?action=edit&id=<?php echo $data['guest_id'] ?>" title="edit this">
                            <i class="bi bi-pencil-square edit"></i>
                          </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="<?php BASE_URL ?>?action=delete&id=<?php echo $data['guest_id'] ?>" title="delete this">
                            <i class="bi bi-trash delete"></i>
                          </a>
                        </td>
                        <td><input type="checkbox" name="check" onchange="checkChange();" value="<?php echo $data['guest_id']; ?>"></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="float-end"><?php echo (isset($sendInvitation)) ? $sendInvitation : ''; ?></div>
                <div class="text-center text-success"><?php if (isset($mesg)) echo $mesg; ?></div>
                <div class="text-center text-danger"><?php if (isset($mesg_err)) echo $mesg_err; ?><?php if (isset($no_data)) echo $no_data; ?></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
require_once(SITE_ROOT_DIR_PATH . "include/footer.php");
?>