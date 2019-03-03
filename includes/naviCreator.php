<?php

//require ('config.inc.php');

new users;


echo '<div class="navbar">
  <a href="' . BASE_URL . '/index.php?p=home">Home</a>
  <a href="' . BASE_URL . '/scripts/forms/creators.php">Creator Menu</a>';
/*echo '  


  
  <div class="dropdown">
    <button class="dropbtn">New Content
     
    </button>
    <div class="dropdown-content">
       <a href="' . BASE_URL . '/creators/newVideo.php">Enter New Video</a>
	  <hr>
	  <a href="' . BASE_URL . '/creators/newTag.php">Enter New Tag</a>
	  	  
	       
    </div>
  </div>';
  
echo  '<div class="dropdown">
    <button class="dropbtn">Learning Tool 
      
    </button>
    <div class="dropdown-content">
      <a href="">None Yet</a>
    </div>
  </div>
  
  
  ';*/



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

	