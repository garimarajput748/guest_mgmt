<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
  header("location: ./pages-login.php");
}
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");

  //edit event and update it into db
  if($_GET['action'] && $_GET['action']=='edit'){
    if(!isset($_GET['id'])) $mesg_err = "Event not found to edit";
      $id = $_GET['id'];
        $sql = "SELECT * from event_list WHERE id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $edit_data[] = $row;
            $editEventName = $edit_data[0]['eventName'];
            $editTotalGuests = $edit_data[0]['totalGuests'];
            $editVenue = $edit_data[0]['venue'];
            $editEventDate = $edit_data[0]['eventDate'];
          }
        }
  }

  //query for updating new event
  if (isset($_POST["updateEvent"])) {
    if (!empty($_POST['name']) && !empty($_POST['number']) && !empty($_POST['address']) && !empty($_POST['date'])){
    $eventName = $_POST['name'];
    $totalGuests = $_POST['number'];
    $venue = $_POST['address'];
    $eventDate = $_POST['date'];
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        if(!empty($id)){
            $sql = "UPDATE event_list SET eventName = '$eventName',totalGuests = '$totalGuests',venue = '$venue',eventDate = '$eventDate' WHERE id = $id";
            $result = $conn->query($sql);
            if($result){
                $mesg = "Event Updated Successfully";
            }
            else{
                $mesg_err = "No Event Updated";
            }
        } else $mesg_err = "No Event found to be edited";
    }
  }
  else $mesg_err = "Fields cann't be empty"; 
}
$conn->close();
?>
  <main class="main" id="main">
    <div class="my-guest container-fluid px-1 py-5 mx-auto">
      <div class="row d-flex justify-content-center">
          <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
              <h1>Update Event</h1>
              <div class="card">
                  <form class="form-card m-3" method="POST">
                    <a href="<?php echo BASE_URL; ?>events/events.php"><span class="text-danger float-end btn-close"></span></a>
                      <div class="row justify-content-between text-left">
                          <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3 py-3">Event Name
                              <span class="text-danger"> *</span></label> 
                              <input type="text" class="form-control" name="name" value="<?php echo(isset($editEventName)) ? $editEventName: ''; ?>"> </div>
                          <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3 py-3">No. of Guests
                              <span class="text-danger"> *</span></label> 
                              <input type="number" class="form-control" name="number" value="<?php echo(isset($editTotalGuests)) ? $editTotalGuests: ''; ?>"> </div>
                      </div>
                      <div class="row justify-content-between text-left">
                          <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3 py-3">Venue
                              <span class="text-danger"> *</span></label> 
                              <textarea class="form-control" name="address"> <?php echo(isset($editVenue)) ? $editVenue: ''; ?></textarea></div>
                          <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3 py-3">Event Date
                              <span class="text-danger"> *</span></label> 
                              <input type="date" class="form-control" name="date" value="<?php echo(isset($editEventDate)) ? $editEventDate: ''; ?>"> </div>
                          </div>
                          <div class="row justify-content-between mt-2">
                              <div class="text-success"><?php if(isset($mesg)) echo $mesg;?></div>
                              <div class="text-danger"><?php if(isset($mesg_err)) echo $mesg_err;?></div>
                          </div>
                      <div class="row justify-content-end">
                          <div class="form-group col-sm-6 py-3"> <button type="submit" class="add-btn" name="updateEvent">Update & Save</button> </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
  </main>