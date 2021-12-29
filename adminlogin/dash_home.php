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

<?php echo "<h3 class='text-center'> Welcome <a href='profile.php'>" . $_SESSION['s_name'] . " " .  $_SESSION['o_names'] . "</a> " . "to your Kokozum Dashboard! </h3>"; 
    echo "<h4 class='text-center'>Your user Login Email Address is <a href='profile.php'>" . $_SESSION['email'] . "</a>!</h4>";
    if (isset($_SESSION['rank'])) {
        if ($_SESSION['rank'] == "3") {
            echo "<h4 class='text-center'>You are an Loged into your <a href='user.php'>Administrative</a> Account with Kokozum!</h4>";
        } else {
            echo "<h4 class='text-center'>You are an Loged into your Users Account with Kokozum!</h4>";
        }
    }


?>
<table border="1" class="text-center">
    <tr>
        <td>
            <a href="dash_home.php"><img src="../frontend/logo/kgclogo.png" width="35%" height="50%" title="Profile Profile"></a>
        </td>
        <td>
            <a href="../index.php">Generate Payment Invoice?</a>
        </td>
        <td>
            <a href="dash_home.php"><img src="../frontend/logo/kgc_nasarawa.png" width="65%" height="auto" title="Profile Profile"></a>
        </td>
    </tr>
</table>
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