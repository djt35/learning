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
    //require($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/includes/config.inc.php');
}else{
    $root = $_SERVER['DOCUMENT_ROOT'].'/learning/';
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/learning/';

    //require($_SERVER['DOCUMENT_ROOT'].'/learning/includes/config.inc.php');

}

new users;


echo '<div class="navbar">
  <a href="' . $roothttp . 'index.php">Home</a>';
  
  echo '<div class="dropdown"><button class="dropbtn">Image</button>
  			<div class="dropdown-content">
  				<a href="">Browse images</a><hr>
  				<a href="' . $roothttp . 'scripts/display/atlas.php">Atlas of endoscopy</a><hr>
  				<a href="' . $roothttp . 'scripts/display/imaging.php">Atlas of endoscopic imaging</a><hr>
  				<a href="' . $roothttp . 'scripts/display/resection.php">Atlas of endoscopic resection</a>
  				
  			</div>
  		</div>';
  
  echo '<div class="dropdown"><button class="dropbtn">Video</button>
  			<div class="dropdown-content">
  				<a href="">Browse video</a><hr>
  				<a href="' . $roothttp . 'scripts/display/displayVideo.php?id=50">Watch specific video</a><hr>
  				<a href="">Suggest new video for inclusion</a>
  			</div>
  		</div>';
  		
   echo '<div class="dropdown"><button class="dropbtn">Learning Tool</button>
  			<div class="dropdown-content">
  				<a href="">Coming soon</a>
  			</div>
  		</div>';
  
  
  


 error_reporting(0); 
/* 
echo '
<div class="dropdown">
    <button class="dropbtn">Documents 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="iACEethics.php">Ethics Documents for iACE</a>
      <a href="PROSPERdocs.php">Ethics Documents for PROSPER</a>
    </div>
  </div>';*/
 
 echo '<a href="index.php?p=help">Help</a>';
echo '<a style="text-align:right;" href="index.php?p=logout">Logout</a>';

echo "<div id='userDisplay' style='text-align:right;'>";
			 $firstname =  $_SESSION['firstname'];
			 $surname = $_SESSION['surname'];
			 $userid = $_SESSION['user_id'];
			 echo "<br>User: $firstname $surname </div>";  
echo '<div class="darkClass"></div>';
echo "<div id='userID' style='display:none;'>";
echo $_SESSION['user_id'];
echo "</div>";
	echo "</div>";

	