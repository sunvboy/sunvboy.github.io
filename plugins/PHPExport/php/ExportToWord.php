<?php
//ExportToWord.php
require "DBConnect.php";
header("Content-type: application/vnd.ms-word");
$headerstring = 'Content-Disposition: attachment; filename=CustomerListExport' . $filetime . '.doc';
header($headerstring);
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body style='font-family:arial;'>";
echo "<h2><b>The customer list is:</b></h2>";
if (empty($error)) {
	while($row = mysqli_fetch_assoc($results)) {
		echo "<b>customer id:</b> ".$row["customer_id"]."<br />";
		echo "<b>name:</b> ".$row["first"]." ".$row["last"]."<br />";
		echo "<b>state:</b> ".$row["state"]."<br />";
		echo "<b>date of birth:</b> ".$row["dob"]."<br />";
		echo "<b>date user created:</b> ".$row["created"]."<br /><br />";				
	}
}
else
	echo "<center>".$error."</center>";
echo "</body>";
echo "</html>";
?>