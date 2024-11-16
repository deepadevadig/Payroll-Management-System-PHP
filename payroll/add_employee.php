<?php
$conn = mysqli_connect('localhost', 'root', '', 'payroll');
if (!$conn) {
    die("Database Connection Failed" . mysqli_error());
}
$db = 'payroll';
$select_db = mysqli_select_db($conn, $db);
if (!$select_db) {
    die("Database Selection Failed" . mysqli_error());
}

if (isset($_POST['submit']) != "") {
    $emp_id = $_POST['emp_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $division = $_POST['division'];

    // Validate first name and last name
    if (!ctype_alpha($fname) || !ctype_alpha($lname)) {
        ?>
        <script>
            alert('First name and last name should only contain alphabetic characters.');
            window.location.href = 'index.php';
        </script>
        <?php
        exit; // Stop further execution if validation fails
    }

    $sql = mysqli_query($conn, "INSERT into employee(emp_id, fname, lname, gender, division)VALUES('$emp_id','$fname','$lname','$gender', '$division')");

    if ($sql) {
        ?>
        <script>
            alert('Employee has been successfully added.');
            window.location.href = 'home_employee.php?page=emp_list';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Invalid.');
            window.location.href = 'index.php';
        </script>
        <?php
    }
}
?>
