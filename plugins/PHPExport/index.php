<?php
//Sean O'Keefe
//Project to show how to export to Word, Excel, and to a Text File
//Also sets file name as unique using a derivative of the time function and seconds.
if (isset($_POST['submit'])){
	$which=$_POST['submit'];
	switch($which){
	case "excel" :
		header('Location: php/ExportToExcel.php'); 
		break;
	case "text" :
		header('Location: php/ExportToText.php');
		break;
	case "word" :
		header('Location: php/ExportToWord.php');
		break;
	}
}else{
	include "php/DBConnect.php";
}
?>
<!DOCTYPE html>
<head>
	<title>Exporting to File Formats with PHP</title>
</head>
<body>
<form action="index.php" method="post">
File Format to export to:&nbsp;
<input type="submit" name="submit" value="excel" />&nbsp;
<input type="submit" name="submit" value="text" />&nbsp;
<input type="submit" name="submit" value="word" />
</form>
	<table border="1">
		<tr>
			<th>id</th>
			<th>name</th>
			<th>state</th>
			<th>dob</th>
			<th>created on</th>
		</tr>
<?php
if (empty($error)) {
	while($row = mysqli_fetch_assoc($results)) {
		echo "\t\t<tr>\n";
		echo "\t\t\t<td>".$row["customer_id"]."</td>\n";
		echo "\t\t\t<td>".$row["first"]." ".$row["last"]."</td>\n";
		echo "\t\t\t<td>".$row["state"]."</td>\n";
		echo "\t\t\t<td>".date('m-d-Y', strtotime($row["dob"]))."</td>\n";
		echo "\t\t\t<td>".date('m-d-Y', strtotime($row["created"]))."</td>\n";				
		echo "\t\t</tr>\n";
		}
}
?>
	</table>
</body>
</html>