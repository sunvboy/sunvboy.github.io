<?php
//ExportToText.php
require "DBConnect.php";
header("Content-type: text/plain");
$headerstring = 'Content-Disposition: attachment; filename=CustomerListExport' . $filetime . '.txt';
header($headerstring);
header("Pragma: no-cache");
header("Expires: 0");
echo "The customer list is:";
if (empty($error)){
	while($row = mysqli_fetch_assoc($results)) {
		echo "\n\nid: ".$row["customer_id"]."\n";
		echo "name: ".$row["first"]." ".$row["last"]."\n";
		echo "state: ".$row["state"]."\n";
		echo "date of birth: ".$row["dob"]."\n";
		echo "date user created: ".$row["created"];				
	}
}else
	echo $error."\n";
?>