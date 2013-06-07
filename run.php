<?php
 $con=mysqli_connect("86.138.18.111","Guest","","Messenger");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else{
	$no = 1;
	$result = mysqli_query($con,"SELECT * FROM Messenger.Commits");
	while($row = mysqli_fetch_array($result)){
		if($no < 5){
			echo '<p align="center">' . $row['User'] . " - " . $row['Commit'] . '</p>';
		}
		$no = $no + 1;
	}
}
?>