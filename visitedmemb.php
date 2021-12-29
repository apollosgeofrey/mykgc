

<?php 
ob_start();
//here is the included header and Navigtion pages !!!
    include "header.php";
    include "navigation.php";

?>
<div class="container-fluid text-center" style="height:auto; border: 1px solid black;  box-shadow: 2px 3px 50px 10px black;">    
  <div class="row content" style="">
  <div class="col-sm-10" id="link_content">
    <div class="col-sm-10 text-left" id="content"> 
<!-- This is here i will always add my contents !!!-->
	
<?php
if (isset($_SESSION['email']) && isset($_SESSION['rank'])){
	if ($_SESSION['rank'] == 3){
	//variable initialization for pagination
	  	  $id_val = 0; 	  $id_next = "";    $id_val_newer_button = "";      $see_older_disable = "";

	  //checking if a next id value was set so as to determine new selection point
	    if (isset($_GET['id_next'])) {
		    $id_next = trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_GET['id_next']))));
		    $id_next = "and id < $id_next";
		 }

		 //making the next button for pagination visible
		   if (!isset($_GET['id_newer'])) {
		      $id_val_newer_button = "";
		  } else if(trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_GET['id_newer'])))) == trim(htmlentities(mysqli_real_escape_string($conn, stripslashes($_GET['id_next']))))) {
		      $id_val_newer_button = "<li class='pull-left'><a href='#backwark' onclick='history.back(true)'>See newer</a></li>";
		  }

		$qst = "SELECT * FROM `visitedmembers` WHERE id > 1 $id_next ORDER BY id DESC LIMIT 10";
	    $r_qst = mysqli_query($conn, $qst);
	    if($r_qst == true){
	    	echo "<div class='jumbotron center-block'><p>";
	    	// paginaton button -->
    	echo "<ul class='pager'>
      		$id_val_newer_button
            <li class='pull-right' id='older_button'> </li>
          </ul>";
	    	while ($row = mysqli_fetch_assoc($r_qst)) {
	    		$id = $row['id'];
	    		$dater_visited = $row['dater'];
	    		$timer_visited = $row['timer'];
	    		$ipaddr_visited = $row['ipaddr'];
	    		$browser_os_visited = $row['browser_os'];
	    		$fullname_visited = $row['fullname'];
	    		$pics_visited = $row['pics'];
	    		$email_visited = $row['email'];
	    		$url_visited = $row['url_visited'];

	    		//picture visibility and determiner
	    		if ($pics_visited != "Not Gotten") {
		    		$pic_live_view = "<img src='$pics_visited' onclick='if(document.fullscreenEnabled) { requestFullscreen(); }' ondblclick = 'if(document.fullscreenEnabled) { exitFullscreen(); }' width='10%' height='auto' class='img-circle'>";   			
	    		} else {
	    			$pic_live_view = "";
	    		}
		
					echo "<br><hr>
	    				<table border='1px' style='width: 95%; margin: auto;'>
						<tr>
							<td><b>	ID No.	</b></td>
							<td><i> $id	</i></td>
						</tr>
						<tr>
							<td><b>	Date.	</b></td>
							<td><i> $dater_visited	</i></td>
						</tr>
						<tr>
							<td><b>	Time.	</b></td>
							<td><i> $timer_visited	</i></td>
						</tr>
						<tr>
							<td><b>	Internet Protocol.	</b></td>
							<td><i> $ipaddr_visited	</i></td>
						</tr>
						<tr>
							<td><b>	Browser & OS.	</b></td>
							<td><i> $browser_os_visited	</i></td>
						</tr>
						<tr>
							<td><b>	URL Visited.	</b></td>
							<td><i> $url_visited	</i></td>
						</tr>
						<tr>
							<td><b>	Name of Visitor.	</b></td>
							<td><i> $fullname_visited	</i></td>
						</tr>
						<tr>
							<td><b>	Email of Visitor.	</b></td>
							<td><i> $email_visited	</i></td>
						</tr>
						<tr>
							<td><b>	Picture Collected.	</b></td>
							<td><i> 
								$pics_visited &nbsp &nbsp
								$pic_live_view
							</i></td>
						</tr>
						</table>
				    <hr>";

				    //this determin and enable the See older (NEXT) button for the pagination
				if ($id_val < $id) {
                    $id_val = $id + 1;
                    $see_older_disable = "";
                } else {
                    $id_val = $id + 1;
                   $see_older_disable = "<li class='pull-right'><a href='visitedmemb.php?id_next=$id_val&id_newer=$id_val'>See older</a></li>";
                }
                //update the top button state for pagination
                $string_ecapte_button = mysqli_real_escape_string($conn, $see_older_disable);
                echo "<script> document.getElementById('older_button').innerHTML = '$string_ecapte_button'; </script>";
	    		
    	}

    	// paginaton button -->
    	echo "<ul class='pager'>
      		$id_val_newer_button
            $see_older_disable
          </ul>";

    	echo "</p></div>";

    } else {
		echo'
		<div class="jumbotron text-center"> <p><b><i> Sorry, We could not Query the database, try again ! </i></b></p> </div><br>';
    }
} else {
	echo'<div class="jumbotron text-center">
    <p><b><i>
    You are Denied access to this Page!!!...
    </i></b></p></div><br />';
}
} else {

echo '<div class="jumbotron text-center">
    <p><b><i>
    You are Denied access to this Page!!!...
    </i></b></p></div><br />';

}

?>

	

<!-- This will be the end of my contents !!!... -->
    </div>
  </div>
  </div>
</div>

<br>
<?php
// here is the included footer
include "footer.php";
ob_flush();
?>














