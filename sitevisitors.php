<?php
//date_default_timezone_set("");

//name and email collector
if(isset($_SESSION['email']) && isset($_SESSION['rank']) && isset($_SESSION['s_name']) && isset($_SESSION['o_names'])){
    $email_visiter = $_SESSION['email'];
    $fullname_visiter = $_SESSION['s_name'] . " " . $_SESSION['o_names'];
} else {
        $fullname_visiter = "Not Gotten";
        $email_visiter = "Not Gotten";
}

//picture collector
if (isset($_SESSION['profile_pics'])) {
    if (!empty($_SESSION['profile_pics']) && $_SESSION['profile_pics'] != null) {
        $pics_visiter = $_SESSION['profile_pics'];  
    } else {
        $pics_visiter = "Not Gotten";
    }
} else {
        $pics_visiter = "Not Gotten";
}

//other data collector
if (isset($conn) ) {
    if ($conn == true){
    $dater_visiter = DATE("D(d)-M-Y");
    $timer_visiter = DATE("h-i-s, a");
    $ipaddr = htmlspecialchars($_SERVER['REMOTE_ADDR']);
    $Browser_OS = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
    $page_visited = htmlspecialchars($_SERVER["REQUEST_URI"]);
    
    $sqlq = "INSERT INTO visitedmembers(dater, timer, ipaddr, browser_os, fullname, email, pics, page_visited) VALUES ('$dater_visiter', '$timer_visiter', '$ipaddr', '$Browser_OS', '$fullname_visiter', '$email_visiter', '$pics_visiter', '$page_visited')"; 
    $sqlqs = mysqli_query($conn, $sqlq);
    }
}

?>
