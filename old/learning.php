 <?php  
        $page_title='ACE wiki learning';
        $page_header='(ACE) wiki, learning';
        include ('image_header.php');   
        
?>
    <div id="navi">
      <li><a href="learning.php">Home</a></li>
    
    <li><a href="logout.php"> Logout </a></li>

    </div>

    
</div>
<script src="dist/jquery.vimeo.api.min.js"></script>
<script>
	
   
</script>


<body>   
<div class="content">
	<div id='userDisplay' style='text-align:right;'><?php 
			 $firstname =  $_SESSION['firstname'];
			 $surname = $_SESSION['surname'];
			 $userid = $_SESSION['user_id'];
			 echo "User: $firstname $surname";  ?></div>
<div class="darkClass"></div>
<div id='userID' style='display:none;'><?php echo $_SESSION['user_id'];?></div>
	
			<?php    
			// error_reporting(0);
				define ('MYSQL', '../mysqli_connect_learning.php');
				require (MYSQL);
			
	
			$q = "SELECT * FROM `csp` WHERE userid = '$userid'";
			$r = mysqli_query($dbc, $q);
			$num = mysqli_num_rows($r);
			if ($num > 0){
				 while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
                    $question1apre = $row['question1apre'];
					$question1bpre = $row['question1bpre'];
					$question2pre = $row['question2pre'];
					$question3apre = $row['question3apre'];
					$question3bpre = $row['question3bpre'];
					$question1apost = $row['question1apost'];
					$question1bpost = $row['question1bpost'];
					$question2post = $row['question2post'];
					$question3apost = $row['question3apost'];
					$question3bpost = $row['question3bpost'];
                    }
				if ($question1apre == '' || $question1apre == null) {
					echo "<div id='question1apre' style='display:none;'>0</div>";
				}else{
					echo "<div id='question1apre' style='display:none;'>1</div>";
				}
				if ($question1bpre == '' || $question1bpre == null) {
					echo "<div id='question1bpre' style='display:none;'>0</div>";
				}else{
					echo "<div id='question1bpre' style='display:none;'>1</div>";
				}
				if ($question2pre == '' || $question2pre == null) {
					echo "<div id='question2pre' style='display:none;'>0</div>";
				}else{
					echo "<div id='question2pre' style='display:none;'>1</div>";
				}
				if ($question3apre == '' || $question3apre == null) {
					echo "<div id='question3apre' style='display:none;'>0</div>";
				}else{
					echo "<div id='question3apre' style='display:none;'>1</div>";
				}
				if ($question3bpre == '' || $question3bpre == null) {
					echo "<div id='question3bpre' style='display:none;'>0</div>";
				}else{
					echo "<div id='question3bpre' style='display:none;'>1</div>";
				}
				if ($question1apost == '' || $question1apost == null) {
					echo "<div id='question1apost' style='display:none;'>0</div>";
				}else{
					echo "<div id='question1apost' style='display:none;'>1</div>";
				}
				if ($question1bpost == '' || $question1bpost == null) {
					echo "<div id='question1bpost' style='display:none;'>0</div>";
				}else{
					echo "<div id='question1bpost' style='display:none;'>1</div>";
				}
				if ($question2post == '' || $question2post == null) {
					echo "<div id='question2post' style='display:none;'>0</div>";
				}else{
					echo "<div id='question2post' style='display:none;'>1</div>";
				}
				if ($question3apost == '' || $question3apost == null) {
					echo "<div id='question3apost' style='display:none;'>0</div>";
				}else{
					echo "<div id='question3apost' style='display:none;'>1</div>";
				}
				if ($question3bpost == '' || $question3bpost == null) {
					echo "<div id='question3bpost' style='display:none;'>0</div>";
				}else{
					echo "<div id='question3bpost' style='display:none;'>1</div>";
				}
			}
			else {
				echo "<div id='question1apre' style='display:none;'>0</div>";
				echo "<div id='question1bpre' style='display:none;'>0</div>";
				echo "<div id='question2pre' style='display:none;'>0</div>";
				echo "<div id='question3apre' style='display:none;'>0</div>";
				echo "<div id='question3bpre' style='display:none;'>0</div>";
				echo "<div id='question1apost' style='display:none;'>0</div>";
				echo "<div id='question1bpost' style='display:none;'>0</div>";
				echo "<div id='question2post' style='display:none;'>0</div>";
				echo "<div id='question3apost' style='display:none;'>0</div>";
				echo "<div id='question3bpost' style='display:none;'>0</div>";
				
			}
	
	echo "<div id='pageShowing' style='display: none;'></div>";
	$lastPage = 44;
	echo "<div id='lastPage' style='display: none;'>44</div>";
	echo "<div id='question1preAnswered'>";
	
	
	function generateAudio ($source, $page) {
		echo "<audio class='audio' id='audio$page'><source src='$source'></audio>";
		echo "<p class='pageNumber' style='text-align: right;'>Audio Controls:&nbsp&nbsp<button type='button' class='restartAudio'>Restart</button><button type='button' class='play'>&#9658</button><button type='button' class='pause'>&#9616;&#9616;</button><select class='audioStatus'><option value='0'>Audio Disabled</option><option value='1'>Audio Enabled</option></select><br/><br/>";
		
	}
	
	
	echo "</div>";
	
	
	
	echo "<div id='intro' style='text-align: center;'>";
	//echo "<h2>Welcome to our Cold Snare Polypectomy Learning tool</h2>";
	echo "<img src='includes/Slide01.jpg' class='slide'><br/><br/>";
	echo "<button type='button' id='startShow'>Start</button>";
	echo "</div>"; ?>
	

	
	<?php
	echo "<div id='1' style='display: none; text-align: center;'>";
	echo "<div class='video' style='text-align: centre'><iframe id='video1' src='https://player.vimeo.com/video/231129179' width='700' height='504' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<br/><br/>Page 1 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='2' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide02.jpg' class='slide'>";
	if (!isset($question1apre) || !isset($question1bpre)) {
	echo "<div class='question1'><br/><br/><button type='button' class='q1'>Answer Question</button></div>";}
	else {
	echo "<div class='answered1'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	}
	echo "<div class='answered1' style='display:none;'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	echo "<div class=\"dropdown-content\" id=\"pretest1\" style='display: none; text-align: center;'>";
	
	echo "<h3>Pre-test Question 1</h3><br/>";
	echo "<div id='errorq1' class='error'></div><br/>";
	echo "<p>a) Is this polyp amenable to cold snare polypectomy?<br/><br/><form id='pretestForm1'><select name='question1apre' id='question1a' class='question1select'><option hidden selected><option value='0'>No</option><option value='1'>Yes</option></select> </p>";
	echo "<p>b) What snare would you select preferentially for cold snare polypectomy of this lesion?<br/><br/><select name='question1bpre' id='question1b' class='question1select'><option hidden selected><option value='1'>Thick wire snare</option><option value='2'>Thin wire snare</option><option value='3'>Wire thickness should not make a difference</option></select></form> </p><br/><br/>";
	echo "<button type='button' class='close'>Close window</button>&nbsp&nbsp&nbsp";
	echo "<button type='button' class='submitQuestion1'>Submit Answers</button>";

	echo "</div>";

	
	
	echo "<p class='pageNumber' style='text-align: right;'>Page 2 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='3' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide03.jpg' class='slide'>";
	if (!isset($question2pre)) {
	echo "<div class='question2'><br/><br/><button type='button' class='q2'>Answer Question</button></div>";}
	else {
	echo "<div class='answered2'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	}
	echo "<div class='answered2' style='display:none;'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	echo "<div class=\"dropdown-content\" id=\"pretest2\" style='display: none; text-align: center;'>";
	
	echo "<h3>Pre-test Question 2</h3><br/>";
	echo "<div id='errorq2' class='error'></div><br/>";
	echo "<p>Based on the image do you believe the lesion has been completely excised?<br/><br/><select name='question2pre' id='question2pre' class='question2select'><option hidden selected><option value='0'>No</option><option value='1'>Yes</option></select> </p>";
	echo "<button type='button' class='close'>Close window</button>&nbsp&nbsp&nbsp";
	echo "<button type='button' class='submitQuestion2'>Submit Answers</button>";

	echo "</div>";

	
	echo "<p class='pageNumber' style='text-align: right;'>Page 3 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='4' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide04.jpg' class='slide'>";
	if (!isset($question3apre) || !isset($question3bpre)) {
	echo "<div class='question3'><br/><br/><button type='button' class='q3'>Answer Question</button></div>";}
	else {
	echo "<div class='answered3'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	}
	echo "<div class='answered3' style='display:none;'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	echo "<div class=\"dropdown-content\" id=\"pretest3\" style='display: none; text-align: center;'>";
	echo "<h3>Pre-test Question 3</h3><br/>";
	echo "<div id='errorq3' class='error'></div><br/>";
	echo "<p>a) Is the protuberance shown in the image of clinical significance?<br/><br/><select name='question3apre' id='question3a' class='question3select'><option hidden selected><option value='0'>No</option><option value='1'>Yes</option></select> </p>";
	echo "<p>b) Should one resect this protuberance with a hot snare?<br/><br/><select name='question3bpre' id='question3b' class='question3select'><option hidden selected><option value='0'>No</option><option value='1'>Yes</option></select> </p><br/><br/>";
	echo "<button type='button' class='close'>Close window</button>&nbsp&nbsp&nbsp";
	echo "<button type='button' class='submitQuestion3'>Submit Answers</button>";
	echo "</div>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 4 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='5' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide05.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide5.mp3', '5');
	echo "<p class='pageNumber' style='text-align: right;'>Page 5 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='6' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide06.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide6.mp3', '6');
	echo "<p class='pageNumber' style='text-align: right;'>Page 6 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='7' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide07.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide7.mp3', '7');
	echo "<p class='pageNumber' style='text-align: right;'>Page 7 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='8' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide08.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide8.mp3', '8');
	echo "<p class='pageNumber' style='text-align: right;'>Page 8 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='9' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide09.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide9.mp3', '9');
	echo "<p class='pageNumber' style='text-align: right;'>Page 9 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='10' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide10.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide10.mp3', '10');
	echo "<p class='pageNumber' style='text-align: right;'>Page 10 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='11' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide11.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide11.mp3', '11');
	echo "<p class='pageNumber' style='text-align: right;'>Page 11 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='12' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide12.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide12.mp3', '12');
	echo "<p class='pageNumber' style='text-align: right;'>Page 12 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='13' style='display: none; text-align: center;'>";
	echo "<h3>CSP: Proper Technique</h3>";
	echo "<div class='video' style='text-align: centre'><iframe id='video13' src='https://player.vimeo.com/video/231185913' width='700' height='504' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 13 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='14' style='display: none; text-align: center;'>";
	echo "<h3>CSP: Common Mistakes</h3>";
	echo "<div class='video' style='text-align: centre'><iframe id='video14' src='https://player.vimeo.com/video/231193422' width='700' height='504' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 14 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='15' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide15.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 15 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='16' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide16.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
		generateAudio ('includes/slide16.mp3', '16');
	echo "<p class='pageNumber' style='text-align: right;'>Page 16 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='17' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide17.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide17.mp3', '17');
	echo "<p class='pageNumber' style='text-align: right;'>Page 17 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='18' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide18.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	generateAudio ('includes/slide18.mp3', '18');
	echo "<p class='pageNumber' style='text-align: right;'>Page 18 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='19' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide19.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
		generateAudio ('includes/slide19.mp3', '19');

	echo "<p class='pageNumber' style='text-align: right;'>Page 19 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='20' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide20.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 20 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='21' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide21.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 21 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='22' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide22.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 22 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='23' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide23.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 23 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='24' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide24.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 24 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='25' style='display: none; position:relative; text-align: center;'>";
	echo "<img src='includes/Slide25.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<div style='position:absolute;right:0px;bottom:0px;width: 45%;overflow: none;z-index:1;'>";
	echo "<div class='video' style='text-align: centre'><iframe id='video25' src='https://player.vimeo.com/video/231194101' width='350' height='252' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 25 of $lastPage</p>";
	echo "</div></div>";
	
	echo "<div id='26' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide26.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 26 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='27' style='display: none; position:relative; text-align: center;z-index:2;'>";
	echo "<img src='includes/Slide27.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<div style='position:absolute;right:0px;bottom:0px;width: 45%;overflow: none;z-index:1;'>";
	echo "<div class='video' style='text-align: centre'><iframe id='video27' src='https://player.vimeo.com/video/231192524' width='350' height='252' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 27 of $lastPage</p>";
	echo "</div></div>";
	
	echo "<div id='28' style='display: none; none; position:relative; text-align: center;'>";
	echo "<img src='includes/Slide28.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<div style='position:absolute;right:0px;bottom:0px;width: 45%;overflow: none;z-index:1;'>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 28 of $lastPage</p>";
	echo "</div></div>";
	
	echo "<div id='29' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide29.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 29 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='30' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide30.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 30 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='31' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide31.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 31 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='32' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide32.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 32 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='33' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide33.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 33 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='34' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide34.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 34 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='35' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide35.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 35 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='36' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide36.jpg' class='slide'>";
	if (!isset($question1apost) || !isset($question1bpost)) {
	echo "<div class='question1post'><br/><br/><button type='button' class='q1post'>Answer Question</button></div>";}
	else {
	echo "<div class='answered1post'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	}
	echo "<div class='answered1post' style='display:none;'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	echo "<div class=\"dropdown-content\" id=\"posttest1\" style='display: none; text-align: center;'>";
	
	echo "<h3>Post-test Question 1</h3><br/>";
	echo "<div id='errorq1post' class='error'></div><br/>";
	echo "<p>a) Is this polyp amenable to cold snare polypectomy?<br/><br/><form id='posttestForm1'><select name='question1apost' id='question1apost' class='question1postselect'><option hidden selected><option value='0'>No</option><option value='1'>Yes</option></select> </p>";
	echo "<p>b) What snare would you select preferentially for cold snare polypectomy of this lesion?<br/><br/><select name='question1bpost' id='question1bpost' class='question1postselect'><option hidden selected><option value='1'>Thick wire snare</option><option value='2'>Thin wire snare</option><option value='3'>Wire thickness should not make a difference</option></select></form> </p><br/><br/>";
	echo "<button type='button' class='close'>Close window</button>&nbsp&nbsp&nbsp";
	echo "<button type='button' class='submitQuestion1post'>Submit Answers</button>";

	echo "</div>";

	
	
	echo "<p class='pageNumber' style='text-align: right;'>Page 36 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='37' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide37.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 37 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='38' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide38.jpg' class='slide'>";
	if (!isset($question2post)) {
	echo "<div class='question2post'><br/><br/><button type='button' class='q2post'>Answer Question</button></div>";}
	else {
	echo "<div class='answered2post'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	}
	echo "<div class='answered2post' style='display:none;'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	echo "<div class=\"dropdown-content\" id=\"posttest2\" style='display: none; text-align: center;'>";
	
	echo "<h3>Post-test Question 2</h3><br/>";
	echo "<div id='errorq2post' class='error'></div><br/>";
	echo "<p>Based on the image do you believe the lesion has been completely excised?<br/><br/><select name='question2post' id='question2post' class='question2selectpost'><option hidden selected><option value='0'>No</option><option value='1'>Yes</option></select> </p>";
	echo "<button type='button' class='close'>Close window</button>&nbsp&nbsp&nbsp";
	echo "<button type='button' class='submitQuestion2post'>Submit Answers</button>";

	echo "</div>";

	
	
	echo "<p class='pageNumber' style='text-align: right;'>Page 38 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='39' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide39.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 39 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='40' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide40.jpg' class='slide'>";
	if (!isset($question3apost) || !isset($question3bpost)) {
	echo "<div class='question3post'><br/><br/><button type='button' class='q3post'>Answer Question</button></div>";}
	else {
	echo "<div class='answered3post'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	}
	echo "<div class='answered3post' style='display:none;'><button type='button' class='back'>Previous page</button>";	
	echo "<button type='button' class='next'>Next page</button></div>";
	echo "<div class=\"dropdown-content\" id=\"posttest3\" style='display: none; text-align: center;'>";
	
	echo "<h3>Post-test Question 3</h3><br/>";
	echo "<div id='errorq3post' class='error'></div><br/>";
	echo "<p>a) Is the protuberance shown in the image of clinical significance?<br/><br/><select name='question3apost' id='question3apost' class='question3selectpost'><option hidden selected><option value='0'>No</option><option value='1'>Yes</option></select> </p>";
	echo "<p>b) Should one resect this protuberance with a hot snare?<br/><br/><select name='question3bpost' id='question3bpost' class='question3selectpost'><option hidden selected><option value='0'>No</option><option value='1'>Yes</option></select> </p>";
	echo "<button type='button' class='close'>Close window</button>&nbsp&nbsp&nbsp";
	echo "<button type='button' class='submitQuestion3post'>Submit Answers</button>";

	echo "</div>";

	
	
	echo "<p class='pageNumber' style='text-align: right;'>Page 40 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='41' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide41.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 41 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='42' style='display: none; text-align: center;'>";
	echo "<br/><br/><table>";
	echo "<tr>";
	echo "<th>Question</th>";
	echo "<th>Pre-test</th>";
	echo "<th>Post-test</th>";
	echo "<th>Change</th>";
	echo "</tr>";
	
	$q = "SELECT * FROM `csp` WHERE userid = '$userid'";
			$r = mysqli_query($dbc, $q);
			$num = mysqli_num_rows($r);
			if ($num > 0){ 
				while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
					$question1apre = $row['question1apre'];
					$question1bpre = $row['question1bpre'];
					$question2pre = $row['question2pre'];
					$question3apre = $row['question3apre'];
					$question3bpre = $row['question3bpre'];
					$question1apost = $row['question1apost'];
					$question1bpost = $row['question1bpost'];
					$question2post = $row['question2post'];
					$question3apost = $row['question3apost'];
					$question3bpost = $row['question3bpost'];
                    }
					echo "<tr>";
					echo "<td>";
					echo "1 a) Is this polyp amenable to CSP?";
					echo "</td>";
					echo "<td>";
						if ($question1apre == 1){
							echo 'Correct'; 
							$question1apreCorrect = 1;
						}
						else {
							echo 'Incorrect'; 
							$question1apreCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if ($question1apost == 1){
							echo 'Correct'; 
							$question1apostCorrect = 1;
						}else{
							echo 'Incorrect'; 
							$question1apostCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if (($question1apostCorrect == 1) && ($question1apreCorrect == 1)){
							echo 'no change';
						}
						elseif (($question1apostCorrect == 1) && ($question1apreCorrect == 0)) {
							echo 'improved';
						}
						elseif (($question1apostCorrect == 0) && ($question1apreCorrect == 1)) {
							echo 'worsened';
						}
					echo "</td>";
					echo "</tr>";
				
					echo "<tr>";
					echo "<td>";
					echo "1 b) Which is the most appropriate snare for CSP?";
					echo "</td>";
					echo "<td>";
						if ($question1bpre == 2){
							echo 'Correct'; 
							$question1bpreCorrect = 1;
						}
						else {
							echo 'Incorrect'; 
							$question1bpreCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if ($question1bpost == 2){
							echo 'Correct'; 
							$question1bpostCorrect = 1;
						}else{
							echo 'Incorrect'; 
							$question1bpostCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if (($question1bpostCorrect == 1) && ($question1bpreCorrect == 1)){
							echo 'no change';
						}
						elseif (($question1bpostCorrect == 1) && ($question1bpreCorrect == 0)) {
							echo 'improved';
						}
						elseif (($question1bpostCorrect == 0) && ($question1bpreCorrect == 1)) {
							echo 'worsened';
						}
					echo "</td>";
					echo "</tr>";
				
					echo "<tr>";
					echo "<td>";
					echo "2 Do you believe the polyp has been completely removed?";
					echo "</td>";
					echo "<td>";
						if ($question2pre == 1){
							echo 'Correct'; 
							$question2preCorrect = 1;
						}
						else {
							echo 'Incorrect'; 
							$question2preCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if ($question2post == 1){
							echo 'Correct'; 
							$question2postCorrect = 1;
						}else{
							echo 'Incorrect'; 
							$question2postCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if (($question2postCorrect == 1) && ($question2preCorrect == 1)){
							echo 'no change';
						}
						elseif (($question2postCorrect == 1) && ($question2preCorrect == 0)) {
							echo 'improved';
						}
						elseif (($question2postCorrect == 0) && ($question2preCorrect == 1)) {
							echo 'worsened';
						}
					echo "</td>";
					echo "</tr>";
				
					echo "<tr>";
					echo "<td>";
					echo "3a Is the protuberance significant?";
					echo "</td>";
					echo "<td>";
						if ($question3apre == 1){
							echo 'Correct'; 
							$question3apreCorrect = 1;
						}
						else {
							echo 'Incorrect'; 
							$question3apreCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if ($question3apost == 1){
							echo 'Correct'; 
							$question3apostCorrect = 1;
						}else{
							echo 'Incorrect'; 
							$question3apostCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if (($question3apostCorrect == 1) && ($question3apreCorrect == 1)){
							echo 'no change';
						}
						elseif (($question3apostCorrect == 1) && ($question3apreCorrect == 0)) {
							echo 'improved';
						}
						elseif (($question3apostCorrect == 0) && ($question3apreCorrect == 1)) {
							echo 'worsened';
						}
					echo "</td>";
					echo "</tr>";
				
					echo "<tr>";
					echo "<td>";
					echo "3b Should you remove the protuberance by hot snare polypectomy?";
					echo "</td>";
					echo "<td>";
						if ($question3bpre == 1){
							echo 'Correct'; 
							$question3bpreCorrect = 1;
						}
						else {
							echo 'Incorrect'; 
							$question3bpreCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if ($question3bpost == 1){
							echo 'Correct'; 
							$question3bpostCorrect = 1;
						}else{
							echo 'Incorrect'; 
							$question3bpostCorrect = 0;
						}
					echo "</td>";
					echo "<td>";
						if (($question3bpostCorrect == 1) && ($question3bpreCorrect == 1)){
							echo 'no change';
						}
						elseif (($question3bpostCorrect == 1) && ($question3bpreCorrect == 0)) {
							echo 'improved';
						}
						elseif (($question3bpostCorrect == 0) && ($question3bpreCorrect == 1)) {
							echo 'worsened';
						}
					echo "</td>";
					echo "</tr>";
					}else {
				
				echo "<br/> Not all questions answered</br>";
			}
	
	echo "</table>";
	echo "<p>Pre-test score = ";
	$pretestScore = +$question1apreCorrect + +$question1bpreCorrect + +$question2preCorrect + +$question3apreCorrect + +$question3bpreCorrect;
	echo "$pretestScore/5</p>";
	echo "<div id='pretestScore' style='display:none;'>$pretestScore</div>";
	
	echo "<p>Post-test score = ";
	$posttestScore = +$question1apostCorrect + +$question1bpostCorrect + +$question2postCorrect + +$question3apostCorrect + +$question3bpostCorrect;
	echo "$posttestScore/5</p>";
	echo "<div id='posttestScore' style='display:none;'>$posttestScore</div>";
	
	echo "<p>Change in score = ";
	$changeScore = $posttestScore - $pretestScore;
	echo "<div id='changeScore' style='display:none;'>$changeScore</div>";
	$percentImprovement = ($changeScore/5)*100;
	echo "<div id='percentImprovement' style='display:none;'>$percentImprovement</div>";
	echo "$changeScore ($percentImprovement%)</p>";
	
	
	
	/*
	
	do this as AJAX
	write scores to database
	overallPre = $pretestScore
	overallPost = $posttestScore
	changeScore = $changeScore
	$percentImprobement = percentImprovement
	
	*/
	
	
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 42 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='43' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide42.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 43 of $lastPage</p>";
	echo "</div>";
	
	echo "<div id='44' style='display: none; text-align: center;'>";
	echo "<img src='includes/Slide43.jpg' class='slide'>";
	echo "<br/><br/><button type='button' class='back'>Previous page</button>";
	echo "<button type='button' class='next'>Next page</button>";
	echo "<button type='button' class='restartShow'>Restart Learning Tool</button>";
	echo "<p class='pageNumber' style='text-align: right;'>Page 44 of $lastPage</p>";
	echo "</div>";
	
		?>
		
	
	
	
	</form>
	
	<div class="img2text" style="color:white; display:none;">
				<h1>Paris 0-IIaIs LSL extending over a colonic fold</h1>
					<h3> removed by EMR dissection technique</h3>

				</div> 
	
<div id="Style1" style="display:none;">
			
	</div>
 
  <div id="Style2"> 
			
	</div> 
  
 <div id="Style3" style="display:none;">
    

</div>
    
    </div>
</body>
<script>

var audioStatus = 1;	
		
function missingErrors (inputArray) {
    
  //  if required selects are empty
  //    print a message in the field
    
    //then check all message fields, if all empty allow submit.
    var x;
    var errors = 0;
    for (x in inputArray) {
        if ($(inputArray[x]).val() == '' || $(inputArray[x]).val() == null) {
                    errors++;
        }}

	return errors;
        
}; 
	
//var audio = new Audio('includes/hello.mp3');

	
	
function loadImages () {
	var lesionid=$('#lesionid')
	 .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text(); 
	
	if (lesionid) {
	
	$.ajax({
        url: 'get_images_view.php',
        type: 'POST',
        data: 'LesionID='+lesionid,
        cache: false,
        success: function(data, textStatus, jqXHR)
        {
            if(typeof data.error === 'undefined')
            {
                console.log('SUCCESS: grabbed images ' + data);
				$('#Style2').html(data);
            }
            else
            {
                // Handle errors here
                console.log('ERRORS: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
        },
        complete: function()
        {
            // STOP LOADING SPINNER
        }
    });
	}
	
	
}
	
function updateScore () {
	
	var userID = $("#userID").clone().children().remove().end().text(); 
	var pretestScore = $('#pretestScore').clone().children().remove().end().text(); 
	var posttestScore = $('#posttestScore').clone().children().remove().end().text();
	var changeScore = $('#changeScore').clone().children().remove().end().text();
	var percentImprovement = $('#percentImprovement').clone().children().remove().end().text();
	
	request = $.ajax({
				url: "submitscores.php",
				type: "post",
				data: "&userid="+userID+"&overallPre="+pretestScore+"&overallPost="+posttestScore+"&changeScore="+changeScore+"&percentImprovement="+percentImprovement   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				if (response == 1){
				console.log('scores saved');
				return;
				}else{
				console.log('scores not saved '+response);
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
	
	
	
	
}
	
	function checkSummarySubmit () {

	if ($('#pageShowing').html() == '42'){
		
		request = $.ajax({
				url: "checkSubmit.php",
				type: "post",
				data: "&userid="+userID  	 		
			});

			request.done(function (response, textStatus, jqXHR){
				if (response == 1){
					updateScore();
					console.log('score updated');
				}else{
					
					console.log('no need to update score');
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
		
		
	}else{
		console.log('triggered but page not 42');
	}


}
	
	
$(document).ready(function() {
	

	$(document).ajaxStart(function(){
        $("#loader").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#loader").css("display", "none");
    });
    

	
$('#startShow').on('click', function() {

	$('#intro').hide();
	$('#1').show();
	$('#pageShowing').html('1');
	 $("#video1").vimeo("play");

})
	
$('.back').on('click', function() {

	var currentPage = $('#pageShowing').html();
	console.log('Current page defined as'+currentPage);
	targetPage = currentPage - 1;
	console.log('Target page defined as'+targetPage);
	
	
	
	if (targetPage == 0) {
		targetPage = 'intro';
		$('.audio').trigger('pause');

	}
	
	$('.audio').trigger('pause');
	$('#'+currentPage).hide();
	$('#'+targetPage).show();
	
	if($("#audio" + currentPage).length > 0) {
	$('#audio'+currentPage).trigger('pause');
	$('#audio'+currentPage).prop("currentTime",0);
	}
	
	if($("#audio" + targetPage).length > 0) {
		if (audioStatus == '1'){
		$('#audio'+targetPage).trigger('play');
		}
	}
	
	if($("#video" + currentPage).length > 0) {
	$('#video'+currentPage).vimeo('pause');
	}
	
	
	if($("#video" + targetPage).length > 0) {
	$('#video'+targetPage).vimeo('play');
	}
	
	$('#pageShowing').html(targetPage);
	
	if (audioStatus=='1'){
		$('.audioStatus option[value=1]').prop('selected', 'selected');
	}
	if (audioStatus=='0'){
		$('.audioStatus option[value=0]').prop('selected', 'selected');
	}
	
	checkSummarySubmit();

})

$('.next').on('click', function() {

	var currentPage = $('#pageShowing').html();
	var lastPage = $('#lastPage').html();
	lastPage++;
	console.log('Current page defined as'+currentPage);
	targetPage = +currentPage + 1;
	console.log('Target page defined as'+targetPage);
	
	if (targetPage == lastPage) {
		alert('End of the Learning Tool.  Please select another link');
		$('.audio').trigger('pause');

		return;
	}
	
	
	$('#'+currentPage).hide();
	$('#'+targetPage).show();
	
	if($("#audio" + currentPage).length > 0) {
	$('#audio'+currentPage).trigger('pause');
	$('#audio'+currentPage).prop("currentTime",0);
	}
	
	if($("#audio" + targetPage).length > 0) {
	if (audioStatus == '1'){
		$('#audio'+targetPage).trigger('play');
		}
	}
	
	
	if($("#video" + currentPage).length > 0) {
	$('#video'+currentPage).vimeo('pause');
	}
	
	
	if($("#video" + targetPage).length > 0) {
	$('#video'+targetPage).vimeo('play');
	}
	

	$('#pageShowing').html(targetPage);
	
	
	if (audioStatus=='1'){
		$('.audioStatus option[value=1]').prop('selected', 'selected');
	}
	if (audioStatus=='0'){
		$('.audioStatus option[value=0]').prop('selected', 'selected');
	}
	
	
	checkSummarySubmit();

})
	
$('.q1').on('click', function() {

	$('.darkClass').show();
	$('#pretest1').show();


})	
	
$('.close').on('click', function() {

	$('.dropdown-content').hide();
	$('.darkClass').hide();


})	
	
	
$('.submitQuestion1').on('click', function() {

	var formInputs = $('.question1select');
		var post = formInputs.serialize();
	 	var userID = $("#userID")
        .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text(); 
		console.log('post contains '+post);
  
	var errors = 0;
	$.each(formInputs, function() {
		
		if ($(this).val() == null || $(this).val() == '') {
			errors++;
		}
		
		return errors;
		
	})
	
	if (errors > 0) {
		$('#errorq1').html('Please answer both questions to proceed').css("color","red");
	}else{
		request = $.ajax({
				url: "submitquestions_initial.php",
				type: "post",
				data: "&userid="+userID+"&"+post   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				if (response == 1){
				alert('Answers saved');
				/*$('#errorq1').html('Answers Saved').css("color","red").delay(100);*/
				$('.dropdown-content').hide();
				$('.darkClass').hide();
				$('.question1').hide();
				$('.answered1').show();
				$('#2').hide();
				$('#3').show();
				$('#pageShowing').html(3);
				return;
				}
				else{
				$('#errorq1').html('Something went wrong, try again').css("color","red");
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
		
	}
	

})	
	
$('.q2').on('click', function() {

	$('.darkClass').show();
	$('#pretest2').show();


})		
	
	
$('.submitQuestion2').on('click', function() {

	var formInputs = $('.question2select');
		var post = formInputs.serialize();
	 	var userID = $("#userID")
        .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text(); 
		console.log('post contains '+post);
  
	var errors = 0;
	$.each(formInputs, function() {
		
		if ($(this).val() == null || $(this).val() == '') {
			errors++;
		}
		
		return errors;
		
	})
	
	if (errors > 0) {
		$('#errorq2').html('Please answer the question to proceed').css("color","red");
	}else{
		request = $.ajax({
				url: "submitquestions.php",
				type: "post",
				data: "&userid="+userID+"&"+post   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				if (response == 1){
				alert('Answer saved');
				$('.dropdown-content').hide();
				$('.darkClass').hide();
				$('.question1').hide();
				$('.answered1').show();
				$('#3').hide();
				$('#4').show();
				$('#pageShowing').html(4);
				return;
				}else{
					
				$('#errorq2').html('Something went wrong, please try again').css("color","red");	
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
		
	}


})	
	
$('.q3').on('click', function() {

	$('.darkClass').show();
	$('#pretest3').show();


})		
	
	
$('.submitQuestion3').on('click', function() {

        var formInputs = $('.question3select');
		var post = formInputs.serialize();
	 	var userID = $("#userID")
        .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text(); 
		console.log('post contains '+post);
  
	var errors = 0;
	$.each(formInputs, function() {
		
		if ($(this).val() == null || $(this).val() == '') {
			errors++;
		}
		
		return errors;
		
	})
	
	if (errors > 0) {
		$('#errorq3').html('Please answer the question to proceed').css("color","red");
	}else{
		request = $.ajax({
				url: "submitquestions.php",
				type: "post",
				data: "&userid="+userID+"&"+post   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				if (response == 1){
				alert('Answer saved');
				$('.dropdown-content').hide();
				$('.darkClass').hide();
				$('.question3').hide();
				$('.answered3').show();
				$('#4').hide();
				$('#5').show();
				$('#pageShowing').html(5);
				return;
				}else{
					
				$('#errorq3').html('Something went wrong, please try again').css("color","red");	
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
		
	}

})
	
$('.q1post').on('click', function() {

	$('.darkClass').show();
	$('#posttest1').show();


})
	
$('.submitQuestion1post').on('click', function() {

	var formInputs = $('.question1postselect');
		var post = formInputs.serialize();
	 	var userID = $("#userID")
        .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text(); 
		console.log('post contains '+post);
  
	var errors = 0;
	$.each(formInputs, function() {
		
		if ($(this).val() == null || $(this).val() == '') {
			errors++;
		}
		
		return errors;
		
	})
	
	if (errors > 0) {
		$('#errorq1post').html('Please answer the question to proceed').css("color","red");
	}else{
		request = $.ajax({
				url: "submitquestions.php",
				type: "post",
				data: "&userid="+userID+"&"+post   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				if (response == 1){
				alert('Answer saved');
				$('.dropdown-content').hide();
				$('.darkClass').hide();
				$('.question1post').hide();
				$('.answered1post').show();
				$('#36').hide();
				$('#37').show();
				$('#pageShowing').html(37);
				return;
				}else{
					
				$('#errorq1post').html('Something went wrong, please try again').css("color","red");	
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
		
	}


})	
	
$('.q2post').on('click', function() {

	$('.darkClass').show();
	$('#posttest2').show();


})
	
$('.submitQuestion2post').on('click', function() {

	var formInputs = $('.question2selectpost');
		var post = formInputs.serialize();
	 	var userID = $("#userID")
        .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text(); 
		console.log('post contains '+post);
  
	var errors = 0;
	$.each(formInputs, function() {
		
		if ($(this).val() == null || $(this).val() == '') {
			errors++;
		}
		
		return errors;
		
	})
	
	if (errors > 0) {
		$('#errorq2post').html('Please answer the question to proceed').css("color","red");
	}else{
		request = $.ajax({
				url: "submitquestions.php",
				type: "post",
				data: "&userid="+userID+"&"+post   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				if (response == 1){
				alert('Answer saved');
				$('.dropdown-content').hide();
				$('.darkClass').hide();
				$('.question2post').hide();
				$('.answered2post').show();
				$('#38').hide();
				$('#39').show();
				$('#pageShowing').html(39);
				return;
				}else{
					
				$('#errorq2post').html('Something went wrong, please try again').css("color","red");
				console.log(response);
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
		
	}


})
	
$('.q3post').on('click', function() {

	$('.darkClass').show();
	$('#posttest3').show();


})

$('.submitQuestion3post').on('click', function() {

	var formInputs = $('.question3selectpost');
		var post = formInputs.serialize();
	 	var userID = $("#userID")
        .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text(); 
		console.log('post contains '+post);
  
	var errors = 0;
	$.each(formInputs, function() {
		
		if ($(this).val() == null || $(this).val() == '') {
			errors++;
		}
		
		return errors;
		
	})
	
	if (errors > 0) {
		$('#errorq3post').html('Please answer the question to proceed').css("color","red");
	}else{
		request = $.ajax({
				url: "submitquestions.php",
				type: "post",
				data: "&userid="+userID+"&"+post   	 		
			});

			request.done(function (response, textStatus, jqXHR){
				if (response == 1){
				alert('Answer saved');
				$('.dropdown-content').hide();
				$('.darkClass').hide();
				$('.question3post').hide();
				$('.answered3post').show();
				$('#40').hide();
				$('#41').show();
				$('#pageShowing').html(41);
				return;
				}else{
					
				$('#errorq3post').html('Something went wrong, please try again').css("color","red");	
				}
			});

			request.fail(function (jqXHR, textStatus, errorThrown){
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
		
	}


})	
	
$('.play').on('click', function() {

	var page = $('#pageShowing').html();
	var audiotoPlay = '#audio'+page;
	$(audiotoPlay).trigger('play');
	$('.play').prop('disabled = true');
	$('.pause').prop('disabled = false');



})	

$('.pause').on('click', function() {
	var page = $('#pageShowing').html();
	var audiotoPlay = '#audio'+page;
	$(audiotoPlay).trigger('pause');
	$('.play').prop('disabled =-false');
	$('.pause').prop('disabled = true');

})		

$('.restartAudio').on('click', function() {
	var page = $('#pageShowing').html();
	var audiotoPlay = '#audio'+page;
	$(audiotoPlay).trigger('pause');
	$(audiotoPlay).prop("currentTime",0);
	$('.play').prop('disabled =-false');
	$('.pause').prop('disabled = false');

})	
	
$('.audioStatus').on('change', function() {
	var page = $('#pageShowing').html();
	var audiotoPlay = '#audio'+page;
	var audioRequiredStatus = $(this).val();
	if (audioRequiredStatus == '1'){
		audioStatus = '1';
		$(audiotoPlay).trigger('play');
		
	}
	if (audioRequiredStatus == '0'){
		audioStatus = '0';
		$(audiotoPlay).trigger('pause');
	}

})	

$('.restartShow').on('click', function() {
	$('#pageShowing').html('intro');
	$('#44').hide();
	$('#intro').show();

})	

	
	
	
	
	
	
});
	
	

	
	
    
    


</script>
<?php include ('footer.html'); ?>

</html>

