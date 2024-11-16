<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Form</title>
  <link href="assets/must.png" rel="shortcut icon">
  <link rel="stylesheet" href="assets/css/login.css">
  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById('password');
      var passwordVisibilityCheckbox = document.getElementById('showPasswordCheckbox');

      if (passwordVisibilityCheckbox.checked) {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }
  </script>
</head>
<body class="hold-transition login-page">
<?php
require('db.php');
session_start();

// Change Password Functionality
if (isset($_POST['change_password'])) {
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  if ($new_password !== $confirm_password) {
    $error = 'New password and confirm password do not match.';
    echo "<script>alert('$error');</script>";
  } else {
    $username = $_SESSION['username'];

    $new_password = stripslashes($new_password);
    $new_password = mysqli_real_escape_string($connection, $new_password);

    $query = "UPDATE `user` SET password='$new_password' WHERE username='$username'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $success = 'Password changed successfully.';
      echo "<script>alert('$success');</script>";
    } else {
      $error = 'Failed to change password. Please try again.';
      echo "<script>alert('$error');</script>";
    }
  }
}

// Login Functionality
if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = stripslashes($username);
  $username = mysqli_real_escape_string($connection, $username);

  $password = stripslashes($password);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT * FROM `user` WHERE username='$username' and password='$password'";
  $result = mysqli_query($connection, $query);
  $rows = mysqli_num_rows($result);

  if ($rows == 1) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
    exit;
  } else {
    $error = 'Invalid Username or Password, please try again.';
    echo "<script>alert('$error');</script>";
  }
}
?>
<br><br><br>
<div class="container">
  <section id="content">
    <form action="" method="post">
      <h1>Login</h1>
      <div>
        <input name="username" type="text" placeholder="Enter Username" required>
      </div>
      <div>
        <input name="password" id="password" type="password" placeholder="Enter Password" required>
        <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility()"> Show Password
      </div>
      <div>
        <input type="submit" value="Log in" />
      </div>
      <div>
        <a href="forgot_password.php">Forgot Password?</a>
      </div>
    </form>
    <!-- Change Password Section -->
    <form action="" method="post">
      <h2>Change Password</h2>
      <div>
        <input name="new_password" type="password" placeholder="Enter New Password" required>
      </div>
      <div>
        <input name="confirm_password" type="password" placeholder="Confirm New Password" required>
      </div>
      <div>
        <input type="submit" name="change_password" value="Change Password" />
      </div>
    </form>
  </section>
</div>
</body>
</html>
