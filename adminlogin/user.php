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
    <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">List Users</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="create.php?khhjksds=sdsdsdsd&sdsdsds=dsdsdsd" class="btn btn-sm btn-primary">Add user</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  

                <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">More Info</th>                                  
                        </tr>
                    </thead>
                       <tbody>
                            <?php
                                if (isset($conn)) {
                                    $query_hist = $conn->prepare("SELECT * FROM `registered_members`");
                                    $query_hist->execute();
                                    $query_hist_run = $query_hist->get_result();
                                    if ($query_hist_run == true && mysqli_num_rows($query_hist_run) >= 1) {
                                      while ($rows = mysqli_fetch_assoc($query_hist_run)) {
                                        $db_db_id = $rows['db_id'];                                        
                                        $db_email = $rows['email'];
                                        if ($db_email == $_SESSION['email']) {
                                            continue;
                                        }
                                        echo "
                                        <tr>
                                            <td> <a href='userdetails.php?db_db_id=$db_db_id&tx_refer=$db_email'>$db_email</a> </td>
                                            <td>
                                                <a href='userdetails.php?db_db_id=$db_db_id&tx_refer=$db_email' class='btn btn-sm btn-info'>More Info</a>
                                            </td>
                                        </tr>";
                                      }
                                    } else {
                                         echo "<h4 class='text-center'>Sorry, no record found in the Databases!</h4>";
                                    }
                                } else {
                                    echo "<h4 class='text-center'>Error in network Connection!</h4>";
                                }
                            ?>
                      </tbody>
                </table>
                </div>
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