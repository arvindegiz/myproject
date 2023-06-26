<?php
include 'database.php';


if(isset($_POST['submit'])){ 
// $id = $_POST['id'];
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

// $sql = "INSERT INTO students (name, dob, class, section, roll_no,created)
// VALUES ('$name', '$dob', '$class' , '$section' , '$roll_no' , '$created')";

// if ($conn->query($sql) === TRUE) {
//   echo "Record Update successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }
// if($name !=''||$dob !=''){
// //Insert Query of SQL
// $query = mysql_query("insert into student(student_name, student_email, student_contact, student_address) values ('$name', '$dob', '$class', '$section' , '$roll_no', '$created')");
// echo "<br/><br/><span>Data Inserted successfully...!!</span>";
// }
// else{
// echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
// }
}
?>