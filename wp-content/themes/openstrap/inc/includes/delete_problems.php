<?php
ob_start();
error_reporting(0);
?>
<?php
	if(!isset($_POST['submit']))
	header('Refresh:0; URL=http://cse.nits.ac.in');
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
		//print_r($_POST);
		
		foreach($_POST as $postarray=>$value)
		{
		if($value=="delete")
			{
			$query="DELETE FROM problems WHERE email='{$postarray}'";
			//echo $query.'<br>';
			$result=mysqli_query($connection,$query);
				if($result)
				{
				echo 'DELETED SUCCESSFULLY<br>';
				}
				else
				{
				echo 'FAILED DELETING<br>';
				}
			}
		}
		
		mysqli_close($connection);
		echo '<br><center><h2 style="color:#dd4814; margin-left-auto; margin-right:auto;">Modification Successful</h1><img src="redirecting.gif"><br>';
					echo 'If not automatically redirected in 5 seconds then click <a href="http://cse.nits.ac.in/alumni-details/">here</a>';
//redirecting
header('Refresh:4; URL=http://cse.nits.ac.in/contact-us/');
?>
<?php
ob_end_flush();
?>