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

$page_title = 'User Table';

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
	
		
    <div id="content" class="content">
	    
        <div class="responsiveContainer white">
	        
	        <div class="row">
                <div class="col-9">
                    <h2 style='text-align:left;'>Users</h2>
                </div>

                <div id='messageBox' class="col-3 yellow-light narrow center">
                    <p></p>
                </div>
            </div>
	        
	        <div class="row">
                <div class="col-1"></div>

                <div class="col-10 narrow" style="overflow-x: scroll;">
                    <p><?php $general->makeTable('SELECT user_id, firstname, surname, email, centre from users'); ?></p>
                </div>

                <div class="col-1"></div>
            </div>

	        
        </div>
        
    </div>
<script>
	var siteRoot = 'http://localhost:90/dashboard/learning/';

		
	$(document).ready(function() {

		$('#dataTable').find('tr');

		$('.content').on('click', '.datarow', function(){
			
			var id = $(this).find('td:first').text();
			
			//console.log(id);
			
			window.location.href = siteRoot + "scripts/forms/userForm.php?id=" + id;

			
		})


    });



	</script>    
    
    
<?php

    // Include the footer file to complete the template:
    include($root .'/includes/footer.html');




    ?>
</body>
</html>