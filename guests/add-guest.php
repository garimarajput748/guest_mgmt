<?php
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");

if (isset($_POST["addGuest"])) {

    if (!empty($_POST['name'])) $name = $_POST['name'];
    else $name_err = "please enter guest's name";

    if (!empty($_POST['number'])) $number = $_POST['number'];
    else $number_err = "please enter guest's number";

    if (!empty($_POST['address'])) $address = $_POST['address'];
    else $address_err = "please enter guest's address";

    if (!empty($_POST['relationship'])) $relationship = $_POST['relationship'];
    else $relationship_err = "please enter your relationship";
    

    if (!empty($name) && !empty($number) && !empty($address) && !empty($relationship)) {
        $sql = "SELECT * FROM guest_list WHERE guest_name = '$name' AND guest_mobile = '$number' AND guest_address = '$address' AND relationship = '$relationship'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        $guestExists = "This Guest already exists.";
        } 
    else {
        $sql = "INSERT INTO guest_list (userID,guest_name,guest_mobile,guest_address,relationship) VALUES ('".$_SESSION['userID']."','$name','$number','$address','$relationship')";
        if ($conn->query($sql) === TRUE) {
            $data = "Data Entered Successfully :)";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            $no_data = "Something Went Wrong :(";
        }
      }
    }
    else {
        $all_fields_err = "All Fields need to be fill **";
    }
    $conn->close();
}
?>
<main class="main" id="main">
    <div class="my-guest container">
        <section class="section">
            <a href="<?php echo BASE_URL; ?>guests/total-guests.php"><button type="submit" class="mb-3 add-btn"><i class="bi bi-calendar-event"></i> See Event List</button></a>
            <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Guest</h5>
                    <form class="row g-3" method="POST" id="addGuestForm">
                        <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="guestName" placeholder="Guest Name" value="<?php echo(isset($name)) ? $name: ''; ?>">
                            <label for="name">Guest Name</label>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="number" class="form-control" placeholder="phone Number" value="<?php echo(isset($number)) ? $number: ''; ?>">
                            <label for="contact Number">Guest contact Number</label>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-floating">
                        <textarea class="form-control" rows=1 name="address" id="guestAddress" placeholder="1234 Main St"><?php echo(isset($address)) ? $address: ''; ?></textarea>
                            <label for="guestAddress">Guest Address</label>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-floating">
                        <input type="text" class="form-control" name="relationship" id="relationship"  value="<?php echo(isset($relationship)) ? $relationship: ''; ?>">
                            <label for="relationship">Relationship</label>
                        </div>
                        </div>
                    
                        <div class="col-12">
                        <span class="text-success"><?php if (isset($data)) echo $data; ?></span>
                        <span class="text-danger"><?php if (isset($no_data)) echo $no_data; if (isset($all_fields_err)) echo $all_fields_err; echo(isset($guestExists))? $guestExists: '';?></span>
                        </div>
                        <div class="col-12 text-center">
                        <a href="<?php BASE_URL ?>"><button type="submit" class="btn add-btn" name="addGuest" id="addGuest">Add <i class="bi bi-person-plus-fill"></i></button></a>
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