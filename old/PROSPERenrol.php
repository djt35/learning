<?php 




define ('MYSQL', '../../../mysqli_connect_PROSPER.php');
     require (MYSQL); 



$_k_lesion = $_POST['_k_lesion'];
$SERT = $_POST['SERT'];
$completeColon = $_POST['completeColon'];
$defectTattoo = $_POST['defectTattoo'];
//must set user timezone
$date = date('Y-m-d H:i:s');

$q = "UPDATE `Lesion` SET `inPROSPER`=1, `SERT`=$SERT,`completeColon_PROSPER`=$completeColon,`defectTattoo_PROSPER`=$defectTattoo,`dateEnrolled_PROSPER`='$date' WHERE `_k_lesion` = $_k_lesion";
$r = mysqli_query($dbc, $q);
$num = mysqli_affected_rows($dbc);

	if ($num == 1){

echo "
			
			<button id='closeRefresh' align='right'>Close</button>
			<p><h3>Lesion successfully enrolled in PROSPER</h3></p> ";
				
} else
{
	echo "<button id='close' align='right'>Close</button><br/><br/>
	Something went wrong, data not updated
	
	";
		 // echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $q . ' </p>';
	
}

?>