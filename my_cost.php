<?php
session_start();
if ($_SESSION['mycar_login']==TRUE  &&  $_SESSION['car_name']) {

    ?>
    <!doctype html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <?php

    include ('inc/head.php');

    ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title><?php echo $_SESSION['car_name'];?> (খরচের তথ্য) </title>
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
                    <strong></strong>খরচ তথ্য সফলভাবে সংরক্ষিত হলো
                </div>

                <?php
            } else if (isset($_GET['please_select'])) {
              ?>
              <div class="alert alert-danger">
                  <strong></strong> উপার্জন খরচ তথ্য সফলভাবে সংরক্ষিত হলো
              </div>
              <?php
          }else if (isset($_GET['updated'])) {
              ?>
              <div class="alert alert-success">
                  <strong></strong> উপার্জন তথ্য সফলভাবে আপডেট হয়েছে
              </div>
              <?php
          }elseif (isset($_GET['deleted'])) {
            ?>
            <div class="alert alert-success">
              <strong></strong> উপার্জন তথ্য সফলভাবে মুছে ফেলা হয়েছে
          </div>

          <?php
      }
      ?>

      <?php echo "<h3 style='color:#435466'>".$_SESSION['car_name']."</h3><br>"; ?>
      <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">নিয়মিত ব্যয় তথ্য সংরক্ষণ করুন</strong>
                </div>
                <div class="card-body">
                    <!-- Credit Card -->
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center">দৈনিক ব্যয় লিখুন
                                </h3>
                            </div>
                            <hr>
                            <form action="db/db_cost.php" method="post" >
                             <input type="hidden" name="car" value="<?php echo $_SESSION['car'];?>">
                             <input type="hidden" name="id" value=" <?php if (isset($_GET['update'])) { echo $_GET['id'];} ?>">
                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">টাকা
                                </label>
                                <input id="cc-payment" onkeypress="return isNumberKey(event)" value="<?php if (isset($_GET['update'])) { echo $_GET['amount'];} ?>" name="amount" type="text" placeholder="দয়া করে ইংরেজি লিখুন" class="form-control" aria-required="true" aria-invalid="false" required="" >
                            </div>
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">খরচের বিবরণ লিখুন </label>
                                <input id="cc-name" value="<?php if (isset($_GET['update'])) { echo $_GET['details'];} ?>" name="details" type="text" class="form-control" data-val="true" data-val-required="Please enter the name of location" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name" required="">
                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">তারিখ</label>
                                <input id="cc-number"  name="date" type="date" class="form-control" value="<?php if (isset($_GET['update'])) { echo $_GET['date'];} ?>" required="" >
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            </div>

                            <?php
                            if (isset($_GET['update'])) {
                               ?>
                               <div>
                                <button id="payment-button" name="update" type="submit" class="btn btn-lg btn-info btn-block">

                                    <span id="payment-button-amount">Update</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div>

                            <?php
                        }else{
                            ?>
                            <div>
                                <button id="payment-button" name="save" type="submit" class="btn btn-lg btn-info btn-block">

                                    <span id="payment-button-amount">Save</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div>

                            <?php
                        }
                        ?>
                    </form>
                </div>
            </div>

        </div>
    </div> <!-- .card -->

</div><!--/.col-->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">ব্যয়  তথ্য দেখুন</strong>
        </div>
        <div class="card-body">
            <!-- Credit Card -->
            <div id="pay-invoice">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">টাকা খরচ তালিকা </h3>
                    </div>
                    <hr>
                    <table id="example" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>তারিখ</th>
                                <th>স্থান</th>
                                <th>টাকা</th>
                                <th>পরিবর্তন</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                           include('db/db.php');
                           $query="SELECT * FROM cost WHERE car='".$_SESSION['car']."'";
                           $result=mysqli_query($con,$query);
//echo mysqli_error();
                           if(mysqli_num_rows($result)>0){

                            while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){


                               ?>
                               <tr>
                                <td><?php echo $row['date'];?></td>
                                <td><?php echo $row['details'];?></td>
                                <td><?php echo $row['amount'];?></td>
                                <?php
                                echo "<td style='text-align: center'>
                                <a style='color:white; text-decoration: none;' href='my_cost?update&id=".$row['cost_id']."&date=".$row['date']."&details=".$row['details']."&amount=".$row['amount']."'><button class='btn btn-info'><i class='fas fa-edit'></i></button></a>

                                <a style='color:white; text-decoration: none;' onClick=\"return confirm('আপনি মুছে ফেলার জন্য নিশ্চিত?')\" href='db/db_cost.php?delete&id=".$row['cost_id']."&date=".$row['date']."&details=".$row['details']."&amount=".$row['amount']."'><button class='btn btn-danger'>
                                <i class='fa fa-trash-alt'></i></button></a>
                                </td>";
                                
                                ?>
                                
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <th>তারিখ</th>
                            <th>স্থান</th>
                            <th>টাকা</th>
                            <th>পরিবর্তন</th>
                        </tr>
                    </tfoot>     
                </tbody>
            </table>
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
<!--  <script src="assets/js/lib/data-table/datatables.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/jszip.min.js"></script>
<script src="assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="assets/js/init/datatables-init.js"></script> -->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script href=""></script>


<script type="text/javascript">
 $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
</body>
</html>
<?PHP

}else{
    header('location:index?please_select');
}

?>