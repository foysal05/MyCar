<?php
include('db.php');
session_start();
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password=mysqli_real_escape_string($con, $_POST['password']);
	$result=mysqli_query($con,"SELECT * FROM users where email='$email' and password='$password'");
		if ($row = mysqli_fetch_array($result)) {
		$_SESSION['u_id']=$row['u_id'];
		$_SESSION['name']=$row['name'];		
		$_SESSION['email']=$row['email'];
		$_SESSION['type']=$row['type'];
		$_SESSION['mycar_login']=TRUE;	
		header("Location:../index");
				
	}else{
		//header("Location:../login?wrong=1");
	}

}
?>
