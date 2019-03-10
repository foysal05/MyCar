<?php
session_start();
include('db.php');
if (isset($_POST['add_driver'])) {
	$target_dir = "images/";
	$target_file_nid = $target_dir . basename($_FILES["nid_photo"]["name"]);
	$target_file_licence = $target_dir . basename($_FILES["licence"]["name"]);
	$imageFileType_nid = strtolower(pathinfo($target_file_nid,PATHINFO_EXTENSION));
	$imageFileType_licence = strtolower(pathinfo($target_file_licence,PATHINFO_EXTENSION));

	$check_nid = getimagesize($_FILES["nid_photo"]["tmp_name"]);
	$check_licence = getimagesize($_FILES["licence"]["tmp_name"]);

	if($check_nid !== false && $check_licence !== false) {
		
		$driver_name=$_POST['name'];
		$address=$_POST['address'];
		$phone=$_POST['phone'];
		$nid=$_POST['nid'];
		$salary=$_POST['salary'];
		$commission=$_POST['commission'];
		$owner=$_SESSION['u_id'];
//==============Moving NID photo======================
		$name =str_replace(" ","_",$_FILES['nid_photo'] ['name']);
		$temp=$_FILES['nid_photo'] ['tmp_name'];
		move_uploaded_file($temp,"images/".$name);
		$nid_photo="images/$name";
//==============Moving Licence photo======================
		$name =str_replace(" ","_",$_FILES['licence'] ['name']);
		$temp=$_FILES['licence'] ['tmp_name'];
		move_uploaded_file($temp,"images/".$name);
		$licence="images/$name";
//==============SQL Query Section======================
		$query="INSERT INTO driver VALUES ('','$driver_name','$address','$nid','$nid_photo','$phone','$licence','$salary','$commission',$owner)";
		$result=mysqli_query($con,$query);
		if ($result) {
			
			header('location:../add_driver?success');
		}else{
			header('location:../add_driver?error');
		}
	} else {
		header('location:../add_driver?not_image');

	}
}


?>