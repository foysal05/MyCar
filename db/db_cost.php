<?php
session_start();
include('db.php');
if (isset($_POST['save'])) {

	$car=$_SESSION['car'];
	$amount=$_POST['amount'];
	$details=$_POST['details'];
	$date=$_POST['date'];

	$query="INSERT INTO cost VALUES('','$date','$details','$amount','$car')";
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../my_cost?success');
	}else{
		header('location:../my_cost?error');
	}
}

if (isset($_GET['delete'])) {

	$id=$_GET['id'];
	$query="DELETE FROM cost WHERE cost_id='$id'";
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../my_cost?deleted');
	}else{
		header('location:../my_cost?error');
	}
}

if (isset($_POST['update'])) {
	
	$id=$_POST['id'];
	$amount=$_POST['amount'];
	$details=$_POST['details'];
	$date=$_POST['date'];
	$query="UPDATE cost  SET `date`='$date',details='$details',amount='$amount' WHERE cost_id='$id'";
	//echo $query;
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../my_cost?updated');
	}else{
		header('location:../my_cost?error');
	}
}


?>