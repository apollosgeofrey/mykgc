
<?php
ob_start();

    include "log_header.php";
    if (isset($_SESSION['email']) || isset($_SESSION['rank'])) {
        session_destroy();
        header("Location: index.php");
    }

//here i begin to process login requirement!
    $generalErr = ""; $generalSuc = ""; $master_emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reseter_pass'])) {
        if (isset($conn) && $conn == true) {
            //form good state checker  
            $form_good_state = 1;

            //recaptcha back end
             $captcha = "";
            if (isset($_POST['g-recaptcha-response'])) {
                $captcha = $_POST['g-recaptcha-response'];
            } else {
                $captcha = "";
            }

            $secret_key = "6Lev77caAAAAANaWZLTS44gtFYjVYJZbluJpAaz9";
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=". urldecode($secret_key) . "&response=" . urldecode($captcha) . " ";
            $responder = file_get_contents($url);
            $responderkey = json_decode($responder, TRUE);

            if ($responderkey["success"] != true) {
                $form_good_state = 0;
                echo "<script> alert('Could not verify the Re-captcha'); </script>";
            }

             $email =  strtolower(trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['master_email'])))));
             if ($form_good_state == 1) {
              if ($email != NULL && !empty($email) && filter_var($email, FILTER_SANITIZE_STRING) === $email) {
                    $query1 = $conn->prepare("SELECT * FROM `registered_members` WHERE email = ?");
                    $query1->bind_param('s', $email,);
                    $query1->execute();
                    $queryrun1 = $query1->get_result();
                    if ($queryrun1 == true && mysqli_num_rows($queryrun1) === 1) {
                        while ($rows = mysqli_fetch_assoc($queryrun1)) {
                            $db_id = $rows['db_id'];
                            $db_s_name = $rows['s_name'];
                            $db_o_name = $rows['o_name'];
                            $db_email = $rows['email'];
                            $db_rank = $rows['rank'];
                            $db_aproval_disaproval = $rows['aproval_disaproval'];
                            $db_member_id = $rows['member_id'];
                            if ($db_aproval_disaproval == 1) {
                            //here i started email sendind verification for each users reset
                                 $daters = strval(date("Y-m-d (l)"));
                                 $timers = strval(date("h:i:s a"));
                                 $joindate_time = $daters . "  " . $timers;
                                 $password = rand(10000000, 10000000000);
                                 $decider = rand(0,3);
                                 if ($decider == 0) {
                                    $gen_password = 'KGC'.$password.'RESET'; 
                                 } else if ($decider == 1) {
                                    $gen_password = 'RESETER'.$password.'KOKOZUM'; 
                                 } else if ($decider == 2){
                                    $gen_password = 'RESET'.$password.'KOKOZUM'; 
                                 } else if ($decider == 3){
                                     $gen_password = 'KOKOZUM'.$password.'CHANGE'; 
                                 }

                                 //mail sender
                                require "../PHPMailer/emailer.php";
                                $subject = "Congratulations! Your Passcode Reset With KOKOZUM GLOBAL CONCEPTS was Successful.";
                                $db_s_name_upper = strtoupper($db_s_name);
                                $db_o_name_upper = strtoupper($db_o_name);
                                $body = "<b>Good Day <font color='red'> $db_s_name_upper $db_o_name_upper</font>, Your request for a passcode reset was successful.<br><br> A new system/machine generated passcode for your KOKOZUM GLOBAL CONCEPTS Account is:</b><h3><u> $gen_password </u></h3><b> Use it to login your registered account with KGC. Thereafter, proceed for change of password. <br><br> Make sure your password is kept saved and secured. <br><br> We also advise you to delete this message from your email trash box for better protection and security. <br><br> From KOKOZUM GLOBAL CONCEPTS TECHNOLOGIES. <br><br> Best Regards !.</b>";

                                $replyer = '';
                                $status = mailFunction($db_email, $subject, $body, $replyer); 

                                if ($status == true) {
                                    //here data is sent to database !           
                                    $update_pass_now = "UPDATE registered_members SET password = '$gen_password' WHERE email = '$db_email'";
                                    $update_pass_now_run = mysqli_query($conn, $update_pass_now);
                                    if ($update_pass_now_run == true) { 
                                        //$generalSuc = "reseting success";  
                                        header("Location: index.php?reset_pass=successfully&reser_mail_client=$db_email");
                                    } else {
                                           $generalErr = "Sorry, We could not Query the Database !";
                                     }
                                } else {
                                    $generalErr = "Sorry! We Could not Send an Email to $db_email.";
                                }                           
                            } else if ($db_aproval_disaproval == 0) {
                                $generalErr = "Sorry, This account has been Disabled or De-activated.<br> Contact KGC for detailed reasons if necessary. ";
                            }
                        }   
                    } else {
                        $master_emailErr = "Email does not exist !";
                        $generalErr = "Email does not Exist !";
                    }
             } else {
                $master_emailErr = "Invalid Email Address !";
                $generalErr = "An error occured, fix it below!";
             }
         } else {
            $generalErr = "Verify the Re-captcha!";
         }
        } else {      
            $generalErr = "Error, We could not connect to the Server!";
        }
    }
}

?>
    
<div class="wrapper wrapper-full-page">
    <div class="full-page login-page">
        <div class="content">
            <div class="container">
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
         <!-- error and success shower !!!. -->
      <?php if ($generalSuc != "") { echo "<br><p class='alert alert-success text-center'> $generalSuc </p>"; $generalSuc = "";} ?>
      <?php if ($generalErr != "") { echo "<br><p class='alert alert-danger text-center'> $generalErr </p>"; $generalErr = "";} ?>

        <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" >

            <input type="hidden" name="_token" value="wB3h7nACQwhV91pvNmqPMQoAlhQObTukz2fjEXQg">
            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="scripts_awesomes/card-primary.png" alt="">
                    <h1 class="card-title text-center">Reset</h1>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <input type="email" name="master_email" required="" class="form-control" placeholder="Registered Email" value="<?php if (isset($_POST['master_email'])){echo $_POST['master_email'];} ?>" >
                    </div>
                <p class="text-center" ><i><span style="color: red;"><?php if ($master_emailErr != ""){echo "$master_emailErr";} ?></span></i></p><br>

                    <div class="input-group">
                        <div class="g-recaptcha" data-sitekey="6Lev77caAAAAAPYLo3KSmrCe75DHgqk-XszBWS0-"></div>
                        <br/>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" name="reseter_pass" class="btn btn-primary btn-lg btn-block mb-3" value="Reset Passcode">

                    <div class="pull-left">
                        <h6>
                            <a href="index.php" class="link footer-link">Back to Login Dashboard?</a>
                        </h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
            </div>
        </div>
    </div>
</div>

            
<?php
    include "night_mode.php";
    include "log_footer.php";
    ob_flush();
?>
</body></html>