<?php

$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))) {
	$local = TRUE;
} else {
	$local = FALSE;
}

if ($local){

	$root = $_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/';
	$roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/dashboard/learning/';
	require($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/includes/config.inc.php');
}else{
	$root = $_SERVER['DOCUMENT_ROOT'];
	$roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/';

	require($_SERVER['DOCUMENT_ROOT'].'/includes/config.inc.php');

}

$location = $roothttp . 'elearn.php';


session_start( );


if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ($root . 'includes/login_functions.php');
	redirect_login($location);
}



$general = new general;
$user = new users;


function ne($v) {
	return $v != '';
}

$errors = array();

if ($user->getUserAccessLevel($_SESSION['user_id']) > 1){
			
			            
			            //queries
			            
			            // 3 inserts
			            
			            
			            
			            
			            //copy the imageset, get new imageset id
			            
			            //get array of all the images in the imageset (ids)
			            
			            //move files to correct directory
			            
			            //copy the images, get new image ids
			            
			            //write imageImageSet table
			            
			            //write tags if there
			            
			            //delete the drafts and clean up files
			
			//$errors = array();
			$errors[] = 'You do not have sufficient access privileges';
			print_r($errors);
			
			exit();
	
	
	
		}



$data = json_decode(file_get_contents('php://input'), true);



if (count($data) > 0){


	if (!isset($data['imageSetDraftid'])){

		$errors[] = 'imageSetDraft key not set';
		print_r($errors);
		exit();

	}else{

		$imageSetDraftid = $data['imageSetDraftid'];

	}

	
    $q = "INSERT INTO imageSet (name, type, author, created, updated)
			SELECT name, type, author, created, updated
			FROM imageSetDraft
			WHERE id = '{$imageSetDraftid}'";
			
			//echo $q;

			
	$result = $general->connection->RunQuery($q);
	
	//get insert id
	
	$imageSetid = $general->connection->conn->insert_id;
	
	//echo 'Insert id was ' . $imageSetid;
	
	if ($imageSetid){
		
		$errors[] = 'Successfully copied imageSet data from draft ( ' . $imageSetDraftid .'  ) to active database for imageset id '. $imageSetid;
		
		$errors['imageSetid'] = $imageSetid;
		
		//get array of all images in the passed draft set
		
		 $q = "SELECT a.`id`, a.`url` FROM imagesDraft as a 
		 		INNER JOIN imageImageSetDraft as b ON a.`id` = b.`image_id`
		 		INNER JOIN imageSetDraft as c ON b.`imageSet_id` = c.`id`
		 		WHERE c.`id` = '{$imageSetDraftid}'";
		
		$result = $general->connection->RunQuery($q);
		
		$images = array();
		
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
		
				$id = $row['id'];
				$url = $row['url'];
		
				$images[$id] = $url;
		
		}
		
		//print_r($images);
		
			if ($images){
				
				
				
				//for each image write to the images table
				
				//and write the current imageset id
				$imagesNew = array();
				
				$x=0;
				
				foreach ($images as $key=>$value){
					
					//$key is image id, $value is url
					
					$new_url = str_replace("/drafts","",$value);
					
					 $q = "INSERT INTO `images` (`url`, `name`, `type`, `created`, `updated`, `order`)
							SELECT '$new_url', `name`, `type`, `created`, `updated`, `order`
							FROM `imagesDraft`
							WHERE id = '{$key}'";
							
							//echo $q;

					$result = $general->connection->RunQuery($q);
					
					if ($result){
					
						$imagesNew[$key] = $general->connection->conn->insert_id;
						
						//move the image to the general location
						
						
						
						$copyfile = copy($root . $value,$root . $new_url);
						
						if ($copyfile == 1) {
							
							
							$errors[] = 'Draft image id ' . $key . ' copied from' . $value . 'to ' . $new_url;
							//continue here once outside the foreach loop
							
							
							
							
							
						}else{
							
							$errors[] = 'Draft image id ' . $key . 'not copied from' . $value . 'to ' . $new_url;
							
						}
						
						
						
					
					}else{
						
						$errors[] = 'Image draft id ' . $key . 'was not copied to the images database';
					}
					
					$x++;
					
				}
				
				
				foreach ($images as $key=>$value){
				//get any draft tags entered for draft images, add these to imagesTag for new image ids 
												
						$q = "SELECT a.`id`, b.`tags_id` FROM imagesDraft as a 
					 		INNER JOIN imagesTagDraft as b ON a.`id` = b.`images_id`
					 		WHERE a.`id` = '{$key}'";
						
						$result = $general->connection->RunQuery($q);
						
						if ($result->num_rows >= 1){
							
							$errors[] = 'there were tags matched with imageDraft id ' . $key;
							
							while($row = $result->fetch_array(MYSQLI_ASSOC)){
								
									$draftimageid = $row['id'];
									$drafttagid = $row['tags_id'];
		
									foreach ($imagesNew as $key=>$value){ //imagesNew is an array of [draft id]->new id
										
										if ($key == $draftimageid){
											
											//value is therefore the new image id
											
											$newimageid = $value;
											
											$s = "INSERT into `imagesTag` (`images_id`,`tags_id`) VALUES ('$newimageid','$drafttagid')";
											
											$result2 = $general->connection->RunQuery($s);

											if ($result2){
											
												$errors[] = 'imagesTag updated with image_id ' . $newimageid . ' and tag id '. $drafttagid;	
												
											}else {
												
												$errors[] = 'could not update imagesTag with image_id ' . $newimageid . ' and tag id '. $drafttagid;	
												
											}
											
										}										
										
									}
							
							}
							
							
						}
						
				}
				
				if ($imagesNew){
					
					foreach ($imagesNew as $key=>$value){
						
						$s = "INSERT into `imageImageSet` (`image_id`,`imageSet_id`) VALUES ('$value','$imageSetid')";
							
						$result = $general->connection->RunQuery($s);
						
						if ($result){
							
							$errors[] = 'image_id ' . $value . 'paired with imageSet_id ' . $imageSetid . ' inserted into imageImageSet';
							
						} else {
							
							$errors[] = 'error inserting image_id ' . $value . 'paired with imageSet_id ' . $imageSetid . ' into imageImageSet';
						}
						
						
					}
					
					
					
					
					
					
					
					
				}else{
					
					$errors[] = 'cannot create an array of images, perhaps there are no images associated with this set';
					
				}
				
				
				
			}else{
				
				$errors[] = 'could not create images array, potentially no images associated with this set';
				
			}
		
		
	}else{
		
		$errors[] = 'could not copy imageset data';
		
		
	}
	
	

	echo json_encode($errors);
	
	//open a log file
	//append errors with date
	//close
		
	foreach ($data as $key=>$value){

		unset($GLOBALS[$key]);


	}

}else{

	$errors[] = 'No variables passed';
	print_r($errors);

}

$general->endGeneral();
