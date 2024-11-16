<?php 

  include("db.php");
  include("auth.php");

  $emp_id     = $_POST['emp_id'];
  $fname      = $_POST['fname'];
  $lname      = $_POST['lname'];
  $gender     = $_POST['gender'];
  $division   = $_POST['division'];

  $sql = mysqli_query($connection,"UPDATE employee SET emp_id='$emp_id', fname='$fname', lname='$lname', gender='$gender', division='$division' WHERE emp_id='$id'");

  if ($sql)
  {
    ?>
    <script>
      alert('Employee successfully updated.');
      window.location.href='home_employee.php';
    </script>
    <?php 
  }
  else
  {
    ?>
    <script>
      alert('Invalid action.');
      window.location.href='home_employee.php';
    </script>
    <?php 
  }
?>