<?php
//ExportToExcel.php
require "DBConnect.php";
header("Content-type: application/vnd.ms-excel");
$headerstring = 'Content-Disposition: attachment; filename=CustomerListExport' . $filetime . '.xls';
header($headerstring);
header("Pragma: no-cache");
header("Expires: 0");
echo "id"."\t";
echo "first"."\t";
echo "last"."\t";
echo "state"."\t";
echo "date of birth"."\t";
echo "created date"."\n";
if (empty($error)) {
	while($row = mysqli_fetch_assoc($results)) {
		echo $row["customer_id"]."\t";
		echo $row["first"]."\t";
		echo $row["last"]."\t";
		echo $row["state"]."\t";
		echo date('m-d-Y', strtotime($row["dob"]))."\t";
		echo date('m-d-Y', strtotime($row["created"]))."\n";				
	}
}else
	echo $error."\n";
?>
