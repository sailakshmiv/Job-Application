<?php
	session_start();
	if (!isset($_SESSION['id'])) { 
			header("Location:login.php");
			exit();
		
	}

	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
		// last request was more than 30 minutes ago
		session_unset();     // unset $_SESSION variable for the run-time 
		session_destroy();   // destroy session data in storage
		$url = "login.php";
		$url .= "?Session_Expired=1";
		header("Location:$url");
		exit();
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
		include("connection.php");
	
	$query="SELECT * FROM `profiles`"; // query to get all the records from the database
	
	$result = mysqli_query($conn,$query);
	
	//$row = mysqli_fetch_array($result);
	//$count = $row['id'];
		
?>

<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus�">
  <meta name="Author" content="Bala Jaswanth">
  <meta name="Description" content="A simple website">
  <title>System Administrator</title>
  <link href="../css/style.css" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

 </head>
 <body>
  <div id = "container" class = "container">
  <div class = "row">
  <div class = "col-md-8 col-md-offset-3 jobbody">
	<div id = "header">
		<ul id='menu'> 
			<li><a href='indexpage.php'>Home</a></li>
			<li class = "pull-right"><a href="login.php?Logout=1">Log Out</a></li>
		</ul>
	</div>
	<div id = "main" class = "jobform">
		<h2>Candidate profiles.</h2></br></br></br> 

		<div id = "data">
			<form name = "data">
				<table>
					<tr>
						<th>S.No</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>CV</th>
					</tr>
<?php
		if(!$result){
			echo "<p>No candidate registered yet.</p>";
		} else {
			while($row = mysqli_fetch_array($result)){ // displaying the applicant's profiles in a tabular format
				echo "<tr>".
					 "<td>".$row['id']."</td>".
					 "<td>".$row['firstName']." ".$row['lastName']."</td>".
					 "<td>".$row['email']."</td>".
					 "<td>".$row['phone']."</td>".
					 "<td><a href = 'viewcv.php?firstName=".$row['firstName']."&id=".$row['id']."' target = '_blank'>view</td>".
					 "</tr>";
			}
		}
	
?>


				</table>
			</form>
		</div>
		
	</div>
	<div id = "footer">
		<p>&copy; <script>new Date().getFullYear()</script> Bala Jaswanth. All rights reserved.</p>
	</div>
	</div>
	</div>
  </div>
  <!--<script src="../javascript/script.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
 </body>
</html>
