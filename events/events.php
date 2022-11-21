<?php
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php"); 

//delete event query
if(!empty($_GET['action']) && $_GET['action']=='delete'){
  if(!isset($_GET['id'])) $mesg_err = "Event not found to delete";
    $id = $_GET['id'];
      $sql = "DELETE from event_list WHERE id = $id";
      $result = $conn->query($sql);
      if($result) $mesg = "Event Deleted Successfully";
      else $mesg_err = "Event not found to be delete";
}

//fetch data from event list to show the list of events
$event_data = array();
$count = 1;
$sql = "SELECT * FROM event_list WHERE userID = '".$_SESSION['userID']."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $event_data[] = $row;
  }
} else {
  $sql = "ALTER TABLE event_list AUTO_INCREMENT = 1";
  $conn->query($sql);
  $no_data =  "No Event Found :)";
}

// add new event into database 
if(isset($_POST['saveEvent'])){
  if(!empty($_POST['eventName']))$eventName = $_POST['eventName'];
  else $eventNameErr = "Please enter Event Name";
  if(!empty($_POST['countGuests'])) $countGuests = $_POST['countGuests'];
   else $countGuestsErr = "Please enter No. of Guests";
   if(!empty($_POST['eventcost'])) $eventcost = $_POST['eventcost'];
   else $eventcostErr = "Please enter Cost of Event";
  if(!empty($_POST['venueAddress'])) $venueAddress = $_POST['venueAddress'];
   else $venueAddressErr = "Please enter Address of Event";
  if(!empty($_POST['newDateEvent'])) $newDateEvent = $_POST['newDateEvent'];
   else $newDateEventErr = "Please enter date of Event";

   if (!empty($eventName) && !empty($countGuests) && !empty($eventcost) && !empty($venueAddress) && !empty($newDateEvent)) {
    $sql = "INSERT INTO event_list (userID,eventName,totalGuests,eventCost,venue,eventDate) VALUES ('".$_SESSION['userID']."','$eventName','$countGuests','$eventcost','$venueAddress','$newDateEvent')";
      if ($conn->query($sql) === TRUE) {
        echo "<meta http-equiv='refresh' content='0'>";
          $event = "Event Created Successfully :)";
      } else {
          $noEvent = "Something Went Wrong :(";
      }
    }
    else {
        $all_fields_err = "All Fields need to be fill **";
    }
  }

  $conn->close();
?>
<!-- create events  -->
<main class="main" id="main">
<div class="my-guest container" id="events">
    <h1 class="text-center">Events</h1>
    <div class="row py-3">
      <div class="col-lg-12 ml-5">
        <!-- Button to add event -->
        <a href="<?php echo BASE_URL; ?>events/add-event.php"><button type="button" class="btn mb-3 add-btn" id="addEvent"><i class="bi bi-plus"></i>Add New Event</button></a>
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <div class="table-responsive">
              <table id="event-table" style="width:100%" class="table table-striped table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>Sr. No.</th>
                    <th>Event Name</th>
                    <th>No. of Guests</th>
                    <th>Expenses</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>Edit / Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($event_data as $data) { ?>
                    <tr class="text-center">
                      <td><?php echo $count;?></td> 
                      <td><?php echo $data['eventName']; ?></td>
                      <td><?php echo $data['totalGuests']; ?></td>
                      <td><?php echo $data['eventCost']; ?></td>
                      <td><?php echo $data['venue']; ?></td>
                      <td><?php echo $data['eventDate']; ?></td>
                      <td>
                        <a href="<?php BASE_URL ?>editevent.php?action=edit&id=<?php echo $data['id']?>">
                          <i class="bi bi-pencil-square edit"></i>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
                        <a href="<?php BASE_URL ?>?action=delete&id=<?php echo $data['id']?>" title="delete this">
                        <i class="bi bi-trash delete"></i>
                        </a>
                      </td>
                    </tr>
                    <?php $count++; } ?>
                  </tbody>
                </table>
                <div class="text-center text-success"><?php if (isset($mesg)) echo $mesg; ?></div> 
              <div class="text-center text-danger"><?php if (isset($mesg_err)) echo $mesg_err;?><?php if (isset($no_data)) echo $no_data; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  
  </div>
</main>
<script>
   $(document).ready(function() {
    var table = $('#event-table').DataTable({
      dom: '<"top"Bfrti><"bottom"lp><"clear">', //refs Link : https://www.ihbc.org.uk/consultationsdb_new/examples/basic_init/dom.html
      buttons: [{
          extend: 'excelHtml5',
          exportOptions: {
            columns: 'th:not(:last-child)'
          },
          text: '<i class="bi  bi-file-earmark-excel"> Export as Excel</i>',
          className: 'text-success',
          footer: true,
          titleAttr: 'Excel'
        },

        {
          extend: 'pdfHtml5',
          exportOptions: {
            columns: 'th:not(:last-child)'
          },
          messageTop: 'This file is export from www.event-info.com',
          messageBottom: 'Pdf exported you can edit this from js code ',
          text: '<i class="bi  bi-file-earmark-pdf"> Export as PDF</i>',
          titleAttr: 'PDF',
          className: 'text-danger',
          footer: true,
          title: 'Data Export PDF File'
        },
        {
          text: '<i class="bi bi-trash delete-all"> Delete All</i>',
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

    // $(".delete-all").on("click", function(ele) {

    //   var boxes_id = $('input[name=check]:checked').map(function(){
    //     return $(this).val();
    //   }).get().join(',');

    //     $.ajax({
    //       url: '',
    //         type: 'GET',
    //         data: {
    //           "deleteId": boxes_id,
    //           "action": "delete_records",
    //         },
    //         success: function(response) {
    //           if (response != "") {
    //             var result = JSON.parse(response);
    //             alert(result.message);
    //               location.reload();
    //           }
    //         }
    //       });
    // });

  });
</script>
<?php 
require_once(SITE_ROOT_DIR_PATH . "include/footer.php");