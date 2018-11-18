<?php


			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
		
			$formv1 = new formGenerator;
			$general = new general;
			$video = new video;
			$tagCategories = new tagCategories;

//echo 'hello';

error_reporting(1);

//define('MYSQL', '../../mysqli_connect_PROSPER.php');
//require (MYSQL);
//var_dump($_FILES);
// check files are set or not

$desired_dir=$root . "includes/images/";
$desired_http_dir = $roothttp . "includes/images/";

$filearray = array();

if(isset($_FILES)){

	$errors= array();
	$desired_dir=$root . "includes/images/"; // replace with your directory name where you want to store images
	// getting files array
	$x=1;
	foreach($_FILES as $file){
		$filename = $file['name'];
		$file_size = $file['size'];
		$file_tmp = $file['tmp_name'];
		$file_type= $file['type'];
		
		// checking file size (because i use it)
		/*if($file_size > 8097152){
			$errors[]='File size must be less than 8 MB'; // change or remove it
		}*/
		
		if($file_type != 'image/jpeg'){
			$errors[]='Files must be jpeg'; // change or remove it
		}
		
		$random = rand ( 99 , 99999 );
		
		
		$initialextension = pathinfo($filename, PATHINFO_EXTENSION);
		
		$file_name = 'image' . $random . '.' . $initialextension;
		
		$actual_name = pathinfo($file_name,PATHINFO_FILENAME);
		$original_name = $actual_name;
		$extension = pathinfo($file_name, PATHINFO_EXTENSION);
		
		$i = 1;
		while(file_exists('tmp/'.$actual_name.".".$extension))
		{           
		    $actual_name = (string)$original_name.$i;
		    $file_name = $actual_name.".".$extension;
		    $i++;
		}
		
		
		
		if(empty($errors)==true){
			// moving files to destination
			$finalFilenames[$x]=$file_name;
			$x++;
			
			$move=move_uploaded_file($file_tmp, $desired_dir . $file_name);
			// you can direct write move_uploaded files method in bellow if condition
			if($move)
			{
				// inserting data into database
				// mysql_query("INSERT into your_tablename(your_field) VALUES('$filename')"); // inserting data if file is moved
				
				$q = "INSERT into `images` (`url`) VALUES ('includes/images/$file_name')";
				
				$insertid = $general->returnWithInsertID($q);
				
				if ($insertid){
					
					$filearray[$x] = array ('id' => $insertid, 'filename' => 'includes/images/' .$file_name);
					
					//echo "The file ".$file_name." has been uploaded";
					
				}
				
				//echo "The file ".$filename." has been uploaded"; // only for debugging
			}
			else{
				echo $file_name."is not uploaded"; // use this for debugging otherwise remove it
			}

		}
		else{
			foreach ($errors as $msg) {
				echo " - $msg";
			}
		}
}

	if(empty($errors)){
		//echo "All files Were uploaded successfully"; // your success message/action
		//var_dump($finalFilenames);
		//echo "<div id=\"finalFilenames\" style=\"display:none;>\"";
		//echo json_encode($finalFilenames);
		//echo "</div>";

		echo '<table id="imagesTable" class="imageTable">';
		echo '<tr>';
			echo '<th></th>';
			echo '<th></th>';
			echo '<th>Tags</th>';
			echo '<th>Description</th>';
			echo '<th>Rank</th>';
			echo '</tr>';
		foreach ($filearray as $key=>$value){
			
			$insert = $value['id'];
			$file = $value['filename'];
			
			
			echo '<tr class="file">';
			echo "<td id='$insert' style='display:none;'>$file</td>";
			echo "<td><img src='$roothttp/$file' style=\"width:128px;\"></td>";
			echo "<td><button class='addTag'>Add Tag</button></td>";
			echo "<td class='imageTag'></td>";
			echo "<td class='imageDesc'><textarea name='imagename$insert' id='imagename$insert' class='name' rows='4' cols='30'></textarea></td>";
			echo "<td class='imageRank'><select name='imagetype$insert' id='imagetype$insert' class='type'><option hidden selected></option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select></td>";

			
			echo '</tr>';
		}
		echo '</table>';
		echo '<p>';
		echo "<button class='addTagAll'> Add tag to all images</button>&nbsp;&nbsp;";
		echo "<button class='save' onclick='fn60sec();'> Save data </button>";
		echo '</p>';
	}


}
else {echo 'No data passed to the form in FILES array';}

?>