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
// Initialize the session
session_start();
PHP_DEBUG;

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: dashboard.php");
  exit;
}

// Include config file
require "include/function.php";


// Define variables and initialize with empty values
$nip = $password = "";
$nip_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Check if nip is empty
  if(empty(trim($_POST["nip"]))){
    $nip_err = "Please enter NIP.";
  } else{
    $nip = trim($_POST["nip"]);
  }

  // Check if password is empty
  if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
  } else{
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if(empty($nip_err) && empty($password_err)){
    // Prepare a select statement
    $sql = "SELECT id, nama, nip, jabatan, password FROM user WHERE nip = ?";

    if($stmt = mysqli_prepare($link, $sql)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_nip);

      // Set parameters
      $param_nip = $nip;

      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if nip exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1){
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $id, $nama, $nip, $jabatan, $hashed_password);
          if(mysqli_stmt_fetch($stmt)){
            if(password_verify($password, $hashed_password)){
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["nama"] = $nama;
              $_SESSION["nip"] = $nip;
              $_SESSION["jabatan"] = $jabatan;


              // Redirect user to welcome page
              header("location: dashboard.php");
            } else{
              // Display an error message if password is not valid
              $password_err = "The password you entered was not valid.";
            }
          }
        } else{
          // Display an error message if nip doesn't exist
          $nip_err = "No account found with that nip.";
        }
      } else{
        echo "Oops! Something went wrong. Please try again later.";
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
  <title>Login</title>
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
       <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-500 mb-4">Welcome To!</h1>
                    <h1 class="h5 text-gray-600 mb-2"><b>SIMANTRA</b></h1>
                  </div>
        
        <div class="wrapper">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($nip_err)) ? 'has-error' : ''; ?>">
              <label>NIP</label>
              <input type="text" name="nip" class="form-control" value="<?php echo $nip; ?>">
              <span class="help-block"><?php echo $nip_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <label>Password</label>
              <input type="password" name="password" class="form-control" autocomplete="on">
              <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Login">
              <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
            <p>Lupa Password? <a href="register.php">Reset Password</a>.</p>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
 