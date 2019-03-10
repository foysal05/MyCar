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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


    <title>
      MyCar

  </title>
  <body>
    <?php

    include ('inc/left_bar.php');
    include ('db/db.php');

    ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
       <?php include('inc/header.php');?>
       <!-- Content -->
       <div class="content">


        <?php //echo "<h3 style='color:#435466'>".$_SESSION['car_name']."</h3><br>"; ?>
        <div class="row">

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
                                    <h3 class="text-center">মাসিক আয় বিবরণী </h3>

                                 <!--    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">তারিখ :
                                        </label>
                                        <input id="cc-payment"  name="amount" type="text" placeholder="ক্লিক করুন" readonly="" class="form-control" aria-required="true" aria-invalid="false" required="" >
                                    </div> -->
                                    <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                        <label>তারিখ নির্বাচন করুন</label>
                                        <form action="" method="post">
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="form-control" readonly="" required="" id="start" name="start" value="<?php echo date('Y-m-d');?>" />
                                                <span class="input-group-addon">থেকে</span>
                                                <input type="text" class="form-control" readonly="" required="" id="end" name="end" value="<?php echo date('Y-m-d');?>" />
                                            </div>
                                            <br>
                                            <div class="input-daterange input-group" id="datepicker">

                                                <select name="car" id="car" required="" onChange="myNewFunction(this);" class="form-control">
                                                    <option value="">আপনার গাড়ী নির্বাচন করুন</option>
                                                    <?php
                                                   // include('db/db.php');
                                                    $query="SELECT * FROM cars WHERE owner_id='".$_SESSION['u_id']."'";

                                                    $result=mysqli_query($con,$query);
//echo mysqli_error();
                                                    if(mysqli_num_rows($result)>0){

                                                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                            echo "<option value='".$row['c_id']."'>".$row['number']."</option>";


                                                        }
                                                    }


                                                    ?>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="input-daterange input-group" id="datepicker">

                                                <input type="submit" class="btn btn-success btn-block" value="আয়ের রিপোর্ট দেখুন" name="get_report">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <?php
                                if (isset($_POST['get_report'])) {

                                    $_SESSION['earn_start']=$_POST['start'];
                                    $_SESSION['earn_end']=$_POST['end'];
                                    $car=$_POST['car'];



                                    $query="SELECT salary FROM driver,cars WHERE cars.driver=driver.d_id AND c_id='$car'";
                                    $driver_salary=0;
                                    $result=mysqli_query($con,$query);
                                    $car_number="";

                                    if(mysqli_num_rows($result)>0){

                                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC
                                        )){

                                            $driver_salary=$row['salary'];
//echo $driver_salary;
                                        }
                                    }
                                    ?>

                                    <title>
                                     <?php
                                     if (isset($_SESSION['earn_start'])) {
                                        echo $_SESSION['earn_start'];
                                        echo $_SESSION['earn_end'];
   // echo $_SESSION['earn_start']." থেকে ".$_POST['end']  ;
                                    }else{
                                        echo "string";
                                    }

                                    ?>
                                </title>
                                <h2>মোট আয় :</h2>
                                <table id="earn" class="table table-striped table-bordered">

                                    <thead>
                                        <tr>
                                            <th>তারিখ</th>
                                            <th>যাতায়েত স্থান</th>
                                            <th>টাকা</th>
                                            <!-- <th>পরিবর্তন</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                     include('db/db.php');
                                       //  echo $_POST['start'];
                                     $query="SELECT * FROM rental WHERE date BETWEEN '".$_POST['start']."' AND '".$_POST['end']."' AND car='$car'";
                                      // echo $query;
                                     $result=mysqli_query($con,$query);
                                     $earn=0;
                                     if(mysqli_num_rows($result)>0){

                                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC
                                        )){
                                            $earn+=$row['amount'];


                                            ?>
                                            <tr>
                                                <td><?php echo $row['date'];?></td>
                                                <td><?php echo $row['location'];?></td>
                                                <td><?php echo $row['amount'];?></td>
                                                <!-- <td><?php echo $row['r_id'];?></td> -->

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    

                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>মোট আয় :</th>
                                            <th><?php echo $earn;?></th>
                                        </tr>
                                    </tfoot>     
                                </tbody>
                            </table>

                            <h2>মোট খরচ :</h2>
                            <table id="cost" class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th>তারিখ</th>
                                        <th>খরচের বর্ণনা</th>
                                        <th>টাকা</th>
                                        <!-- <th>পরিবর্তন</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                 include('db/db.php');
                                       //  echo $_POST['start'];
                                 $query_cost="SELECT * FROM cost WHERE date BETWEEN '".$_POST['start']."' AND '".$_POST['end']."' AND car='$car'";
                                  // echo $query_cost;
                                 $result=mysqli_query($con,$query_cost);
                                 $cost=0;
                                 if(mysqli_num_rows($result)>0){

                                    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC
                                    )){
                                        $cost+=$row['amount'];


                                        ?>
                                        <tr>
                                            <td><?php echo $row['date'];?></td>
                                            <td><?php echo $row['details'];?></td>
                                            <td><?php echo $row['amount'];?></td>
                                            <!-- <td><?php echo $row['r_id'];?></td> -->

                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>মোট খরচ :</th>
                                        <th><?php echo $cost;?></th>
                                    </tr>
                                </tfoot>     
                            </tbody>
                        </table>  

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <table class="table">
                                    <tr>
                                        <th>রঙ</th>
                                        <th> সঙ্গা</th>
                                    </tr>
                                    <tr>
                                        <td><div style="height: 20px; width: 20px; background-color: #00804F"></div></td>
                                        <td>আপনি লাভ করছেন </td>
                                    </tr>
                                    <tr>
                                        <td><div style="height: 20px; width: 20px; background-color: #FF9800"></div></td>
                                        <td>আপনি ড্রাইবারের বেতেরন সমপরিমাণ টাকাও উপার্জন করতে পারেন নাই</td>
                                    </tr>
                                    <tr>
                                        <td><div style="height: 20px; width: 20px; background-color: #FF1700"></div></td>
                                        <td>আপনি লস করছেন</td>
                                    </tr>
                                    
                                </table>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>          
                <div class="row">
                    <div style="margin-left: 35%;" class="center-block col-md-4" style="float: none; background-color: grey">

                        <h2>
                          <?php
                          $net_income=$earn-$cost;
                          if ($net_income>$driver_salary) {
                             echo "<h2 style='color:green'>নিট আয় : ".$net_income."/="."</h2>";
                         }else if ($net_income<0){
                           echo "<h2 style='color:red'>নিট আয় : ".$net_income." ৳/="."</h2>";
                       }else{
                           echo "<h2 style='color:#FF9800'>নিট আয় : ".$net_income." ৳/="."</h2>";
                       }

                       ?>  
                   </h2> 
                   <h4>ড্রাইভার এর বেতন : <?php echo$driver_salary; ?> /= টাকা</h4>  </div>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    রঙ এর সংজ্ঞা
                  </button>
              </div>
              <?php
          }
          ?>
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


<!-- <script type="text/javascript">
 $(document).ready(function() {
    $('#earn1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#cost').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
        var printCounter = 0;

    // Append a caption to the table before the DataTables initialisation
    // $('#earn').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');

    $('#earn').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        'copy',
        {
            extend: 'excel',
            messageTop: 'আয়ের তথ্য |  <?php
            if (isset($_SESSION['earn_start'])) {
    // echo $_SESSION['earn_start'];
    // echo $_SESSION['earn_end'];
                echo " (".$_SESSION['earn_start']." থেকে ".$_SESSION['earn_end'].")";
            }else{
                echo "";
            }

            ?> '
        },
        {
            extend: 'pdf',
            messageBottom: null
        },
        {
            extend: 'print',
            footer: true,
            messageTop: function () {
                printCounter++;

                if ( printCounter === 1 ) {
                    return 'আয়ের তথ্য  |  <?php
                    if (isset($_SESSION['earn_start'])) {
                       echo " (".$_SESSION['earn_start']." থেকে ".$_SESSION['earn_end'].")";
                   }else{
                    echo "";
                }

                ?>';
            }
            else {
                return 'You have printed this document '+printCounter+' times';
            }
        },
        messageBottom: null
    }
    ]
} );
} );
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var printCounter = 0;
        // var car=$("#car option:selected").text();;
        // alert(car);

    // Append a caption to the table before the DataTables initialisation
    // $('#earn').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');

    $('#cost').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        'copy',
        {
            extend: 'excel',
            messageTop: 'খরচের তথ্য |  <?php
            if (isset($_SESSION['earn_start'])) {
    // echo $_SESSION['earn_start'];
    // echo $_SESSION['earn_end'];
                echo " (".$_SESSION['earn_start']." থেকে ".$_SESSION['earn_end'].")";
            }else{
                echo "";
            }

            ?> '
        },
        {
            extend: 'pdf',
            messageBottom: null
        },
        {
            extend: 'print',
            footer: true,
            messageTop: function () {
                printCounter++;

                if ( printCounter === 1 ) {
                    return 'খরচের তথ্য |  <?php
                    if (isset($_SESSION['earn_start'])) {
    // echo $_SESSION['earn_start'];
    // echo $_SESSION['earn_end'];
                        echo " (".$_SESSION['earn_start']." থেকে ".$_SESSION['earn_end'].")";
                    }else{
                        echo "";
                    }

                    ?>';
                }
                else {
                    return 'You have printed this document '+printCounter+' times';
                }
            },
            messageBottom: null
        }
        ]
    } );
} );
</script>
<!-- Start Jquery Date Picker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    var dateFormat = "yy-mm-dd",
    from = $( "#start" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd'
  })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );
  }),
    to = $( "#end" ).datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'yy-mm-dd'
    })
    .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
    });

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
        date = null;
    }

    return date;
}
} );
</script>


<!--End Jquery Date Picker -->

</body>
</html>
<?PHP

}else{
    header('location:index');
}

?>