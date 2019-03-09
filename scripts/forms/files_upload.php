<?php
ini_set('display_errors',1);

require ('../../includes/config.inc.php');

$openaccess = 0;
$requiredUserLevel = 1;

require (BASE_URI . '/scripts/headerScript.php');

error_reporting(E_ALL);
/*
			$host = substr($_SERVER['HTTP_HOST'], 0, 5);
		if (in_array($host, array('local', '127.0', '192.1'))) {
		    $local = TRUE;
		} else {
		    $local = FALSE;
		}
		
		if ($local){
			
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
			
			
		}else{
			
			require ($_SERVER['DOCUMENT_ROOT'].'/scripts/headerCreator.php');
		}
*/	
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

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$desired_dir=BASE_URI . "/includes/images/";
$desired_http_dir = BASE_URL . "/includes/images/";

$filearray = array();



if(isset($_FILES)){
	
	$r = "INSERT into `imageSet` (`name`) VALUES ('" . generateRandomString() . "')";
					
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
		
		//print_r($errors);
		
		if(empty($errors)==true){
			// moving files to destination
			$finalFilenames[$x]=$file_name;
			$x++;
			
			//echo 'Move target' . $desired_dir . $file_name;
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
					
					//rename the file using the insert id -- implement later
					
					//use insert ID for insert into imagesGroup
					
					$s = "INSERT into `imageImageSet` (`image_id`,`imageSet_id`) VALUES ('$insertid','$insertid2')";
					//echo "The file ".$file_name." has been uploaded";
					$general->connection->RunQuery($s);
					
				}
				
				//echo "The file ".$filename." has been uploaded"; // only for debugging
			}
			else{
				//echo $file_name."is not uploaded"; // use this for debugging otherwise remove it
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
		echo "<button class='save' onclick='fn60sec();'> Save data </button>";
		echo '</p>';
	}


}
else {echo 'No data passed to the form in FILES array';}

?>