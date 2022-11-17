<?php
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");

// query for delete data from database
if (!empty($_GET['action']) && $_GET['action'] == 'delete_records' && !empty($_GET['deleteId'])) {
  $deleteId = $_GET['deleteId'];
  $sql = "DELETE FROM guest_list WHERE guest_id = $deleteId";

  try {
    $result = $conn->query($sql);
    $message = "Record Delete Successfully";
  } catch (Exception $e) {
    $message = $e->getMessage();
  }
  echo json_encode(array("message" => $message));
  exit;
}

require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");

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

$conn->close();

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
        <a href="<?php echo BASE_URL; ?>guests/add-guest.php">
          <button type="submit" class="mb-3 add-btn"><i class="bi bi-plus"></i>Add New Guest</button>
        </a>
        <div class="float-end">
          <?php if (!empty($_GET['action']) && $_GET['action'] == 'sendinvitation')
            echo '<button type="submit" class="mb-3 add-btn bg-info" name="invitation">Send Invitation <i class="bi bi-postage-heart"></i></button>';
          ?>
        </div>
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">

            <div class="table-responsive">
              <table id="guest-table" style="width:100%" class="table table-striped table-bordered">
                <thead>
                  <tr class="text-center">
                    <th class="text-nowrap">Select All <input type="checkbox" name="chk-all" value="chk-all" onchange="checkAll(this)"></th>
                    <th class="text-nowrap">Sr. No.</th>
                    <th>Name</th>
                    <th class="text-nowrap">Contact No.</th>
                    <th>Address</th>
                    <th>Relationship</th>
                    <th>Edit / Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($guest_data as $data) { ?>
                    <tr class="text-center table-row">
                      <td><input type="checkbox" name="check" onchange="checkChange()" value="<?php echo $data['guest_id']; ?>"></td>
                      <td><?php echo $data['guest_id']; ?></td>
                      <td><?php echo $data['guest_name']; ?></td>
                      <td><?php echo $data['guest_mobile']; ?></td>
                      <td><?php echo $data['guest_address']; ?></td>
                      <td><?php echo $data['relationship']; ?></td>
                      <td>
                        <a href="<?php BASE_URL ?>update-guest.php?action=edit&id=<?php echo $data['guest_id'] ?>" title="edit this">
                          <i class="bi bi-pencil-square edit"></i>
                        </a>&nbsp;&nbsp;
                        <button class="border-0 bg-transparent" title="delete this" class="delete-btn" onclick="deleteRow(this)" data-id="<?php echo $data['guest_id'] ?>">
                          <i class="bi bi-trash delete"></i>
                        </button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div class="text-center text-success"><?php if (isset($mesg)) echo $mesg; ?></div>
              <div class="text-center text-danger"><?php if (isset($mesg_err)) echo $mesg_err; ?><?php if (isset($no_data)) echo $no_data; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function() {
    var table = $('#guest-table').DataTable({
      dom: '<"top"Bfrti><"bottom"lp><"clear">', //refs Link : https://www.ihbc.org.uk/consultationsdb_new/examples/basic_init/dom.html
      buttons: [{
          extend: 'excelHtml5',
          exportOptions: {
            columns: 'th:not(:last-child)'
          },
          text: '<i class="bi  bi -file-excel-o"> Export as Excel</i>',
          className: 'text-success',
          footer: true,
          titleAttr: 'Excel'
        },

        {
          extend: 'csvHtml5',
          exportOptions: {
            columns: 'th:not(:last-child)'
          },
          text: '<i class="bi  bi -file-text-o"> Export as CSV </i>',
          className: 'text-info',
          footer: true,
          titleAttr: 'CSV'
        },

        {
          extend: 'pdfHtml5',
          exportOptions: {
            columns: 'th:not(:last-child)'
          },
          messageTop: 'This file is export from www.event-info.com',
          messageBottom: 'Pdf exported you can edit this from js code ',
          text: '<i class="bi  bi -file-pdf-o"> Export as PDF</i>',
          titleAttr: 'PDF',
          className: 'text-danger',
          footer: true,
          title: 'Data Export PDF File'
        },
        {
          text: '<i class="bi bi-trash delete"> Delete All</i>',
          titleAttr: 'Delete All',
          className: 'text-danger',
        }
      ],
      columnDefs: [{
          targets: 0,
          sortable: false
        },
        {
          targets: 6,
          sortable: false
        },
      ],
      order: [
        [1, "asc"]
      ],
      "pageLength": 10

    });

  });

  function deleteRow(ele) {
    var deleteId = $(ele).attr("data-id");
    $(ele).parents("tr").remove();

    $.ajax({
      url: '',
      type: 'GET',
      data: {
        "deleteId": deleteId,
        "action": "delete_records",
      },
      success: function(response) {
        if (response != "") {
          var result = JSON.parse(response);
          alert(result.message);
        }
      }
    });
  }
</script>

<?php
require_once(SITE_ROOT_DIR_PATH . "include/footer.php");
?>