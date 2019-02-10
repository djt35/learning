<?php
session_start();

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
    $root = $_SERVER['DOCUMENT_ROOT'];
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/';

    //require($_SERVER['DOCUMENT_ROOT'].'/includes/config.inc.php');

}

$user = new users;


echo '<div id="navbarResponsive" class="navbar responsiveContainer topnav1">

  <div class="row">
  	<div class="slim-col-10">
  				<a href="javascript:void(0);" class="icon" onclick="mobileMenuShow()">
    <i class="fa fa-bars"></i>
  </a>
			  <a class="topnav" href="' . $roothttp . 'index.php">Home</a>';
			  
			  echo '<div class="dropdown topnav"><button class="dropbtn">Image&#9660;</button>
			  			<div class="dropdown-content">
			  				<a href="">Browse images</a><hr>
			  				<a href="' . $roothttp . 'scripts/display/atlas.php">Atlas of endoscopy</a><hr>
			  				<a href="' . $roothttp . 'scripts/display/imaging.php">Atlas of endoscopic imaging</a><hr>
			  				<a href="' . $roothttp . 'scripts/display/resection.php">Atlas of endoscopic resection</a><hr>
			  				<a href="' . $roothttp . 'scripts/forms/imagesdraftUploadForm.php">Submit new images for inclusion</a>
			  				
			  			</div>
			  		</div>';
			  
			  echo '<div class="dropdown topnav"><button class="dropbtn">Video&#9660;</button>
			  			<div class="dropdown-content">
			  				<a href="' . $roothttp . 'scripts/display/atlasVideo.php">Browse video</a><hr>
			  				<a href="' . $roothttp . 'scripts/display/displayVideo.php?id=50">Watch specific video</a><hr>
			  				<a href="">Suggest new video for inclusion</a>
			  			</div>
			  		</div>';
			  		
			  echo '<div class="dropdown topnav"><button class="dropbtn">Colonoscopy Tutor&#9660;</button>
			  			<div class="dropdown-content">
			  				<a href="' . $roothttp . 'scripts/display/colontutor/video.php">Videos</a>
			  							  				
			  			</div>
			  		</div>';
			  		
			   echo '<div class="dropdown topnav"><button class="dropbtn">Learning Tool&#9660;</button>
			  			<div class="dropdown-content">
			  				<a href="">Coming soon</a>
			  			</div>
			  		</div>';
			  		
			  //echo $user->getUserAccessLevel($_SESSION['user_id']);	
			  
			  if ($user->getUserAccessLevel($_SESSION['user_id']) == 1 || $user->getUserAccessLevel($_SESSION['user_id']) == 2){
				  echo '<div class="dropdown topnav"><button class="dropbtn">Creator&#9660;</button>
			  			<div class="dropdown-content">
			  				<a href="'. $roothttp . 'scripts/forms/creatormenu.php">Main Creator Menu</a>
			  			</div>
			  		</div>';
				  
				  };
			  		
			  if ($user->getUserAccessLevel($_SESSION['user_id']) == 1){
				  echo '<div class="dropdown topnav"><button class="dropbtn">Superuser&#9660;</button>
			  			<div class="dropdown-content">
			  				<a href="'. $roothttp . 'scripts/forms/creators.php">Superuser Creator Menu</a>
			  				<a href="'. $roothttp . 'scripts/getThumbnailsVideo.php">Generate video thumbnails</a>
			
			  			</div>
			  		</div>';
				  
				  };
				  
				  
			  
			  
			  
			
			
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
			 
			 echo '<a class="topnav" href="index.php?p=help">Help</a>';
			echo '			
			</div>
			
			';

	echo '<div class="slim-col-2">';

			echo "<div id='userDisplay'>";
				 $firstname =  $_SESSION['firstname'];
				 $surname = $_SESSION['surname'];
				 $userid = $_SESSION['user_id'];
				 if ($userid){
					 echo '<div class="dropdown topnav"><button class="dropbtn">Logged in&#9660;</button>
					 
					 <div class="dropdown-content" id="myDropdown">
			  				<a href="'. $roothttp . 'scripts/forms/imageSetDraftTable.php">My Submitted Images</a>
			  				<a class="logout">Logout</a>
			  				
			  				
			  			</div>
					 
					 
					 </div>';
				 }else{
					 
					 echo '<div class="dropdown topnav"><button class="dropbtn login">Login</button></div>';
				 }
			 echo '</div>';
				 
							 //<br>User: $firstname $surname </div>";  
			//echo '<div class="darkClass"></div>';
			echo "<div id='userID' style='display:none;'>";
			echo $_SESSION['user_id'];
			echo "</div>";
			
		
			
			
	echo "</div>";
	echo "</div>";
	echo "</div>";

	