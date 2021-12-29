<?php
    include "general_log_header.php";
//deleter man
if (isset($_GET['delete_email']) && isset($_GET['db_db_id'])) {
    $id_deleter = trim($_GET['db_db_id']);
    $email_deleter = trim(($_GET['delete_email']));
    $query_delete = "DELETE FROM registered_members WHERE db_id='$id_deleter' AND email='$email_deleter'";
    $query_delete_run = mysqli_query($conn, $query_delete);
    if($query_delete_run == true && mysqli_affected_rows($conn) == 1){
        echo "<script>alert('User $email_deleter was Deleted Successfully!'); window.location = 'user.php';</script>";
    } else {
        echo "<script>alert('Sorry, We could not delete the user'); window.location = 'user.php';</script>";
    }
}

//disabler man
if (isset($_GET['disable_email']) && isset($_GET['db_db_id'])) {
    $id_disable = trim($_GET['db_db_id']);
    $email_disable = trim(($_GET['disable_email']));
    $query_disable = "UPDATE registered_members SET aproval_disaproval='0' WHERE db_id='$id_disable' AND email='$email_disable'";
    $query_disable_run = mysqli_query($conn, $query_disable);
    if($query_disable_run == true && mysqli_affected_rows($conn) == 1){
        echo "<script>alert('User $email_disable was Disabled Successfully!'); window.location = 'user.php';</script>";
    } else {
        echo "<script>alert('Sorry, We could not disable the user'); window.location = 'user.php';</script>";
    }
}

//enabler man
if (isset($_GET['enabler_email']) && isset($_GET['db_db_id'])) {
    $id_enabler = trim($_GET['db_db_id']);
    $email_enabler = trim(($_GET['enabler_email']));
    $query_enabler = "UPDATE registered_members SET aproval_disaproval='1' WHERE db_id='$id_enabler' AND email='$email_enabler'";
    $query_enabler_run = mysqli_query($conn, $query_enabler);
    if($query_enabler_run == true && mysqli_affected_rows($conn) == 1){
        echo "<script>alert('User $email_disable was Enabled Successfully!'); window.location = 'user.php';</script>";
    } else {
        echo "<script>alert('Sorry, We could not Enable the user'); window.location = 'user.php';</script>";
    }
}

?>
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
            <!-- error and success shower !!!. -->
<!-- begining of contents -->
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">User Info</h4>
                </div>
                <div class="col-4 text-right">
                    <a href="user.php" class="btn btn-sm btn-primary">Back to list</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="">
               <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                            <?php
                                    if (isset($_GET['db_db_id']) && isset($_GET['tx_refer'])) {
                                        $db_db_id = htmlspecialchars(htmlentities($_GET['db_db_id']));
                                        $tx_refer = htmlspecialchars(htmlentities($_GET['tx_refer']));
                                        if (!empty($db_db_id) && !empty($tx_refer)) {
                                            if (isset($conn)) {
                                                $query_hist = $conn->prepare("SELECT * FROM `registered_members` WHERE db_id=? AND email=?");
                                                $query_hist->bind_param('ss', $db_db_id, $tx_refer);
                                                $query_hist->execute();
                                                $query_hist_run = $query_hist->get_result();
                                                if ($query_hist_run == true && mysqli_num_rows($query_hist_run) === 1) {
                                                    while ($rows = mysqli_fetch_assoc($query_hist_run)) {
                                                        $db_db_id = $rows['db_id'];
                                                        $db_s_name = $rows['s_name'];
                                                        $db_o_name = $rows['o_name'];
                                                        $db_email = $rows['email'];
                                                        $db_phone_number = $rows['phone_number'];
                                                        $db_rank = $rows['rank'];
                                                        $db_aproval_disaproval = $rows['aproval_disaproval'];
                                                        $db_gender = $rows['gender'];
                                                        $db_member_id = $rows['member_id'];
                                                        $db_last_login_device = $rows['last_login_device'];
                                                        $db_last_login_ip = $rows['last_login_ip'];
                                                        $db_last_login_date_time = $rows['last_login_date_time'];
                                                        $db_home_addres = $rows['home_addres'];
                                                        $db_lisenced_by_email = $rows['lisenced_by_email'];
                                                        $db_joindate_time = $rows['joindate_time'];

                                                        $button_approval = "";
                                                        if($db_aproval_disaproval == '1'){
                                                            $db_aproval_disaproval = 'Enabled';
                                                            $button_approval = "<a href='userdetails.php?db_db_id=$db_db_id&disable_email=$db_email' class='btn btn-md btn-primary'>Disable</a>";
                                                        } else {
                                                            $db_aproval_disaproval = 'Not Enabled';
                                                            $button_approval = "<a href='userdetails.php?db_db_id=$db_db_id&enabler_email=$db_email' class='btn btn-md btn-primary'>Enable</a>";
                                                        }
                                                        
                                                       echo"<tr>
                                                                <th scope='col'>Surname:</th>
                                                                <td>$db_s_name</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Othernames:</th>
                                                                <td>$db_o_name</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Email Address:</th>
                                                                <td>$db_email</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Phone Number:</th>
                                                                <td>$db_phone_number</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Aproval/Disability Status:</th>
                                                                <td>$db_aproval_disaproval</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Gender:</th>
                                                                <td>$db_gender</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Member ID:</th>
                                                                <td>$db_member_id</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Last Login Device:</th>
                                                                <td>$db_last_login_device</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Last Login IP:</th>
                                                                <td>$db_last_login_ip</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Last Login Date/Time:</th>
                                                                <td>$db_last_login_date_time</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Home Address:</th>
                                                                <td>$db_home_addres</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Registered/Lisenced By:</th>
                                                                <td>$db_lisenced_by_email</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Date Registered:</th>
                                                                <td>$db_joindate_time</td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href='userdetails.php?db_db_id=$db_db_id&delete_email=$db_email' class='btn btn-md btn-danger'>Delete</a></td>
                                                                <td>$button_approval</td>
                                                            </tr>";
                                                    }

                                                } else {
                                                    echo "<h4 class='text-center'>Sorry, no record found in the Databases!</h4>";
                                                }
                                            } else {
                                                echo "<h4 class='text-center'>Error in network Connection!</h4>";
                                            }
                                        } else {
                                           header("Location: user.php");    
                                        }
                                    } else {
                                     // header("Location: pay_history.php");
                                    }
                            ?>
                    </thead>
                </table>
            </div>
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