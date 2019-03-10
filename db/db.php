<?php
$con=mysqli_connect('localhost','root','','mycar');
mysqli_query($con,'SET CHARACTER SET utf8');
mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");



?>