<?php
include 'database.php';



if(isset($_GET['deleteid'])){
  $id=$_GET['deleteid'];
  $sql = "delete from students where id= $id ";
  // $sql = "UPDATE students set deleted = 1 where id = ".$id;
  $result = mysqli_query($conn, $sql);

  if($result){
    echo "Deleted Successfull";
    header('location:listing.php');
  }else{
    die(mysqli_error($conn));
  }
}

//     $sql = "delete from `students` where id= '".$id."'";


?>

