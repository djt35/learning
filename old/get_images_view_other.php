<?php

//var_dump($_POST);
// check files are set or not
if(isset($_POST)){

	//var_dump($_POST);
	$lesionID = $_POST['LesionID'];
	//echo $lesionID;
			
				define ('MYSQL', '../../mysqli_connect_PROSPER.php');
					require (MYSQL);
				
       			$query = "
				SELECT filename, position FROM imagesOther
				WHERE MRN=$lesionID and position>0 ORDER BY position ASC LIMIT 0, 8
				";
			
            	$res = mysqli_query ($dbc, $query);
					
					while($row = mysqli_fetch_array($res))
					{   
						echo "<div class='imgstyle21'>";
						echo "<img src='".$row['filename'];
						echo "'></div>" ;
						
					}
		//echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $query . ' </p>';
            mysqli_free_result($res);
	
}
		
		
		
		
		?>
    
