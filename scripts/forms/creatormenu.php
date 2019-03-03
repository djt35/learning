<?php

	require ('../../includes/config.inc.php'); require (BASE_URI.'/scripts/headerCreator.php');
		
		
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
include(BASE_URI . "/scripts/logobar.php");
		
include(BASE_URI . "/includes/naviv1.php");

//$columns = $formv1->getAllDatabaseTables();
/*
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
*/


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
					<p style='text-align:left;'><b>Choose an entity to edit or create:</b></p>
                <div class="col-8 narrow">
                    
                </div>

                <div class="col-2"></div>
            </div>
	        
	        
	        	        
		         <div class="row">
			         
			         <div class="col-2"></div>
	                <div class="col-2"><b>Images</b></div>
	
	                <div class="col-4 narrow">
	                    <p><a href='<?php echo BASE_URL.'/scripts/forms/imagesUploadForm.php';?>'>Upload new images</a></p>
	                </div>
	                
	                <div class="col-4 narrow">
	                    
	                </div>
	
	
	                
	            </div>   
	            
	             <div class="row">
	                <div class="col-4"><b></b></div>
	
	                <div class="col-4 narrow">
	                    <p><a href='<?php echo BASE_URL.'/scripts/forms/imageSetTable.php';?>'>Modify existing images</a></p>
	                </div>
	                
	                <div class="col-4 narrow">
	                    
	                </div>
	
	
	                
	            </div>  
	        
            
            <br><br>
            
            	
            
	            <div class="row">
		            <div class="col-2"></div>
	                <div class="col-2"><b>Draft Images</b></div>
	
	                <div class="col-4 narrow">
	                    <p><a href='<?php echo BASE_URL.'/scripts/forms/imageSetdraftTableApprove.php';?>'>View and approve draft images uploaded by users</a><br><b><?php echo $general->countPendingApprovals() . ' pending.';?></b></p>
	                </div>
	                
	                <div class="col-4 narrow">
	                    
	                </div>
	
	
	                
	            </div> 
            
           
            
            <br><br>
            
            
            
	             <div class="row">
		             <div class="col-2"></div>
	                <div class="col-2"><b>Videos</b></div>
	
	                <div class="col-4 narrow">
	                    <p><a href='<?php echo BASE_URL.'/scripts/forms/videoUploadForm.php';?>'>Register new Vimeo video</a></p>
	                </div>
	                
	                <div class="col-4 narrow">
	                   
	
	                </div>
	
	
	                
	            </div>   
	            
	             <div class="row">
	                <div class="col-4"><b></b></div>
	
	                <div class="col-4 narrow">
	                    <p><a href='<?php echo BASE_URL.'/scripts/forms/videoTable.php';?>'>View and add chapters and tags to existing videos</a></p>
	                </div>
	                
	                <div class="col-4 narrow">
	                    
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
    include(BASE_URI .'/includes/footer.html');




    ?>
</body>
</html>