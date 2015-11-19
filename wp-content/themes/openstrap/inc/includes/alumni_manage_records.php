<?php
ob_start();
?>
<?php

if(!isset($_POST['submit']))
	{
	header('Location:http://cse.nits.ac.in');
	die('Invalid Page');}
	
	$connection_new=mysqli_connect('localhost','root','','cse');

		$count_delete=0;
		foreach($_POST as $one=>$two) //id => value
		{
			if($two==1)
			{
				$idu[$count_update]=$one;
				$count_update++;
			}
			if($two==0)
			{
				$idd[$count_delete]=$one;
				$count_delete++;
			}			
		}

			
	//Performing Delete Query		 
		//delete
		for($i=0;$i<$count_delete-1;$i++)
			{
			$query2s='SELECT image from alumni where id='.$idd[$i];
			$query2='DELETE FROM alumni where id='.$idd[$i].' limit 1';

			$result2s=mysqli_query($connection_new,$query2s);
			$row=mysqli_fetch_assoc($result2s);
			$result2=mysqli_query($connection_new,$query2);
			
			if(unlink('/opt/lampp/htdocs/www/cse/uploads/'.substr($row['image'],30)))
			{echo 'Succesfully removed image<br>';}
			else
			echo('Error in deleting image. Check uploads folder and delete manually<br>');
		if($result2 && mysqli_affected_rows($connection_new)) // returns number of affected rows (-ve if error in result)
		 {
		  //success
		  echo 'Successfully Deleted record from database<br>';
		  
		 }
		 }
	mysqli_close($connection_new);
	
					echo '<br><center><h2 style="color:#dd4814; margin-left-auto; margin-right:auto;">Modification Successful</h1><img src="redirecting.gif"><br>';
					echo 'If not automatically redirected in 5 seconds then click <a href="http://cse.nits.ac.in/alumni-details/">here</a>';
//redirecting
header('Refresh:4; URL=http://cse.nits.ac.in/alumni-details');
?>
<?php
ob_end_flush();
?>