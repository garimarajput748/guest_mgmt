<?php
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php"); 

//fetch data from event list to show the list of events
$event_data = array();
$sql = "SELECT * FROM event_list";
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
  if(!empty($_POST['venueAddress'])) $venueAddress = $_POST['venueAddress'];
   else $venueAddressErr = "Please enter Address of Event";
  if(!empty($_POST['newDateEvent'])) $newDateEvent = $_POST['newDateEvent'];
   else $newDateEventErr = "Please enter date of Event";

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
    }
  }

  //delete event query
  if($_GET['action'] && $_GET['action']=='delete'){
    if(!isset($_GET['id'])) $mesg_err = "Event not found to delete";
      $id = $_GET['id'];
        $sql = "DELETE from event_list WHERE id = $id";
        $result = $conn->query($sql);
        if($result) $mesg = "Event Deleted Successfully";
        else $mesg_err = "Event not found to be delete";
  }


  $conn->close();
?>
<!-- create events  -->
<main class="main" id="main">
<div class="my-guest container" id="events">
    <h1 class="text-center">Events</h1>
    <div class="row py-3">
      <div class="col-lg-12 ml-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn mb-3 add-btn" data-bs-toggle="modal" data-bs-target="#addEvent"><i class="bi bi-plus"></i>Add New Event</button>
        <div class="card rounded shadow border-0">
          <div class="card-body p-5 bg-white rounded">
            <div class="table-responsive">
              <table id="event-table" style="width:100%" class="table table-striped table-bordered">
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
                  <?php foreach ($event_data as $data) { ?>
                    <tr class="text-center">
                      <td><?php echo $data['id'];?></td> 
                      <td><?php echo $data['eventName']; ?></td>
                      <td><?php echo $data['totalGuests']; ?></td>
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
                    <?php } ?>
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
   <!-- add new event by modal popup -->
   <form class="row g-3" method="POST" id="addEventForm">
   <div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title" id="addNewEvent">New Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row"> 
              <div class="col-md-6">
                <label for="eventName" class="form-label">Event Name:</label>
                <input type="text" class="form-control eventFields" name="eventName" id="eventName" value="<?php echo(isset($eventName)) ? $eventName: ''; ?>">
              </div>
              <div class="col-md-6">
                <label for="countGuests" class="form-label">No. of Guests:</label>
                <input type="number" class="form-control eventFields" name="countGuests" id="countGuests" value="<?php echo(isset($countGuests)) ? $countGuests: ''; ?>">
              </div>
            </div>
            <div class="row"> 
              <div class="col-md-6">
                <label for="venueAddress" class="form-label">Venue:</label>
                <textarea class="form-control eventFields" rows=1 name="venueAddress" id="venueAddress" placeholder="1234 Main St"><?php echo(isset($venueAddress)) ? $venueAddress: ''; ?></textarea>
              </div>
              <div class="col-md-6">
                <label for="dateEvent" class="form-label">Date:</label>
                <input type="date" class="form-control eventFields" name="newDateEvent" id="newDateEvent"  value="<?php echo(isset($newDateEvent)) ? $newDateEvent: ''; ?>"min="<?php echo date("j F Y") ?>">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12">
                <span class="text-success"><?php if (isset($event)) echo $event; ?></span>
                <span class="text-danger"><?php if (isset($noEvent)) echo $noEvent; if (isset($all_fields_err)) echo $all_fields_err;?></span>
              </div>
              <div class="col-12 text-center">
                <a href="<?php BASE_URL ?>"><button type="submit" class="btn btn-primary" name="saveEvent" id="saveEvent">Save</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>
</main>
<?php 
require_once(SITE_ROOT_DIR_PATH . "include/footer.php");