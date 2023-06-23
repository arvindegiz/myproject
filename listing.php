<?php
include("studentlist.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>My Project</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Arvind</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="student.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_edit_student.php">Add Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Edit Student</a>
        </li>
       </ul>
    </div>
  </div>
</nav>
	<div class="container">
		<h1 class="text-center m-5">List Student</h1>
		<div style="overflow-x:auto;">
		<table class="table table-striped align-middle table-bordered border-secondary text-center table-responsive">
		  <thead class="bg-primary text-white">
		    <tr>
		      <th scope="col">S.N.</th>
		      <th scope="col">Name</th>
		      <th scope="col">Dob</th>
		      <th scope="col">Class</th>
		      <th scope="col">Section</th>
		      <th scope="col">Roll No</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
			<?php
			      if(is_array($fetchData)){      
			      $sn=1;
			      foreach($fetchData as $data){
			      $student_id =	$data['id'];
			    ?>	
		    <tr>
		      <th scope="row"><?php echo $sn; ?></th>
		      <td><?php echo $data['name']??''; ?></td>
		      <td><?php echo $data['dob']??''; ?></td>
		      <td><?php echo $data['class']??''; ?></td>
		      <td><?php echo $data['roll_no']??''; ?></td>
		      <td><?php echo $data['section']??''; ?></td>
		      <td>
				<div class="d-grid gap-2 d-md-block">
				  <button class="btn btn-primary" type="button" onclick="window.location.href='add_edit_student.php?id=<?php echo $student_id; ?>'" >Edit</button>
				  <button class="btn btn-danger" type="button">Delete</button>
				</div>
		      </td>
		    </tr>
		     <?php
			      $sn++;}}else{ ?>
			      <tr>
			        <td colspan="8">
			    <?php echo $fetchData; ?>
			  </td>
			    <tr>
			    <?php
			    }?>
		    
		  </tbody>
		</table>
		</div>
	</div>
	

	
	</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>