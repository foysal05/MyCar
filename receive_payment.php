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
 <!--  <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


  <title><?php echo $_SESSION['car_name'];?> (আয়ের তথ্য) </title>
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
          <strong></strong>উপার্জন তথ্য সফলভাবে সংরক্ষিত হলো
        </div>

        <?php
      }else if (isset($_GET['please_select'])) {
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
      }else if (isset($_GET['deleted'])) {
        ?>
        <div class="alert alert-success">
          <strong></strong> উপার্জন তথ্য সফলভাবে মুছে ফেলা হয়েছে
        </div>

        <?php
      }
      ?>

      <?php echo "<h3 style='color:#435466'>".$_SESSION['car_name']."</h3><br>"; ?>

      <?php
      $query="SELECT * FROM cars,driver WHERE cars.driver=driver.d_id AND c_id='".$_SESSION['car']."'";
      $commission=0;

      $result=mysqli_query($con,$query);
//echo mysqli_error();
      if(mysqli_num_rows($result)>0){

        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
          $commission=$row['commission'];
        }
      }

      ?>
      <div class="row">
        <div class="col-lg-8">
         <a href="get_earn_report"> <button  class="btn btn-success">আয়ের রিপোর্ট দেখুন</button></a>
         <br>
         <br>
         <div class="card">
          <div class="card-header">
            <strong class="card-title">নিয়মিত আয় তথ্য সংরক্ষণ করুন</strong>
          </div>
          <div class="card-body">
            <!-- Credit Card -->
            <div id="pay-invoice">
              <div class="card-body">
                <div class="card-title">
                  <h3 class="text-center">দৈনিক আয় লিখুন
                  </h3>
                </div>
                <hr>
                <script type="text/javascript">
                  function validateForm() {
                    var x = document.forms["income"]["tour_earn"].value;
                    if (x == "") {
                      alert("Name must be filled out");
                      return false;
                    }
                  }
                </script>
                <form name="income" action="db/db_earn.php" method="post" onsubmit="return validateForm()" >
                 <input type="hidden" name="car" value="<?php echo $_SESSION['car'];?>">
                 <input type="hidden" name="id" value=" <?php if (isset($_GET['update'])) { echo $_GET['id'];} ?>">
                 <!-- Checking -->

                 <div class="form-group">
                  <label for="cc-payment" class="control-label mb-1">অর্জিত টাকা
                  </label>


                  <input onkeypress="return isNumberKey(event)" name="tour_earn" type="text" placeholder="দয়া করে ইংরেজি লিখুন" class="form-control input value1 " aria-required="true" aria-invalid="false" required="required" value="<?php if (isset($_GET['update'])) { echo $_GET['tour_earn'];} ?>" >
                </div>
                <div class="form-group">
                  <label for="cc-payment" class="control-label mb-1">কমিশন (%)
                  </label>


                  <input id="cc-payment" value="<?php if (isset($commission)) {
                   echo $commission;
                 }?>"   onkeypress="return isNumberKey(event)" name="commission"  type="text" placeholder="দয়া করে ইংরেজি লিখুন" class="form-control input value2 " aria-required="true" aria-invalid="false" required="" value=" <?php if (isset($_GET['update'])) { echo $_GET['amount'];} ?>" >
               </div>
               <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">মালিকের টাকা
                  <br>
                  <div id="math" style="font-size: 1.5em; color: #00C292; display: none">
                    <span id="earn"></span>-<span id="comm"></span>=<span id="res"></span>
                  </div>
                </label>


                <input  id="result" readonly="" onkeypress="return isNumberKey(event)" name="amount" type="text" placeholder="(অর্জিত টাকা-কমিশন)" class="form-control" aria-required="true" aria-invalid="false" required="" value="<?php if (isset($_GET['update'])) { echo $_GET['amount'];} ?>" >
              </div>
             
              <div class="form-group has-success">
                <label for="cc-name" class="control-label mb-1">ভ্রমণের শুরু এবং শেষ স্থান </label>
                <input id="cc-name" name="location" type="text" class="form-control" data-val="true" data-val-required="Please enter the name of location" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name" required=""  value="<?php if (isset($_GET['update'])) { echo $_GET['location'];} ?>">
                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true" ></span>
              </div>
              <div class="form-group">
                <label for="cc-number" class="control-label mb-1">তারিখ</label>
                <input id="cc-number" name="date" type="date" class="form-control" required=""  value="<?php if (isset($_GET['update'])) { echo $_GET['date'];} ?>" >
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
      <strong class="card-title">আয়ের তথ্য দেখুন</strong>
    </div>
    <div class="card-body">
      <!-- Credit Card -->
      <div id="pay-invoice">
        <div class="card-body">
          <div class="card-title">
            <h3 class="text-center">টাকা গ্রহণের তালিকা </h3>
          </div>
          <hr>
          <table id="example" class="table table-striped table-bordered">

            <thead>
              <tr>
                <th>তারিখ</th>
                <th>স্থান</th>
                <th>অর্জিত টাকা</th>
                <th>কমিশন (<?php echo $commission; ?>%)</th>
                <th>টাকা</th>
                <th>পরিবর্তন</th>
              </tr>
            </thead>
            <tbody>
             <?php
             include('db/db.php');
             $query="SELECT * FROM rental WHERE car='".$_SESSION['car']."'";
             $driver_commission=0;
             $total_earn=0;
             $total_commission=0;
             $net=0;
             $result=mysqli_query($con,$query);
//echo mysqli_error();
             if(mysqli_num_rows($result)>0){

              while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){

                $driver_commission=$row['tour_earn']*$row['commission']/100;
                $total_earn+=$row['tour_earn'];
                $total_commission+=$driver_commission;
                $net+=$row['amount'];
                ?>
                <tr>
                  <td><?php echo $row['date'];?></td>
                  <td><?php echo $row['location'];?></td>
                  <td><?php echo $row['tour_earn'];?></td>
                  <td><?php echo $driver_commission;?></td>
                  <td><?php echo $row['amount'];?></td>
                  <?php
                  echo "<td style='text-align: center'>
                  <a style='color:white; text-decoration: none;' href='receive_payment?update&id=".$row['r_id']."&date=".$row['date']."&location=".$row['location']."&amount=".$row['amount']."&tour_earn=".$row['tour_earn']."&commission=".$row['commission']."'><button class='btn btn-info'><i class='fas fa-edit'></i></button></a>

                  <a style='color:white; text-decoration: none;' onClick=\"return confirm('আপনি মুছে ফেলার জন্য নিশ্চিত?')\" href='db/db_earn.php?delete&id=".$row['r_id']."&date=".$row['date']."&location=".$row['location']."&amount=".$row['amount']."'><button class='btn btn-danger'>
                  <i class='far fa-trash-alt'></i></button></a>
                  </td>";

                  ?>

                </tr>
                <?php
              }
            }
            ?>
            <tfoot>
              <tr>
                <th></th>
                <th>মোট</th>
                <th><?php echo $total_earn; ?>/=</th>
                <th><?php echo $total_commission; ?>/=</th>
                <th><?php echo $net; ?>/=</th>
                <th></th>
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
//include('inc/script.php');

?>

<!--  <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>



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
 <script>
                $(document).ready(function(){
                  $(".input").keyup(function(){
                    var val1 = +$(".value1").val();
                    var val2 = +$(".value2").val();
                    var res=val1-(val1*val2/100);
                    $("#result").val(res);
                    $('#earn').show().text(val1);
                    $('#comm').show().text(val1*val2/100);
                    $('#res').show().text(res);
                    $('#math').css('display', 'inline-block');
                  });
                });
              </script>
</body>
</html>
<?PHP

}else{
  header('location:index?please_select');
}

?>