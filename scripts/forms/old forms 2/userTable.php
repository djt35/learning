<?php

require ('../../../includes/config.inc.php');
$location = BASE_URL . '/elearn.php';

session_start();
if (!isset($_SESSION['user_id'])) {

    // Need the functions:
    require (BASE_URI . '/includes/login_functions.php');
    redirect_login($location);
}

?> 

<script src="<?php echo BASE_URL . '/includes/generaljs.js'; ?>" type="text/javascript"></script>
<script src="<?php echo BASE_URL . '/includes/jquery.min.js'; ?>" type="text/javascript"></script>



<?php

$formv1 = new formGenerator;
$general = new general;
$video = new video;
$tagCategories = new tagCategories;

//!change title

$page_title = 'User Table';

// Include the header file:
include(BASE_URI . '/includes/header.php');
include(BASE_URI . '/includes/naviCreator.php');






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
                    <p><?php $general->makeSearchableTableDelete('SELECT `user_id`, `firstname`, `surname`, `email`, `centre` from users'); ?></p>
                </div>

                <div class="col-1"></div>
            </div>

	        
        </div>
        
    </div>
<script>
	switch (document.location.hostname)
{
        case 'www.endoscopy.wiki':
                          
                         var rootFolder = 'http://www.endoscopy.wiki/'; break;
        case 'localhost' :
                           var rootFolder = 'http://localhost:90/dashboard/learning/'; break;
        default :  // set whatever you want
}
			
var siteRoot = rootFolder;

		
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
    include(BASE_URI .'/includes/footer.html');




    ?>
</body>
</html>