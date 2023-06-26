<?php
include 'database.php';


if(isset($_POST['deleteid'])){
  $id=$_POST['deleteid'];

  $sql = "delete from `students` where id= '".$id."'";

  $result = mysqli_query($con, $sql);
  if($result){
    echo "Deleted Successfull";
    // header('location:listing.php');
  }else{
    die(mysqli_error($con));
  }
}





    // sql to delete a record
//     $sql = "delete from `students` where id= '".$id."'";

//     if ($conn->query($sql) === TRUE) {
//     	echo "Deleted Successfull";
//        // header("Location: listing.php");
//     } else {
//         echo "Error deleting record: " . $conn->error;
//     }

//     $conn->close();


// }



?>