<?php
include("database.php");
// SQL query
$sql = "SELECT * FROM students  where deleted = 0";

// Execute the query
$result = $conn->query($sql);




?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>My Project</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="student.php">Crud Operation</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="student.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="student.php">Add Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">List Student</a>
        </li>
       </ul>
    </div>
  </div>
</nav>
	<div class="container">
		<h1 class="text-center my-5">List Student</h1>
		<div style="overflow-x:auto;">

		<div class="row my-4">
			<div class="col-md-3">
				<div class="input-group">
					<input class="form-control" type="search" value="" placeholder="Search name" id="example-search-input">
					<span class="input-group-append">
						<button class="btn btn-outline-secondary bg-primary text-white" type="button">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-3"></div>
			<div class="col-md-3">
			<a class="btn btn-primary float-end col-md-8" href="student.php" role="button">Add Student</a>
			</div>
		</div>
    

		<table class="table table-striped align-middle table-bordered border-secondary text-center table-responsive">
		  <thead class="bg-primary text-white">
		    <tr>
		      <th scope="col">S.N.</th>
		      <th scope="col">Name</th>
		      <th scope="col">Dob</th>
		      <th scope="col">Class</th>	      
		      <th scope="col">Roll No</th>
		      <th scope="col">Section</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
			<?php
			if ($result->num_rows > 0) {
				// Output data of each row
				$sn=1;
				while ($row = $result->fetch_assoc()) { 
					$student_id =	$row['id'];
			      	$dob = date('Y-m-d', $row['dob']);?>
				<tr>
					<th scope="row"><?php echo $sn; ?></th>
					<td><?php echo $row['name']??''; ?></td>
					<td><?php echo $dob??''; ?></td>
					<td><?php echo $row['class']??''; ?></td>
					<td><?php echo $row['roll_no']??''; ?></td>
					<td><?php echo $row['section']??''; ?></td>
					<td>
						<div class="d-grid gap-2 d-md-block">
						<button class="btn btn-primary" type="button" onclick="window.location.href='add_edit_student.php?id=<?php echo $student_id; ?>'" >Edit</button>
						<button class="btn btn-danger" type="button"><a class="text-white" href="deleted.php?deleteid=<?php echo $student_id; ?>">Delete</a></button>
						</div>
					</td>
				</tr>
				<?php  $sn++; }
			} else {
				echo "No results found";
			}
			      ?>	
		    
		  </tbody>
		</table>
		</div>
	</div>
	

	
	</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>