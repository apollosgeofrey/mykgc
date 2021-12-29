<!-- header file -->
	<?php
	error_reporting(0);
	  include "header.php";
	  $bus_person_f_nameErr=""; $phoneErr=""; $emailErr=""; $bus_natureErr=""; $rc_noErr=""; $tinErr=""; $sectorErr=""; $bus_sizeErr=""; $date_commenceErr=""; $no_employErr=""; $branchesErr=""; $addressErr=""; $landlord_agentErr=""; $landlord_agent_phoneErr=""; $amountErr=""; $generalErr=""; $generalSuccess=""; $recaptcha_Err=""; $PayerIdErr="";

	if (isset($_GET['inv_suc']) && isset($_GET['inv_num']) && isset($_GET['inv_req_ref']) && isset($_GET['pay_inv_url']) && isset($_GET['pay_inv_view']) && isset($_GET['emailing']) && isset($_GET['payer_id'])) {
		if ($_GET['inv_suc'] == "success") {
			$emailers = trim($_GET['emailing']);
			$inv_num = trim($_GET['inv_num']);
			$inv_req_ref = trim($_GET['inv_req_ref']);
			$pay_inv_url = trim($_GET['pay_inv_url']);
			$pay_inv_view = trim($_GET['pay_inv_view']);
			$payer_id = trim($_GET['payer_id']);
			$generalSuccess = "<b>Successful!!! An email has been sent to <u>$emailers</u></b><br> <b>Tax Payer ID:</b> $payer_id<br> <b>Invoice Number:</b> $inv_num<br> <b>Request Reference:</b> $inv_req_ref<br> <b>Invoice Preview:</b> <a href='$pay_inv_view' target='_blank'>Here</a><br> <b>Payment URL:</b> <a href='$pay_inv_url' target='_blank'>Here</a><br> <b><a href='index.php' class='btn btn-danger btn-sm'>Close / Refresh</a></b><br>";
		} else {
			$generalSuccess="";
		}
	}

	?>
<!-- header file -->

<!-- body -->
<body id="heading_top">
<!--header-->
<header>

	<div class="container">
			<div class="logo" id="logo">
				<h1><a href="index.php" id="trans_state">KGC-Tax</a></h1>
			</div>

				<div class="clearfix"></div>

<!--  begining of form validation is in progress!! -->
<?php 
  // this is where form data are collected and validated.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		//function to validate user inputs
	 function input_fields_validate(){
		global $conn, $bus_person_f_nameErr, $phoneErr, $emailErr, $bus_natureErr, $rc_noErr, $tinErr, $sectorErr, $bus_sizeErr, $date_commenceErr, $no_employErr, $branchesErr, $addressErr, $landlord_agentErr, $landlord_agent_phoneErr, $amountErr, $generalErr, $generalSuccess, $recaptcha_Err; 

		//form good state checker  
            $form_good_state = 1;

		if (isset($conn) && $conn == true) {
	//recaptcha back end
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
				$recaptcha_Err = "Please pass the recaptcha test to proceed!";
				echo "<script> alert('Could not verify the Re-captcha, Try again!'); </script>";
            }

    //input collections
    //session A
			$bus_person_f_name =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['bus_person_f_name']))))));
			$phone = trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, stripslashes($_POST['phone'])))));
			$email =  strtolower(trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_POST['email'])))));
	//input collections
	//session B
			$bus_nature =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['bus_nature']))))));
			$rc_no =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['rc_no']))))));
			$tax_id =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, stripslashes($_POST['tax_id'])))));
			$sector =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['sector']))))));
			$bus_size =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['bus_size']))))));
			$date_commence =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, stripslashes($_POST['date_commence'])))));
			$no_employ = trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, stripslashes($_POST['no_employ'])))));
			$branches = trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, stripslashes($_POST['branches'])))));
			$address =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['address']))))));
	//input collections
	//session C
			$landlord_agent =  trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['landlord_agent']))))));
			$landlord_agent_phone = trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, stripslashes($_POST['landlord_agent_phone'])))));
			$amount = trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, ucwords(stripslashes($_POST['amount']))))));
			$PayerId = trim(htmlentities(htmlspecialchars(mysqli_real_escape_string($conn, stripslashes($_POST['PayerId'])))));

 // for bus_person_f_name validation
	       if ($bus_person_f_name != null && !empty($bus_person_f_name) && filter_var($bus_person_f_name, FILTER_SANITIZE_STRING) === $bus_person_f_name) {
	          if (preg_match("/^[a-zA-Z ]*$/",$bus_person_f_name)) {
	              $bus_person_f_name = $bus_person_f_name;
	           } else {
	              $form_good_state = 0;
	              $bus_person_f_nameErr = "Only letters and white space allowed ! ";
	              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	           }
	        } else {
	         $form_good_state = 0;
	         $bus_person_f_nameErr = "Invalid Fullname Entered ! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	       }

// for phonenumber validation
           if ($phone != null && !empty($phone) && filter_var($phone, FILTER_SANITIZE_NUMBER_INT) === $phone) {
              $phone = $phone;
            } else {
              $form_good_state = 0;
              $phoneErr = "Invalid Mobile Phone Number Provided ! ";
              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            }

 // for email validation
           if ($email != null && !empty($email) && filter_var($email, FILTER_SANITIZE_EMAIL) === $email) {
              if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                	$email = $email;
               } else {
                  $form_good_state = 0;
                  $emailErr = "Invalid email format ! ";
                  $generalErr ="Sorry, There was an error below, Scroll to fix it!";
               }
            } else {
              $form_good_state = 0;
              $emailErr = "Invalid email format ! ";
              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            }

 // for business_nature validation
	       if ($bus_nature != null && !empty($bus_nature) && filter_var($bus_nature, FILTER_SANITIZE_STRING) === $bus_nature) {
	              $bus_nature = $bus_nature;
	        } else {
	         $form_good_state = 0;
	         $bus_natureErr = "Invalid Business Nature Entered ! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	       }

// for rc_no validation
	        if ($rc_no == null || empty($rc_no)) {
              	$rc_no = "";
            } else if (!empty($rc_no)){
            	if (filter_var($rc_no, FILTER_SANITIZE_STRING) === $rc_no) {
            		$rc_no = $rc_no;
            	} else {
        	   		$form_good_state = 0;
	         		$rc_noErr = "Invalid RC/BN Number Entered ! ";
             		$generalErr ="Sorry, There was an error below, Scroll to fix it!";
            	}
            }

 // for TIN validation
           if ($tax_id == null || empty($tax_id)) {
              $tax_id = "";
            } else if (!empty($tax_id)){
            	if (filter_var($tax_id, FILTER_SANITIZE_NUMBER_INT) === $tax_id) {
            		$tax_id = $tax_id;
            	} else {
        	   	  $form_good_state = 0;
    	          $tinErr = "Invalid Tax Identification format provided ! ";
	              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            	}
            }

// for sector validation
	       if ($sector != null && !empty($sector) && filter_var($sector, FILTER_SANITIZE_STRING) === $sector && $sector != "None Selected") {
	          if (preg_match("/^[a-zA-Z ]*$/",$sector)) {
	              $sector = $sector;
	           } else {
	              $form_good_state = 0;
	              $sectorErr = "Only letters, white space are allowed! ";
	              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	           }
	        } else {
	         $form_good_state = 0;
	         $sectorErr = "Invalid Sector Selected! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	       }

// for bus_size validation
	       if ($bus_size != null && !empty($bus_size) && filter_var($bus_size, FILTER_SANITIZE_STRING) === $bus_size && $bus_size != "None Selected") {
	          if (preg_match("/^[a-zA-Z ]*$/",$bus_size)) {
	              $bus_size = $bus_size;
	           } else {
	              $form_good_state = 0;
	              $bus_sizeErr = "Only letters, white space are allowed! ";
	              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	           }
	        } else {
	         $form_good_state = 0;
	         $bus_sizeErr = "Invalid Business Size Selected! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	       }

// for date_commence validation
	       if ($date_commence != null && !empty($date_commence) && filter_var($date_commence, FILTER_SANITIZE_STRING) === $date_commence) {
	          $date_commence = $date_commence;
	        } else {
	         $form_good_state = 0;
	         $date_commenceErr = "Invalid Date of Commencement Provided! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	       }

// for no_employ validation
           if ($no_employ != null && !empty($no_employ) && filter_var($no_employ, FILTER_SANITIZE_NUMBER_INT) === $no_employ) {
              $no_employ = $no_employ;
            } else {
              $form_good_state = 0;
              $no_employErr = "Invalid No. of Employee(s) provided! ";
              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            }
// for branches validation
           if ($branches != null && !empty($branches) && filter_var($branches, FILTER_SANITIZE_NUMBER_INT) === $branches) {
              $branches = $branches;
            } else {
              $form_good_state = 0;
              $branchesErr = "Invalid No. of Branches provided!";
              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            }

// for address validation
	       if ($address != null && !empty($address) && filter_var($address, FILTER_SANITIZE_STRING) === $address) {
	              $address = $address;
	            } else {
	         $form_good_state = 0;
	         $addressErr = "Invalid Business Nature Entered ! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	       }

// for landlord_agent validation
	       if ($landlord_agent != null && !empty($landlord_agent) && filter_var($landlord_agent, FILTER_SANITIZE_STRING) === $landlord_agent) {
	          if (preg_match("/^[a-zA-Z ]*$/",$landlord_agent)) {
	              $landlord_agent = $landlord_agent;
	           } else {
	              $form_good_state = 0;
	              $landlord_agentErr = "Only letters and white space allowed ! ";
	              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	           }
	        } else {
	         $form_good_state = 0;
	         $landlord_agentErr = "Invalid LandLord/Agent Full name Entered ! ";
             $generalErr ="Sorry, There was an error below, Scroll to fix it!";
	       }

// for landlord_agent_phone validation
           if ($landlord_agent_phone != null && !empty($landlord_agent_phone) && filter_var($landlord_agent_phone, FILTER_SANITIZE_NUMBER_INT) === $landlord_agent_phone) {
              $landlord_agent_phone = $landlord_agent_phone;
            } else {
              $form_good_state = 0;
              $landlord_agent_phoneErr = "Invalid LandLord/Agent Phone Number Provided! ";
              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            }

// for Amount validation
           if ($amount != null && !empty($amount) && filter_var($amount, FILTER_SANITIZE_NUMBER_INT) === $amount) {
              $amount = $amount;
            } else {
              $form_good_state = 0;
              $amountErr = "Invalid Amount provided! ";
              $generalErr ="Sorry, There was an error below, Scroll to fix it!";
            }

// for payerID validation
	        if ($PayerId == "" || empty($PayerId)) {
              	$PayerId = "";
            } else if (!empty($PayerId)){
            	if (filter_var($PayerId, FILTER_SANITIZE_STRING) === $PayerId) {
            		$PayerId = $PayerId;
            	} else {
        	   		$form_good_state = 0;
	         		$PayerIdErr = "Invalid Payer ID Number Entered ! ";
             		$generalErr ="Sorry, There was an error below, Scroll to fix it!";
            	}
            }

//final checker to procedd
            if ($bus_person_f_name != null && !empty($bus_person_f_name) && $phone != null && !empty($phone) && $email != null && !empty($email) && $date_commence != null && !empty($date_commence) && $form_good_state == 1) {
            		$ref_val = "KGC" . strval(date("sHimdy"));
            		$fields_values = array("abus_person_f_name"=>"$bus_person_f_name", "aphone"=>"$phone", "aemail"=>"$email", "abus_nature"=>"$bus_nature", "arc_no"=>"$rc_no", "atax_id"=>"$tax_id", "asector"=>"$sector", "abus_size"=>"$bus_size", "adate_commence"=>"$date_commence", "ano_employ"=>"$no_employ", "abranches"=>"$branches", "aaddress"=>"$address", "alandlord_agent"=>"$landlord_agent", "alandlord_agent_phone"=>"$landlord_agent_phone", "aamount"=>"$amount", "ref_val"=>"$ref_val", "PayerId"=>"$PayerId");		
					return $fields_values;
            } else {
            	if ($generalErr == "") {
            		$generalErr = "Invalid Form Fields Data Were Provided. Fix Errors Below !";
            	}
            }
		} else {
            $generalErr ="Sorry, Connection to the Database Server was not successful !!!";
            global $conn;
			if (isset($conn)) {
				mysqli_close($conn);
			}
        }
	}

		//invoice button validator
		if (isset($_POST['submit_invoice'])) {
			$proceeding_state = input_fields_validate();
			if ($proceeding_state != null && !empty($proceeding_state)) {
				$proceeding_state_abus_person_f_name = $proceeding_state['abus_person_f_name'];
				$proceeding_state_aphone = $proceeding_state['aphone'];
				$proceeding_state_aemail = $proceeding_state['aemail'];
				$proceeding_state_bus_anature = $proceeding_state['abus_nature'];
				$proceeding_state_arc_no = $proceeding_state['arc_no'];
				$proceeding_state_atax_id = $proceeding_state['atax_id'];
				$proceeding_state_asector = $proceeding_state['asector'];
				$proceeding_state_abus_size = $proceeding_state['abus_size'];
				$proceeding_state_adate_commence = $proceeding_state['adate_commence'];
				$proceeding_state_ano_employ = $proceeding_state['ano_employ'];
				$proceeding_state_abranches = $proceeding_state['abranches'];
				$proceeding_state_aaddress = $proceeding_state['aaddress'];
				$proceeding_state_alandlord_agent = $proceeding_state['alandlord_agent'];
				$proceeding_state_alandlord_agent_phone = $proceeding_state['alandlord_agent_phone'];
				$proceeding_state_aamount = $proceeding_state['aamount'];
				$proceeding_state_ref_val = $proceeding_state['ref_val'];
				$proceeding_state_PayerId = $proceeding_state['PayerId'];
				$proceeding_state_ip_address = $ipaddr;

			echo "<script>
				var confirmer = confirm('Permit KGC to reachout the Central Billing System Now?');
				if(confirmer == true){
					document.getElementById('logo').innerHTML='<center> <div class=loader></div><style> .loader { border: 12px solid #f3f3f3; border-top: 12px solid #3498db; border-bottom: 12px solid #3498db; border-radius: 50%; width: 50px; height: 50px; animation: spin 3s linear infinite; margin:auto;} @keyframes spin{ 0%{ transform: rotate(0deg); } 100% { transform: rotate(360deg); }}	</style> <h3><b><font color=yellow>Please Wait... KGC is reaching the Biller</font></b></h3></center>';
					$.post('central_billing_system/central_billing_sys.php',
				    {
				        state_abus_person_f_name: '$proceeding_state_abus_person_f_name',
				        state_aphone: '$proceeding_state_aphone',
				        state_aemail: '$proceeding_state_aemail',
				        state_bus_anature: '$proceeding_state_bus_anature',
				        state_arc_no: '$proceeding_state_arc_no',
				        state_atax_id: '$proceeding_state_atax_id',
				        state_asector: '$proceeding_state_asector',
				        state_abus_size: '$proceeding_state_abus_size',
				        state_adate_commence: '$proceeding_state_adate_commence',
				        state_ano_employ: '$proceeding_state_ano_employ',
				        state_abranches: '$proceeding_state_abranches',
				        state_aaddress: '$proceeding_state_aaddress',
				        state_alandlord_agent: '$proceeding_state_alandlord_agent',
				        state_alandlord_agent_phone: '$proceeding_state_alandlord_agent_phone',
				        state_aamount: '$proceeding_state_aamount',
				        state_ref_val: '$proceeding_state_ref_val',
				        state_ip_address: '$proceeding_state_ip_address',
				        state_PayerId: '$proceeding_state_PayerId'
				    },
				    function(data, status){
				    	document.getElementById('logo').innerHTML = '<h1><a href=index.php id=trans_state>KGC-Tax</a></h1>';
				    	var state_data = data;
				    	if(state_data.includes('index.php?inv_suc=success&')){
				    		window.location = state_data;
				    	} else {
				    		alert(data + 'Response: ' + status);
				    	}
				    });
				} else {
						alert('Transaction has been Canceled!');
				}
			</script>";
			}
		}
	}
?>
<!-- End of Php Script -- >



    </div>
   <!-- This is the general Error display session -->
    <?php if ($generalErr != "") { echo "<br><p class='alert alert-danger text-center'> $generalErr </p>"; $generalErr = ""; $generalSuccess="";} ?>
    <?php if ($generalSuccess != "") { echo "<br><p class='alert alert-success text-center'> $generalSuccess </p>"; $generalSuccess = ""; $generalErr="";} ?>
</header>

<!-- Continuation of Body -->
<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->

<!--//-->

  <!--//-->
	<div class=" header-right">
		<div class="banner">
			 <div class="slider">
			    <div class="callbacks_container">
			      <ul class="rslides callbacks callbacks1" id="slider">
					 <li id="callbacks1_s0" class="callbacks1_on" style="display: block; float: left; position: relative; opacity: 1; z-index: 2; transition: opacity 500ms ease-in-out 0s;">
					 		<img src="frontend/images/slide_pic.png" class="img-responsive" alt="">
			           		<div class="caption">
					          	<h3 style="color: white;"><span>Pay your tax</span> in fast, easy steps</h3>
					          	<p><a href="#mobilew3layouts" class="scroll" style="color: white;">Pay now</a></p>
			          		</div>
			         </li>


			      </ul>
			  </div>
			</div>
		</div>
	</div>

    <!--Vertical Tab-->
	<div class="categories-section main-grid-border" id="mobilew3layouts">
		<div class="container">
			<div class="category-list">
				<div id="parentVerticalTab" class="resp-vtabs hor_1" style="display: block; width: 100%; margin: 0px;">
					<div class="agileits-tab_nav">
					<ul class="resp-tabs-list hor_1" style="margin-top: 3px;">
						<li class="resp-tab-item hor_1 resp-tab-active" aria-controls="hor_1_tab_item-0" role="tab" style="background-color: white; border-color: rgb(193, 193, 193);"><i class="icon fa fa-money" aria-hidden="true"></i>Witholding tax on rent?</li>

						<li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-1 " role="tab" style="background-color: rgb(245, 245, 245);"><i class="icon fa fa-home" aria-hidden="true"></i>Kokozum Global Concepts </li>
					</ul>
					</div>
					<div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);">
              <div class="tabs-box">
						<div class="text-center">
							<img src="frontend/logo/kgc_nasarawa.png" class="img-responsive" alt="">
						</div>
								<h2>Pay your tax through <b>KGC!</b></h2>
			     <div class="clearfix"> </div>
			     <div class="tab-grids">
              <div id="tab1" class="tab-grid">
                <div class="login-form mt-5" style="margin-top:3%;">
      				<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="post" autocomplete="on">
      					<!-- this will help validate the form itself -->  
      					<h3 class="text-center"><u>Session A</u></h3>                
                     <div class="row mt-5">
					  <div class="col-md-12">
							<div class="form-group">
								<font color='red'>*</font><label class="form-control-label" for="input_name">Fullname of Business/Person</label>
								<input type="text" name="bus_person_f_name" id="input_name" title="Provide Business or Person Fullname" class="form-control" placeholder="Business/Person Fullname" required="" value="<?php if(isset($_POST['bus_person_f_name'])){ echo $_POST['bus_person_f_name']; } ?>">
								<i><span style="color: red"><?php if ($bus_person_f_nameErr != ""){ echo "$bus_person_f_nameErr"; }?></span></i>
							</div>
					  </div>

					   <div class="col-md-12">
                        <div class="form-group">
                            <font color='red'>*</font><label class="form-control-label" for="input_phone">Enter registered phone number</label>
                            <input type="number" name="phone" id="input_phone" title="Provide valid and registered phone number here" class="form-control " placeholder="Phone number" required="" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } ?>">
                            <i><span style="color: red"><?php if ($phoneErr != ""){ echo "$phoneErr"; }?></span></i>
                        </div>
                      </div>

                      <div class="col-md-12">
							<div class="form-group">
								<font color='red'>*</font><label class="form-control-label" for="input_email">Enter Email Address</label>
								<input type="email" name="email" id="input_email" title="Provide Valid email address here" class="form-control" placeholder="Valid Email Address" required="" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>">
								<i><span style="color: red"><?php if ($emailErr != ""){ echo "$emailErr"; }?></span></i>
							</div>
					  </div>

					  <h3 class="text-center"><u>Session B</u></h3><hr>  
					   <div class="col-md-12">
							<div class="form-group">
								<font color='red'>*</font><label class="form-control-label" for="input_nature_bus">Nature of Business</label>
								<input type="text" name="bus_nature" id="input_nature_bus" title="Provide the Nature of the business" class="form-control" placeholder="Nature of Business" required="" value="<?php if(isset($_POST['bus_nature'])){ echo $_POST['bus_nature']; } ?>">
								<i><span style="color: red"><?php if ($bus_natureErr != ""){ echo "$bus_natureErr"; }?></span></i>
							</div>
					  </div>

					  <div class="col-md-12">
							<div class="form-group">
								<font color='red'>?</font><label class="form-control-label" for="input_rc">RC/BN: No.</label>
								<input type="text" name="rc_no" id="input_rc" title="Provide RC ir BN No." class="form-control" placeholder="RC or BN No." value="<?php if(isset($_POST['rc_no'])){ echo $_POST['rc_no']; } ?>">
								<i><span style="color: red"><?php if ($rc_noErr != ""){ echo "$rc_noErr"; }?></span></i>
							</div>
					  </div>

					  <div class="col-md-12">
						<div class="form-group">
							<font color='red'>?</font><label class="form-control-label" for="input_tin">Tax identification number</label>
							<input type="number" name="tax_id" id="input_tin" title="Provide correct TIN here" class="form-control" placeholder="TIN" value="<?php if(isset($_POST['tax_id'])){ echo $_POST['tax_id']; } ?>">
							<i><span style="color: red"><?php if ($tinErr != ""){ echo "$tinErr"; }?></span></i>
						</div>
					  </div>

					  <!-- this will help me maintain previous selected values by user for SECTOR! -->
    <?php $none=""; $public=""; $private=""; $ngo="";
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if (isset($_POST['submit_invoice'])){
             $field_options = $_POST['sector'];
             switch ($field_options) { case "Public": $public="selected"; $private=""; $ngo=""; $none=""; break;
                  case "Private":  $public=""; $private="selected"; $ngo=""; $none = ""; break;
                  case "None Governmental Organization": $public=""; $private=""; $ngo="selected"; $none=""; break;
               	  default: $none="selected"; $public=""; $private=""; $ngo=""; break; }}} 
    ?>

					  <div class="col-md-12">
							<div class="form-group">
								<font color='red'>*</font><label class="form-control-label" for="input_sector">Kindly Select Sector!</label>
								<select name="sector" id="input_sector" title="Kindly Select Sector!" class="form-control" >
									<option value="None Selected" <?php echo $none; ?> >None Selected</option>
									<option value="Public" <?php echo $public; ?> >Public</option>
									<option value="Private" <?php echo $private; ?> >Private</option>
									<option value="None Governmental Organization" <?php echo $ngo; ?> >None Governmental Organization</option>
								</select>
								<i><span style="color: red"><?php if ($sectorErr != ""){ echo "$sectorErr"; }?></span></i>
							</div>
					  </div>

					  <!-- this will help me maintain previous selected values by user for SECTOR! -->
    <?php $none2=""; $small=""; $medium=""; $large="";
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if (isset($_POST['submit_invoice'])){
             $field_options = $_POST['bus_size'];
             switch ($field_options) { case "Small": $small="selected"; $medium=""; $large=""; $none2=""; break;
                  case "Medium":  $small=""; $medium="selected"; $large=""; $none2=""; break;
                  case "Large": $public=""; $private=""; $large="selected"; $none2=""; break;
               	  default: $none2="selected"; $public=""; $private=""; $large=""; break; }}} 
    ?>

					  <div class="col-md-12">
							<div class="form-group">
								<font color='red'>*</font><label class="form-control-label" for="input_bus_size">Kindly Select Business Size!</label>
								<select name="bus_size" id="input_bus_size" title="Kindly Select Business Size" class="form-control" >
									<option value="None Selected" <?php echo $none2; ?> >None Selected</option>
									<option value="Small" <?php echo $small; ?> >Small</option>
									<option value="Medium" <?php echo $medium; ?> >Medium</option>
									<option value="Large" <?php echo $large; ?> >Large</option>
								</select>
								<i><span style="color: red"><?php if ($bus_sizeErr != ""){ echo "$bus_sizeErr"; }?></span></i>
							</div>
					  </div>

					  <div class="col-md-12">
                        <div class="form-group">
                            <font color='red'>*</font><label class="form-control-label" for="input_commencement">Date of Commencement</label>
                            <input type="date" name="date_commence" id="input_commencement" title="Provide Commencement Date" class="form-control " placeholder="Select Business Commencement Date" required="" value="<?php if(isset($_POST['date_commence'])){ echo $_POST['date_commence']; } ?>">
                            <i><span style="color: red"><?php if ($date_commenceErr != ""){ echo "$date_commenceErr"; }?></span></i>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <font color='red'>*</font><label class="form-control-label" for="input_employees">No. of Employees'</label>
                            <input type="number" name="no_employ" id="input_employees" title="Provide valid Number of Employees" class="form-control " placeholder="Correct Number of Employees" required="" value="<?php if(isset($_POST['no_employ'])){ echo $_POST['no_employ']; } ?>">
                            <i><span style="color: red"><?php if ($no_employErr != ""){ echo "$no_employErr"; }?></span></i>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <font color='red'>*</font><label class="form-control-label" for="input_branches">No. of Branches!</label>
                            <input type="number" name="branches" id="input_branches" title="Provide valid number of Branches here" class="form-control " placeholder="Number of Branches" required="" value="<?php if(isset($_POST['branches'])){ echo $_POST['branches']; } ?>">
                            <i><span style="color: red"><?php if ($branchesErr != ""){ echo "$branchesErr"; }?></span></i>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <font color='red'>*</font><label class="form-control-label" for="input_address">Address/Location</label>
                            <input type="text" name="address" id="input_address" title="Provide Address/Location" class="form-control " placeholder="Provide Address/Location" required="" value="<?php if(isset($_POST['address'])){ echo $_POST['address']; } ?>">
                            <i><span style="color: red"><?php if ($addressErr != ""){ echo "$addressErr"; }?></span></i>
                        </div>
                      </div>

                      
                      <h3 class="text-center"><u>Session C</u></h3>
                      <hr>  
                      <div class="col-md-12">
							<div class="form-group">
								<font color='red'>*</font><label class="form-control-label" for="input_land_agent">Fullname of Landlord/Agent</label>
								<input type="text" name="landlord_agent" id="input_land_agent" title="Provide Landlord or Agent Fullname" class="form-control" placeholder="Provide Landlord/Agent Fullname" required="" value="<?php if(isset($_POST['landlord_agent'])){ echo $_POST['landlord_agent']; } ?>">
								<i><span style="color: red"><?php if ($landlord_agentErr != ""){ echo "$landlord_agentErr"; }?></span></i>
							</div>
					  </div>

					  <div class="col-md-12">
                        <div class="form-group">
                            <font color='red'>*</font><label class="form-control-label" for="input_land_phone">Landlord/Agent phone number</label>
                            <input type="number" name="landlord_agent_phone" id="input_land_phone" title="Provide valid and registered phone number here" class="form-control " placeholder="Phone number" required="" value="<?php if(isset($_POST['landlord_agent_phone'])){ echo $_POST['landlord_agent_phone']; } ?>">
                            <i><span style="color: red"><?php if ($landlord_agent_phoneErr != ""){ echo "$landlord_agent_phoneErr"; }?></span></i>
                        </div>
                      </div>
                     
                     <h3 class="text-center"><u>Session D</u></h3>
                      <div class="col-md-12">
                        <div class="form-group">
                            <font color='red'>*</font><label class="form-control-label" for="input_amount">Enter amount to pay</label>
                            <input type="number" name="amount" autocomplete="off" id="input_amount" title="Provide valid non-nagative figure" class="form-control " placeholder="Amount to be paid" required="" value="<?php if(isset($_POST['amount'])){ echo $_POST['amount']; } ?>">
                            <i><span style="color: red"><?php if ($amountErr != ""){ echo "$amountErr"; }?></span></i>
                        </div>
                        <div class="form-group">
                            <font color='red'>?</font><label class="form-control-label" for="input_amount">Do you have a Payer ID Number?</label>
                            <input type="text" name="PayerId" autocomplete="off" id="input_PayerId" title="Provide valid payer ID Number if any " class="form-control " placeholder="Provide Payer ID here if any!" value="<?php if(isset($_POST['PayerId'])){ echo $_POST['PayerId']; } ?>">
                            <i><span style="color: red"><?php if ($PayerIdErr != ""){ echo "$PayerIdErr"; }?></span></i>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Lev77caAAAAAPYLo3KSmrCe75DHgqk-XszBWS0-"></div>
                            <i><span style="color: red"><?php if ($recaptcha_Err != ""){ echo "$recaptcha_Err"; }?></span></i>
     						 <br/>
                        </div>
                    </div>

      				<div class="form-group text-center">
      					<input type="submit" style="color: red; border-bottom: 2px solid black; border-radius: 8px; margin-top: 5px;" class="submit btn btn-primary" name="submit_invoice" value="Generate Invoice?">
                       
                        <!-- <p><b><i class="alert alert-info">Secured by Flutter Wave!</i></b></p> -->
                    </div>
                 </form>
			         </div>
              </div>

				</div>

			<div class="clearfix"> </div>
		</div>
	<!-- script -->
		<script>
			$(document).ready(function() {
				$("#tab2").hide();
				$("#tab3").hide();
				$("#tab4").hide();
				$(".tabs-menu a").click(function(event){
					event.preventDefault();
					var tab=$(this).attr("href");
					$(".tab-grid").not(tab).css("display","none");
					$(tab).fadeIn("slow");
				});
			});
		</script>


			             </div>
                        <!-- /tab1 -->
			<!-- tab2 -->

					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--Plug-in Initialisation-->
	<script type="text/javascript">
    $(document).ready(function() {

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>
	<!-- //Categories -->


<!--phone-->
	<div class="phone" id="mobileappagileits">
		<div class="container">
			<div class="col-md-6">
				<img src="WTH-Tax_files/ph1.png" class="img-responsive" alt="">
			</div>
			<div class="col-md-6 phone-text">
				<h4>Online tax payment mobile app on your smartphone!</h4>
                <p class="subtitle">Simple and Fast Payments</p>
					<div class="text-1">
						<h5>Simple</h5>
						<p>Two easy steps, all you need is your phone number and a means of payment (USSD, Card, Bank transfer etc) </p>
					</div>
					<div class="text-1">
						<h5>Fast</h5>
						<p>Complete your tax payment in a 120 seconds or less </p>
					</div>
					<div class="text-1">
						<h5>Secure</h5>
						<p>Our platform is secure and your information is safe with us </p>
					</div>
					<div class="agileinfo-dwld-app">
						<h6>Mobile app coming soon :
							<a href="#"><i class="fa fa-apple"></i></a>
							<a href="#"><i class="fa fa-windows"></i></a>
							<a href="#"><i class="fa fa-android"></i></a>
						</h6>
					</div>
			</div>
		</div>
	</div>
<!--//phone-->


<!--partners-->
	<div class="w3layouts-partners">
		<h3>We accept the following:</h3>
	 		<div class="container "><hr>
				<ul class="text-center">
				  <li>
					<a href="#"><img class="img-responsive" src="frontend/images/visa.jpg" title="Visa Cards" alt="loading Image..."></a>
				  </li>
				  <li>
					 <a href="#"><img class="img-responsive" src="frontend/images/master.png" alt="loading Image..." title="Master Cards"></a>
				  </li>
				  <li>
					<a href="#"><img class="img-responsive" src="frontend/images/verves.jpg" alt="loading Image..." title="Verve Cards"></a>
				  </li>
				  <li>
				   <a href="#"><img class="img-responsive" src="frontend/images/master.png" alt="loading Image..." title="Master Cards"></a>
				  </li>
				  <li>
				   <a href="#"><img class="img-responsive" src="frontend/images/visa.jpg" alt="loading Image..." title="Visa Cards"></a>
				  </li>
				</ul>
			</div>
		</div>
<!--//partners -->



  <!-- subscribe -->
  	<div class="w3-subscribe agileits-w3layouts">
  		<div class="container">
  			<div class="col-md-6 social-icons w3-agile-icons">
  				<h4>Join Us</h4>
  				<ul>
  					<li><a href="#" class="fa fa-facebook sicon facebook"> </a></li>
  					<li><a href="#" class="fa fa-twitter sicon twitter"> </a></li>
  					<li><a href="#" class="fa fa-google-plus sicon googleplus"> </a></li>
  					<li><a href="#" class="fa fa-dribbble sicon dribbble"> </a></li>
  					<li><a href="#" class="fa fa-rss sicon rss"> </a></li>
  				</ul>
  			</div>
  			<div class="col-md-6 w3-agile-subscribe-right">
  				<h3 class="w3ls-title">Subscribe to Our <br><span>Newsletter</span></h3>
  				<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="post" autocomplete="on">
  					<input type="email" name="email_subscribe" placeholder="Enter your Email..." required="" value="<?php if(isset($_POST['email_subscribe'])){ echo $_POST['email_subscribe'];} ?>">
  					<input type="submit" value="Subscribe">
  					<div class="clearfix"> </div>
  				</form>
  			</div>
  			<div class="clearfix"> </div>
  		</div>
  	</div>
  <!-- //subscribe -->

<?php
	include "footer.php";
?>