<?php
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");
if (isset($_POST["add_guest"])) {

    if (!empty($_POST['name'])) $name = $_POST['name'];
    else $name_err = "please enter guest's name";

    if (!empty($_POST['number'])) $number = $_POST['number'];
    else $number_err = "please enter guest's number";

    if (!empty($_POST['address'])) $address = $_POST['address'];
    else $address_err = "please enter guest's address";

    if (!empty($_POST['relationship'])) $relationship = $_POST['relationship'];
    else $relationship_err = "please enter your relationship";

    if (!empty($name) && !empty($number) && !empty($address) && !empty($relationship)) {
        $sql = "INSERT INTO guest_list (guest_name,guest_mobile,guest_address,relationship) VALUES ('$name','$number','$address','$relationship')";
        if ($conn->query($sql) === TRUE) {
            $data = "Data Entered Successfully :)";
        } else {
            $no_data = "Something Went Wrong :(";
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
        <h1 class="text-center">Add New Guest</h1>
        <div class="row py-3">
            <div class="col-lg-12 ml-5">
                <a href="<?php echo BASE_URL; ?>guests/total-guests.php"><button type="submit" class="mb-3 add-btn"><i class="bi bi-person-heart"></i> See Guest List</button></a>
                <div class="card rounded shadow border-0">
                    <a href="<?php echo BASE_URL; ?>guests/total-guests.php"><span class="text-danger float-end btn-close"></span></a>
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
                                            <td>
                                                <input class="form-control" type="text" name="name" placeholder="Please Enter Guest Name" value="<?php echo(isset($name)) ? $name: ''; ?>">
                                                <span class="text-danger"><?php if(isset ($name_err)) echo $name_err; ?></span>
                                            </td>
                                            <td>
                                                <input type="number" name="number" class="form-control" placeholder="Please Enter Guest Mobile Number" value="<?php echo(isset($number)) ? $number: ''; ?>">
                                                <span class="text-danger"><?php if(isset ($number_err)) echo $number_err; ?></span> 
                                            </td>
                                            <td>
                                                <textarea name="address" class="form-control" placeholder="Please Enter Address"><?php echo(isset($address)) ? $address: ''; ?></textarea>
                                                <span class="text-danger"><?php if(isset ($address_err)) echo $address_err; ?></span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="relationship" placeholder="Relationship with Guest" value="<?php echo(isset($relationship)) ? $relationship: ''; ?>">
                                                <span class="text-danger"><?php if(isset ($relationship_err)) echo $relationship_err; ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center"><button class="add-btn" type="submit" name="add_guest">Add <i class="bi bi-person-plus-fill"></i> </button></div>
                                <div class="text-center mt-2 text-success"><?php if (isset($data)) echo $data;?> <span class="text-danger"><?php if (isset($no_data)) echo $no_data; if (isset($all_fields_err)) echo $all_fields_err;?></span></div>
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