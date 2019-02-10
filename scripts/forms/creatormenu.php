<?php

	$host = substr($_SERVER['HTTP_HOST'], 0, 5);
		if (in_array($host, array('local', '127.0', '192.1'))) {
		    $local = TRUE;
		} else {
		    $local = FALSE;
		}
		
		if ($local){
			
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
			
			
		}else{
			
			require ($_SERVER['DOCUMENT_ROOT'].'/scripts/headerCreator.php');;
		}
		
		
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		$user = new users;

		if ($user->getUserAccessLevel($_SESSION['user_id']) > 2){
	
			redirect_login($location);
	
	
		}

?> 

<?php


//!change title

$page_title = 'Creator Menu';

// Include the header file:
include($root . "/scripts/logobar.php");
		
include($root . "/includes/naviv1.php");

$columns = $formv1->getAllDatabaseTables();

$datafields = array();

$x=0;

foreach ($columns as $key=>$value){
	
	if 	($table != $value['table']) {

	
		$table = $value['table'];
		//$identifier = $value['name'];
		
		$datafields[$x] = array ('databaseTable' => $table); 
		
		$x++;
	
	}
		
} 



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
                    <h2 style='text-align:left;'>Creator Menu</h2>
                </div>

                <!--<div id='messageBox' class="col-3 yellow-light narrow center">
                    <p></p>
                </div>-->
            </div>

            <div class="row">
                <div class="col-2"></div>

                <div class="col-8 narrow">
                    <p>Choose an entity to edit or create</p>
                </div>

                <div class="col-2"></div>
            </div>
	        
	        
	        	        
	         <div class="row">
                <div class="col-4"><b>Images</b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/forms/imagesUploadForm.php';?>'>Upload new images</a></p>
                </div>
                
                <div class="col-4 narrow">
                    
                </div>


                
            </div>   
            
             <div class="row">
                <div class="col-4"><b></b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/forms/imageSetTable.php';?>'>Modify existing images</a></p>
                </div>
                
                <div class="col-4 narrow">
                    
                </div>


                
            </div>  
            
             <div class="row">
                <div class="col-4"><b>Videos</b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/forms/videoUploadForm.php';?>'>Register new Vimeo video</a></p>
                </div>
                
                <div class="col-4 narrow">
                   

                </div>


                
            </div>   
            
             <div class="row">
                <div class="col-4"><b></b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo $roothttp.'/scripts/forms/videoTable.php';?>'>View and add chapters and tags to existing videos</a></p>
                </div>
                
                <div class="col-4 narrow">
                    
                </div>


                
            </div>  
	        
	        		        
		      
	        
        </div>
        
    </div>
<script>
	var siteRoot = 'http://localhost:90/dashboard/learning/';

		
	$(document).ready(function() {

		 var titleGraphic = $(".title").height();
    var titleBar = $("#menu").height();
    $(".title").css('height', (titleBar));


    $(window).resize(function() {
        waitForFinalEvent(function() {
            //alert("Resize...");
            var titleGraphic = $(".title").height();
            var titleBar = $("#menu").height();
            $(".title").css('height', (titleBar));

        }, 100, 'Resize header');
    });




})

	</script>    
    
    
<?php

    // Include the footer file to complete the template:
    include($root .'/includes/footer.html');




    ?>
</body>
</html>