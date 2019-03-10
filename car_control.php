<?php
session_start();
if ($_SESSION['mycar_login']==TRUE && $_GET['selected_car']) {
  
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<?php

include ('inc/head.php');

?>
<title><?php echo $_SESSION['car_name']; ?></title>
<body>
<?php

include ('inc/left_bar.php');

?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
 <?php include ('inc/header.php'); ?>
        <!-- Content -->
        <div class="content">
    <?php
$catch=$_GET['selected_car'];
// $enc=base64_encode($catch);
$dec=base64_decode($catch);
$_SESSION['car']=$dec;
$_SESSION['car_name']=$_GET['car_name'];
echo "<h3>".$_SESSION['car_name']."</h3><br>";
//echo $SESSION['car'];




    ?>
     <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                   
    <div class="col-lg-3 col-md-6">
         <a href="receive_payment">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text"><b>আয় হিসেব</b></div>
                                        <!-- <div class="stat-digit">1,012</div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <a href="my_cost">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money text-danger border-danger"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text"><b>বায় হিসেব</b></div>
                                       <!--  <div class="stat-digit">961</div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Active Projects</div>
                                        <div class="stat-digit">770</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-link text-danger border-danger"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Referrals</div>
                                        <div class="stat-digit">2,781</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
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
        </footer>
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
    header('location:index?please_select_car');
}

?>