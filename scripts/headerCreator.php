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
    $root = $_SERVER['DOCUMENT_ROOT'].'/learning/';
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/learning/';

    require($_SERVER['DOCUMENT_ROOT'].'/learning/includes/config.inc.php');

}
$location = $roothttp . 'elearn.php';

session_start();
if (!isset($_SESSION['user_id'])) {

    // Need the functions:
    require ($root . 'includes/login_functions.php');
    redirect_login($location);
}

//echo $root;

?>


    <script src="<?php echo $roothttp . 'includes/generaljs.js'; ?>" type="text/javascript">
</script>
    <script src="<?php echo $roothttp . 'includes/jquery.min.js'; ?>" type="text/javascript">
</script>
   
	    
	    
</script>

<script src="<?php echo $roothttp . 'includes/generaljs.js'; ?>" type="text/javascript"></script>

<script>
	
	
	/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */




/*function myFunction() {
  console.log('clicked on dropdown')
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}*/
	
</script>



<?php echo '<script src="' . $roothttp . 'includes/jquery.validate.js"></script>';

    echo '<link rel="stylesheet" type="text/css" href="'. $roothttp . '/styles%20image.css">';


    ?>
