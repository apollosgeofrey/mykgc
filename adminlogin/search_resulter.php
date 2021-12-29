<?php
    include "general_log_header.php";
    $generalSuc=""; $generalErr=""; $generalConts="";

 // this is where form data are collected and validated.
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['search_submit'])) {
     if (isset($conn) && $conn == true) {
        $search_val = trim(htmlentities(htmlspecialchars(mysqli_escape_string($conn, stripslashes($_GET['search_val'])))));
        if ($search_val != null && !empty($search_val)) {
            $query_search = $conn->prepare("SELECT * FROM `kokozum_payment_records` WHERE tx_ref = ?");
            $query_search->bind_param('s', $search_val,);
            $query_search->execute();
            $queryrun_search = $query_search->get_result();
            if ($queryrun_search == true && mysqli_num_rows($queryrun_search) >= 1) {
                $generalConts .= " <table class='table tablesorter' id=''>
                    <thead class='text-primary'>
                        <tr><th scope='col'>Reference</th>
                            <th scope='col'>Amount Expected</th>
                            <th scope='col'>Invoice Date</th>                                  
                        </tr>
                    </thead>
                       <tbody>";
                while ($rows = mysqli_fetch_assoc($queryrun_search)) {
                    $search_db_id = $rows['db_id'];
                    $search_email_address = $rows['email_address'];
                    $search_amount_paid = $rows['amount_expected'];
                    $search_payment_status = $rows['payment_status'];
                    $search_tx_ref = $rows['tx_ref'];
                    $search_local_grabed_date_time = $rows['local_date_time_of_invoice'];
                    if($search_payment_status == '0'){
                        $search_payment_status = '(Not Paid)';
                    } else {
                        $search_payment_status = '(Paid)';
                    }

                    $generalConts .= "
                        <tr>
                            <td><a href='taxpayer.php?db_db_id=$search_db_id&tx_refer=$search_tx_ref'>$search_tx_ref</a></td>
                            <td>N $search_amount_paid $search_payment_status</td>
                            <td><a href='taxpayer.php?db_db_id=$search_db_id&tx_refer=$search_tx_ref'>$search_local_grabed_date_time</a></td>
                        </tr>
                    ";
                }
                $generalConts .= " </tbody>
                                        </table>";
            } else {
                  $generalErr = "No match found for <a href='#' style='color: blue;'>$search_val</a>!";
            }
        } else {
            $generalErr = "Invalid search value provided!";
        }
     } else {
            $generalErr ="Sorry, Connection to the Database Server was not successful, Try again!";
     }
  } else {
    header("location: dash_home.php");
  }
} else {
    header("location: dash_home.php");
}




?>
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
    
    <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Search Results</h4>
                        </div>
                    </div>
                </div>
<!-- error and success shower !!!. -->
      <?php if ($generalSuc != "") { echo "<br><p class='alert alert-success text-center'> $generalSuc </p>"; $generalSuc = "";} ?>
      <?php if ($generalErr != "") { echo "<br><p class='alert alert-danger text-center'> $generalErr </p>"; $generalErr = "";} ?>
<!-- begining of contents -->
                <div class="card-body">
                    <div class="card-body">
                        <?php if ($generalConts != "") { echo "<br> $generalConts "; $generalConts = "";} ?>   
                    </div>
                </div>
            </div>
        </div>


<!-- End of Contents -->
            </div>
        </div>
    </div>
</div>

   <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>

 <form id="logout-form" action="#logout" method="POST" style="display: none;">
    <input type="hidden" name="_token" value="cS1DwmlqdF93F4WjL4aFZbAxNJ0wlanMr6RhGm2v">
</form>
               

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