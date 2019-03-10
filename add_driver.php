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
        <title>নতুন ড্রাইভার এর তথ্য</title>
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
                  <strong>Success!</strong> Driver Information Saved Successfully.
              </div>

              <?php
          }else if (isset($_GET['error'])) {
            ?>
            <div class="alert alert-warning">
              <strong>Warning!</strong> Driver Information not saved.
          </div>

          <?php
      }else if (isset($_GET['not_image'])) {
            ?>
            <div class="alert alert-warning">
              <strong>Warning!</strong> Please Select Valid Image For NID & Licence.
          </div>

          <?php
      }
      ?>
      

      <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">ড্রাইভার তথ্য</strong>
                    <button style="float: right" class="btn btn-info">ড্রাইভার তালিকা দেখুন</button>
                </div>
                <div></div>
                <div class="card-body">
                    <!-- Credit Card -->
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="card-title">
                               <h3 class="text-center">ড্রাইভার এর  তথ্য যুক্ত করুন
                               </h3>
                           </div>
                           <hr>
                           <form action="db/db_driver.php" method="post" enctype="multipart/form-data" accept-charset="utf-8" >
        <!-- <div class="form-group text-center">
            <ul class="list-inline">
                <li class="list-inline-item"><i class="text-muted fa fa-cc-visa fa-2x"></i></li>
                <li class="list-inline-item"><i class="fa fa-cc-mastercard fa-2x"></i></li>
                <li class="list-inline-item"><i class="fa fa-cc-amex fa-2x"></i></li>
                <li class="list-inline-item"><i class="fa fa-cc-discover fa-2x"></i></li>
            </ul>
        </div> -->
        <div class="form-group">
         <span style="color: red">*</span> <label for="cc-payment" class="control-label mb-1">নাম
         </label>
         <input id="cc-payment"  name="name" type="text"  class="form-control" aria-required="true" aria-invalid="false" required="" >
     </div>
     <div class="form-group">
         <span style="color: red">*</span> <label for="cc-payment" class="control-label mb-1">ঠিকানা
         </label>
         <input id="cc-payment"  name="address" type="text"  class="form-control" aria-required="true" aria-invalid="false" required="" >
     </div>
     <div class="form-group has-success">
        <span style="color: red">*</span><label for="cc-name" class="control-label mb-1">এন আইডি </label>
        <input id="cc-name" onkeypress="return isNumberKey(event)" name="nid" type="text" class="form-control" data-val="true" data-val-required="Please enter the name of location" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name" required="">
        <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
    </div> 
    <div class="form-group has-success">
     <span style="color: red">*</span> <label for="cc-name" class="control-label mb-1">এন আইডি ফটো </label>
     <input id="cc-name" name="nid_photo" type="file" accept=".png,.jpeg,.jpg" class="form-control" data-val="true" data-val-required="Please enter the name of location" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name" required="">
     <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
 </div>
 <div class="form-group">
     <span style="color: red">*</span> <label for="cc-number" class="control-label mb-1">ফোন</label>
     <input id="cc-number" onkeypress="return isNumberKey(event)" name="phone" type="text" class="form-control" required="" >
     <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
 </div>
 <div class="form-group">
    <span style="color: red">*</span><label for="cc-number" class="control-label mb-1">লাইসেন্স</label>
    <input id="cc-number" name="licence" accept=".png,.jpeg,.jpg" type="file" class="form-control" required="" >
    <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
</div>
<div class="form-group">
    <span style="color: red">*</span><label for="cc-number" class="control-label mb-1">বেতন</label>
    <input id="cc-number" name="salary" onkeypress="return isNumberKey(event)" type="text" class="form-control" required="" >
    <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
</div>
<div class="form-group">
    <label for="cc-number" class="control-label mb-1">কমিশন (%)</label>
    <input id="cc-number" name="commission" onkeypress="return isNumberKey(event)" type="text" class="form-control" placeholder="প্রতি যাত্রা এর কমিশন "  >
    <span class="help-block" data-valmsg-for="cc-number"   data-valmsg-replace="true"></span>
</div>
        <!-- <div class="form-group">
            <label for="cc-number" class="control-label mb-1">অবস্থা</label>
            <select class="form-control" name="status" required="">
                <option value="">নির্বাচন করন</option>
                <option value="অ্যাক্টিভ">অ্যাক্টিভ</option>
                <option value="নিষ্ক্রিয়">নিষ্ক্রিয়</option>
            </select>
            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
        </div> -->

        <div>
            <button id="payment-button" name="add_driver" type="submit" class="btn btn-lg btn-info btn-block">

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
    header('location:index');
}

?>