<?php

var_dump($_POST);
// check files are set or not
if(isset($_POST)){
    
    $errors= array();
	$Study=$_POST['Study'];
	$LesionID=$_POST['LesionID'];
	
	unset($_POST['Study']);
    unset($_POST['LesionID']);
	
	$post = array();
		foreach ($_POST as $key => $value) {
		$post[str_replace("_", ".", $key)] = $value;}
	
	//foreach ($_POST as $key=>$value) {
      //  $value = "'$value'";
       // $updates[] = "$key = $value";  
        //}

    //var_dump($updates);
	
	$desired_dir="images/LesionID$LesionID"; // replace with your directory name where you want to store images
   
        if($Study=='1'){
			
				define ('MYSQL', '../../mysqli_connect_PROSPER.php');
					require (MYSQL);
			
			if (!file_exists($desired_dir)) {
						echo 'filepath does not exist, creating';
						mkdir($desired_dir, 0777, true);
						}
			
			foreach ($post as $key=>$value) {
				if (!empty($key)) {	
				$destination = "$desired_dir/$key";
				rename("images/$key", $destination);
				
       			$q="INSERT INTO `images` (_k_lesion, filename, display, position) VALUES ('$LesionID', '$destination', '1', '$value')";
			$r = @mysqli_query ($dbc, $q);
                if (mysqli_affected_rows ($dbc) == 1) {
               echo $destination.'was entered into the database';
            } else {
                echo $destination.'was not entered into the database';
                     // echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $q . ' </p>';
                        
            } }
				
        }
			
					
			
			
            

        }elseif($Study=='2'){ 
			define ('MYSQL', '../../mysqli_connect_PROSPER.php');
					require (MYSQL);
			
			if (!file_exists($desired_dir)) {
						echo 'filepath does not exist, creating';
						mkdir($desired_dir, 0777, true);
						}
			
			foreach ($post as $key=>$value) {
				if (!empty($key)) {	
				$destination = "$desired_dir/$key";
				rename("images/$key", $destination);
				
       			$q="INSERT INTO `imagesOther` (MRN, filename, display, position) VALUES ('$LesionID', '$destination', '1', '$value')";
			$r = @mysqli_query ($dbc, $q);
                if (mysqli_affected_rows ($dbc) == 1) {
               echo $destination.'was entered into the database';
            } else {
                echo $destination.'was not entered into the database';
                      echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $q . ' </p>';
                        
            } }
				
        }
		
		
		
		
		
		}elseif($Study=='3'){ 
			define ('MYSQL', '../../mysqli_connect_PROSPER.php');
					require (MYSQL);
			
			if (!file_exists($desired_dir)) {
						echo 'filepath does not exist, creating';
						mkdir($desired_dir, 0777, true);
						}
			
			foreach ($post as $key=>$value) {
				if (!empty($key)) {	
				$destination = "$desired_dir/$key";
				rename("images/$key", $destination);
				
       			$q="INSERT INTO `imagesOther` (MRN, filename, display, position) VALUES ('$LesionID', '$destination', '1', '$value')";
			$r = @mysqli_query ($dbc, $q);
                if (mysqli_affected_rows ($dbc) == 1) {
               echo $destination.'was entered into the database';
            } else {
                echo $destination.'was not entered into the database';
                     // echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $q . ' </p>';
                        
            } }
				
        }
		
		
		
		
		
		}
        
        }
            
    //if(empty($errors)){
        //echo "All files Were uploaded successfully"; // your success message/action
		//var_dump($finalFilenames);
		//echo json_encode($finalFilenames);
    //}
    
    
    
else {echo 'No data passed to the script';
	 exit();
	 }
    
?>