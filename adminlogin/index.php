

<?php
ob_start();
error_reporting(0);
    include "log_header.php";
    if (isset($_SESSION['email']) || isset($_SESSION['rank'])) {
        session_destroy();
        header("Location: index.php");
    }

//here i begin to process login requirement!
    $generalErr = ""; $generalSuc = ""; $master_emailErr = ""; $passwordErr = "";

//here u beging to check the login approval state
    if (isset($_GET['disapproved'])) {
        if ($_GET['disapproved'] == "yes") {
            $generalErr = "Sorry, This account has been Disabled or De-activated.<br> Contact KGC for detailed reasons if necessary. "; 
        }
    }

// resting pasword link successful
if (isset($_GET['reset_pass']) && isset($_GET['reser_mail_client'])) {
    if (htmlentities($_GET['reset_pass']) == "successfully") {
        $reser_mail_client = htmlentities($_GET['reser_mail_client']);
        $generalSuc = "Password reset link sent to <a href='index.php' style='color: red'>$reser_mail_client</a> successfully!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
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
                $form_good_state = 1;
                echo "<script> alert('Could not verify the Re-captcha'); </script>";
            }

             $email =  strtolower(trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['master_email'])))));
             $password =  trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['password']))));
             if ($form_good_state == 1) {
              if ($email != NULL && !empty($email) && filter_var($email, FILTER_SANITIZE_STRING) === $email) {
                 if ($password != NULL && !empty($password) && filter_var($password, FILTER_SANITIZE_STRING) === $password) {
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
                            $db_password = $rows['password'];
                            $db_member_id = $rows['member_id'];
                            if ($db_password === $password) {
                                if ($db_aproval_disaproval == 1) {
                                    //here i started sessions for each users data
                                    $_SESSION['db_id'] = $db_id;
                                    $_SESSION['s_name'] = $db_s_name;
                                    $_SESSION['o_names'] = $db_o_name;
                                    $_SESSION['email'] = $db_email;
                                    $_SESSION['rank'] = $db_rank; 
                                    header("Location: dash_home.php");                              
                                } else if ($db_aproval_disaproval == 0) {
                                    $generalErr = "Sorry, This account has been Disabled or De-activated.<br> Contact KGC for detailed reasons if necessary. "; 
                                }
                            } else {
                                $passwordErr = "Wrong combination!";
                                $master_emailErr = "Wrong combination!";
                                $generalErr = "Wrong Email and Password Combination !";  
                            }
                        }   
                    } else {
                        $master_emailErr = "Email does not exist !";
                        $generalErr = "Email does not Exist !";
                    }
                 } else {
                    $passwordErr = "Invalid Password !";
                    $generalErr = "An error occured, fix it below!";
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
                    <h1 class="card-title text-center">Login</h1>
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
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <input type="password" required="" placeholder="Password" name="password" class="form-control">
                    </div>
                <p class="text-center" ><i><span style="color: red;"><?php if ($passwordErr != ""){echo "$passwordErr";} ?></span></i></p><br>

                    <div class="input-group">
                            <div class="g-recaptcha" data-sitekey="6Lev77caAAAAAPYLo3KSmrCe75DHgqk-XszBWS0-"></div>
                             <br/>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block mb-3" value="Get Started">

                    <div class="pull-left">
                        <h6>
                            <a href="resetpasscode.php" class="link footer-link">Forgot password?</a>
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