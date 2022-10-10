  <body style="background: linear-gradient(90deg, #FC466B 0%, #3F5EFB 100%);">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-6 col-md-4">

        
      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-user-2.min.js"></script>

</body>

</html>
<?php
// Include config file
require "include/function.php";

// Define variables and initialize with empty values
$nama = $nip = $jabatan = $password = $confirm_password = "";
$nama_err = $nip_err = $jabatan_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //Validate name
  if (empty($_POST["nama"])) {
    $nama_err = "Name is required";
  } else {
    $nama = trim($_POST["nama"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
      $nama_err = "Hanya huruf dan spasi saja";
    }
  }

  // Validate nip
  if (empty(trim($_POST["nip"]))) {
    $nip_err = "Please enter a nip.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM user WHERE nip = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_nip);

      // Set parameters
      $param_nip = trim($_POST["nip"]);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $nip_err = "This nip is already taken.";
        } else {
          $nip = trim($_POST["nip"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }


  //Validate Jabatan
  if (empty($_POST["jabatan"])) {
    $jabatan_err = "Jabatan is required";
  } else {
    $jabatan = trim($_POST["jabatan"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $jabatan)) {
      $jabatan_err = "Hanya huruf dan spasi saja";
    }
  }

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }

  // Check input errors before inserting in database
  if (empty($nama_err) && empty($nip_err) && empty($jabatan_err) && empty($password_err) && empty($confirm_password_err)) {

    // Prepare an insert statement
    $sql = "INSERT INTO user (nama, nip, jabatan, password) VALUES (?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ssss", $param_nama, $param_nip, $param_jabatan, $param_password);

      // Set parameters
      $param_nama = $nama;
      $param_nip = $nip;
      $param_jabatan = $jabatan;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Redirect to login page
        header("location: login.php");
      } else {
        echo "Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="dist/css/styles.css">
  <script src="backup/asset/js/font-awesome-5.15.1.min.js"></script>
  <script src="backup/asset/js/bootstrap.bundle.min.js"></script>
  <script src="backup/asset/js/jquery-3.5.1.slim.min.js"></script>
  <script src="dist/js/scripts.js"></script>
</head>

<body>
  <div class="alert alert-light" role="alert">
    <h4 class="alert-heading"></h4>
  </div>
  <div class="container w-25">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"></h5>
        <div class="text-center">
                    <h1 class="h4 text-gray-500 mb-4">Sign Up</h1>
                    <h1 class="h5 text-gray-600 mb-2"><b>Silakan Isi Formulir Ini Untuk Membuat Akun.</b></h1>
                  </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
            <span class="help-block"><?php echo $nama_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($nip_err)) ? 'has-error' : ''; ?>">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="<?php echo $nip; ?>">
            <span class="help-block"><?php echo $nip_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($jabatan_err)) ? 'has-error' : ''; ?>">
            <label>Jabatan</label>
            <input type="jabatan" name="jabatan" class="form-control" value="<?php echo $jabatan; ?>">
            <span class="help-block"><?php echo $jabatan_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Konfirmasi Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
          </div>
          <br>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-danger" value="Reset">
            <a href="index.php" class="btn btn-secondary">Kembali</a>
          </div>
          <p>Sudah Punya Akun? <a href="login .php">Login Disini</a>.</p>
        </form>
      </div>
    </div>
  </div>
</div>
</body>

</html>
