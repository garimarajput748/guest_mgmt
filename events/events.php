<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    header("location: ./pages-login.php");
}
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php"); 

// add new event into database 
if(isset($_POST['saveEvent'])){
  if(!empty($_POST['eventName']))$eventName = $_POST['eventName'];
  else $eventNameErr = "Please enter Event Name";
  if(!empty($_POST['countGuests'])) $countGuests = $_POST['countGuests'];
   else $countGuestsErr = "Please enter No. of Guests";
  if(!empty($_POST['venueAddress'])) $venueAddress = $_POST['venueAddress'];
   else $venueAddressErr = "Please enter Address of Event";
  if(!empty($_POST['newDateEvent'])) $newDateEvent = $_POST['newDateEvent'];
   else $newDateEventErr = "Please enter date of Event";
   $success = '';
   if (!empty($eventName) && !empty($countGuests) && !empty($venueAddress) && !empty($newDateEvent)) {
    $sql = "INSERT INTO event_list (eventName,totalGuests,venue,eventDate) VALUES ('$eventName','$countGuests','$venueAddress','$newDateEvent')";
      if ($conn->query($sql) === TRUE) {
          $event = "Event Created Successfully :)";
      } else {
          $noEvent = "Something Went Wrong :(";
      }
    }
    else {
        $all_fields_err = "All Fields need to be fill **";
        $success = '';
    }
$conn->close();

}
?>
<!-- create events  -->
<main class="main" id="main">
<div class="my-guest container" id="events">
    <h1 class="text-center">Events</h1>
    <?php //var_dump($newDateEvent);?>
    <div class="row py-3">
      <div class="col-lg-12 ml-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn mb-3 add-btn" data-bs-toggle="modal" data-bs-target="#addEvent"><i class="bi bi-plus"></i>Add New Event</button>
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <div class="table-responsive">
              <table id="guest-table" style="width:100%" class="table table-striped table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>Sr. No.</th>
                    <th>Event Name</th>
                    <th>No. of Guests</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>Edit / Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php //foreach ($guest_data as $data) { ?>
                    <tr class="text-center">
                      <td><?php echo "1";?></td> 
                      <td><?php echo "Birthday"; ?></td>
                      <td><?php echo "500"; ?></td>
                      <td><?php echo "GWL"; ?></td>
                      <td><?php echo "10/11/2022"; ?></td>
                      <td>
                        <a href="<?php BASE_URL ?>update-event.php?action=edit&id=<?php //echo $data['guest_id']?>" title="edit this">
                          <i class="bi bi-pencil-square edit"></i>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
                        <a href="<?php BASE_URL ?>?action=delete&id=<?php //echo $data['guest_id']?>" title="delete this">
                         <i class="bi bi-trash delete"></i>
                        </a>
                      </td>
                    </tr>
                    <?php //} ?>
                  </tbody>
                </table>
                <div class="text-center text-success"><?php //if (isset($mesg)) echo $mesg; ?></div> 
              <div class="text-center text-danger"><?php //if (isset($mesg_err)) echo $mesg_err;?><?php //if (isset($no_data)) echo $no_data; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- add new event by modal popup -->
    <div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title" id="addNewEvent">New Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3" method="POST" id="addEventsForm">
              <div class="col-md-6">
                <label for="eventName" class="form-label">Event Name:</label>
                <input type="text" class="form-control eventFields" name="eventName" id="eventName" value="<?php echo(isset($eventName) && $success == '') ? $eventName: ''; ?>">
              </div>
              <div class="col-md-6">
                <label for="countGuests" class="form-label">No. of Guests:</label>
                <input type="number" class="form-control eventFields" name="countGuests" id="countGuests" value="<?php echo(isset($countGuests) && $success == '') ? $countGuests: ''; ?>">
              </div>
              <div class="col-md-6">
                <label for="venueAddress" class="form-label">Venue:</label>
                <textarea class="form-control eventFields" rows=1 name="venueAddress" id="venueAddress" placeholder="1234 Main St"><?php echo(isset($venueAddress) && $success == '') ? $venueAddress: ''; ?></textarea>
              </div>
              <div class="col-md-6">
                <label for="dateEvent" class="form-label">Date:</label>
                <input type="date" class="form-control eventFields" name="newDateEvent" id="newDateEvent"  value="<?php echo(isset($newDateEvent) && $success == '') ? $newDateEvent: ''; ?>"min="<?php echo date("j F Y") ?>">
              </div>
              <span class="text-success"><?php if (isset($event)) echo $event; ?></span>
              <span class="text-danger"><?php if (isset($noEvent)) echo $noEvent; if (isset($all_fields_err)) echo $all_fields_err;?></span>
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary" name="saveEvent" id="saveEvent">Save</button>
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