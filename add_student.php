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

$sql = "INSERT INTO students (name, dob, class, section, roll_no,created)
VALUES ('$name', '$dob', '$class' , '$section' , '$roll_no' , '$created')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
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