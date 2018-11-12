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

?> 

<script src="<?php echo $roothttp . 'includes/generaljs.js'; ?>" type="text/javascript"></script>
<script src="<?php echo $roothttp . 'includes/jquery.min.js'; ?>" type="text/javascript"></script>



<?php

$formv1 = new formGenerator;
$general = new general;
$video = new video;
$tagCategories = new tagCategories;

//!change title

$page_title = 'User Editor';

// Include the header file:
include($root . '/includes/header.php');
include($root . '/includes/naviCreator.php');




//TERMINATE THE SCRIPT IF NOT A SUPERUSER



// Page content
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
    <title></title>
</head>

<body>
	
	<div id='id' style='display:none;'><?php if ($id){echo $id;}?></div>
	
    <div id="content" class="content">
	    
        <div class="responsiveContainer white">
	        
	        <div class="row">
                <div class="col-9">
                    <h2 style='text-align:left;'>Main Creator Menu</h2>
                </div>

                <div id='messageBox' class="col-3 yellow-light narrow center">
                    <p></p>
                </div>
            </div>

            <div class="row">
                <div class="col-2"></div>

                <div class="col-8 narrow">
                    <p>Choose an entity to edit or create</p>
                </div>

                <div class="col-2"></div>
            </div>
	        
	         <div class="row">
                <div class="col-4"><b>Video</b></div>

                <div class="col-4 narrow">
                    <p>New</p>
                </div>
                
                <div class="col-4 narrow">
                     <p><a href='<?php echo $roothttp.'scripts/forms/videoTable.php';?>'>Modify</a></p>                    
                </div>


                
            </div>
	        
	        <div class="row">
                <div class="col-4"><b>Tag</b></div>

                <div class="col-4 narrow">
                    <p>New</p>
                </div>
                
                <div class="col-4 narrow">
                    <p>Modify</p>
                </div>


                
            </div>
            
            <div class="row">
                <div class="col-4"><b>User</b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/forms/userForm.php';?>'>New</a></p>
                </div>
                
                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/forms/userTable.php';?>'>Modify</a></p>
                </div>


                
            </div>
            
            <div class="row">
                <div class="col-4"><b>Audio</b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/forms/audioForm.php';?>'>New</a></p>
                </div>
                
                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/forms/audioTable.php';?>'>Modify</a></p>
                </div>


                
            </div>
	        		        
		    <div class="row">
                <div class="col-4"><b>Helpers</b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/helpers/getTables.php';?>'>All tables in database</a></p>
                </div>
                
                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/helpers/createFormHtml.php';?>'>Generate code for particular table</a></p>
                </div>


                
            </div>    
	        
        </div>
        
    </div>
<script>
	var siteRoot = 'http://localhost:90/dashboard/learning/';

		
	$(document).ready(function() {

		




})

	</script>    
    
    
<?php

    // Include the footer file to complete the template:
    include($root .'/includes/footer.html');




    ?>
</body>
</html>