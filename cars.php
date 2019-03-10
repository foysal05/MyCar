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
<title>MyCar BD</title>
<link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
<body>
    <?php

    include ('inc/left_bar.php');

    ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
     <?php include ('inc/header.php'); ?>
     <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">গাড়ির তথ্য সমুহ</strong>
                            <a href="new_car"><button  class="btn btn-success"><i class="menu-icon ti-plus"></i> নতুন গাড়ি যুক্ত করুন</button></a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>গাড়ির নম্বর</th>
                                        <th>ব্রান্ড</th>
                                        <th>মডেল</th>
                                        <th>চেসিস নং</th>
                                        <th>ড্রাইভার</th>
                                        <th>অবস্থা</th>
                                        <th>পরিবর্তন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include('db/db.php');
                                    $query="SELECT * FROM cars";
                                    $result=mysqli_query($con,$query);
//echo mysqli_error();
                                    if(mysqli_num_rows($result)>0){

                                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                            

                                           ?>
                                           <tr>
                                            <td><?php echo $row['number'];?></td>
                                            <td><?php echo $row['brand'];?></td>
                                            <td><?php echo $row['model'];?></td>
                                            <td><?php echo $row['chassis_no'];?></td>
                                            <td><?php echo $row['driver'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <?php
                  echo "<td style='text-align: center'>
                  <a style='color:white; text-decoration: none;' href='new_car?update&id=".$row['c_id']."&number=".$row['number']."&brand=".$row['brand']."&model=".$row['model']."&chassis_no=".$row['chassis_no']."&driver=".$row['driver']."&status=".$row['status']."'><button class='btn btn-info'><i class='fas fa-edit'></i></button></a>

                  <a style='color:white; text-decoration: none;' onClick=\"return confirm('আপনি মুছে ফেলার জন্য নিশ্চিত?')\" href='db/db_car.php?delete&id=".$row['c_id']."'><button class='btn btn-danger'>
                  <i class='far fa-trash-alt'></i></button></a>
                  </td>";

                  ?>

                                            
                                        </tr>
                                        <?php

                                    }
                                }
                                ?>                                     
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
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
<script src="assets/js/lib/data-table/datatables.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/jszip.min.js"></script>
<script src="assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="assets/js/init/datatables-init.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
  } );
</script>
</body>
</html>
<?PHP

}else{
    header('location:index');
}

?>