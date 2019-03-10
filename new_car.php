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
    <title>নতুন গাড়ির তথ্য</title>
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <body>
        <?php

        include ('inc/left_bar.php');

        ?>
        <!-- Right Panel -->
        <div id="right-panel" class="right-panel">
           <?php include('inc/header.php');?>
           <!-- Content -->
           <div class="content">

            <?php
            if (isset($_GET['success'])) {
               ?>
               <div class="alert alert-success">
                  <strong>Success!</strong> Car Information Saved Successfully.
              </div>

              <?php
          }else if (isset($_GET['error'])) {
            ?>
            <div class="alert alert-warning">
              <strong>Warning!</strong> Car Information not saved.
          </div>

          <?php
      }
      ?>

      <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">গাড়ির তথ্য</strong>
                </div>
                <div class="card-body">
                    <!-- Credit Card -->
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="card-title">
                             <h3 class="text-center">গাড়ির  তথ্য যুক্ত করুন
                             </h3>
                         </div>
                         <hr>
                         <form action="db/db_car.php" method="post" accept-charset="utf-8" >
                                            <!-- <div class="form-group text-center">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item"><i class="text-muted fa fa-cc-visa fa-2x"></i></li>
                                                    <li class="list-inline-item"><i class="fa fa-cc-mastercard fa-2x"></i></li>
                                                    <li class="list-inline-item"><i class="fa fa-cc-amex fa-2x"></i></li>
                                                    <li class="list-inline-item"><i class="fa fa-cc-discover fa-2x"></i></li>
                                                </ul>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">গাড়ির নম্বর
                                                </label>
                                                <input id="cc-payment" 
   value="<?php if(isset($_GET['update'])){echo $_GET['number'];} ?>"  name="car_number" type="text"  class="form-control" aria-required="true" aria-invalid="false" required="" >
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">ব্রান্ড
                                                </label>
                                                <input value="<?php if(isset($_GET['update'])){echo $_GET['brand'];} ?>"  id="cc-payment"  name="brand" type="text"  class="form-control" aria-required="true" aria-invalid="false" required="" >
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">মডেল </label>
                                                <input id="cc-name" name="model" type="text" class="form-control" value="<?php if(isset($_GET['update'])){echo $_GET['model'];} ?>"  data-val="true" data-val-required="Please enter the name of location" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name" required="">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">চেসিস নং</label>
                                                <input id="cc-number" value="<?php if(isset($_GET['update'])){echo $_GET['chassis_no'];} ?>"  name="chassis" type="text" class="form-control" required="" >
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">ড্রাইভার</label>
                                                <select id="cc-number" name="driver" class="form-control" required="">
                                                    <option value="">নির্বাচন করন</option>
                                                    <?php
                                                    include('db/db.php');
                                                    $query="SELECT * FROM driver WHERE owner='".$_SESSION['u_id']."'";

                                                    $result=mysqli_query($con,$query);
//echo mysqli_error();
                                                    if(mysqli_num_rows($result)>0){

                                                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                            echo "<option value='".$row['d_id']."'>".$row['name']."</option>";


                                                        }
                                                    }


                                                    ?>
                                                </select>
                                                
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">অবস্থা</label>
                                                <select class="form-control" name="status" required="">
<option value="" >নির্বাচন করন</option>
<option value="অ্যাক্টিভ" <?php if(isset($_GET['status'])=='অ্যাক্টিভ'){echo "selected" ;} ?>>অ্যাক্টিভ</option>
<option value="নিষ্ক্রিয়" <?php if(isset($_GET['status'])=='নিষ্ক্রিয়'){echo "selected" ;} ?>>নিষ্ক্রিয়</option>
                                                </select>
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>

                                            <div>
                                                <button id="payment-button" name="save" type="submit" class="btn btn-lg btn-info btn-block">

                                                    <span id="payment-button-amount">Save</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div><!--/.col-->

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
    header('location:login?authentication_required');
}

?>