<?php
    include "general_log_header.php";
    $generalSuc = ""; $generalErr = ""; $s_nameErr=""; $o_nameErr=""; $emailEerr=""; $phone_numberErr=""; $genderErr=""; $member_idErr=""; $old_passwordErr=""; $passwordErr=""; $password_confirmationErr="";
//success state checker
if (isset($_GET['data_updater']) && isset($_GET['kjsdklslksd']) && isset($_GET['fsdfsdfsfsd'])) {
    if ($_GET['data_updater'] == "sucess" && $_GET['kjsdklslksd'] == "sfsdfsdffsd" && $_GET['fsdfsdfsfsd'] == "sdfsdfsdfssd") {
        $generalSuc = "Congratulations! Your Bio-Info was Updated Successfully..."; 
    }
} else if (isset($_GET['update_password']) && isset($_GET['ghfghfghfghfgh']) && isset($_GET['fhfghfdgd'])) {
    if ($_GET['update_password'] == "success" && $_GET['ghfghfghfghfgh'] == "fghfghfghf" && $_GET['fhfghfdgd'] == "asdfasdasdasd") {
        $generalSuc = "Congratulations! Your Password was Updated Successfully..."; 
    }
} 

    //this is where i collect the data form and validate to update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($conn) && $conn == true) {
            if (isset($_POST['update_data'])) {
                //form good state checker  
                $form_good_state = 1;
                $s_name =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['s_name']))))));
                $o_name =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['o_name']))))));
                $email =  strtolower(trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['email'])))));
                $phone_number = trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, stripslashes($_POST['phone_number'])))));
                $gender =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['gender']))))));

// for s_name validation
           if ($s_name != null && !empty($s_name) && filter_var($s_name, FILTER_SANITIZE_STRING) === $s_name) {
              if (preg_match("/^[a-zA-Z ]*$/",$s_name)) {
                  $s_name = $s_name;
               } else {
                  $form_good_state = 0;
                  $s_nameErr = "Only letters and white space allowed ! ";
                  $generalErr ="Sorry, There was an error below, Scroll to fix it!";
               }
            } else {
             $form_good_state = 0;
             $s_nameErr = "Invalid Fullname Entered ! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
           }

// for o_name validation
           if ($o_name != null && !empty($o_name) && filter_var($o_name, FILTER_SANITIZE_STRING) === $o_name) {
              if (preg_match("/^[a-zA-Z ]*$/",$o_name)) {
                  $o_name = $o_name;
               } else {
                  $form_good_state = 0;
                  $o_nameErr = "Only letters and white space allowed ! ";
                  $generalErr ="Sorry, There was an error below, Scroll to fix it!";
               }
            } else {
             $form_good_state = 0;
             $o_nameErr = "Invalid Fullname Entered ! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
           }


 // for email validation
        //    if ($email != null && !empty($email) && filter_var($email, FILTER_SANITIZE_EMAIL) === $email) {
        //       if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                     $email = $db_email;
        //        } else {
        //           $form_good_state = 0;
        //           $emailErr = "Invalid email format ! ";
        //           $generalErr ="Sorry, There was an error below, Scroll to fix it!";
        //        }
        //     } else {
        //       $form_good_state = 0;
        //       $emailErr = "Invalid email format ! ";
        //       $generalErr ="Sorry, There was an error below, Scroll to fix it!";
        //     }

// for phonenumber validation
           if ($phone_number != null && !empty($phone_number) && filter_var($phone_number, FILTER_SANITIZE_NUMBER_INT) === $phone_number) {
              $phone_number = $phone_number;
            } else {
              $form_good_state = 0;
              $phone_numberErr = "Invalid Mobile Phone Number Provided ! ";
              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            }

// for gender validation
        if ($gender != null && !empty($gender) && filter_var($gender, FILTER_SANITIZE_STRING) === $gender) {
            if ($gender == "Male" || $gender == "Female") {

            } else {
                $form_good_state = 0;
                $genderErr = "Invalid Gender Specification Provided ! ";
                $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            }
        } else {
            $form_good_state = 0;
            $genderErr = "Invalid Gender Selected!";
            $generalErr ="Sorry, There was an error below, Scroll to fix it!";
        }

//final checker to procedd
            if ($s_name != null && !empty($s_name) && $email != null && !empty($email) && $phone_number != null && !empty($phone_number) && $form_good_state == 1) {
                $query_dash_data = $conn->prepare("UPDATE registered_members SET s_name='$s_name', o_name='$o_name', email='$email', phone_number='$phone_number', gender='$gender' WHERE email = ? AND db_id = ?");
                $query_dash_data->bind_param('ss', $db_email, $db_id);
                if($query_dash_data->execute()){
                    //here i started sessions for each users data
                    $_SESSION['s_name'] = $s_name;
                    $_SESSION['o_names'] = $o_name;
                    $_SESSION['email'] = $email; 
                    header("Location: profile.php?data_updater=sucess&kjsdklslksd=sfsdfsdffsd&fsdfsdfsfsd=sdfsdfsdfssd");
                } else {
                    $generalErr = "Sorry, we could not update the Database! Please try again...";
                }
            } else {
                if ($generalErr == "") {
                    $generalErr = "Invalid Form Fields Data Were Provided. Fix Errors Below !";
                }
            }
            }
//end of up_date submit button checker and update


//begining of password reset checker
            if (isset($_POST['update_password'])) {
                $form_good_state_2 = 1;
                $old_password =  trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['old_password']))));
                $password =  trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['password']))));
                $password_confirmation =  trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['password_confirmation']))));
        
        //old_password field checker
                if ($old_password != NULL && !empty($old_password) && filter_var($old_password, FILTER_SANITIZE_STRING) === $old_password) {
                    $old_password = $old_password;
                } else {
                    $form_good_state_2 = 0;
                    $old_passwordErr = "Invalid Old Password !";
                    $generalErr = "An error occured, fix it below!";
                }

        //password field checker
                if ($password != NULL && !empty($password) && filter_var($password, FILTER_SANITIZE_STRING) === $password) {
                    $password = $password;
                } else {
                    $form_good_state_2 = 0;
                    $passwordErr = "Invalid Password !";
                    $generalErr = "An error occured, fix it below!";
                }

        //password_confirmation field checker
                if ($password_confirmation != NULL && !empty($password_confirmation) && filter_var($password_confirmation, FILTER_SANITIZE_STRING) === $password_confirmation) {
                    $password_confirmation = $password_confirmation;
                } else {
                    $form_good_state_2 = 0;
                    $password_confirmationErr = "Invalid Password Confirmation!";
                    $generalErr = "An error occured, fix it below!";
                }

                if ($old_password != NULL && !empty($old_password) && filter_var($old_password, FILTER_SANITIZE_STRING) === $old_password && $form_good_state_2 = 1) {
                    if (filter_var($old_password, FILTER_SANITIZE_STRING) === $db_password && $form_good_state_2 = 1) {
                        if ($password != NULL && !empty($password_confirmation) && $form_good_state_2 = 1 && $password === $password_confirmation) {
                             $query_dash_data_1 = $conn->prepare("UPDATE registered_members SET password='$password' WHERE email = ? AND db_id = ?");
                             $query_dash_data_1->bind_param('ss', $db_email, $db_id);
                            if($query_dash_data_1->execute()){
                                header("Location: profile.php?update_password=success&ghfghfghfghfgh=fghfghfghf&fhfghfdgd=asdfasdasdasd");
                            } else {
                                $generalErr = "Sorry, we could not update your Password Changes! Please try again...";
                            }
                        } else {
                            $passwordErr = "Password and Comfirmation Missed Matched!";
                            $password_confirmationErr = "Password and Comfirmation Missed Matched!";
                            $generalErr = "New Password and Comfirmation Missed Matched!";
                        }
                    } else {
                        $old_passwordErr = "Incorrect Old Password provided !";
                        $generalErr = "An error occured, fix it below!";
                    }
                } else {
                    $old_passwordErr = "Incorrect Old Password provided !";
                    $generalErr = "An error occured, fix it below!";
                }
            }
//end of password reset checker!
        } else {      
            $generalErr = "Error, We could not connect to the Server!";
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
             <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Profile</h5>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" method="post" autocomplete="on" >
                    <div class="card-body">
                            <input type="hidden" name="_token" value="cS1DwmlqdF93F4WjL4aFZbAxNJ0wlanMr6RhGm2v">                            <input type="hidden" name="_method" value="put">
                            
                            <div class="form-group">
                                <font color='red'>*</font><label>Surname:</label>
                                <input type="text" name="s_name" required="" class="form-control" placeholder="Name" value="<?php if(isset($_POST['s_name'])){ echo $_POST['s_name'];} else {echo $db_s_name;} ?>" >
                                 <i><span style="color: red"><?php if ($s_nameErr != ""){ echo "$s_nameErr"; }?></span></i>
                            </div>
                            <div class="form-group">
                                <font color='red'>*</font><label>Other Names:</label>
                                <input type="text" name="o_name" required="" class="form-control" placeholder="Name" value="<?php if(isset($_POST['o_name'])){ echo $_POST['o_name'];} else {echo $db_o_name;} ?>">
                                 <i><span style="color: red"><?php if ($o_nameErr != ""){ echo "$o_nameErr"; }?></span></i>
                            </div>

                            <div class="form-group">
                                <font color='red'>*</font><label>Email address:</label>
                                <input type="email" name="email" required="" disabled="" class="form-control" placeholder="Email address" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} else {echo $db_email;} ?>">
                                 <i><span style="color: red"><?php if ($emailEerr != ""){ echo "$emailEerr"; }?></span></i>
                            </div>
                            <div class="form-group">
                                <font color='red'>*</font><label>Phone Number:</label>
                                <input type="number" name="phone_number" required="" class="form-control" placeholder="Email address" value="<?php if(isset($_POST['phone_number'])){ echo $_POST['phone_number'];} else {echo $db_phone_number;} ?>">
                                 <i><span style="color: red"><?php if ($phone_numberErr != ""){ echo "$phone_numberErr"; }?></span></i>
                            </div>
                            <div class="form-group">
                                <font color='red'>*</font><label>Gender:</label>
                                <?php 
                                    $maler=""; $femaler=""; $default="";
                                    if ($db_gender == "Male") {
                                        $maler="selected";
                                        $femaler="";
                                        $default="";
                                    } else if ($db_gender == "Female") {
                                        $maler="";
                                        $femaler="selected";
                                        $default="";
                                    } else {
                                        $maler="";
                                        $femaler="";
                                        $default="selected";
                                    }
                                ?>
                                <select name="gender" class="form-control" required="" placeholder="Email address" style="color: purple">
                                    <optionc <?php echo $default;?> value="Non Selected">None Selected</option>
                                    <option <?php echo $maler;?> value="Male">Male</option>
                                    <option <?php echo $femaler;?> value="Female">Female</option>
                                </select>
                                 <i><span style="color: red"><?php if ($genderErr != ""){ echo "$genderErr"; }?></span></i>
                            </div>

                            <div class="form-group">
                                <font color='red'>*</font><label>KCG Member ID No.</label>
                                <input type="number" name="member_id" required="" disabled="disabled" class="form-control" placeholder="My KGC ID" value="<?php if(isset($_POST['member_id'])){ echo $_POST['member_id'];} else {echo $db_member_id;} ?>">
                                <i><span style="color: red"><?php if ($member_idErr != ""){ echo "$member_idErr"; }?></span></i>
                            </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="update_data" class="btn btn-fill btn-primary" value="Save" />
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">Password</h5>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" method="post" autocomplete="on">
                    <div class="card-body">
                        <input type="hidden" name="_token" value="cS1DwmlqdF93F4WjL4aFZbAxNJ0wlanMr6RhGm2v">                        <input type="hidden" name="_method" value="put">
                        
                        <div class="form-group">
                            <font color='red'>*</font><label>Current Password</label>
                            <input type="password" name="old_password" class="form-control" placeholder="Current Password" value="<?php if(isset($_POST['old_password'])){ echo $_POST['old_password'];} ?>" required="">
                            <i><span style="color: red"><?php if ($old_passwordErr != ""){ echo "$old_passwordErr"; }?></span></i>
                        </div>

                        <div class="form-group">
                            <font color='red'>*</font><label>New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="New Password" value="<?php if(isset($_POST['password'])){ echo $_POST['password'];} ?>" required="">
                            <i><span style="color: red"><?php if ($passwordErr != ""){ echo "$passwordErr"; }?></span></i>
                        </div>
                        
                        <div class="form-group">
                            <font color='red'>*</font><label>Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" value="" required="">
                            <i><span style="color: red"><?php if ($password_confirmationErr != ""){ echo "$password_confirmationErr"; }?></span></i>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="update_password" class="btn btn-fill btn-primary" value="Change password" />
                    </div>
                </form>
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