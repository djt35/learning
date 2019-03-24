<?php

	$openaccess = 1;

	require ('../../includes/config.inc.php'); 
	
	require (BASE_URI.'/scripts/headerCreator.php');
		
		
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		$user = new users;

		

?> 

<?php


//!change title

$page_title = 'UZG Endoscopische Eenheid';

// Include the header file:
include(BASE_URI . "/scripts/logobarUZG.php");
		
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
    <script>
        jQuery.tableOfContents =                                                                   
function (tocList) {                                                                   
    jQuery(tocList).empty();                                                            
    var prevH2Item = null;                                                             
    var prevH2List = null;                                                             
    
    var index = 0;                                                                     
    jQuery("h2, h3").each(function() {                                                      
    
        var anchor = "<a name='" + index + "'></a>";                                   
        jQuery(this).before(anchor);                                                        
        
        var li     = "<li><a href='#" + index + "'>" + 
                     jQuery(this).text() + "</a></li>";   
        
        if( jQuery(this).is("h2") ){                                                        
            prevH2List = jQuery("<ul></ul>");                                               
            prevH2Item = jQuery(li);                                                        
            prevH2Item.append(prevH2List);                                             
            prevH2Item.appendTo(tocList);                                              
        } else {                                                                       
            prevH2List.append(li);                                                     
        }                                                                              
        index++;                                                                       
    });                                                                                
}
    
    </script>
    <style>
			
			.content, #menu, .responsiveContainer {
				
				color: white;
				background-color: black;
				
				
			}
			
			.content {
				
				max-height: none;
				
				
			}
			
			.navbar, .dropbtn, .dropdown .dropbtn, .navbar a, .dropdown, .dropdown-content {
				
				background-color: #2670DD;
				
			}
			
			footer {
				
				color: white;
				background-color: black;
				
			}
			
			.startTyping {
				
				font-size: large;
				
				
			}
			
			.modifiers {
				
				background-color: #2670DD; /* Blue UZ */
			    border: none;
			    color: white;
			    padding: 5px 10px;
			    text-align: center;
			    text-decoration: none;
			    display: inline-block;
			    font-size: 16px;
				
				
			}
			
			table{
				
				border-collapse: collapse;
				
			}
			
			#images {
				
				/*overflow-x: scroll;*/
				
			}
			img {
				max-width: 100%;
				max-height: 100%;
			}
			
			.activeButton{
				
				background-color: #fcdd85 !important;
				color: black !important;
				
			}
			/*
			.imageTable td, .imageTable th {
			    color: white;
			    padding: 10px;
			    text-align: center;
			    
			    border-color: rgba(255, 255, 255, 0.3);
			}
			
			input[type="text"], select, textarea {

			  background-color : #000000; 
			  color : white;
			  border-color: rgba(255, 255, 255, 0.17);
			
			}*/
			
			
			
			
		</style>
</head>

<body>
	
	<div id='id' style='display:none;'><?php if ($id){echo $id;}?></div>
	
    <div id="content" class="content">
	    
        <div class="responsiveContainer black">
	        
	        <div class="row">

            <div class="col-3" style="position: relative; text-align:left; padding-right: 2%;">
            <div id="tocDiv"> 
                <p><h2>Contents</h2></p>                                                          
<ul id="tocList">                                                       

</ul>                                                                   
</div> 
                <!--java get all first level ul and list them here-->

            </div>
                <div class="col-9" style="padding-left: 2%; text-align:left; border-left: white solid 1px;">
                    <?php include('approach.html'); ?>
                </div>

                <!--<div id='messageBox' class="col-3 yellow-light narrow center">
                    <p></p>
                </div>-->
            </div>

            
            
            	
            
	            
            
           
            

            
            
            

				<br><br>

           
	        	
		      
	        
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

jQuery.tableOfContents("#tocList");
		
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

	document.getElementById("tocList").addEventListener("scroll", function(){
   var translate = "translate(0,"+this.scrollTop+"px)";
   this.querySelector("tocList").style.transform = translate;
	});


})

	</script>    
    
    
<?php

    // Include the footer file to complete the template:
    include(BASE_URI .'/includes/footer.html');




    ?>
</body>
</html>