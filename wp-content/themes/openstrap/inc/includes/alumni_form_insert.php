<?php
ob_start();
error_reporting(0);
?>
<?php
	if(!isset($_POST['submit'])){
		header('Refresh:0; URL=http://cse.nits.ac.in');
		die('Invalid Submission');}
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
			$d[0]=mysqli_real_escape_string($connection,$_POST['title']);
			$d[1]=mysqli_real_escape_string($connection,$_POST['name']);
			$d[2]=mysqli_real_escape_string($connection,$_POST['dob']);
			$d[3]=(int)$_POST['mobile'];
			if(!empty($_POST['mobile']) && strlen($_POST['mobile'])!=10)
			die("<h2 style=\"color:#dd4814;\"><center>Please Enter Valid mobile Number</center></h2>");
			$d[4]=mysqli_real_escape_string($connection,$_POST['email']);

			
	//MOVING UPLOADED FILE
		//location of temporary file
			$tmp_file=$_FILES['image']['tmp_name'];
		
		//name of new file
			$samay=time();
			$target_file=$samay; // to make each file distinct otherwise it will get replaced
			$target_file.=str_replace(' ','',basename($_FILES['image']['name'])); //original name of file space replaced
		
		//checking file	
			if (($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/png" ) && ($_FILES["image"]["size"] < 1048580) && !$_FILES['image']['error'])
			{		
		//upload directory
			$upload_dir="/var/www/html/cse/uploads/";
			$image_address="http://cse.nits.ac.in/uploads/".$samay.str_replace(' ','',basename($_FILES['image']['name']));	
			
		//moving file  //move_uploaded_file(tempoaray_directory , new/final directory)
			move_uploaded_file($tmp_file, $upload_dir.$target_file);
			}
			else
			{
			header('Refresh:10; URL=http://cse.nits.ac.in/alumni-registration-form');
			die ('<h3>Files must be either JPEG, GIF, or PNG and less than 1MB .... GO back and reupload valid image<br>
			OR <a href="http://cse.nits.ac.in/contact-us/" style="text-decoration:none; color:#dd4814;">Contact us</a></h3>');}
			
			$d[6]=mysqli_real_escape_string($connection,$_POST['address_line_1']);
			$d[7]=mysqli_real_escape_string($connection,$_POST['address_line_2']);
			$d[8]=mysqli_real_escape_string($connection,$_POST['city']);
			$d[9]=mysqli_real_escape_string($connection,$_POST['state']);
			$d[10]=mysqli_real_escape_string($connection,$_POST['pin']);
			$d[11]=mysqli_real_escape_string($connection,$_POST['country']);
			$d[12]=mysqli_real_escape_string($connection,$_POST['degree_nit_silchar']);
			$d[13]=(int)$_POST['year_admission'];
			$d[14]=(int)$_POST['year_graduation'];
			$d[15]=mysqli_real_escape_string($connection,$_POST['scholar_no']);
			$d[16]=mysqli_real_escape_string($connection,$_POST['highest_academic_degree']);
			$d[17]=mysqli_real_escape_string($connection,$_POST['company']);
			$d[18]=mysqli_real_escape_string($connection,$_POST['designation']);
			$d[19]=(int)$_POST['year_joining'];
			$d[20]=mysqli_real_escape_string($connection,$_POST['comment']);
		
		$query="INSERT INTO alumni VALUES(";
		$query.="'{$d[0]}','{$d[1]}','{$d[2]}',{$d[3]},'{$d[4]}','{$image_address}','{$d[6]}','{$d[7]}','{$d[8]}','{$d[9]}','{$d[10]}','{$d[11]}','{$d[12]}',{$d[13]},{$d[14]},'{$d[15]}','{$d[16]}','{$d[17]}','{$d[18]}',{$d[19]},'{$d[20]}',0,0)";
		$result=mysqli_query($connection,$query);

		if($result && $_FILES['image']['error']==0)
		 {		//Closing Connection
					mysqli_close($connection);
					echo '<br><center><h2 style="color:#dd4814; margin-left-auto; margin-right:auto;">Submission Successful</h1><img src="redirecting.gif"><br>';
					echo 'If not automatically redirected in 5 seconds then click <a href="http://'.$host.'/wordpress/cse.nits.ac.in">here</a>';
		  //redirect
		  header('Refresh:4; URL=http://cse.nits.ac.in');
		 }
			
?>
<?php
ob_end_flush();
?>