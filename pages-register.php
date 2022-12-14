<?php
require_once("dbConn/db.php");

$usernameErr= $nameErr= $emailErr= $passwordErr= $addressErr= $numberErr= "";
$username= $name= $email= $password= $number= $address= "";
if (isset($_POST['register_btn'])) {
  if (!empty($_POST['username'])) $username = $_POST['username'];
  else $usernameErr = "Username is required";

  if (!empty($_POST['name'])) $name = $_POST['name'];
  else $nameErr = "Name is required";

  if (!empty($_POST['address'])) $address = $_POST['address'];
  else $addressErr = "Address is required";

  if (!empty($_POST['number'])) $number = $_POST['number'];
  else $numberErr = "Number is required";

  if (!empty($_POST['email'])) $email = $_POST['email'];
  else $emailErr = "Email is required";

  if (!empty($_POST['password'])) $password = $_POST['password'];
  else $passwordErr = "Password is required";
  
  if(!empty($email)) {
    $sql = "SELECT * FROM register_users where email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $email_exist = "This email already exists.";
    } else {
      $sql = "INSERT INTO register_users (username, name, address, email, number, password)  VALUES ('$username', '$name', '$address', '$email', '$number', '$password')";
      if ($conn->query($sql) === TRUE) {
        $regestered_mesg = "Registered successfully";
        header('Location: http://localhost/guest_mgmt/pages-login.php?message='.$regestered_mesg);
      }
    }
    $conn->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registeration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Registration</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="POST">
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" value="<?php echo $username ?>" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" value="<?php echo $name ?>" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourAddress" class="form-label">Your Address</label>
                      <textarea name="address" class="form-control" id="yourAddress" value="<?php echo $address ?>" required></textarea>
                      <div class="invalid-feedback">Please, enter your address!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourNumber" class="form-label">Your Contact Number</label>
                      <input type="number" name="number" class="form-control" id="yourNumber" value="<?php echo $number ?>" required>
                      <div class="invalid-feedback">Please, enter your contact number!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" value="<?php echo $email ?>" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                      <span class="text-danger"><?php if (isset($email_exist)) echo $email_exist ?></span>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" value="<?php echo $password ?>" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="register_btn">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="pages-login.php">Log in</a></p>
                    </div>
                    <div class="col-12">
                      <p class="d-block"><?php if (isset($regestered_mesg)) echo $regestered_mesg ?></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>