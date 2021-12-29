<?php
	if (!isset($_SESSION['db_id']) || !isset($_SESSION['s_name']) || !isset($_SESSION['o_names']) || !isset($_SESSION['email']) || !isset($_SESSION['rank'])) {
		header("location: logout.php");
	} else if(isset($_SESSION['db_id']) && isset($_SESSION['s_name']) && isset($_SESSION['o_names']) && isset($_SESSION['email']) && isset($_SESSION['rank'])) {
		$query_dash_data = $conn->prepare("SELECT * FROM `registered_members` WHERE email = ?");
        $query_dash_data->bind_param('s', $_SESSION['email']);
        $query_dash_data->execute();
        $query_dash_data_run_1 = $query_dash_data->get_result();
        if ($query_dash_data_run_1 == true && mysqli_num_rows($query_dash_data_run_1) === 1) {
        	$db_id=""; 	$db_s_name=""; 	$db_o_name=""; 	$db_email="";	$db_phone_number="";	$db_rank="";  
        	$db_aproval_disaproval="";	$db_gender="";	$db_password="";	$db_member_id="";	$db_last_login_device="";
        	$db_last_login_ip="";	$db_last_login_date_time="";	$db_home_addres="";

            while ($rows = mysqli_fetch_assoc($query_dash_data_run_1)) {
               	$db_id = $rows['db_id'];
                $db_s_name = $rows['s_name'];
                $db_o_name = $rows['o_name'];
                $db_email = $rows['email'];
                $db_phone_number = $rows['phone_number'];
                $db_rank = $rows['rank'];
                $db_aproval_disaproval = $rows['aproval_disaproval'];
                $db_gender = $rows['gender'];
                $db_password = $rows['password'];
                $db_member_id = $rows['member_id'];
                $db_last_login_device = $rows['last_login_device'];
                $db_last_login_ip = $rows['last_login_ip'];
                $db_last_login_date_time = $rows['last_login_date_time'];
                $db_home_addres = $rows['home_addres'];
                if ($db_aproval_disaproval == 0) {
                	header("Location: index.php?disapproved=yes");
                } else if($db_aproval_disaproval == 1) {
                	$last_date_visited = DATE("D(d)-M-Y");
    				$last_timer_visited = DATE("h-i-s, a");
    				$combined = $last_date_visited . " " . $last_timer_visited;
    				$last_ipaddr = htmlspecialchars($_SERVER['REMOTE_ADDR']);
    				$last_Browser_OS = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
    				
                	$query_dash_data = $conn->prepare("UPDATE registered_members SET last_login_device='$last_Browser_OS', last_login_ip='$last_ipaddr', last_login_date_time='$combined' WHERE email = ? AND db_id = ?");
        			$query_dash_data->bind_param('ss', $db_email, $db_id);
        			$query_dash_data->execute();
                }
            }
        } else {
           	header("location: logout.php");
        }
	} else {
		header("location: logout.php");
	}

?>