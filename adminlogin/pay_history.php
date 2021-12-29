<?php
    include "general_log_header.php";
    $generalSuc = ""; $generalErr = "";
?>
<div class="content">
    <div class="row">
        <div class="col-12">    
            <div class="card card-chart">
            <!-- error and success shower !!!. -->
      <?php if ($generalSuc != "") { echo "<br><p class='alert alert-success text-center'> $generalSuc </p>"; $generalSuc = "";} ?>
      <?php if ($generalErr != "") { echo "<br><p class='alert alert-danger text-center'> $generalErr </p>"; $generalErr = "";} ?>
<!-- begining of contents -->
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">Latest payments</h4>
                </div>
                <div class="col-4 text-right">
                            <!-- <a href="#pay/create" class="btn btn-sm btn-primary">Add payment</a> -->
                </div>
           </div>
        </div>
        <div class="card-body">   
                <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                        <tr><th scope="col">Reference</th>
                            <th scope="col">Amount paid</th>
                            <th scope="col">Payment Date</th>                                  
                        </tr>
                    </thead>
                       <tbody>
                            <?php
     //pagination button  setter
      $id_next = "";
      $id_val = 0;
      $id_val_newer_button = "";
      $see_older_disable = "";
      
      if (isset($_GET['id_next'])) {
        $id_next = trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_GET['id_next']))));
        $id_next = "and db_id < $id_next";
      }

       if (!isset($_GET['id_newer'])) {
        $id_val_newer_button = "";
      } else if(trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_GET['id_newer'])))) == trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_GET['id_next']))))) {
        $id_val_newer_button = "<li class='pull-left btn btn-sm'><a href='#backwark' onclick='history.back(true)'>See newer</a></li>";
      }
      //end

                                if (isset($conn)) {
                                    $query_hist = $conn->prepare("SELECT * FROM `kokozum_payment_records` WHERE payment_status='1' $id_next ORDER BY db_id DESC LIMIT 15");
                                    $query_hist->execute();
                                    $query_hist_run = $query_hist->get_result();
                                    if ($query_hist_run == true && mysqli_num_rows($query_hist_run) >= 1) {
                                      while ($rows = mysqli_fetch_assoc($query_hist_run)) {
                                        $db_db_id = $rows['db_id'];                                        
                                        $db_amount_paid = $rows['amount_expected'];
                                        $db_local_grabed_date_time = $rows['local_date_time_of_invoice'];
                                        $db_tx_ref = $rows['tx_ref'];
                                        $db_payment_status = $rows['payment_status'];

                                        if($db_payment_status == '1'){
                                            $db_payment_status = '(Paid)';
                                        } else {
                                            $db_payment_status = '(Not Paid)';
                                        }

                                        echo "
                                        <tr>
                                            <td><a href='taxpayer.php?db_db_id=$db_db_id&tx_refer=$db_tx_ref'>$db_tx_ref</a></td>
                                            <td>N $db_amount_paid $db_payment_status</td>
                                            <td><a href='taxpayer.php?db_db_id=$db_db_id&tx_refer=$db_tx_ref'>$db_local_grabed_date_time</a></td>
                                        </tr>";

                                        //setting button current state 
                                        if ($id_val < $db_db_id) {
                                            $id_val = $db_db_id + 1;
                                            $see_older_disable = "";
                                          } else {
                                            $id_val = $db_db_id + 1;
                                           $see_older_disable = "<li class='pull-right btn btn-sm'><a href='pay_history.php?id_next=$id_val&id_newer=$id_val'>See older</a></li>";
                                          }
                                      }
                                    } else {
                                         echo "<h4 class='text-center'>Sorry, no record found in the Databases!</h4>";
                                    }
                                    
                                    //this prints the button to screen
                                    echo"<ul class='pager'> $id_val_newer_button  $see_older_disable</ul>";                                
                                } else {
                                    echo "<h4 class='text-center'>Error in network Connection!</h4>";
                                }
                            ?>
                      </tbody>
                </table>
        </div>
        <?php 
        //this prints the see more button to screen
            echo"<ul class='pager'> $id_val_newer_button  $see_older_disable</ul>";         
        ?>

        <div class="card-footer py-4">
           <nav class="d-flex justify-content-end" aria-label="...">
                        
            </nav>
        </div>
    </div>
</div>

<!-- End of Contents -->
            </div>
        </div>
    </div>
</div>

   <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>  

        <script src="general_scripts_awesome/jquery.min.js.download"></script>
        <script src="general_scripts_awesome/popper.min.js.download"></script>
        <script src="general_scripts_awesome/bootstrap.min.js.download"></script>
        <script src="general_scripts_awesome/perfect-scrollbar.jquery.min.js.download"></script>
        <!--  Google Maps Plugin    -->
        <!-- Place this tag in your head or just before your close body tag. -->
        
        <!-- Chart JS -->
        
        <!--  Notifications Plugin    -->
        <script src="general_scripts_awesome/bootstrap-notify.js.download"></script>

        <script src="general_scripts_awesome/black-dashboard.min.js.download"></script>
        <script src="general_scripts_awesome/theme.js.download"></script>

            <script src="general_scripts_awesome/chartjs.min.js.download"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>

        
    <script src="general_scripts_awesome/chartjs.min.js.download"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>

    <?php
        include "night_mode.php";
         ob_flush();
    ?>