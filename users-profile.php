<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    header("location: ./pages-login.php");
}
require_once("path.php");
require_once(SITE_ROOT_DIR_PATH . "include/header.php");
require_once(SITE_ROOT_DIR_PATH . "include/sidebar.php");
require_once(SITE_ROOT_DIR_PATH . "dbConn/db.php");

//fetch data of users from register users table
$email = $_SESSION["email"];
if (!empty($email)) {
    $sql = "SELECT * FROM register_users where email = '$email'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_all(MYSQLI_ASSOC)) {
        $id = $row[0]['id'];
        $username = $row[0]['username'];
        $name = $row[0]['name'];
        $email = $row[0]['email'];
        $address = $row[0]['address'];
        $number = $row[0]['number'];
        $password = $row[0]['password'];
    }
    // update data of users from edit profile to database
    if (isset($_POST['updateProfile'])) {
        if (empty($_POST['username']) && empty($_POST['name']) && empty($_POST['email']) && empty($_POST['number']) && empty($_POST['address'])) {
            $err = "All fields are required";
            return false;
        }
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $address = $_POST['address'];
        $sql = "UPDATE register_users SET username = '$username',name = '$name',address = '$address', email = '$email', number ='$number' WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result === TRUE) $mesg = "Record Updated Successfully";
        else $mesg_err = "No Record Updated";
    }
    // update password of users from existing password to new password
    if (isset($_POST['updatePassword'])) {
        if (empty($_POST['password']) && empty($_POST['newpassword']) && empty($_POST['renewpassword'])) {
            $err = "All fields are required";
            return false;
        }
        $oldPassword = $_POST['password'];
        $newPassword = $_POST['newpassword'];
        $renewpassword = $_POST['renewpassword'];
        if ($password === $oldPassword && $newPassword === $renewpassword) {
            $sql = "UPDATE register_users SET password = '$renewpassword' WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result === TRUE) $passwrdmesg = "Password Updated Successfully";
            else $passwrdmesg_err = "No Password Updated";
        } else $notMatched = "Password does not matched";
    }
    $conn->close();
} else return false;

?>
<main class="main" id="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            <?php //var_dump($username); 
            ?>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?php echo IMAGES_HTTP ?>profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2><?php if (isset($name)) echo (ucwords($name)); ?></h2>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Username</div>
                                    <div class="col-lg-9 col-md-8"><?php if (isset($username)) echo ('@' . $username); ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8"><?php if (isset($name)) echo (ucwords($name)); ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"><?php if (isset($email)) echo ($email); ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8"><?php if (isset($number)) echo ($number); ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8"><?php if (isset($address)) echo (ucwords($address)); ?></div>
                                </div>


                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST">
                                    <?php //var_dump($username1);
                                    ?>
                                    <!-- <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?php //echo IMAGES_HTTP
                                    ?>profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div> -->

                                    <div class="row mb-3">
                                        <label for="Username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="username" type="text" class="form-control" id="userName" value="<?php echo $username ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $name ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email" value="<?php echo $email ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="number" type="number" class="form-control" id="Phone" value="<?php echo $number ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Address" value="<?php echo $address ?>">
                                        </div>
                                    </div>
                                    <span class="text-success"><?php if (isset($mesg)) echo $mesg; ?></span>
                                    <span class="text-danger"><?php if (isset($mesg_err)) echo $mesg_err; ?></span>
                                    <span class="text-danger"><?php if (isset($err)) echo $err; ?></span>

                                    <div class="text-center">
                                        <button type="submit" name="updateProfile" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                <label class="form-check-label" for="changesMade">
                                                    Changes made to your account
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                <label class="form-check-label" for="newProducts">
                                                    Information on new products and services
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="proOffers">
                                                <label class="form-check-label" for="proOffers">
                                                    Marketing and promo offers
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                                <label class="form-check-label" for="securityNotify">
                                                    Security alerts
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form method="POST">

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>
                                    <span class="text-success"><?php if (isset($passwrdmesg)) echo $passwrdmesg; ?></span>
                                    <span class="text-danger"><?php if (isset($passwrdmesg_err)) echo $passwrdmesg_err; if (isset($notMatched)) echo $notMatched;?></span>
                                    

                                    <div class="text-center">
                                        <button type="submit" name="updatePassword" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php
require_once(SITE_ROOT_DIR_PATH . "include/footer.php");
