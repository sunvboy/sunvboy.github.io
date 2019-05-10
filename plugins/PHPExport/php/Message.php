<?php
$message=$_GET['message'];
?>
<div style="text-align:center">
<h2>There was an error with your request:</h2>
<h3><?php echo $message; ?></h3>
<br />
<p><a href="../index.php">Go back to index</a></p>
</div>