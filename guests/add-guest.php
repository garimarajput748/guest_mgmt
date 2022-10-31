<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    header("location: ./pages-login.php");
}
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");
if (isset($_POST["add_guest"])) {

    if (!empty($_POST['name'])) $name = $_POST['name'];
    else $name_err = "Please Enter Valid Name";

    if (!empty($_POST['number'])) $number = $_POST['number'];
    else $name_err = "Please Enter Valid Number";

    if (!empty($_POST['address'])) $address = $_POST['address'];
    else $name_err = "Please Enter Valid Address";

    if (!empty($_POST['relationship'])) $relationship = $_POST['relationship'];
    else $name_err = "Please Enter Valid Relationship";

    if (!empty($name) && !empty($number) && !empty($address) && !empty($relationship)) {
        $sql = "INSERT INTO guest_list (guest_name,guest_mobile,guest_address,relationship) VALUES ('$name','$number','$address','$relationship')";
        if (!empty($sql)) {
            $data = "Data Entered Successfully :)";
        } else {
            $no_data = "Something Went Wrong :(";
        }
    }
    $conn->close();
}
?>
<main class="main" id="main">
    <div class="my-guest container">
        <h1 class="text-center">Add New Guest</h1>
        <div class="row py-3">
            <div class="col-lg-12 ml-5">
                <a href="<?php echo BASE_URL; ?>guests/total-guests.php"><button type="submit" class="mb-3 add-guest-btn"><i class="bi bi-person-heart"></i> See Guest List</button></a>
                <div class="card rounded shadow border-0">
                    <div class="card-body p-5 bg-white rounded">
                        <form method="POST">
                            <div class="table-responsive">
                                <table id="guest-table" style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Name</th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>Relationship</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="text" name="name" placeholder="Please Enter Guest Name"></td>
                                            <td><input type="number" name="number" class="contact-number" placeholder="Please Enter Guest Mobile Number"></td>
                                            <td><textarea name="address" placeholder="Please Enter Address"></textarea></td>
                                            <td><input type="text" name="relationship" placeholder="Relationship with Guest"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center"><button class="add-guest-btn" type="submit" name="add_guest">Add <i class="bi bi-person-plus-fill"></i> </button></div>
                                <div class="text-center mt-2 text-success"><?php echo $data ?> <span class="text-danger"><?php if (isset($no_data)) echo $no_data; ?></span></div>
                        </form>

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