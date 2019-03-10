<?php
session_start();
include('db.php');
if (isset($_POST['save'])) {

$owner=$_SESSION['u_id'];
$car_number=$_POST['car_number'];
$brand=$_POST['brand'];
$model=$_POST['model'];
$chassis=$_POST['chassis'];
$driver=$_POST['driver'];
$status=$_POST['status'];

echo $status;
$query="INSERT INTO cars VALUES('','$car_number','$brand','$model','$chassis','$driver','$status','$owner')";
$result=mysqli_query($con,$query);
if ($result) {


	header('location:../new_car?success');

}else{
	header('location:../new_car?error');
}




	}

?>