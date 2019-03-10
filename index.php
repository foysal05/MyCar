<?php
session_start();
if ($_SESSION['mycar_login']==TRUE) {
  
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<?php

include ('inc/head.php');

?>
<title>MyCar | Home</title>
<body>
<?php

include ('inc/left_bar.php');

?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
    <?php include ('inc/header.php'); ?>
        <!-- Content -->
        <div class="content">
            <!-- Animated -->

            <?php
if (isset($_GET['please_select'])) {
  ?>
 <div class="alert alert-danger">
  <strong>সতর্কতা!</strong> উপার্জন বা খরচ তথ্য দেখতে একটি গাড়ী নির্বাচন করুন।
</div>
  <?php
}

            ?>
           
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">

 <?php
include('db/db.php');
$query="SELECT * FROM cars";
$result=mysqli_query($con,$query);
//echo mysqli_error();
if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
    

 ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <a href="car_control?selected_car=<?php echo base64_encode($row['c_id']);?>&car_name=<?php echo $row['number'];?>">
                            <div class="card-body">
                                 
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-car"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">
                                               <?php echo $row['number']; ?> <br> 
                                                
                                                <!-- <span class="count"></span> -->
                                                </div>
                                            <div class="stat-heading"> <?php echo $row['brand']; ?></div>
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </a>
                        </div>
                    </div>
                    <?php
}
}
                    ?>
              
               

                   
                </div>
                <!-- /Widgets -->
                <!--  Traffic  -->
                <div class="row">
                <!--  -->
                </div>
                <!--  /Traffic -->
                <div class="clearfix"></div>
                <!-- Orders -->
                
                <!-- /.orders -->
                <!-- To Do and Live Chat -->
                <div class="row">
                

                    <div class="col-lg-6">
                   
                    </div>
                </div>
                
          
     
            </div>
            <!-- .animated -->
        </div>
       
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
       <!--  <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; <?php echo date('Y');?> MyCar BD
                    </div>
                    <div class="col-sm-6 text-right">
                        Developed by <a href="http://www.facebook.com/me.foysal">Foysal</a>
                    </div>
                </div>
            </div>
        </footer> -->
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

<?php
include('inc/script.php');

?>
</body>
</html>
<?PHP

}else{
    header('location:login?authentication_required');
}

?>