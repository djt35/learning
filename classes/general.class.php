<?php

require_once 'DataBaseMysql.class.php';



//spl_autoload_unregister ('class_loader');
		
		//require('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/autoload.php');
		//use Vimeo\Vimeo;

class general {


	public $connection;

	public function __construct (){
		$this->connection = new DataBaseMysql();
	}

	//!Sanitise form input and other important functions

	public function sanitiseInput ($data) {

		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;

	}

	public function sanitiseGET ($data) {

		$dataSanitised = array();

		foreach ($data as $key=>$value){

			$sanitisedValue = trim($value);
			$sanitisedValue = stripslashes($sanitisedValue);
			$sanitisedValue = htmlspecialchars($sanitisedValue);

			$dataSanitised[$key] = $sanitisedValue;

		}


		return $dataSanitised;


	}

	public function getVimeoID ($id) {

		$q = "SELECT  `id`, `url`  FROM  `video`  WHERE  `id`  = $id";

		$result = $this->connection->RunQuery($q);

		if ($result){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$vimeoid = $row['url'];


			}

		}


		return  $vimeoid;

	}

	public function getVideoTitle ($id) {

		$q = "SELECT  `id`, `name`  FROM  `video`  WHERE  `id`  = $id";

		$result = $this->connection->RunQuery($q);

		if ($result){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$vimeoid = $row['name'];


			}

		}


		return  $vimeoid;

	}

	public function getChapterSelector ($id) {

		$q = "SELECT a.`id`, a.`split`, b.`id` as `chapterid`, b.`timeFrom`, b.`timeTo`, b.`number`, b.`name` AS `chaptername` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` WHERE a.`id` = $id";

		$result = $this->connection->RunQuery($q);

		if ($result){

			$html = "<br><select id='chapterSelectorVideo{$id}' class='chapterSelector' style='width:100%;'>";

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$chapterid = $row['chapterid'];
				$name = $row['chaptername'];
				$number = $row['number'];

				$html .= "<option value='{$chapterid}'>{$number} - {$name}</option>";

			}

			$html .= "</select>";

		}


		return  $html;

	}

	public function getVideoAndChapterData ($id) {

		$q = "SELECT a.`id`, a.`split`, b.`id` as `chapterid`, b.`timeFrom`, b.`timeTo`, b.`number`, b.`name` AS `chaptername`, b.`description`, d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` WHERE a.`id` = $id";

		$result = $this->connection->RunQuery($q);

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$rows[] = array_map('utf8_encode', $row);
			}

			return json_encode($rows);


		}



	}
	
	public function getVideoData ($id) {

		$q = "SELECT `name`, `description`, `author` FROM `video` WHERE `id` = $id";

		$result = $this->connection->RunQuery($q);

		if ($result){


			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$rows[] = array_map('utf8_encode', $row);
			}
			
			
			
			$author = $rows[0]['author'];
			$authorName = $this->getUserName($author);
			$rows[0]['author'] = $authorName;

			return json_encode($rows);


		}
		
		



	}
	
	public function getUserName ($id){
		
		$q = "SELECT `firstname`, `surname` FROM `users` WHERE `user_id` = $id";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows == 1){

			
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				$firstname = $row['firstname'];
				$surname = $row['surname'];
				
				$user = $firstname . ' ' . $surname;
				
				
			}
		
			return $user;
		}else{
			
			return null;
		}
	}

	public function getTagCategoryName ($id){
		
		$q = "SELECT `tagCategoryName` FROM `tagCategories` WHERE `id` = $id";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows == 1){

			
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				$tagCategoryName = $row['tagCategoryName'];
			
				
				
				
				
			}
		
			return $tagCategoryName;
		}else{
			
			return null;
		}
	}





	public function returnYesNoDBQuery ($q){


		//print_r($q);


		$result = $this->connection->RunQuery($q);

		//print_r($result);

		//IF THERE is a database error return 2

		//IF THERE are no rows affected but no errors return 0

		//IF THERE is one row affected return 1

		if ($result){


			//print_r($this->connection->conn->affected_rows);

			//print_r($this->connection->conn, there is plenty else in this object including error_list as an array and connect_error);

			if ($this->connection->conn->affected_rows == 1){

				return 1;

			} else {

				return 0;

			}

		} else {

			return 2;

		}

	}

	public function returnUpdateQuery ($q){


		//print_r($q);


		$result = $this->connection->RunQuery($q);

		//print_r($result);

		//IF THERE is a database error return 2

		//IF THERE are no rows affected but no errors return 0

		//IF THERE is one row affected return 1

		if ($result){


			//print_r($this->connection->conn->affected_rows);

			//print_r($this->connection->conn);

			if ($this->connection->conn->affected_rows == 1){

				return 1;

			} else {

				return 0;

			}

		} else {

			return 2;

		}

	}

	public function returnWithInsertID($q) {


		//$result = $this->connection->RunQuery($q);

		if ($this->returnYesNoDBQuery($q) == 1){

			return $this->connection->conn->insert_id;

		}else{


			return false;

		}

		//$result = $this->connection->RunQuery($q);


	}



	public function endGeneral (){

		$this->connection->CloseMysql();


	}


	public function makeTable ($q){

		//echo $q;

		$result = $this->connection->RunQuery($q);


		if ($result->num_rows > 0){


			$data = array();

			while($data[] = $result->fetch_array(MYSQLI_ASSOC));



			echo '<table id="dataTable">';

			echo '<tr>';

			foreach ($data as $key=>$value){

				foreach ($value as $k=>$v){
					echo '<th>' . $k . '</th>';
				}

				break;
			}

			echo '</tr>';

			foreach ($data as $k=>$v){


				echo '<tr class="datarow">';

				foreach($v as $key=>$value){


					echo '<td>';
					echo $value;
					echo '</td>';

				}

				echo '</tr>';


			}



			echo '</table>';

		}else{

			echo '<p>Error</p>';
			print_r($this->connection->conn);

		}

	}

	public function makeSearchableTableDelete ($q){

		//echo $q;

		$result = $this->connection->RunQuery($q);


		if ($result->num_rows > 0){


			$data = array();

			

			while($data[] = $result->fetch_array(MYSQLI_ASSOC));

			echo '<table id="dataTable">';

			echo '<tr class="header">';

			foreach ($data as $key=>$value){

				foreach ($value as $k=>$v){
					echo '<th data="' . $k . '">' . $k . '</th>';
				}

				break;
			}

			echo '</tr>';

			$x = 0;

			foreach ($data as $k=>$v){
				if ($v['id']){
					if ($id <> $v['id']){
						echo '</tr>';
						echo '<tr>';
						$x = 0;

					}
				$id = $v['id'];
				$id = trim($id);
				}

				if ($v['user_id']){
					if ($id <> $v['user_id']){
						echo '</tr>';
						echo '<tr>';
						$x = 0;

					}
				$id = $v['user_id'];
				$id = trim($id);
				}
				



				foreach($v as $key=>$value){



					if ($key == 'tagCategories_id'){
						echo '<td class="datarow">';
						echo $this->getTagCategoryName($id);
						echo '</td>';
					}else{

						

							echo '<td class="datarow">';
							echo "$value";
							echo '</td>';

						

					}

					$x++;


				}




			}



			echo '</table>';

		}

	}

	public function makeTableImages ($q, $roothttp){

		//echo $q;
		//$result = $this->connection->RunQuery('USE ESD');
		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){


			$data = array();

			while($data[] = $result->fetch_array(MYSQLI_ASSOC));



			echo '<table id="dataTable">';

			echo '<tr>';

			foreach ($data as $key=>$value){
				echo '<th></th>';
				foreach ($value as $k=>$v){
					echo '<th>' . $k . '</th>';
				}

				break;
			}

			//echo '<th></th>';
			echo '</tr>';

			$x = 0;

			foreach ($data as $k=>$v){

				if ($id <> $v['id']){
					echo '</tr>';
					echo '<tr>';
					$x = 0;

				}

				$id = $v['id'];
				$id = trim($id);



				foreach($v as $key=>$value){



					if ($key == 'url'){
						echo '<td class="datarow">';
						echo "<img class='lslimage' style='max-width:50px;' src='$roothttp/$value'>";
						echo '</td>';
					}else{

						if ($x==0){

							echo '<td>';
							echo "<button class='deleteSet'>Delete</button>";
							echo '</td>';

							echo '<td class="datarow">';
							echo "$value";
							echo '</td>';

						}

					}

					$x++;


				}




			}



			echo '</table>';

		}

	}
	
	public function makeTableImagesv2 ($q, $roothttp){

		//echo $q;
		//$result = $this->connection->RunQuery('USE ESD');
		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){


			$data = array();
			
			

			while($data[] = $result->fetch_array(MYSQLI_ASSOC));
			
			//print_r($data);

			echo '<table id="dataTable">';
			
			echo '<tr>';

			foreach ($data as $key=>$value){
				//echo '<th></th>';
				foreach ($value as $k=>$v){
					
					if ($k == 'url'){
						
						echo '<th>' . 'Thumbnail' . '</th>';
						
					}else if ($k == 'type'){
						
						echo '<th>' . 'Title' . '</th>';
						
					}else{
					
					echo '<th>' . $k . '</th>';
				
					}
				
				
				}
				//echo '<th></th>';
				

				break;
			}

			//echo '<th></th>';
			echo '</tr>';

			$x = 0;

			foreach ($data as $k=>$v){
				//$manipulated = null;
				
				if ($id) {	
					if ($id <> $v['id']){
						echo '<td>';
								echo "<button class='deleteSet'>Delete</button>";
								if (($manipulated != 1)){
								echo "<button class='manipulateSet'>Manipulate</button>";
								}
								//echo '$manipulated is ' . $manipulated;
								echo '</td>';
						
						echo '</tr>';
						echo '<tr>';
						$x = 0;
	
					}
					
				}

				$id = $v['id'];
				$id = trim($id);
				$manipulated = $v['manipulated'];


				foreach($v as $key=>$value){



					if ($key == 'url'){
						echo '<td class="datarow">';
						echo "<img class='lslimage' style='max-width:100px;' src='$roothttp/$value'>";
						echo '</td>';
					}else if ($key == 'author'){
						
						echo '<td class="datarow">';
						echo $this->getUserName($value);
						echo '</td>';
						
						
					}else if ($key == 'approved'){
						
						echo '<td class="datarow">';
							if ($value == NULL){
								
								echo 'pending';
								
							}elseif ($value == '1'){
								
								echo 'accepted';
								
							}elseif ($value == '0'){
								
								echo 'rejected';
								
							}
						echo '</td>';
						
						
					}else if ($key == 'manipulated'){
						
						echo '<td class="datarow">';
							if ($value == NULL){
								
								echo 'No';
								
							}elseif ($value == '1'){
								
								echo 'Yes';
								
							}
						echo '</td>';
						
						
					}else{

						
						
						echo '<td class="datarow">';
							echo trim($value);
							echo '</td>';
						
						

					}

					$x++;


				}




			}



			echo '</table>';

		}

	}
	
	public function makeTableImagesv3 ($q, $roothttp){

		//echo $q;
		//$result = $this->connection->RunQuery('USE ESD');
		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){


			$data = array();
			
			echo '<table id="dataTable">';
			
			echo '<tr>';

			while($data[] = $result->fetch_array(MYSQLI_ASSOC));
			
			foreach ($data as $key=>$value){
				//echo '<th></th>';
				foreach ($value as $k=>$v){
					
					if ($k == 'url'){
						
						echo '<th>' . 'Thumbnail' . '</th>';
						
					}else if ($k == 'type'){
						
						echo '<th>' . 'Title' . '</th>';
						
					}else{
					
					echo '<th>' . $k . '</th>';
				
					}
				
				
				}
				echo '<th></th>';
				echo '<th></th>';
				

				break;
			}

			//echo '<th></th>';
			echo '</tr>';

			$x = 0;

			foreach ($data as $k=>$v){

				if ($id) {	
					if ($id <> $v['id']){
						echo '<td>';
								echo "<button class='deleteSet'>Delete</button>";
								echo '</td>';
						echo '<td>';
								echo "<button class='approveSet'>Approve</button><br><br><button class='reject'>Reject</button>";
								echo '</td>';
						
						echo '</tr>';
						echo '<tr>';
						$x = 0;
	
					}
					
				}

				$id = $v['id'];
				$id = trim($id);



				foreach($v as $key=>$value){



					if ($key == 'url'){
						echo '<td class="datarow">';
						echo "<img class='lslimage' style='max-width:100px;' src='$roothttp/$value'>";
						echo '</td>';
					}else if ($key == 'author'){
						
						echo '<td class="datarow">';
						echo $this->getUserName($value);
						echo '</td>';
						
						
					}else{

						
						
						echo '<td class="datarow">';
							echo trim($value);
							echo '</td>';
						
						

					}

					$x++;


				}




			}



			echo '</table>';

		}else{
			
			echo '<p>There are no user submissions pending approval</p>';
			
		}

	}

	public function makeTableTagManager ($q, $roothttp){

		//echo $q;
		//$result = $this->connection->RunQuery('USE ESD');
		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){


			$data = array();
			
			echo '<table id="dataTable">';
			
			echo '<tr class="header">';

			while($data[] = $result->fetch_array(MYSQLI_ASSOC));
			
			foreach ($data as $key=>$value){
				//echo '<th></th>';
				foreach ($value as $k=>$v){
					
					
					
					echo '<th data="'.$k.'">' . $k . '</th>';
				
					
				
				
				}
				echo '<th>References</th>';
				echo '<th></th>';
				echo '<th></th>';
				

				break;
			}

			//echo '<th></th>';
			echo '</tr>';

			$x = 0;

			foreach ($data as $k=>$v){

				if ($id) {	
					if ($id <> $v['id']){
						
						
							echo '<td>';
							echo $this->getBriefReference($id);
							echo '</td>';
							
							
						
						echo '<td>';
								echo "<button class='reference'>Add reference</button>";
								echo '</td>';
						
						echo '<td>';
								echo "<button class='deleteTag'>Delete</button>";
								echo '</td>';
						
						
						
						echo '</tr>';
						echo '<tr>';
						$x = 0;
	
					}
					
				}

				$id = $v['id'];
				$id = trim($id);



				foreach($v as $key=>$value){



					if ($key == 'url'){
						echo '<td class="datarow">';
						echo "<img class='lslimage' style='max-width:100px;' src='$roothttp/$value'>";
						echo '</td>';
					}else if ($key == 'tagCategories_id'){
						
						echo '<td class="datarow">';
						echo $this->getTagCategoryName($value);
						echo '</td>';
						
						
					}else{

						
						
						echo '<td class="datarow">';
							echo trim($value);
							echo '</td>';
						
						

					}

					$x++;


				}




			}



			echo '</table>';

		}else{
			
			echo '<p>There are no user submissions pending approval</p>';
			
		}

	}


	public function generateFormField ($table){

		$q = "SELECT `COLUMN_NAME` AS `name`, `ORDINAL_POSITION` AS `position`, `CHARACTER_MAXIMUM_LENGTH` AS `length`
	    FROM INFORMATION_SCHEMA.COLUMNS
	            WHERE TABLE_SCHEMA='LearningTool'
	            AND TABLE_NAME = '$table'";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$columns = array();

			while($columns[] = $result->fetch_array(MYSQLI_ASSOC));




			foreach ($columns as $key=>$value){



				foreach ($value as $k=>$v){

					if ($k == 'name'){

						if ($v != 'id'){

							echo 'echo $formv1->generateText(\'';

							echo $v . '\', \'' . $v . '\', ';

							echo '\'\', \'tooltip here\');' . PHP_EOL;

						}

					}


				}



				//echo '\n';


			}



		}






	}

	public function getBriefReference ($id){

		$q = "SELECT b.`id`, c.`authors`, c.`formatted`, c.`DOI` 
		from `tags` as a 
		INNER JOIN `referencesTag` as b on a.`id` = b.`tag_id` 
		INNER JOIN `references` as c on c.`id` = b.`references_id` 
		WHERE a.`id` = $id ";

		//$q = "SELECT `authors`, `formatted`, `DOI` from `references` WHERE `id` = $id";

		//echo $q;

		$references = '';
		$x = 1;
		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$idforthis = $row['id'];
				$references .= '<p class="referenceintable" data="' . $idforthis . '">' . $x . ' - ';
				$references .= mb_substr($row['authors'], 0, 30);
				$references .= ' ,';
				$references .= mb_substr($row['formatted'], 0, 60);
				$references .= ' ,';
				$references .= mb_substr($row['journal'], 0, 30);
				//$references .= ' ,';
				//$references .= mb_substr($row['DOI'], 0, 5);
				$references .= '. </p><br>';
				$x++;
			}


		}

		echo $references;




	}

	public function getFullReferenceList ($tagid){

		$q = "SELECT b.`id`, c.`authors`, c.`formatted`, c.`DOI`, c.`journal`, c.`PMID` 
		from `tags` as a 
		INNER JOIN `referencesTag` as b on a.`id` = b.`tag_id` 
		INNER JOIN `references` as c on c.`id` = b.`references_id` 
		WHERE a.`id` = $tagid ";

		//echo $q;

		//$q = "SELECT `authors`, `formatted`, `DOI` from `references` WHERE `id` = $id";

		//echo $q;

		$references = '';
		$x = 1;
		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$PMID = $row['PMID'];
				$references .= '<p class="referencelist" data="' . $PMID . '" style="text-align:left;" >' . $x . ' - ';
				$references .= $row['authors'];
				$references .= '. ';
				$references .= $row['formatted'];
				$references .= ' ';
				$references .= $row['journal'];
				$references .= ' ';
				if ($row['DOI'] <> ''){

					$references .= $row['DOI'];
					$references .= '.';
				}
				$references .= '</p>';
				
				$x++;
			}

			echo $references;
		}else{

			echo '<p class="left">No references yet</p>';
		}

		




	}


	public function generateLogicValidate ($table){

		$q = "SELECT `COLUMN_NAME` AS `name`, `ORDINAL_POSITION` AS `position`, `CHARACTER_MAXIMUM_LENGTH` AS `length`
	    FROM INFORMATION_SCHEMA.COLUMNS
	            WHERE TABLE_SCHEMA='LearningTool'
	            AND TABLE_NAME = '$table'";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$columns = array();

			while($columns[] = $result->fetch_array(MYSQLI_ASSOC));

			/*
				rules: {

	            timezone: {
	                required: true,
	            },
	            password: {
		            required: true,
		        },
		        password_again: {
				      equalTo: "#password",
				},



		        },
		        messages: {


		            timezone: {
		                required: \'a timezone is required for the user\',


		            },

		        },
		        */
			echo 'rules: {'. PHP_EOL;

			foreach ($columns as $key=>$value){

				//echo 'echo $formv1->generateText(\'text here\', \'';

				foreach ($value as $k=>$v){

					if ($k == 'name'){

						if ($v != 'id'){

							echo $v . ': { required: true },   '. PHP_EOL;
							//echo '<br><br>';

						}

					}


				}

			}

			echo '},';

			echo 'messages: {'. PHP_EOL;

			foreach ($columns as $key=>$value){

				//echo 'echo $formv1->generateText(\'text here\', \'';

				foreach ($value as $k=>$v){

					if ($k == 'name'){

						if ($v != 'id'){

							echo $v . ': { required: \'message\' },   '. PHP_EOL;
							//echo '<br><br>';

						}

					}


				}

			}

			echo '},';

		}






	}

	public function selectTenRandomImageSets ($tagid, $roothttp){

		//echo 'centre passed was ' . $centreid;


		$q = "SELECT a.`id` AS imageid, a.`url`, a.`name`, a.`order`, b.`id` AS tagid
			  FROM `images` as a
			  INNER JOIN `imagesTag` as c ON a.`id` = c.`images_id`
			  INNER JOIN `tags` as b ON b.`id` = c.`tags_id`
				WHERE b.`id` = $tagid
				ORDER BY a.`order` ASC
				";

		//modify this to only allow 8 picture groups in

		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';

			echo "<div class='row'>";

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				/*if ($lesionid == $row['imageid']){ //for imageset

					//do for more images

					$filename = $row['url'];
					//$position = $row['position'];
					$lesionid = $row['imageid'];
					$name = $row['name'];



					echo "<div class='col-1'>";

					echo "<img id='$lesionid' class='lslimage zoom' src='$roothttp/$filename'>";

					echo "</div>";

					$x++;

				}else{*/

				//first time x=0

				//if ($x==0){

				//do initial include define x as 1
				//$x=1;




				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['imageid'];
				$name = $row['name'];

				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				if($x % 4 == 0){echo "<div class='row'>";}

				echo "<div data='$x' class='col-3'>";

				echo "<img id='$lesionid' class='lslimage zoom' src='$roothttp/$filename'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>";}

				$x++;

				continue;


				//}elseif ($x>0){

				//images where there are less than 8 images
				/*
						if ($x>1){



							echo "<div data='$x' class='col-";

							if ($x==2){echo '7';}
							if ($x==3){echo '6';}
							if ($x==4){echo '5';}
							if ($x==5){echo '4';}
							if ($x==6){echo '3';}
							if ($x==7){echo '2';}
							if ($x==8){echo '1';}


							echo "'></div>"; // add remaining columns

							echo "</div>"; // close the row



							$x=1; //reset x

							echo "<div class='row'>";

									$filename = $row['url'];
							//$position = $row['position'];
							$lesionid = $row['imageid'];
							$name = $row['name'];

							echo "<div class='col-2' data='$x'><div class='description'>$name";
							echo "</div>";

							echo "</div>";

							echo "<div data='$x' class='col-1'>";

							echo "<img id='$lesionid' class='lslimage zoom' src='$roothttp/$filename'>";

							//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";

							echo "</div>";

							$x++;
							$y++;

*/


				//}





				//}



				//}



				/*if ($x % 8 == 0){

					echo "</div>";
					echo "<div class='row'>";
					echo "<div class='col-2'></div>";

					} */





			}echo "</div>";



		}

	}
	
	
	public function getHighestRatedImagesCover ($roothttp) {
		
		//$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE c.`type` = 1 LIMIT 12";
		
		$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` WHERE c.`type` = 1 ORDER BY RAND() LIMIT 12";
		

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){
			
			$x = 1;
			
			echo '<div class="row">';
			
			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				if ($row['url'] == $imageSetid){
					
					continue;
					
				}
				
			
				echo '<div class="col-3 coverImages">';
				
					echo "<img class='cover' src='{$roothttp}/{$row['url']}'>";

				echo '</div>';
				
				if ($x % 4 == 0){
					
					echo "</div>";  
					
					echo '<div class="row">';
					
					$x = 1;
					
					continue;
						
					
				}
				
				$x++;
				
				$imageSetid = $row['url'];


			}
			
			echo "</div>";
			

		}
		
		
	}
	
	public function getHighestRatedImagesCoverResection ($roothttp) {
		
		$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE c.`type` = 1 AND e.`tagCategories_id` = 40 LIMIT 12";
		

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){
			
			$x = 1;
			
			echo '<div class="row">';
			
			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				if ($row['url'] == $imageSetid){
					
					continue;
					
				}
				
			
				echo '<div class="col-3 coverImages">';
				
					echo "<img class='cover' src='{$roothttp}/{$row['url']}'>";

				echo '</div>';
				
				if ($x % 4 == 0){
					
					echo "</div>";  
					
					echo '<div class="row">';
					
					$x = 1;
					
					continue;
						
					
				}
				
				$x++;
				
				$imageSetid = $row['url'];


			}
			
			echo "</div>";
			

		}
		
		
	}

	public function getAllTagsInCategoryWithHighestRatedImages ($tagCategoriesid, $roothttp) {


		//shows highest rated (1) images from each tag category

		$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = $tagCategoriesid AND c.`type` = 1 ORDER BY e.`tagName` ASC, `imageSetid` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';
			echo "<hr>";
			echo "<div class='row tagSet'>";


			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				if ($tagName){
					if ($tagName != $row['tagName']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}

				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['imageid'];
				$imageSetid = $row['imageSetid'];
				$name = $row['name'];
				$tagName = $row['tagName'];
				$tags_id = $row['tags_id'];

				//get all the tags for this tag with their category
				//does this show all tags for a specific image


				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				if ($x == 1){echo "<div class='responsiveContainer'><div class='row'><div class='col-8'><h3 style='text-align:left; cursor:pointer;' id='tag{$tags_id}' class='tagLink'>$tagName</h3></div><div class='col-2'><button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button></div></div></div>";}

				if($x % 4 == 0){echo "<div class='row'>";  }

				echo "<div data='$x' class='col-3 coverimages'>";

				echo "<img id='$lesionid' data='imageSet{$imageSetid}' class='lslimage zoom' src='$roothttp/$filename'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>";}

				$x++;

				continue;







			}echo "</div>";

		}

	}

	public function split2($string,$needle,$nth){
		$max = strlen($string);
		$n = 0;
		for($i=0;$i<$max;$i++){
			if($string[$i]==$needle){
				$n++;
				if($n>=$nth){
					break;
				}
			}
		}
		$arr[] = substr($string,0,$i);
$arr[] = substr($string,$i+1,$max);

return $arr;
}

	public function getAllTagsInCategoryWithHighestRatedImagesWatermarkImage ($tagCategoriesid, $roothttp) {


		//shows highest rated (1) images from each tag category

		$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = $tagCategoriesid AND c.`type` = 1 ORDER BY e.`tagName` ASC, `imageSetid` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';
			echo "<hr>";
			echo "<div class='row tagSet'>";


			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				if ($tagName){
					if ($tagName != $row['tagName']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}

				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['imageid'];
				$imageSetid = $row['imageSetid'];
				$name = $row['name'];
				$tagName = $row['tagName'];
				$tags_id = $row['tags_id'];

				//get all the tags for this tag with their category
				//does this show all tags for a specific image


				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				if ($x == 1){echo "<div class='responsiveContainer'><div class='row'><div class='col-8'><h3 style='text-align:left; cursor:pointer;' id='tag{$tags_id}' class='tagLink'>$tagName</h3></div><div class='col-2'><button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button></div></div></div>";}

				if($x % 4 == 0){echo "<div class='row'>";  }

				echo "<div data='$x' class='col-3 coverimages'>";
				$filenameArray = $this->split2($filename, '/', '2');
				echo "<img id='$lesionid' data='imageSet{$imageSetid}' class='lslimage zoom' src='$roothttp/{$filenameArray[0]}/watermarkImage/{$filenameArray[1]}'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>";}

				$x++;

				continue;







			}echo "</div>";

		}

	}

	public function getAllTagsInCategoryWithHighestRatedImagesThumbnailImage ($tagCategoriesid, $roothttp) {


		//shows highest rated (1) images from each tag category

		$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = $tagCategoriesid AND c.`type` = 1 ORDER BY e.`tagName` ASC, `imageSetid` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';
			echo "<hr>";
			echo "<div class='row tagSet'>";


			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				if ($tagName){
					if ($tagName != $row['tagName']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}

				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['imageid'];
				$imageSetid = $row['imageSetid'];
				$name = $row['name'];
				$tagName = $row['tagName'];
				$tags_id = $row['tags_id'];

				//get all the tags for this tag with their category
				//does this show all tags for a specific image


				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				if ($x == 1){echo "<div class='responsiveContainer'><div class='row'><div class='col-8'><h3 style='text-align:left; cursor:pointer;' id='tag{$tags_id}' class='tagLink'>$tagName</h3></div><div class='col-2'><button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button></div></div></div>";}

				if($x % 4 == 0){echo "<div class='row'>";  }

				echo "<div data='$x' class='col-3 coverimages'>";
				$filenameArray = $this->split2($filename, '/', '2');
				echo "<img id='$lesionid' data='imageSet{$imageSetid}' class='lslimage zoom' src='$roothttp/{$filenameArray[0]}/thumbnail/{$filenameArray[1]}'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>";}

				$x++;

				continue;







			}echo "</div>";

		}

	}

	//filter the above function query to get the image ids for each tagCategory

	public function getImageIdsProcedure () {

		//get the tags within the procedure category


		$q = "SELECT e.`tagName`, e.`id` as `tagid` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = 36 AND c.`type` = 1 GROUP BY `tagName` ORDER BY e.`tagName` ASC, b.`imageSet_id` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				$rows[] = array_map('utf8_encode', $row);

			}

			echo '<div id="procedureTags" style="display:none;">' . json_encode($rows) . '</div>';


		}

		//gets image ids of each tag within this category

		$q = "SELECT b.`image_id` as `imageid`, e.`tagName`, e.`id` as `tagid` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = 36 AND c.`type` = 1 ORDER BY e.`tagName` ASC, b.`imageSet_id` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				$rows[] = array_map('utf8_encode', $row);

			}

			echo '<div id="imageMatchProcedure" style="display:none;">' . json_encode($rows) . '</div>';


		}


	}



	public function getTaggedImageSets ($tagid, $roothttp){

		$q = "SELECT a.`id` as imageSetid, b.`image_id` as imageid, c.`url`, c.`name`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` WHERE d.`tags_id` = $tagid ORDER BY imageSetid ASC, c.`order` ASC";

		//modify this to only allow 8 picture groups in

		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';

			echo "<div class='row'>";

			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				if ($imageSetid){
					if ($imageSetid != $row['imageSetid']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<div class='row'>";
						$x=1;

					}
				}

				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['imageid'];
				$imageSetid = $row['imageSetid'];
				$name = $row['name'];

				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				if($x % 4 == 0){echo "<div class='row'>";}

				echo "<div data='$x' class='col-3 coverImages'>";

				echo "<img id='$lesionid' class='lslimage zoom' src='$roothttp/$filename'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>";}

				$x++;

				continue;







			}echo "</div>";



		}

	}

	public function getTaggedImageSetsv2 ($tagid, $roothttp) {


		//shows all images from each tag
		
		//prints only one set of search buttons
		
		//no hrs
		
		//currently sorted by imageSET  $imageSetDescription = $row['imageSetDescription'];

		//$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = $tagCategoriesid AND c.`type` = 1 ORDER BY e.`tagName` ASC, `imageSetid` ASC, c.`order` ASC";

		$q = "SELECT a.`id` as imageSetid, a.`name` as imageSetDescription, a.`type` as imageSetType, b.`image_id` as imageid, c.`url`, c.`name`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` WHERE d.`tags_id` = $tagid ORDER BY imageSetid ASC, c.`order` ASC";



		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';
			echo "<hr>";
			echo "<div class='row tagSet'>";


			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				/* sort by tagset
				if ($tagName){
					if ($tagName != $row['tagName']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}
				
				*/
				
				$imageSetDescription = $row['imageSetDescription'];
				$imageSetType = $row['imageSetType'];

				if ($imageSetid){
					if ($imageSetid != $row['imageSetid']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						echo "<div class='row describer'><div class='col-8'><div class='row'><div class='col-12 imageSetTitle' style='text-align:left;font-size:20px;'><b>$imageSetType</b></div></div><div class='row'><div class='col-12' style='text-align:left;'>$imageSetDescription</div></div></div><div class='col-2'><button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button></div></div></div>";
						$x=1;

					}
				}
				

				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['imageid'];
				$imageSetid = $row['imageSetid'];
				$name = $row['name'];
				$tagName = $row['tagName'];
				$tags_id = $row['tags_id'];
				
				//get all the tags for this tag with their category
				//does this show all tags for a specific image


				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				
				//removed from below line <h3 style='text-align:left; cursor:pointer;' id='tag{$tags_id}' class='tagLink'>$tagName</h3>
				
				
				if ($y == 1){echo "<div class='responsiveContainer'><div class='row describer'><div class='col-8' style='text-align:left;'><div class='row'><div class='col-12 imageSetTitle'  style='text-align:left;font-size:20px;'><b>$imageSetType</b></div></div><div class='row'><div class='col-12' style='text-align:left;'>$imageSetDescription</div></div></div><div class='col-2'><button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button></div></div></div>"; $y=2;}

				if($x % 4 == 0){echo "<div class='row'>";  }

				echo "<div data='$x' class='col-3 coverImages'>";

				echo "<img id='$lesionid' data='imageSet{$imageSetid}' class='lslimage zoom' src='$roothttp/$filename'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>";}

				$x++;

				continue;







			}echo "</div>";

		}

	}
	
	public function getTaggedImageSetsv3 ($imageSetid, $roothttp) {


		//shows all images from each tag
		
		//prints only one set of search buttons
		
		//no hrs
		
		//currently sorted by imageSET

		//$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = $tagCategoriesid AND c.`type` = 1 ORDER BY e.`tagName` ASC, `imageSetid` ASC, c.`order` ASC";

		$q = "SELECT a.`id` as imageSetid, a.`name` as imageSetDescription, b.`image_id` as imageid, c.`url`, c.`name` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` WHERE a.`id` = $imageSetid ORDER BY c.`order` ASC";



		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';
			echo "<hr>";
			echo "<div class='row tagSet'>";


			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				/* sort by tagset
				if ($tagName){
					if ($tagName != $row['tagName']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}
				
				*/
				if ($imageSetid){
					if ($imageSetid != $row['imageSetid']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}
				

				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['imageid'];
				$imageSetid = $row['imageSetid'];
				$name = $row['name'];
				$tagName = $row['tagName'];
				$tags_id = $row['tags_id'];
				$imageSetDescription = $row['imageSetDescription'];

				//get all the tags for this tag with their category
				//does this show all tags for a specific image


				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				
				//removed from below line <h3 style='text-align:left; cursor:pointer;' id='tag{$tags_id}' class='tagLink'>$tagName</h3>
				
				
				if ($y == 1){echo "<div class='responsiveContainer'><div class='row describer'><div class='col-8'></div><div class='col-2'><button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button></div></div><div class='row'>"; $y=2;}

				if($x % 4 == 0 || $x == 0){ }

				echo "<div data='$x' class='col-3'>";

				echo "<img id='$lesionid' data='imageSet{$imageSetid}' class='lslimage zoom' src='$roothttp/$filename'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>"; echo "<div class='row'>"; }

				$x++;

				continue;







			}echo "</div>";echo "</div>";

		}

	}
	
	public function getTaggedImageSetsv3Draft ($imageSetid, $roothttp) {


		//shows all images from each tag
		
		//prints only one set of search buttons
		
		//no hrs
		
		//currently sorted by imageSET

		//$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = $tagCategoriesid AND c.`type` = 1 ORDER BY e.`tagName` ASC, `imageSetid` ASC, c.`order` ASC";

		$q = "SELECT a.`id` as imageSetid, a.`name` as imageSetDescription, b.`image_id` as imageid, c.`url`, c.`name` FROM `imageSetDraft` as a INNER JOIN `imageImageSetDraft` as b ON a.`id` = b.`imageSet_id` INNER JOIN `imagesDraft` as c on b.`image_id` = c.`id` WHERE a.`id` = $imageSetid ORDER BY c.`order` ASC";



		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';
			echo "<hr>";
			echo "<div class='row tagSet'>";


			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				/* sort by tagset
				if ($tagName){
					if ($tagName != $row['tagName']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}
				
				*/
				if ($imageSetid){
					if ($imageSetid != $row['imageSetid']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}
				

				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['imageid'];
				$imageSetid = $row['imageSetid'];
				$name = $row['name'];
				$tagName = $row['tagName'];
				$tags_id = $row['tags_id'];
				$imageSetDescription = $row['imageSetDescription'];

				//get all the tags for this tag with their category
				//does this show all tags for a specific image


				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				
				//removed from below line <h3 style='text-align:left; cursor:pointer;' id='tag{$tags_id}' class='tagLink'>$tagName</h3>
				
				
				if ($y == 1){echo "<div class='responsiveContainer'><div class='row describer'><div class='col-8'></div><div class='col-2'><button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button></div></div><div class='row'>"; $y=2;}

				if($x % 4 == 0 || $x == 0){ }

				echo "<div data='$x' class='col-3'>";

				echo "<img id='$lesionid' data='imageSet{$imageSetid}' class='lslimage zoom' src='$roothttp/$filename'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>"; echo "<div class='row'>"; }

				$x++;

				continue;







			}echo "</div>";echo "</div>";

		}

	}
	
	
	//!video atlas functions
	
	
	public function getVimeoThumb($id)
	{
	$vimeo = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
	print_r($vimeo);
	//echo $small = $vimeo[0]['thumbnail_small'];
	//echo $medium = $vimeo[0]['thumbnail_medium'];
	return $vimeo[0]['thumbnail_large'];
	}


	
	//!--VIDEO --get all videos
	
	public function getAllVideos ($tagCategoriesid, $roothttp) {

		//shows all videos in the tagCategory
		
		//$client = new Vimeo($vimeo_client_id, $vimeo_client_secret, $vimeo_token);
		
		$q = "SELECT a.`id`, a.`url`, d.`tagName`, d.`id` as `tags_id` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e on e.`id` = d.`tagCategories_id` WHERE e.`id` = $tagCategoriesid GROUP BY a.`id` ORDER BY d.`tagName` ASC";
		
		echo $q;
		
		//shows highest rated (1) images from each tag category

		//$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = $tagCategoriesid AND c.`type` = 1 ORDER BY e.`tagName` ASC, `imageSetid` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$x = 1;
			$y = 1;
			$lesionid='';
			echo "<hr>";
			echo "<div class='row tagSet'>";


			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				if ($tagName){
					if ($tagName != $row['tagName']){ //for imageset then reset the row somehow

						echo "</div>";
						echo "<hr>";
						echo "<div class='row tagSet'>";
						//echo "<h3 style='text-align:left;'>$tagName</h3>";
						$x=1;

					}
				}

				$filename = $row['url'];
				//$position = $row['position'];
				$lesionid = $row['id'];
				$imageSetid = $row['imageSetid']; //implement later for videoset
				$name = $row['name'];
				$tagName = $row['tagName'];
				$tags_id = $row['tags_id'];

				//get all the tags for this tag with their category
				//does this show all tags for a specific image


				//echo "<div class='col-2' data='$x'><div class='description'>$name";
				//echo "</div>";

				//echo "</div>";
				if ($x == 1){echo "<div class='responsiveContainer'><div class='row'><div class='col-8'><h3 style='text-align:left; cursor:pointer;' id='tag{$tags_id}' class='tagLink'>$tagName</h3></div><div class='col-2'><button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button></div></div></div>";}

				if($x % 4 == 0){echo "<div class='row'>";  }

				echo "<div data='$x' class='col-3'>";

				$urlThumbnail = $this->getVimeoThumb($filename);
				
				echo "<img id='$lesionid' data='imageSet{$imageSetid}' class='lslimage zoom' src='$urlThumbnail'>";
				//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
				echo "<div class='caption'>$name</div>";
				//echo "</div>";
				echo "</div>";

				if($x % 4 == 0){echo "</div>";}

				$x++;

				continue;







			}echo "</div>";

		}

	}
	
	//filter the above function query to get the video ids for each tagCategory

	public function getVideoIdsProcedure () {

		//get the tags within the procedure category

		$q = "SELECT d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e on e.`id` = d.`tagCategories_id` WHERE e.`id` = 40 GROUP BY `tagName` ORDER BY d.`tagName` ASC";
		
		//$q = "SELECT e.`tagName`, e.`id` as `tagid` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = 36 AND c.`type` = 1 GROUP BY `tagName` ORDER BY e.`tagName` ASC, b.`imageSet_id` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				$rows[] = array_map('utf8_encode', $row);

			}

			echo '<div id="procedureTags" style="display:none;">' . json_encode($rows) . '</div>';


		}

		//gets video ids of each tag within this category

		$q = "SELECT a.`id` as `videoid`, d.`tagName`, d.`id` as `tagid` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e on e.`id` = d.`tagCategories_id` WHERE e.`id` = 40 ORDER BY d.`tagName` ASC";
		
		//$q = "SELECT b.`image_id` as `imageid`, e.`tagName`, e.`id` as `tagid` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = 36 AND c.`type` = 1 ORDER BY e.`tagName` ASC, b.`imageSet_id` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				$rows[] = array_map('utf8_encode', $row);

			}

			echo '<div id="imageMatchProcedure" style="display:none;">' . json_encode($rows) . '</div>';


		}


	}
	
	public function getVideoIdsAnderValAll () {

		//get the tags within the procedure category

		$q = "SELECT d.`id` as `tagid`, d.`tagName` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e on e.`id` = d.`tagCategories_id` WHERE e.`id` = 41 GROUP BY `tagName` ORDER BY d.`tagName` ASC";
		
		//$q = "SELECT e.`tagName`, e.`id` as `tagid` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = 36 AND c.`type` = 1 GROUP BY `tagName` ORDER BY e.`tagName` ASC, b.`imageSet_id` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				$rows[] = array_map('utf8_encode', $row);

			}

			echo '<div id="procedureTags" style="display:none;">' . json_encode($rows) . '</div>';


		}

		//gets video ids of each tag within this category

		$q = "SELECT a.`id` as `videoid`, d.`tagName`, d.`id` as `tagid` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e on e.`id` = d.`tagCategories_id` WHERE e.`id` = 41 ORDER BY d.`tagName` ASC";
		
		//$q = "SELECT b.`image_id` as `imageid`, e.`tagName`, e.`id` as `tagid` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = 36 AND c.`type` = 1 ORDER BY e.`tagName` ASC, b.`imageSet_id` ASC, c.`order` ASC";

		$result = $this->connection->RunQuery($q);

		//print_r($result);

		if ($result->num_rows > 0){

			$tags = array();

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$tagid = $row['tagid'];
				$videoid = $row['videoid'];
				$tagName = $row['tagName'];
				
				$tags[] = array('tagid'=>$tagid, 'videoid'=>$videoid, 'tagName'=>$tagName);
				
				//$rows[] = array_map('utf8_encode', $row);

			}

			echo '<div id="imageMatchProcedure" style="display:none;">' . json_encode($tags) . '</div>';


		}


	}
	
	//functions for images

	public function getAuthorImageSet($imageset){

		$q = "SELECT a.`author` 
		FROM `imageSet` as a 
		WHERE a.`id` = $imageset";




		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			//$columns = array();

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$author = $row['author'];

			}

			return $author;

		}else{

			return FALSE;
		}

	}

	public function setManipulatedImageSet($imageset){

		$q = "UPDATE `imageSet` 
		SET `manipulated`='1'
		WHERE `id` = $imageset";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result){

			return TRUE;

		}else{

			return FALSE;
		}

	}

	public function getFilenamesImageSetid($imageset){

		$q = "SELECT c.`url` 
		FROM `imageSet` as a 
		INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` 
		INNER JOIN `images` as c on b.`image_id` = c.`id`
		WHERE a.`id` = $imageset";


		echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){

			$columns = array();

			while($row = $result->fetch_array(MYSQLI_ASSOC)){

				$columns[] = $row['url'];

			}

			return $columns;

		}else {

			return FALSE;
		}




	}


	//! counting functions
	
	public function countPendingApprovals () {
		
		$q = "SELECT COUNT(`id`) as number
		FROM `imageSetDraft`
		WHERE `approved` IS NULL";

		$result = $this->connection->RunQuery($q);
		
		if ($result->num_rows > 0){

			while($row = $result->fetch_array(MYSQLI_ASSOC)){


				$count = $row['number'];
			}
			
			return $count;

		
		
		}else{
			
			return 0;
			
		}
		
	}

	public function getVideos () {

		
		
		$q = "SELECT `id`, `name`, `url` FROM `video`";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){
			

			$users = array();

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				$id = $row['id'];
				$name = $row['name'];
				$url = $row['url'];
				
				$users[$id] = $name . ' ' . $url;
				
				
			}
		
			return $users;
		}
		




	}

	public function getImageset (){

		$q = "SELECT `id`, `name`, `type` FROM `imageSet`";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){
			

			$users = array();

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				$id = $row['id'];
				$name = $row['name'];
				$type = $row['type'];
				
				$users[$id] = $id . ' ' . $type;
				
				
			}
		
			return $users;
		}



	}

	public function getBlogNewsPosts () {

		$q = "SELECT `id`, `title`, `author`, `imageSet_id`, `dateCreated` from `blog` ORDER BY `dateCreated` DESC LIMIT 5";

		//echo $q;

		$result = $this->connection->RunQuery($q);

		if ($result->num_rows > 0){
			

			$users = array();

			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				$id = $row['id'];
				$title = $row['title'];
				$author = $row['author'];
				$author = $this->getUserName($author);
				$dateCreated = $row['dateCreated'];
				$dateCreated = date( "d/m/Y", strtotime($dateCreated));

				$imageSet_id = $row['imageSet_id'];

				$r = "SELECT `url` from `images` as a inner join `imageImageSet` as b on a.`id` = b.`image_id` inner join `imageSet` as c on b.`imageSet_id` = c.`id` WHERE c.`id` = '$imageSet_id' ORDER BY `order` ASC LIMIT 1";

				//echo $r;

				$result2 = $this->connection->RunQuery($r);

				while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){

					$imageurl = $row2['url'];
					//echo $imageurl;

				}
				//get the first image from this imageSet
				
				$users[] = array('id'=>$id, 'title'=>$title, 'author'=>$author, 'url'=>$imageurl, 'dateCreated'=>$dateCreated);
				
				
			}
		
			return($users);
		}



		





	}
	
	

}



?>