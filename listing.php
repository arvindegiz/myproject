<?php
include("database.php");
// SQL query

$param_exists = false;
$url_param = '?';
if (isset($_GET['pageno'])) {
	$pageno = $_GET['pageno'];
	$param_exists = true;
	$url_param = "?pageno=".$_GET['pageno']."&";
} else {
	$pageno = 1;
}

$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM students WHERE deleted = 0 ";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sort_by = "name";
$sort_order = "asc";
if(isset($_GET['sortby']) && isset($_GET['order'])) {
	$sort_by = $_GET['sortby'];
	$sort_order = $_GET['order'];
}

$sql = "SELECT * FROM students  where deleted = 0 ORDER BY $sort_by $sort_order LIMIT $offset, $no_of_records_per_page";
// $sql = "SELECT * FROM students  where deleted = 0 ORDER BY name DSC LIMIT $offset, $no_of_records_per_page";

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
<script src=
        "https://code.jquery.com/jquery-3.6.0.min.js"
        >
    </script>
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
		<div style="">

		<div class="row">
			<div class="col-md-3 my-4">
				<div class="input-group">
					<input class="form-control" type="search" name="search" placeholder="Search name" id="nameInput">
					<span class="input-group-append">
						<button class="btn btn-outline-secondary bg-primary text-white form-control" id="search_student" type="button">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</div>
			<div class="col-md-3 my-4">
				<!-- <select class="form-control" name="" id="sortbyAtribute">
					<option value="sort_by_name_asc">Sort by Name A-Z</option>
					<option value="sort_by_name_dsc">Sort by Name Z-A</option>
					<option value="sort_by_roll_no">Sort by Roll No</option>
					<option value="sort_by_Class">Sort by Class</option>
				</select> -->
			<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle col-md-9" type="button" id="sortbyAtribute" data-bs-toggle="dropdown" aria-expanded="false">
					Sort Data
				</button>
				<ul class="dropdown-menu">
					<li><a class="text-decoration-none btn" id="sort_by_name_asc" type="button" href="<?php echo $url_param."sortby=name&order=asc"; ?>">Sort by Name A-Z</a></li>
					<li><a class="text-decoration-none btn" id="sort_by_name_dsc" type="button" href="<?php echo $url_param."sortby=name&order=desc"; ?>">Sort by Name Z-A</a></li>
					<li><a class="text-decoration-none btn" id="sort_by_roll_no" type="button" href="<?php echo $url_param."sortby=roll_no&order=asc"; ?>">Sort by Roll No</a></li>
					<li><a class="text-decoration-none btn" id="sort_by_Class" type="button" href="<?php echo $url_param."sortby=class&order=asc"; ?>">Sort by Class</a></li>
					<li><a class="text-decoration-none btn" id="sort_by_Class" type="button" href="<?php echo $url_param."sortby=section&order=asc"; ?>">Sort by Section</a></li>

				</ul>
				</div>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-3 my-4">
			<a class="btn btn-primary float-end col-md-9" href="student.php" role="button">Add Student</a>
			</div>
		</div>
    

		<table id="dataTable" class="table table-striped align-middle table-bordered border-secondary text-center table-responsive">
		  <thead class="bg-primary text-white">
		    <tr>
		      <th scope="col">S.N.</th>
		      <th id="student_name" scope="col">Name</th>
		      <th scope="col">Dob</th>
		      <th scope="col">Class</th>	      
		      <th scope="col">Roll No</th>
		      <th id="student_section" scope="col">Section</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
			<?php
			if ($result->num_rows > 0) {
				// Output data of each row
				$sn= $offset+1;
				while ($row = $result->fetch_assoc()) { 
					$student_id =	$row['id'];
			      	$dob = date('Y-m-d', $row['dob']);
					?>

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
			<div class="d-flex justify-content-center">
				<ul class="pagination">
					<li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
					<a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Previous</a>
					</li>
					<li class="page-item active">
						<a class="page-link mx-2" href="?pageno=1"><?php echo $pageno ;?></a>
					</li>
					<li class="page-item " aria-current="page">
						<a class="page-link " href="?pageno=<?php echo $total_pages; ?>"><?php echo $pageno+1 ;?></a>
					</li>
					<!-- <li class="page-item">
						<a class="page-link mx-2" href="#">3</a>
					</li> -->
					<li class="page-item mx-2 <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
						<a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	

	
	</body>

	<script>
// search by name
	$(document).ready(function() {
		$('#search_student').click('input', function() {
			filterTable();
			// alert("This is an alert message!");
		});

		function filterTable() {
			const searchName = $('#nameInput').val().toLowerCase();
			

			$('#dataTable tbody tr').each(function() {
				const name = $(this).find('td:first').text().toLowerCase();
				const nameMatch = name.includes(searchName);
				
				if (nameMatch) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		}
	});
// sort by name


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
