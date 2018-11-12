 <?php  
        $page_title='iACE - lesion studies';
        $page_header='iACE - Lesion Studies';
        include ('header.php');  
        
?>
<?php
error_reporting(0);
if ((isset($_GET['lesionid'])) && (is_numeric ($_GET['lesionid']))) { // From other pages.php 
      $lesionid = $_GET['lesionid'];}
$centre = $_SESSION['centre'];
	
?>
<div id="navi">
        <li><a href="PROSPER_l.php">Home</a></li>
    <li><a href="new.php"> PROSPER </a></li>
    <li><a href="tables.php"> Study Manager </a></li>
    <?php if ($lesionid){echo "<li><a href=\"lesion.php?lesionID=$lesionid\"> Lesion Page for lesion $lesionid </a></li>";}?>
	<?php if ($centre == 77 | $centre == 1){echo "<li><a href=\"other_studies.php\">Other WM Studies</a></li>";}?>
	<li><a href="PROSPERdocs.php"> Study Documents </a></li>
	<li class="active"><a href="studies.php"> Studies </a></li>
    <li><a href="logout.php"> Logout </a></li>

    </div>
    
</div>

<script>
       
    </script>

<style>

	
	img {
    max-width: 100%;
   
}

	
	.content {
    background-color: black;
	color: white;

}
	
.column {
    float: left;
    width: 30%;
    margin-bottom: 20px;
    padding: 0 10px;
}

@media (max-width: 650px) {
    .column {
        width: 100%;
        display: block;
    }
}

.card {
	background-color: #205690;
	-webkit-box-shadow: 4px 6px 83px 3px rgba(214,213,224,1);
-moz-box-shadow: 4px 6px 83px 3px rgba(214,213,224,1);
box-shadow: 4px 6px 83px 3px rgba(214,213,224,1);
	padding-left: 5px;
	padding-top: 4px;
	padding-bottom: 4px;
	text-align: center;
	min-height: 185px;
		
	}
	
.card2 {
	background-color: black;
	padding-left: 5px;
	top: -200px;
		
	}
	
.container {
    padding-left: 5px;
	padding-top: 5px;
	text-align: center;
}
	
.container::after, .row::after {
    content: "";
    clear: both;
    display: table;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
position: fixed;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    background-color: black;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 50;
}

.darkClass {
    background-color: white;
    filter:alpha(opacity=50); /* IE */
    opacity: 0.5; /* Safari, Opera */
    -moz-opacity:0.50; /* FireFox */
    z-index: 20;
    height: 100%;
    width: 100%;
    background-repeat:no-repeat;
    background-position:center;
    position:absolute;
    top: 0px;
    left: 0px;
	display: none;
}
	.errorClass {
		
		 border: solid 2px #f75345;
		 background-color: #f75345;
	}
	.correct {
		border: solid 2px #4CAF50;
		background-color: #4CAF50;
		
	}

	
</style>

</header>

    
<div class="content">
  

  <?php
    
	$centre = $_SESSION['centre'];
	
    error_reporting(0);    
    
	//if no lesion iD passed to the page, show a selection box of patient procedure and lesion
	
	 include "centres.php";
	
	if((isset($_GET['lesionid'])) && (is_numeric($_GET['lesionid']))) {
       $lesionid = $_GET['lesionid'];
        //echo 'page accessed via GET';
        } elseif ((isset($_POST['lesionid'])) && (is_numeric($_POST['lesionid']))) {
            $lesionid = $_POST['lesionid'];}
       // if(!empty($lesionid)) {
		//		echo "<h2>Studies dashboard</h2>";
//	echo "<h3>Lesion ID $lesionid</h3>";
        
    
	//else if the lesion ID passed display the stats for that lesion
			
    //}
	
	
	?>

<div class="darkClass"></div>
<div id="titleBar"> 
	<style>
	a:link, a:visited {
    
    color: white;
    text-align: center; 
    text-decoration: none;
    display: inline-block;
}

a:hover, a:active {
    background-color: #D2343E;
}
	
	</style>
<?php 
	
	define ('MYSQL', '../../../mysqli_connect_PROSPER.php');
					require (MYSQL);
	 
    $sql = "SELECT `Institution`, `Institution_t` FROM `values` ORDER BY `Institution` ASC";
    $institution = @mysqli_query ($dbc, $sql);			
	$Institution = array();
        while ($row = mysqli_fetch_array($institution, MYSQLI_ASSOC)) { 
                    $Institution[$row['Institution']] = $row['Institution_t'];    
                    }
	mysqli_free_result($institution);
	
	$sql = "SELECT `Location`, `Location_t` FROM `values` ORDER BY `Location` ASC";
    $location = @mysqli_query ($dbc, $sql);			
	$Location = array();
        while ($row = mysqli_fetch_array($location, MYSQLI_ASSOC)) { 
                    $Location[$row['Location']] = $row['Location_t'];    
                    }
	mysqli_free_result($location);
	
       			$query = "
				SELECT a.`_k_procedure` , a.`_k_patient` , b.`_k_lesion` , b.`Size` , b.`Location` , DATE_FORMAT( a.`ProcedureDate` , '%d %M, %Y' ) AS dr, b.`inPROSPER`, b.`SERT`, b.`defectTattoo_PROSPER`, c.`Institution`
				FROM `Procedure` AS a
				INNER JOIN `Lesion` AS b ON a.`_k_procedure` = b.`_k_procedure`
				INNER JOIN `Patient` AS c ON a.`_k_patient` = c.`_k_patient`
				WHERE b.`_k_lesion`=$lesionid
				";
			
            	$res = mysqli_query ($dbc, $query);
				$num = mysqli_num_rows($res);
				//echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $query . ' </p>';
					if ($num == 1) {	
					while($row = mysqli_fetch_assoc($res))
					{   
						$_k_patient = $row['_k_patient'];
						$_k_procedure = $row['_k_procedure'];
						$Size = $row['Size'];
						$Loc = $row['Location'];
						$Date = $row['dr'];
						$Inst = $row['Institution'];
						$inPROSPER = $row['inPROSPER'];
						$SERT = $row['SERT'];
						$defectTattoo = $row['defectTattoo_PROSPER'];
						
					}
					}else {
						echo "no lesion selected";
					}
	
            mysqli_free_result($res);
	
	echo "<div style='display: none;' id='lesionid'>$lesionid</div>";
	
	echo "<h2> Lesion $lesionid enrolled studies</h2>";
	echo "<p> <b>Patient: </b>$_k_patient, <b>Procedure on: </b>$Date <br/>";
	echo "$Size mm LSL, <b> Location: </b> $Location[$Loc], <b>Institution:</b> $Institution[$Inst]</p><br/><br/>";
	echo "</div>";
	
	//ROW 1
	
	echo " 
	<div class=\"row\">
	<div class=\"column\">
		<div class=\"card\">
			<h2>PROSPER study</h2>
		<div class=\"container\">";
	if ($inPROSPER==0||$inPROSPER==null){
	
	echo"	<button id=\"enrolPROSPER\">Enrol</button><br/><br/>
		<div class=\"dropdown-content\" id=\"PROSPERedit\"></div>";}else {
		
		echo"Enrolled in PROSPER on $Date<br/><br/>SERT score is $SERT. <br/><br/> Defect was ";
		if ($defectTattoo==0){echo 'not ';}
		echo "marked with tattoo<br/><br/><button id=\"deviationPROSPER\">Record protocol deviation</button><br/><br/>
		<div class=\"dropdown-content\" id=\"PROSPERedit\"></div>";}
	echo "
		
	
			
			
			
			</div>
		
		
		
		</div>
	
	
	
	
	</div>";
	echo " 
	<div class=\"column\">
		<div class=\"card\">
			<h2>Lesion images</h2>
		<div class=\"container\">";
			define ('MYSQL', '../../../mysqli_connect_PROSPER.php');
					require (MYSQL);
				
       			$query = "
				SELECT a.`_k_procedure` , a.`_k_patient` , b.`_k_lesion` , b.`Size` , b.`Location` , DATE_FORMAT( a.`ProcedureDate` , '%d %M, %Y' ) AS dr, c.`filename` , c.`position` 
				FROM  `Procedure` AS a
				INNER JOIN  `Lesion` AS b ON a.`_k_procedure` = b.`_k_procedure` 
				INNER JOIN  `images` AS c ON b.`_k_lesion` = c.`_k_lesion` 
				WHERE b.`_k_lesion`=$lesionid and c.`position`>0 ORDER BY c.`position` ASC LIMIT 0, 1
				";
			
            	$res = mysqli_query ($dbc, $query);
				$num = mysqli_num_rows($res);
					
					if ($num > 0) {	
							while($row = mysqli_fetch_array($res))
							{   
								echo "<a href=\"../view_images.php?lesionid=$lesionid\">View images for lesion $lesionid</a><br/>";

							}
					}
					else {
						echo "
			<a href=\"../new_images.php\">Enter new images for lesion $lesionid</a><br/>
			
			<br/><br/>";
					}
	
            mysqli_free_result($res);
			
			echo "
			
			
			</div>
		
		
		
		</div>
	
	
	
	
	</div>
	
	
	
	";
	echo " 
	<div class=\"column\">
		<div class=\"card2\">";
			define ('MYSQL', '../../../mysqli_connect_PROSPER.php');
					require (MYSQL);
				
       			$query = "
				SELECT a.`_k_procedure` , a.`_k_patient` , b.`_k_lesion` , b.`Size` , b.`Location` , DATE_FORMAT( a.`ProcedureDate` , '%d %M, %Y' ) AS dr, c.`filename` , c.`position` 
				FROM  `Procedure` AS a
				INNER JOIN  `Lesion` AS b ON a.`_k_procedure` = b.`_k_procedure` 
				INNER JOIN  `images` AS c ON b.`_k_lesion` = c.`_k_lesion` 
				WHERE b.`_k_lesion`=$lesionid and c.`position`>0 ORDER BY c.`position` ASC LIMIT 0, 1
				";
			
            	$res = mysqli_query ($dbc, $query);
				$num = mysqli_num_rows($res);
					
					if ($num > 0) {	
					while($row = mysqli_fetch_array($res))
					{   
						echo "<img src='../".$row['filename'];
						echo "'>" ;
						
					}
					}else {
						echo "<br/><br/><br/>No image available for this lesion";
					}
	
            mysqli_free_result($res);
	
		
	echo "	
		
		</div>
	
	
	
	
	</div>
	</div>
	
	
	";
	
	//END ROW 1
	
	//if not enrolled ie no in[study]field Present show enrol link, otherwise say enrolled in iACE and dim the background colour 
	

	?>
<br/>
	

<?php 

//show depending on centre; if 1 then show all study features, otherwise show only basic, PROSPER etc

	
	

if (($centre==77) | ($centre==1)) {
	
	echo " 
	<div class=\"row\">
		<div class=\"column\">
			<div class=\"card\" style=\"text-align: center;\">
				<h2>CSP versus EMR study</h2>
				<div id=\"CSPRandomisation\" style=\"color: #F7C345;\"></div>
						<div class=\"container\" id=\"cspRandomiseButton\">
						<button id='randomiseCSP'>Randomise Lesion</button>
						<br/><br />
						
						
						";
						$cspRand = mt_rand(1,2);
						echo "<div class=\"dropdown-content\" id=\"cspRAND\">
							Randomised to ";
						if ($cspRand == 1) {echo "EMR";}
						elseif ($cspRand == 2) {echo "CSP";}
						echo "
						<br/><br/>
						<button id='closeCSPrandomise'>Done</button>";
						echo "
						<br/>
						
						</div>
						</div>

		
		
			</div>
	
	
	
	
		</div>
	
	";
	echo " 
	
		<div class=\"column\">
			<div class=\"card\">
				<h2>CLiP study</h2>
						<div class=\"container\">
						in the container



						</div>

		
		
			</div>
	
	
	
	
		</div>
	
	";
	echo " 
	
		<div class=\"column\">
			<div class=\"card\">
				<h2>STALK study</h2>
						<div class=\"container\">
						in the container



						</div>

		
		
			</div>
	
	
	
	
		</div>
	</div>
	
	";
	
}

else {
	
	echo 'No other studies to show';
	
}

?>

  
 <script>
	 
	 function enrolPROSPER () {
		 var defectTattoo = $('#enrolPROSPER4').val();
		 var completeColon = $('#enrolPROSPER5').val();
		 var SERT = $('.content').find('#SERT').text();
		 var lesionID = $("#lesionid")
				.clone()    //clone the element
				.children() //select all the children
				.remove()   //remove all the children
				.end()  //again go back to selected element
				.text(); 
		 
		 if ((defectTattoo == 1) && (completeColon == 2)){
			 
			 request = $.ajax({
				url: "PROSPERenrol.php",
				type: "post",
				data: "&_k_lesion="+lesionID+"&SERT="+SERT+"&completeColon="+completeColon+"&defectTattoo="+defectTattoo   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				console.log(response);
				$('#PROSPERedit').html(response);
					  return;
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
			 
			 
		 } else if ((defectTattoo == 0) && (completeColon == 2)) {
			 
			 if (window.confirm("Are you sure, we recommend marking the defect for this study")){
				request = $.ajax({
				url: "PROSPERenrol.php",
				type: "post",
				data: "&_k_lesion="+lesionID+"&SERT="+SERT+"&completeColon="+completeColon+"&defectTattoo="+defectTattoo   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				console.log(response);
				$('#PROSPERedit').html(response);
					  return;
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			}); 
				 
			 }
			 
			 
		 } else {
			 
			 alert('Lesion ineligible for PROSPER study');
		 }
		 
		 
		 
		 //write SERT score, Tattoo, Complete colon, enroldate, deviation
	 };
	 
	 function submitVariationPROSPER () {
		 var deviation = $('.content').find('#deviationText').val();
		 var lesionID = $("#lesionid")
				.clone()    //clone the element
				.children() //select all the children
				.remove()   //remove all the children
				.end()  //again go back to selected element
				.text(); 
		 console.log(deviation);
		 request = $.ajax({
				url: "PROSPERSubmitDeviation.php",
				type: "post",
				data: "&_k_lesion="+lesionID+"&deviation="+deviation		
			});

			request.done(function (response, textStatus, jqXHR){
				console.log(response);
				$('#PROSPERedit').html(response);
					  return;
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			}); 
		 
		 
		 
		 
		 
	 }
	 
	 
     $(document).ready(function() {
	 
	 $('#enrolPROSPER').click(function() {
		$('.darkClass').show();
		
		 
			var lesionID = $("#lesionid")
				.clone()    //clone the element
				.children() //select all the children
				.remove()   //remove all the children
				.end()  //again go back to selected element
				.text(); 

			request = $.ajax({
				url: "PROSPERinfo.php",
				type: "post",
				data: '&_k_lesion='+lesionID
			});

			request.done(function (response, textStatus, jqXHR){
				console.log(response);
				$('#PROSPERedit').show();
				$('#PROSPERedit').html(response);
					  return;
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});

		 
			 
		 
		 
		 
		 
	 });
		 
	$('#deviationPROSPER').click(function() {
		$('.darkClass').show();
		var lesionID = $("#lesionid")
				.clone()    //clone the element
				.children() //select all the children
				.remove()   //remove all the children
				.end()  //again go back to selected element
				.text(); 

			request = $.ajax({
				url: "PROSPERdeviation.php",
				type: "post",
				data: '&_k_lesion='+lesionID
			});

			request.done(function (response, textStatus, jqXHR){
				console.log(response);
				$('#PROSPERedit').show();
				$('#PROSPERedit').html(response);
					  return;
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
		 
		 
		 
		 
	 });
		 
	$('#randomiseCSP').click(function() {
			 $('#cspRAND').show();
		var cspRAND = $("#cspRAND")
        .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text()
		.trim(); 
		
		if (cspRAND == 'Randomised to CSP') {
			$('#CSPRandomisation').html('Randomised to CSP');
				$('#randomiseCSP').html('Remove Randomisation');
			$('#randomiseCSP').attr("id","removeCSPRandomisation");
		

		}else if (cspRAND == 'Randomised to EMR') {
			$('#CSPRandomisation').html('Randomised to EMR');
			$('#randomiseCSP').html('Remove Randomisation');
			$('#randomiseCSP').attr("id","removeCSPRandomisation");
			
		} 
		 
	 });
	 
	$('.content').on("click", "#close", (function() {
			 $('#PROSPERedit').hide();
		$('.darkClass').hide();
			  }));	
		 
	$('.content').on("click", "#closeRefresh", (function() {
			 $('#PROSPERedit').hide();
				$('.darkClass').hide();
				    location.reload();

			  }));	
	
	$('.content').on("click", "#closeCSPrandomise", (function() {
			 $('#cspRAND').hide();
			$('.darkClass').hide();
			  }));	 
		 
	$('.content').on("click", "#removeCSPRandomisation", (function() {
		 //$('#CSPRandomisation').html('');
				//call to the database to remove CSP randomisation
			  }));	  
	
		 $('.content').on("change", "#enrolPROSPER4", (function() {
		  	 var DefectTattoo = $(this);
			 var tattoo = $(this).val()
		  if (tattoo == 0){
			  $(DefectTattoo).addClass("errorClass");
			  $(DefectTattoo).removeClass("correct");
		  }
		  if (tattoo == 1){
			  $(DefectTattoo).removeClass("errorClass"); 
			  $(DefectTattoo).addClass("correct"); 
		  }
			
			  }));	
		 
		 $('.content').on("change", "#enrolPROSPER5", (function() {
		  	 var restColon = $(this);
			 var colon = $(this).val()
		  if (colon == 0  || colon == 1){
			  $(restColon).addClass("errorClass");
			  $(restColon).removeClass("correct");
		  }
		  if (colon == 2){
			  $(restColon).removeClass("errorClass"); 
			  $(restColon).addClass("correct"); 
		  }
			
			  }));	
	
		 $('.content').on("click", "#enrolNowPROSPER", enrolPROSPER);
		 
		 $('.content').on("click", "#submitDeviation", submitVariationPROSPER);
	
	 
	 });
	 
	 
    </script>  

    </div>

<?php include ('footer.html'); ?>

</html>




<?php
 
    //check that the page was passed a study id;
    
   // 
//    } else {
  //      echo '<p id="error"> This page has been accessed in error. </p>';
//    }
    
  //  if ($id == 1) {
//
  //      echo '<h1>Your record was saved</h1><br><br>';
//   }

   // The user is redirected here from thickthin.php;}

  ?>