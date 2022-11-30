<?php
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
     if(!empty($_POST['eventcost'])) $eventcost = $_POST['eventcost'];
     else $eventcostErr = "Please enter Cost of Event";
    if(!empty($_POST['venueAddress'])) $venueAddress = $_POST['venueAddress'];
     else $venueAddressErr = "Please enter Address of Event";
    if(!empty($_POST['newDateEvent'])) $newDateEvent = $_POST['newDateEvent'];
     else $newDateEventErr = "Please enter date of Event";
  
     if (!empty($eventName) && !empty($countGuests) && !empty($eventcost) && !empty($venueAddress) && !empty($newDateEvent)) {
        $sql = "SELECT * FROM event_list WHERE eventName = '$eventName' AND totalGuests = '$countGuests' AND eventCost = '$eventcost' AND venue = '$venueAddress' AND eventDate = '$newDateEvent'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        $eventExists = "This Event already exists.";
        } 
    else {
        $sql = "INSERT INTO event_list (userID,eventName,totalGuests,eventCost,venue,eventDate) VALUES ('".$_SESSION['userID']."','$eventName','$countGuests','$eventcost','$venueAddress','$newDateEvent')";
        if ($conn->query($sql) === TRUE) {
          echo "<meta http-equiv='refresh' content='0'>";
            $event = "Event Created Successfully :)";
        } else {
            $noEvent = "Something Went Wrong :(";
        }
      }
    }
      else {
          $all_fields_err = "All Fields need to be fill **";
      }
    }
$conn->close();
?>
<main class="main" id="main">
    <div class="my-guest container">
        <!-- add new event -->
        <section class="section">
            <a href="<?php echo BASE_URL; ?>events/events.php"><button type="submit" class="mb-3 add-btn"><i class="bi bi-calendar-event"></i> See Event List</button></a>
            <div class="row">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">New Event</h5>
                <form class="row g-3" method="POST" id="addEventForm">
                    <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" name="eventName" class="form-control" id="eventName" placeholder="Event Name" value="<?php echo(isset($eventName)) ? $eventName: ''; ?>">
                        <label for="eventName">Event Name</label>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" name="countGuests" class="form-control" id="countGuests" placeholder="Total Guests" value="<?php echo(isset($countGuests)) ? $countGuests: ''; ?>">
                        <label for="countGuests">No. of Guests</label>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-floating">
                        <input type="number" class="form-control" name="eventcost" id="eventCost" placeholder="Expenses" value="<?php echo(isset($eventcost)) ? $eventcost: ''; ?>">
                        <label for="eventCost">Event Expenses</label>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-floating">
                    <textarea class="form-control" rows=1 name="venueAddress" id="venueAddress" placeholder="1234 Main St"><?php echo(isset($venueAddress)) ? $venueAddress: ''; ?></textarea>
                        <label for="venueAddress">Venue</label>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-floating">
                    <input type="date" class="form-control" name="newDateEvent" id="newDateEvent"  value="<?php echo(isset($newDateEvent)) ? $newDateEvent: ''; ?>"min="<?php echo date("j F Y") ?>">
                        <label for="dateEvent">Date</label>
                    </div>
                    </div>
                
                    <div class="col-12">
                    <span class="text-success"><?php if (isset($event)) echo $event; ?></span>
                    <span class="text-danger"><?php if (isset($noEvent)) echo $noEvent; if (isset($all_fields_err)) echo $all_fields_err; echo(isset($eventExists))? $eventExists: '';?></span>
                    </div>
                    <div class="col-12 text-center">
                    <a href="<?php BASE_URL ?>"><button type="submit" class="btn add-btn" name="saveEvent" id="saveEvent">Add <i class="bi bi-person-plus-fill"></i></button></a>
                    <button type="reset" class="btn add-btn">Reset</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </section>
    </div>
</main>
<?php 
require_once(SITE_ROOT_DIR_PATH . "include/footer.php");
?>