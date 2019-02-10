
		
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
		
		
		
		
		
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>Draft Images Uploaded by All Users</title>
		</head>
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviv1.php");
		
		if ($user->getUserAccessLevel($_SESSION['user_id']) > 1){
			
			echo '<body><div class="content">';
			
			//message to user goes here
			
			echo 'You do not have sufficient access privileges to view this page';
			echo '<br><br>';
			echo '<a href="javascript:history.back()">Go Back</a>';
			
			echo '</div></body>';
			include($root ."/includes/footer.html");
			
			exit();
			
			//redirect_login($location);
	
	
		}
		
		?>
		
		
		<body>
			
				
		    <div id='content' class='content'>
			    
		        <div class='responsiveContainer white'>
			        
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">Draft Images Table</h2>
		                    <p style='text-align:left;'>All user submissions.  These can be approved here</p>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <!--<p><button id="newimageSet" onclick="window.location.href = '<?php echo $roothttp;?>/scripts/forms/imageSetForm.php';">New imageSet</button></p>-->
		                </div>
		            </div>
			        
			        <div class='row'>
		                <div class='col-1'></div>
		
		                <div class='col-10 narrow' style='overflow-x: scroll;'>
		                    <p><?php 
			                    
			                    $useridquery = $_SESSION['user_id'];
			                    
			                    $general->makeTableImagesv3("SELECT a.`type`, a.`author`, a.`id`, c.`url`, a.`created`, a.`updated` 
FROM `imageSetDraft` as a 
INNER JOIN `imageImageSetDraft` as b ON a.`id` = b.`imageSet_id`
INNER JOIN `imagesDraft` as c on b.`image_id` = c.`id` WHERE a.`approved` IS NULL GROUP BY a.`id` ORDER BY a.`created` desc", $roothttp); ?></p>
		                </div>
		
		                <div class='col-1'></div>
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
		
				$("#dataTable").find("tr");
		
				$(".content").on("click", ".datarow", function(){
					
					var id = $(this).closest('tr').find("td:eq(2)").text();
					
					//console.log(id);
					
					window.location.href = siteRoot + 'scripts/forms/imagesdraftUploadForm.php?id=' + id;
		
					
				})
				
				var navBarEntry = '<div class="dropdown"><button class="dropbtn activeButton">Image Creators&#9660;</button><div class="dropdown-content"><a href="' + siteRoot + 'scripts/forms/imagesdraftUploadForm.php">New Image Entry</a><hr><a href="' + siteRoot + 'scripts/forms/imageSetdraftTableApprove.php">All Draft Images Table</a></div></div>';
    
    $('.navbar').find('.dropdown:eq(3)').after(navBarEntry);
				
				$(".content").on("click", ".deleteSet", function(){
					
					var id = $(this).closest('tr').find("td:eq(2)").text();
					
					var tr = $(this).closest('tr');
					
					//console.log(id);
					
					if (confirm("Do you wish to delete this imageSet [can't be undone]?")) {

			            //disableFormInputs("images");
			
			            var imagesObject = pushDataAJAX('imageSetDraft', 'id', id, 2, ''); //delete images
			
			            imagesObject.done(function(data) {
			
			                console.log(data);
			
			                if (data) {
			
			                    if (data == 1) {
			
			                        //alert ("tag connection deleted");
			                        $(tr).hide();
			
			                        //edit = 0;
			                        //imagesPassed = null;
			                        //window.location.href = siteRoot + "scripts/forms/imagesTable.php";
			                        //go to images list
			
			                    } else {
			
			                        alert("Error, try again");
			
			                        //enableFormInputs("images");
			
			                    }
			
			
			
			                }
			
			
			            });
			
			        }

		
					
				})
				
				
				$(".content").on("click", ".reject", function(){
					
				var id = $(this).closest('tr').find("td:eq(2)").text();
					
					var tr = $(this).closest('tr');
					
					//console.log(id);
					
					if (confirm("Do you wish to REJECT this imageSet?\It will no longer be visible and the user will be notified")) {	
					
								                
								                var imageSetObject = pushDataAJAX('imageSetDraft', 'id', id, 1, {
										                        'approved': 0,
										                     
										                 
										                    }); 
										        
										        imageSetObject.done(function(data) {
											        
											        console.log(data);
											        
											        if (data == 1){
												        
												        //window.location.href = siteRoot + 'scripts/forms/imagesUploadForm.php?id=' + newObject.imageSetid;
												        alert('Draft ImageSet rejected');
												        $(tr).hide();
												        
												        
											        }else{
												        
												        alert('Error, try again');
												        
											        }
											        
											    })
											    
											    
					}
				})

				
				$(".content").on("click", ".approveSet", function(){
					
					var id = $(this).closest('tr').find("td:eq(2)").text();
					
					var tr = $(this).closest('tr');
					
					//console.log(id);
					
					if (confirm("Do you wish to APPROVE this imageSet [can't be undone]?\nYou will then be taken to the imageSet edit screen where tagging is possible")) {

			            //disableFormInputs("images");
			            
			            //queries
			            
			            // 3 inserts
			            
			            //copy the imageset, get new imageset id
			            
			            //get array of all the images in the imageset (ids)
			            
			            //move files to correct directory
			            
			            //copy the images, get new image ids
			            
			            //write imageImageSet table
			            
			            //write tags if there
			            
			            //delete the drafts and clean up files
			            
			            var dataObject = new Object();
	
						dataObject.imageSetDraftid = id;
			            
			            var datastring = JSON.stringify(dataObject);
			
			            var imagesObject = $.ajax({
												url: siteRoot + "scripts/approveDraftImageSet.php",
												type: "POST",
												contentType: "application/json",
												data: datastring,
											    });
			
			            imagesObject.done(function(data) {
			
			                console.log(data);
			
			                if (data) {
				                
				                try {
				                
				                var newObject = $.parseJSON(data);
				                console.dir(newObject);
				                //delete the old data row by adding approved
				                
				                var imageSetObject = pushDataAJAX('imageSetDraft', 'id', id, 1, {
						                        'approved': 1,
						                     
						                 
						                    }); 
						        
						        imageSetObject.done(function(data) {
							        
							        if (data){
								        
								        window.location.href = siteRoot + 'scripts/forms/imagesUploadForm.php?id=' + newObject.imageSetid;
								        
								        
							        }else{
								        
								        alert('error, try again');
								        
							        }
							        
							    })
				                
				                //$(tr).hide();
				                

				                
				                
				                
				                }catch(err){
					                
					                console.log('error creating object');
					                alert('error, try again');
					                
				                }
				                
				                
			
			
			
			                }
			
			
			            });
			
			        }

		
					
				})
			  	var titleGraphic = $(".title").height();
				var titleBar = $("#menu").height();
				$(".title").css('height',(titleBar));	
				
				
				$(window).resize(function () {
			    waitForFinalEvent(function(){
			      //alert("Resize...");
			      var titleGraphic = $(".title").height();
				  var titleBar = $("#menu").height();
				  $(".title").css('height',(titleBar));	
					
			    }, 100, 'Resize header');
					});
		
		
		
		    });
		
		
		
			</script>    
		    
		    
		<?php
		
		    // Include the footer file to complete the template:
		    include($root ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>
		
		