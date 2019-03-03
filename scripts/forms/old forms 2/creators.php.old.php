<?php

require ('../../includes/config.inc.php');
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

$page_title = 'User Editor';

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
                     <p><a href='<?php echo BASE_URL.'scripts/forms/videoTable.php';?>'>Modify</a></p>                    
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
                    <p><a href='<?php echo BASE_URL.'/scripts/forms/userForm.php';?>'>New</a></p>
                </div>
                
                <div class="col-4 narrow">
                    <p><a href='<?php echo BASE_URL.'/scripts/forms/userTable.php';?>'>Modify</a></p>
                </div>


                
            </div>
            
            <div class="row">
                <div class="col-4"><b>Audio</b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo BASE_URL.'/scripts/forms/audioForm.php';?>'>New</a></p>
                </div>
                
                <div class="col-4 narrow">
                    <p><a href='<?php echo BASE_URL.'/scripts/forms/audioTable.php';?>'>Modify</a></p>
                </div>


                
            </div>
	        		        
		    <div class="row">
                <div class="col-4"><b>Helpers</b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo BASE_URL.'/scripts/helpers/getTables.php';?>'>All tables in database</a></p>
                </div>
                
                <div class="col-4 narrow">
                    <p><a href='<?php echo BASE_URL.'/scripts/helpers/createFormHtml.php';?>'>Generate code for particular table</a></p>
                </div>


                
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

		




})

	</script>    
    
    
<?php

    // Include the footer file to complete the template:
    include(BASE_URI .'/includes/footer.html');




    ?>
</body>
</html>