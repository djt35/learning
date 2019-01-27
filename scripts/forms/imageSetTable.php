
		
		<?php
		
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
		
		
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		$user = new users;
		
		if ($user->getUserAccessLevel($_SESSION['user_id']) > 2){
	
			redirect_login($location);
	
	
		}
		
		
		
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>imageSet Table</title>
		</head>
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviv1.php");
		?>
		
		
		<body>
			
				
		    <div id='content' class='content'>
			    
		        <div class='responsiveContainer white'>
			        
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">List of imageSet</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p><button id="newimageSet" onclick="window.location.href = '<?php echo $roothttp;?>/scripts/forms/imageSetForm.php';">New imageSet</button></p>
		                </div>
		            </div>
			        
			        <div class='row'>
		                <div class='col-1'></div>
		
		                <div class='col-10 narrow' style='overflow-x: scroll;'>
		                    <p><?php $general->makeTableImagesv2("SELECT a.`type`, a.`author`, a.`id`, c.`url`, a.`created`, a.`updated` 
FROM `imageSet` as a 
INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id`
INNER JOIN `images` as c on b.`image_id` = c.`id` GROUP BY a.`id` ORDER BY a.`id` desc", $roothttp); ?></p>
		                </div>
		
		                <div class='col-1'></div>
		            </div>
		
			        
		        </div>
		        
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
				
			$(document).ready(function() {
		
				$("#dataTable").find("tr");
		
				$(".content").on("click", ".datarow", function(){
					
					var id = $(this).closest('tr').find("td:eq(2)").text();
					
					//console.log(id);
					
					window.location.href = siteRoot + 'scripts/forms/imagesUploadForm.php?id=' + id;
		
					
				})
				
				var navBarEntry = '<div class="dropdown"><button class="dropbtn activeButton">Image Creators&#9660;</button><div class="dropdown-content"><a href="' + siteRoot + 'scripts/forms/imagesUploadForm.php">New Image Entry</a><hr><a href="' + siteRoot + 'scripts/forms/imageSetTable.php">Images Table</a></div></div>';
    
    $('.navbar').find('.dropdown:eq(3)').after(navBarEntry);
				
				$(".content").on("click", ".deleteSet", function(){
					
					var id = $(this).closest('tr').find("td:eq(2)").text();
					
					var tr = $(this).closest('tr');
					
					//console.log(id);
					
					if (confirm("Do you wish to delete this imageSet [can't be undone]?")) {

			            //disableFormInputs("images");
			
			            var imagesObject = pushDataAJAX('imageSet', 'id', id, 2, ''); //delete images
			
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
		
		