<?php
$host = "localhost"; 
$user = "root"; 
$pass = "root"; 
$db = "bank";
$constatus = true;
$dbstatus = true;
$valid = false;
$r = mysql_connect($host, $user, $pass);
if (!$r) {
	$constatus = false;
	echo "Could not connect to server\n";
	trigger_error(mysql_error(), E_USER_ERROR);
} else {
	echo "Connection established\n"."</br>"; 
}
	$r2 = mysql_select_db($db);
	echo $host."</br>";
if (!$r2) {
	$dbstatus = false;
	echo "Cannot select database\n";
	trigger_error(mysql_error(), E_USER_ERROR); 
} else {
	echo "Database selected\n"."</br>";

}

if ($_POST['uid']) {
$uid = $_POST['uid'];
$pid = $_POST['passid'];
}
else {
$uid = $_GET['u'];
$pid = $_GET['p'];
}

echo $uid."</br>".$pid."</br>";
$SQL = "select * from accounts where userid = '$uid' and password = '$pid' ";
$result = mysql_query($SQL) or die ('Error updating database: '.mysql_error());
if(mysql_num_rows($result)>0)

{
	$valid = true;
	echo "<h4>"."-- Personal Information -- ".$row[1]."</h4>","</br>";
	while ($row=mysql_fetch_row($result))
	{
		$data[]=$row;
		// echo "<p>"."User ID : ".$row[0]."</p>";
		// echo "<p>"."Password : ".$row[2]."</p>";
		// echo "<p>"."Name : ".$row[1]." Country : ".$row[4]."</p>";
		// echo "<p>"."Gender : ".$row[3]."</p>";
		// echo "<p>"."Balance : ".$row[6];
		// echo "<p>"."Email ID : ".$row[5]." Contact No. : ".$row[7]."</p>"."</p>";
		// echo "--------------------------------------------";
		}
 }
else {
	echo "Invalid user id or password";
}
echo count($data);

?>

<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
	<title>Bank Emp Details</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet"> 
    <link href="css/action.css" rel="stylesheet">
</head>
<body>
	<?php if ($constatus & $dbstatus) { ?>
	<div class="alert alert-success" role="alert">
        <strong>Good To Go!</strong> You successfully connected to Database.
      </div>
    <?php } else { ?>
    	<div class="alert alert-danger" role="alert">
        	<strong>Oh snap!</strong> Failed to connect to Database.
      	</div>	
    <?php } ?>
    <?php if ($valid) { ?>
	<div class="alert alert-success" role="alert">
        <strong>Well done!</strong> Valid Username and Password.
      </div>
    <?php } else { ?>
    	<div class="alert alert-danger" role="alert">
        	<strong>Oh snap!</strong> Invalid Username and Password.
      	</div>	
    <?php } ?>

<div class="container">
	<div class="row myrow">
	  	<h1 style="margin-top: 4vw">Bank Employee Data</h1>
		  <table class="batsman">
		    <thead>
		     	<tr>
		 	  		<th>Name</th>
		      		<th class="tl">User ID</th>
		      		<th class="tl">Password</th>
		      		<th class="tl">Balance</th>
		      		<th class="tl">Email ID</th>
		      		<th class="tl">Contact No.</th>
		      	</tr>
		    </thead>
		    <?php for($i=0;$i<count($data);$i++) {  ?>
		      	<tr>
		      		<td><h4><?php echo $data[$i][1]; ?></h4></td>
		      		<td class="tl"><?php echo $data[$i][0]; ?></td>
		      		<td class="tl"><?php echo $data[$i][2]; ?></td>
		      		<td class="tl"><?php echo $data[$i][3]; ?></td>
		      		<td class="tl"><?php echo $data[$i][4]; ?></td>
		      		<td class="tl"><?php echo $data[$i][5]; ?></td>
		      	</tr>
		     <?php } ?>
		  </table>
	</div>
</div>



</body>
</html>
