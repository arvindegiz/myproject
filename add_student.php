<?php
include 'database.php';


if(isset($_POST['submit'])){ 
$name = $_POST['name'];
$dob = $_POST['dob'];
$class = $_POST['class'];
$section = $_POST['section'];
$roll_no = $_POST['roll_no'];
$created = time();



$status = "";

if(isset($_POST['time_in'])) {
    $query = "INSERT INTO students (datetime) VALUES (NOW())";
    $d = $conn->prepare($query);
    $d->execute();     
    $_SESSION['clock_id'] = $conn->lastInsertId();
} elseif(isset($_POST['time_out'])) {
    if (!isset($_SESSION['clock_id'])) {
      $status = "You need to clock in first!";
    } else {
      $query = "UPDATE nameOfTable SET datetime = NOW() WHERE id = :id ";
      $d = $conn->prepare($query);
      $d->execute(['id' => $_SESSION['clock_id']]);   
    }
} else {
    $status = "Can't time in!";
}

}
?>