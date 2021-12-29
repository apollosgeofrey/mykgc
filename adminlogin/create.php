<?php
    include "general_log_header.php";
    $generalSuc=""; $generalErr=""; $sur_nameErr=""; $other_namesErr=""; $new_emailErr=""; $new_phoneErr=""; $recaptchaErr="";
if (isset($_GET['adder_mem']) && isset($_GET['mat_client']) && isset($_GET['mail_client'])) {
        if ($_GET['adder_mem'] == 'successfully') {
            $mat_client_get = htmlentities($_GET['mat_client']);
            $mail_client_get = htmlentities($_GET['mail_client']);
            $generalSuc = "The KGC Member with <a href='' style='color:red;'> $mat_client_get</a> and <a href='#' style='color:red;'>$mail_client_get</a> was added and sent a verification email!";
        }
}

 // this is where form data are collected and validated.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['submit'])) {
     if (isset($conn) && $conn == true) {
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
            $recaptchaErr = "Please pass the recaptcha test to proceed!";
            echo "<script> alert('Could not verify the Re-captcha'); </script>";
         }

        $sur_name = trim(htmlentities(htmlspecialchars(mysqli_escape_string($conn, ucfirst(stripslashes($_POST['sur_name']))))));
        $other_names = trim(htmlentities(htmlspecialchars(mysqli_escape_string($conn, ucfirst(stripslashes($_POST['other_names']))))));
        $new_email =  strtolower(trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['new_email'])))));
        $new_phone =  strtolower(trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['new_phone'])))));

        // for sur_name validation
        if ($sur_name != null && !empty($sur_name) && filter_var($sur_name, FILTER_SANITIZE_STRING) === $sur_name) {
           if (preg_match("/^[a-zA-Z ]*$/",$sur_name)) {
               $sur_name = $sur_name;
            } else {
                $form_good_state = 0;
                $sur_nameErr = "Only letters and white space allowed ! ";
            }
        } else {
            $form_good_state = 0;
            $sur_nameErr = "Invalid Surname Entered ! ";
        }


        // for othername validation
        if ($other_names != null && !empty($other_names) && filter_var($other_names, FILTER_SANITIZE_STRING) === $other_names) {
            if (preg_match("/^[a-zA-Z ]*$/", $other_names)) {
                $other_names = $other_names;
            } else {
                $form_good_state = 0;
                $other_namesErr = "Only letters and white space allowed ! ";
            }
        } else {
            $form_good_state = 0;
            $other_namesErr = "Invalid Other Name Entered ! ";
        }


         // for email validation
        if ($new_email != null && !empty($new_email) && filter_var($new_email, FILTER_SANITIZE_EMAIL) === $new_email) {
            if (filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
              //checking email on DBase
                $queryCheckMail = "SELECT email FROM registered_members WHERE email = '$new_email'";
                $queryCheckMailRun = mysqli_query($conn, $queryCheckMail);
                if ($queryCheckMailRun == true and mysqli_num_rows($queryCheckMailRun) >= 1) {
                      $form_good_state = 0;
                      $new_emailErr = "Error, This email has been Registered.";
                }
            } else {
                $form_good_state = 0;
                $new_emailErr = "Invalid email format !";
            }
        } else {
          $new_emailErr = "Invalid Email Entered !";
          $form_good_state = 0;
        }


     // for phonenumber validation
        if ($new_phone != null && !empty($new_phone) && filter_var($new_phone, FILTER_SANITIZE_NUMBER_INT) === $new_phone) {
           $new_phone = $new_phone;
        } else {
            $form_good_state = 0;
            $new_phoneErr = "Invalid Mobile Phone Number Provided ! ";
        }

     
//here the final verification and insertion is executed
        if ($sur_name != null && !empty($sur_name) && $other_names != null && !empty($other_names) && $new_email != null && !empty($new_email) && $new_phone != null && !empty($new_phone) && $form_good_state == 1) {
                     $daters = strval(date("Y-m-d (l)"));
                     $timers = strval(date("h:i:s a"));
                     $joindate_time = $daters . "  " . $timers;
                     $password = rand(10000000, 10000000000);
                     $decider = rand(0,3);
                     if ($decider == 0) {
                        $gen_password = 'KOKOZUM'.$password.'CHANGE'; 
                     } else if ($decider == 1) {
                        $gen_password = 'CHANGE'.$password.'KGC'; 
                     } else if ($decider == 2){
                        $gen_password = 'KGC'.$password.'KOKOZUM'; 
                     } else if ($decider == 3){
                         $gen_password = 'CONCEPTS'.$password.'CHANGE'; 
                     }

                     //mail sender
                require "../PHPMailer/emailer.php";
                $subject = "Congratulations! Your Account with KOKOZUM GLOBAL CONCEPTS ENTERPRISE was Successfully created.";
                $sur_name_upper = strtoupper($sur_name);
                $other_names_upper = strtoupper($other_names);
                $body = "<b>Good Day <font color='red'>$sur_name_upper $other_names_upper</font>, Your Account with KOKOZUM GLOBAL CONCEPTS ENTERPRISE was successfully created.<br><br> A new system/machine generated passcode for your new KOKOZUM GLOBAL CONCEPTS ENTERPRISE Account is:</b><h3><u> $gen_password </u></h3><b> Use it to login your registered account with KOKOZUM GLOBAL CONCEPTS ENTERPRISE. Thereafter, proceed for change of password. <br><br> Make sure your password is kept saved and secured. <br><br> We also advise you to delete this message from your email trash box for better protection and security. <br><br> From KOKOZUM GLOBAL CONCEPTS ENTERPRISE. <br><br> Best Regards !.</b>";

                $replyer = "$new_email";
                $status = mailFunction($new_email, $subject, $body, $replyer); 

                if ($status == true) {
                    //here data is sent to database !  
                    $lisenced_by_email = $_SESSION['email'];
                    $update_pass_now = "INSERT INTO registered_members(s_name, o_name, email, phone_number, rank, aproval_disaproval, password, member_id, lisenced_by_email, joindate_time) VALUES ('$sur_name', '$other_names' , '$new_email', '$new_phone', '2', '1', '$gen_password', '', '$lisenced_by_email', '$joindate_time')";
                    
                    $update_pass_now_run = mysqli_query($conn, $update_pass_now);
                    if ($update_pass_now_run == true) { 
                        header("Location: create.php?adder_mem=successfully&mat_client=$sur_name&mail_client=$new_email");
                    } else {
                           $generalErr = "Sorry, We could not Query the Database !";
                     }
                } else {
                    $generalErr = "Sorry! We Could not Send an Email to $new_email.";
                }

        } else {
            $generalErr = "Invalid Form Fields Data Were Provided. See Errors and Fix them!";
        }

     } else {
            $generalErr ="Sorry, Connection to the Database Server was not successful !!!";
     }
  }
}




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
                            <h4 class="card-title">Add Users</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="user.php?khhjksds=sdsdsd&sdsds=dsdsdsd" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" >
                      <div class="card-body">
                        <font color="red">*</font><label>Surname:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <input type="text" name="sur_name" required="" class="form-control" placeholder="New Users Surname" value="<?php if (isset($_POST['sur_name'])){echo $_POST['sur_name'];} ?>" >
                        </div>
                        <b class="text-center" ><i><span style="color: red;"><?php if ($sur_nameErr != ""){echo "$sur_nameErr";} ?></span></i></b><br>

                        <font color="red">*</font><label>Other Names:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <input type="text" name="other_names" required="" class="form-control" placeholder="New Users Other Names" value="<?php if (isset($_POST['other_names'])){echo $_POST['other_names'];} ?>" >
                        </div>
                        <b class="text-center" ><i><span style="color: red;"><?php if ($other_namesErr != ""){echo "$other_namesErr";} ?></span></i></b><br>

                        <font color="red">*</font><label>Email Address:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div>
                            <input type="email" name="new_email" required="" class="form-control" placeholder="New Users Active Email" value="<?php if (isset($_POST['new_email'])){echo $_POST['new_email'];} ?>" >
                        </div>
                        <b class="text-center" ><i><span style="color: red;"><?php if ($new_emailErr != ""){echo "$new_emailErr";} ?></span></i></b><br>

                        <font color="red">*</font><label>Phone Number:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                            <input type="number" name="new_phone" required="" class="form-control" placeholder="Active Phone Number" value="<?php if (isset($_POST['new_phone'])){echo $_POST['new_phone'];} ?>" >
                        </div>
                        <b class="text-center" ><i><span style="color: red;"><?php if ($new_phoneErr != ""){echo "$new_phoneErr";} ?></span></i></b><br>

                        <div class="input-group">
                            <div class="g-recaptcha" data-sitekey="6Lev77caAAAAAPYLo3KSmrCe75DHgqk-XszBWS0-"></div>
                            <br/>
                        </div>
                        <b class="text-center" ><i><span style="color: red;"><?php if ($recaptchaErr != ""){echo "$recaptchaErr";} ?></span></i></b><br>

                        <div class="card-footer">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block mb-3" value="Add User?">
                        </div>
                      </div>
                  </form>
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