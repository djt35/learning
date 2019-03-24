<?php

    require('../../includes/config.inc.php');
		
		if ($local){
            $ref = 'LearningTool';
        }else{
			$ref = 'learningToolv1';
			
		}
		
	require (BASE_URI . '/scripts/headerCreator.php');

			
		
		
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		$user = new users;

		if ($user->getUserAccessLevel($_SESSION['user_id']) > 1){
	
			redirect_login($location);
	
	
		}

?> 

<?php


//!change title

$page_title = 'Superuser Creator Menu';

// Include the header file:
include(BASE_URI . "/scripts/logobar.php");
		
include(BASE_URI . "/includes/naviv1.php");

$columns = $formv1->getAllDatabaseTablesv1($ref);

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

<style>



</style>

<body>
	
	<div id='id' style='display:none;'><?php if ($id){echo $id;}?></div>
	
    <div id="content" class="content">
	    
        <div class="responsiveContainer white">
	        
	        <div class="row">
                <div class="col-9">
                    <h2 style='text-align:left;'>Superuser Creator Menu</h2>
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
	        
	        
	        <?php
	        foreach ($datafields as $key=>$value){
		        
                $name = $value['databaseTable'];

                $exclusions = array('auth_group', 'auth_group_permissions', 'auth_permission', 'django_content_type', 'userLearningToolAccess', 'users_customuser_groups', 'users_customuser_user_permissions', 'users_customuser');
                
                if (in_array($name, $exclusions)){

                    //skip this iteration
                    continue;

                }
		        
		       echo '
		       
               <div class="row">
               <div class="col-3"><b></b></div>
                <div class="col-2 narrow" style="border: 1px solid black; border-collapse: separate;
                border-spacing: 10px;"><b>'.$name.'</b></div>

                <div class="col-2 narrow" style="border: 1px solid black; border-collapse: separate;
                border-spacing: 0px;">
                    <p><a href=\''.BASE_URL.'/scripts/forms/'.$name.'Form.php\'>New</a></p>
                </div>
                
                <div class="col-2 narrow" style="border: 1px solid black; border-collapse: separate;
                border-spacing: 0px;">
                     <p><a href=\''.BASE_URL.'/scripts/forms/'.$name.'Table.php\'>Modify</a></p>                    
                </div>
                <div class="col-3"><b></b></div>


                
            </div>
            
            ';
		        
		          
	        }
	        
	        
	        
	        
	         
            
            ?>
	        
	         <div class="row">
                <div class="col-4"><b>Uploaders</b></div>

                <div class="col-4 narrow">
                    <p><a href='<?php echo BASE_URL.'/scripts/forms/imagesUploadForm.php';?>'>Upload images</a></p>
                </div>
                
                <div class="col-4 narrow">
                    
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