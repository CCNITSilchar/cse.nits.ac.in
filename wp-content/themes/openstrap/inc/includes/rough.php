<?php
	$host='localhost';
	$dbuser='root';
	$dbpass='';
	$dbname='cse';
	$connection=mysqli_connect($host,$dbuser,$dbpass,$dbname);
	if($connection)
	echo 'connected<br>';
	//testing connection
		if(mysqli_connect_errno())
			{
			die("Connection to database failed:".mysqli_connect_error()."(".mysqli_connect_errno().")");
			}
			//$address='http://cse.nits.ac.in/uploads/1428325179BARGA.jpg';
	//query
		//$query="UPDATE alumni SET image='{$address}'";
		$result=mysqli_query($connection,$query);
		echo $query.'<br>';
		 	//Closing Connection
			if(!$result)
			{
					echo 'failed<br>';
			}
					
?>
		