<?php
session_start();
include('db.php');
if (isset($_POST['save'])) {

	$car=$_SESSION['car'];
	$amount=$_POST['amount'];
	$tour_earn=$_POST['tour_earn'];
	$commission=$_POST['commission'];
	$location=$_POST['location'];
	$date=$_POST['date'];
	$query="INSERT INTO rental VALUES('','$date','$location','$amount','$tour_earn','$commission','$car')";
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../receive_payment?success');
	}else{
		header('location:../receive_payment?error');
	}

}

if (isset($_GET['delete'])) {

	$id=$_GET['id'];
	$query="DELETE FROM rental WHERE r_id='$id'";
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../receive_payment?deleted');
	}else{
		header('location:../receive_payment?error');
	}
}

if (isset($_POST['update'])) {
	
	$car=$_POST['id'];
	$amount=$_POST['amount'];
	$tour_earn=$_POST['tour_earn'];
	$commission=$_POST['commission'];
	$location=$_POST['location'];
	$date=$_POST['date'];
	$query="UPDATE rental  SET `date`='$date',location='$location',amount='$amount',tour_earn='$tour_earn',commission='$commission' WHERE r_id='$car'";
	//echo $query;
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../receive_payment?updated');
	}else{
		header('location:../receive_payment?error');
	}
}

?>