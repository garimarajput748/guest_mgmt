<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
  header("location: ./pages-login.php");
}
require_once("../path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");
//query for edit the data
$guest_data = array();
 if($_GET['action'] && $_GET['action']=='edit'){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      if(!empty($id)){
        $sql = "SELECT * from guest_list WHERE guest_id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $guest_data[] = $row;
          }
        }
      }
    }
  }
else $mesg_err = "Record not found to be edit";
//query for updating new data
    if (isset($_POST["update"])) {
        if (empty($_POST['name']) && empty($_POST['number']) && empty($_POST['address']) && empty($_POST['relationship'])) return; 
        $name = $_POST['name'];
        $number = $_POST['number'];
        $address = $_POST['address'];
        $relationship = $_POST['relationship'];
        if(isset($_GET['id'])){
            $id= $_GET['id'];
            if(!empty($id)){
                $sql = "UPDATE guest_list SET guest_name = '$name',guest_mobile = '$number',guest_address = '$address',relationship = '$relationship' WHERE guest_id = $id";
                $result = $conn->query($sql);
                if($result){
                    $mesg = "Record Updated Successfully";
                }
                else{
                    $mesg_err = "No Record Updated";
                }
            } else $mesg_err = "No Record found to be edited";
        }
    }
  $conn->close();

?>
<main class="main" id="main">
    <div class="my-guest container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h1>Update Guest Data</h1>
            <div class="card">
                <form class="form-card" method="POST">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3 py-3">Guest Name
                            <span class="text-danger"> *</span></label> 
                            <input type="text" id="fname" name="name" value="<?php echo $guest_data[0]['guest_name'] ?>"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3 py-3">Guest Mobile Number
                            <span class="text-danger"> *</span></label> 
                            <input type="text" id="lname" name="number" value="<?php echo $guest_data[0]['guest_mobile'] ?>"> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3 py-3">Guest Address
                            <span class="text-danger"> *</span></label> 
                            <input type="text" id="email" name="address" value="<?php echo $guest_data[0]['guest_address'] ?>"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3 py-3">Relationship
                            <span class="text-danger"> *</span></label> 
                            <input type="text" id="mob" name="relationship" value="<?php echo $guest_data[0]['relationship'] ?>"> </div>
                        </div>
                        <div class="row justify-content-between mt-2">
                            <div class="text-success"><?php if(isset($mesg)) echo $mesg;?></div>
                            <div class="text-danger"><?php if(isset($mesg_err)) echo $mesg_err;?></div>
                        </div>
                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6 py-3"> <button type="submit" class="add-guest-btn" name="update">Update & Save</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
<?php
require_once(SITE_ROOT_DIR_PATH . "include/footer.php");