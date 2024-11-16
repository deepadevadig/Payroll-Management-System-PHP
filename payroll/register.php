<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registration Form</title>
  <link href="assets/must.png" rel="shortcut icon">
  <link rel="stylesheet" href="assets/css/login.css">
  <script>
    function validateRegistrationForm() {
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;

      // Username validation: at least 1 uppercase letter, minimum 4 lowercase letters
      var usernameRegex = /^(?=.*[A-Z])(?=.*[a-z]{4,}).*$/;
      if (!username.match(usernameRegex)) {
        alert('Username must contain at least 1 uppercase letter and minimum 4 lowercase letters.');
        return false;
      }

      // Password validation: 1 uppercase letter, 4 lowercase letters, 1 number, 1 special symbol
      var passwordRegex = /^(?=.*[A-Z])(?=.*[a-z]{4,})(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
      if (!password.match(passwordRegex)) {
        alert('Password must contain at least 1 uppercase letter, minimum 4 lowercase letters, 1 number, and 1 special symbol.');
        return false;
      }

      return true;
    }

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

  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = stripslashes($username);
    $username = mysqli_real_escape_string($connection, $username);

    $password = stripslashes($password);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "INSERT INTO `user` (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($connection, $query);
    if ($result) {
      echo "<script>alert('Registration successful. You can now login.'); window.location.href='login.php';</script>";
      exit;
    } else {
      echo "<script>alert('Registration failed. Please try again.'); window.location.href='register.php';</script>";
      exit;
    }
  }
?>
<br><br><br>
<div class="container">
  <section id="content">
    <form action="" method="post" onsubmit="return validateRegistrationForm()">
      <h1>Registration</h1>
      <div>
        <input name="username" id="username" type="text" placeholder="Enter Username" required>
      </div>
      <div>
        <input name="password" id="password" type="password" placeholder="Enter Password" required>
        <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility()"> Show Password
      </div>
      <div>
        <input type="submit" value="Register" />
      </div>
    </form>
    <div style="margin-top: 10px;">
      <p>Already a member? <a href="login.php">Login here</a></p>
    </div>
  </section>
</div>
</body>
</html>