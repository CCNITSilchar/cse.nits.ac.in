<?php
ob_start();
error_reporting(0);
?>
<?php

	//connecting to mysql database
			$host='localhost';
			$dbuser='root';
			$dbpass='';
			$dbname='cse';
		$connection=mysqli_connect($host,$dbuser,$dbpass,$dbname);

	// Testing connection
		if(mysqli_connect_errno())
			{
			die("Connection to database failed:".mysqli_connect_error()."(".mysqli_connect_errno().")");
			}
		
	//Performing Queries
			$d[0]=mysqli_real_escape_string($connection,$_POST['name']);
			$d[1]=mysqli_real_escape_string($connection,$_POST['email']);
			$d[2]=mysqli_real_escape_string($connection,$_POST['feedback']);
			
		if(isset($_POST['submit'])){
		$query="INSERT INTO feedback VALUES(";
		$query.="'{$d[0]}','{$d[1]}','{$d[2]}')";
		}
		
		else{
		header('Refresh:2; URL=http://cse.nits.ac.in');
		die ('<h2>Invalid Submission</h2>');}
	
	
		$result=mysqli_query($connection,$query);

		if($result)
		 {		//Closing Connection
					mysqli_close($connection);
					echo '<br><center><h2 style="color:#dd4814; margin-left-auto; margin-right:auto;">Thank You For your Valuable Feedback</h1><img src="redirecting.gif"><br>';
					echo 'If not automatically redirected in 5 seconds then click <a href="http://'.$host.'/wordpress/cse.nits.ac.in">here</a>';
		  //redirect
		  header('Refresh:4; URL=http://cse.nits.ac.in');
		 }
			
?>
<?php
ob_end_flush();
?>