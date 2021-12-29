<?php
    include "general_log_header.php";
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
                    <h4 class="card-title">Taxees</h4>
                </div>
                <div class="col-4 text-right">
                    <a href="pay_history.php" class="btn btn-sm btn-primary">Back to list</a>
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
                                                $query_hist = $conn->prepare("SELECT * FROM `kokozum_payment_records` WHERE db_id='$db_db_id' AND tx_ref='$tx_refer' AND payment_status='1'");
                                                $query_hist->execute();
                                                $query_hist_run = $query_hist->get_result();
                                                if ($query_hist_run == true && mysqli_num_rows($query_hist_run) === 1) {
                                                    while ($rows = mysqli_fetch_assoc($query_hist_run)) {
                                                        $db_db_id = $rows['db_id'];
                                                        $db_bus_person_f_name = $rows['bus_person_f_name'];
                                                        $db_phone = $rows['phone'];
                                                        $db_email_address = $rows['email_address'];
                                                        $db_bus_nature = $rows['bus_nature'];
                                                        $db_rc_no = $rows['rc_no'];
                                                        $db_tax_id = $rows['tax_id'];
                                                        $db_sector = $rows['sector'];
                                                        $db_bus_size = $rows['bus_size'];
                                                        $db_date_commence = $rows['date_commence'];
                                                        $db_no_employ = $rows['no_employ'];
                                                        $db_branches = $rows['branches'];
                                                        $db_address = $rows['address'];
                                                        $db_landlord_agent = $rows['landlord_agent'];
                                                        $db_landlord_agent_phone = $rows['landlord_agent_phone'];
                                                        $db_amount_expected = $rows['amount_expected'];
                                                        $db_tx_ref = $rows['tx_ref'];
                                                        $db_PayerId = $rows['PayerId'];
                                                        $db_ip = $rows['ip'];
                                                        $db_local_grabed_date_time = $rows['local_date_time_of_invoice'];
                                                        $db_CustomerPrimaryContactId = $rows['CustomerPrimaryContactId'];
                                                        $db_CustomerId = $rows['CustomerId'];
                                                        $db_MDAName = $rows['MDAName'];
                                                        $db_RevenueHeadName = $rows['RevenueHeadName'];
                                                        $db_ExternalRefNumber = $rows['ExternalRefNumber'];
                                                        $db_PaymentURL = $rows['PaymentURL'];
                                                        $db_Description = $rows['Description'];
                                                        $db_InvoiceNumber = $rows['InvoiceNumber'];
                                                        $db_InvoicePreviewUrl = $rows['InvoicePreviewUrl'];
                                                        $db_payment_status = $rows['payment_status'];
                                                        $db_PaymentDate = $rows['PaymentDate'];
                                                        $db_BankCode = $rows['BankCode'];
                                                        $db_BankName = $rows['BankName'];
                                                        $db_BankBranch = $rows['BankBranch'];
                                                        $db_amount_paid = $rows['AmountPaid'];
                                                        $db_TransactionDate = $rows['TransactionDate'];
                                                        $db_TransactionRef = $rows['TransactionRef'];
                                                        $db_Channel = $rows['Channel'];
                                                        $db_PaymentProvider = $rows['PaymentProvider'];
                                                        $db_Mac = $rows['Mac'];
                                                        $db_ResponseCode = $rows['ResponseCode'];
                                                        $db_ResponseMessage = $rows['ResponseMessage'];
                                                        $db_RequestReference = $rows['RequestReference'];
                                                        $db_IsReversal = $rows['IsReversal'];

                                                        if($db_payment_status == '1'){
                                                            $db_payment_status = 'Successful';
                                                        } else {
                                                            $db_payment_status = 'Not Successful';
                                                            die('This transaction was not Successful');
                                                        }
                                                        
                                                       echo"<tr>
                                                                <th scope='col'>Name:</th>
                                                                <td>$db_bus_person_f_name</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Phone:</th>
                                                                <td>$db_phone</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Email Address:</th>
                                                                <td>$db_email_address</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Nature:</th>
                                                                <td>$db_bus_nature</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>RC/BN:</th>
                                                                <td>$db_rc_no</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Tax ID:</th>
                                                                <td>$db_tax_id</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Sector:</th>
                                                                <td>$db_sector</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Size:</th>
                                                                <td>$db_bus_size</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Commencement Date:</th>
                                                                <td>$db_date_commence</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>No. Employee:</th>
                                                                <td>$db_no_employ</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>No. Branches:</th>
                                                                <td>$db_branches</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Address:</th>
                                                                <td>$db_address</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Land Lord Name:</th>
                                                                <td>$db_landlord_agent</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Land Lord Phone:</th>
                                                                <td>$db_landlord_agent_phone</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Transaction Ref:</th>
                                                                <td>$db_tx_ref</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Amount Expected:</th>
                                                                <td>N $db_amount_expected</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Payer Id:</th>
                                                                <td>$db_PayerId</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Date:</th>
                                                                <td>$db_local_grabed_date_time</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Customer Primary Contact Id:</th>
                                                                <td>$db_CustomerPrimaryContactId</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Customer Id:</th>
                                                                <td>$db_CustomerId</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>MDA Name:</th>
                                                                <td>$db_MDAName</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Revenue Head Name:</th>
                                                                <td>$db_RevenueHeadName</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>External Ref Number:</th>
                                                                <td>$db_ExternalRefNumber</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Payment URL:</th>
                                                                <td>$db_PaymentURL</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Invoice Preview Url:</th>
                                                                <td>$db_InvoicePreviewUrl</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Description:</th>
                                                                <td>$db_Description</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Invoice Number:</th>
                                                                <td>$db_InvoiceNumber</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Payment Status:</th>
                                                                <td>$db_payment_status</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>External Ref Number:</th>
                                                                <td>$db_ExternalRefNumber</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Payment Date:</th>
                                                                <td>$db_PaymentDate</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Bank Code:</th>
                                                                <td>$db_BankCode</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Bank Name:</th>
                                                                <td>$db_BankName</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Bank Branch:</th>
                                                                <td>$db_BankBranch</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Amount Paid:</th>
                                                                <td>N $db_amount_paid</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Transaction Date:</th>
                                                                <td>$db_TransactionDate</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Transaction Ref:</th>
                                                                <td>$db_TransactionRef</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Channel:</th>
                                                                <td>$db_Channel</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Payment Provider:</th>
                                                                <td>$db_PaymentProvider</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Mac:</th>
                                                                <td>$db_Mac</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Response Code:</th>
                                                                <td>$db_ResponseCode</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Response Message:</th>
                                                                <td>$db_ResponseMessage</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Request Reference:</th>
                                                                <td>$db_RequestReference</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope='col'>Is Reversal:</th>
                                                                <td>$db_IsReversal</td>
                                                            </tr>";
                                                    }

                                                } else {
                                                    echo "<h4 class='text-center'>Sorry, no record found in the Databases!</h4>";
                                                }
                                            } else {
                                                echo "<h4 class='text-center'>Error in network Connection!</h4>";
                                            }
                                        } else {
                                           header("Location: pay_history.php");    
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