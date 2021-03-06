<?php

ini_set('display_errors',1);

require ('../../includes/config.inc.php');

$openaccess = 0;
$requiredUserLevel = 4;

require (BASE_URI . '/scripts/headerScript.php');

require (BASE_URI . '/scripts/imageFunctions.php');

error_reporting(E_ALL);

error_reporting(1);

$formv1 = new formGenerator;
			$general = new general;
			$video = new video;
			$tagCategories = new tagCategories;

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


$desired_dir=BASE_URI . "/includes/images/drafts/";
$desired_http_dir = BASE_URL . "/includes/images/drafts/";	

$filearray = array();


$userid = $_SESSION['user_id'];
if(isset($_FILES)){
	
	$r = "INSERT into `imageSetDraft` (`name`, `author`) VALUES ('" . generateRandomString() . "', '$userid')";
					
	$insertid2 = $general->returnWithInsertID($r);

	$errors= array();
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
		
		//if($file_type != 'image/jpeg'){
		//	$errors[]='Files must be jpeg'; // change or remove it
		//}
		
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
				
				$q = "INSERT into `imagesDraft` (`url`) VALUES ('includes/images/drafts/$file_name')";
				
				$insertid = $general->returnWithInsertID($q);
				
				if ($insertid){
					
					$newDesiredFilename = 'image'. $insertid . '.' . strtolower($extension);
					
					//use insert ID for insert into imagesGroup
					
					$s = "INSERT into `imageImageSetDraft` (`image_id`,`imageSet_id`) VALUES ('$insertid','$insertid2')";
					//echo "The file ".$file_name." has been uploaded";
					$general->connection->RunQuery($s);

					rename($desired_dir . $file_name, $desired_dir . $newDesiredFilename);

					$t = "UPDATE `imagesDraft` SET `url` = 'includes/images/drafts/$newDesiredFilename' WHERE `id` = $insertid";
					$general->connection->RunQuery($t);


					$filearray[$x] = array ('id' => $insertid, 'filename' => 'includes/images/drafts/' .$newDesiredFilename);
					
					
				}
				
				//echo "The file ".$filename." has been uploaded"; // only for debugging
			}
			else{
				//echo $newDesiredFilename."is not uploaded"; // use this for debugging otherwise remove it
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
		echo "<div id='imageSetID' style='display:none;'>$insertid2</div>'";
		echo "Title of this image set : <input id='imageSetTitle'></input><br>";
		//echo "Author of this image set : {select here for author}<br>";
		echo "Overall description for these images : <br><textarea name='imageSetname' id='imageSetname' class='name' rows='4' cols='100'></textarea>";
		echo '<table id="imagesTable" class="imageTable">';
		echo '<tr>';
			echo '<th></th>';
			echo '<th></th>';
			echo '<th>Tags</th>';
			echo '<th>Description</th>';
			echo '<th>Rank</th>';
			echo '<th>Display order</th>';
			echo '</tr>';
			
		$filenumber = count($filearray);
		$xy = 1;
			
		foreach ($filearray as $key=>$value){
			
			$insert = $value['id'];
			$file = $value['filename'];
			
			
			echo '<tr class="file">';
			echo "<td id='$insert' style='display:none;'>$file</td>";
			echo "<td><img src='".BASE_URL."/$file' style=\"width:128px;\"></td>";
			echo "<td><button class='addTag'>Add Tag</button></td>";
			echo "<td class='imageTag'></td>";
			echo "<td class='imageDesc'><textarea name='imagename$insert' id='imagename$insert' class='name' rows='4' cols='30'></textarea></td>";
			echo "<td class='imageType'><select name='imagetype$insert' id='imagetype$insert' class='type'><option hidden selected></option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select></td>";
			echo "<td class='imageOrder'>";
			echo "<select name='imageorder$insert' id='imageorder$insert' class='order'><option hidden selected>";
			//code to produce a select with the correct number of boxes
			
			for ($x = 1; $x <= $filenumber; $x++){
				
				if ($x == $xy){
					
					echo "<option value='$x' selected='selected'>$x</option>";
					
				}else{
				
				
					echo "<option value='$x'>$x</option>";
					
				}
				
			}
			echo "</select>";
			echo "</td>";
			echo "<td class='deleteImage'>&#x2718;</td>";;

			
			echo '</tr>';
			$xy++;
		}
		echo '</table>';
		echo '<p>';
		echo "<button class='addTagAll'> Add tag to all images</button>&nbsp;&nbsp;";
		echo "<button class='save' onclick='fn60sec();'> Save data </button>&nbsp;&nbsp;";
		echo "<button class='view' onclick='preview({$insertid2});'><b>View example page</b> </button>";
		echo '</p>';
	}


}
else {echo 'No data passed to the form in FILES array';}

?>