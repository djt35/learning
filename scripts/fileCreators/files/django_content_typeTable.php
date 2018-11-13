
		
		<?php
		
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
		
		
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		
		
		
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>django_content_type Table</title>
		</head>
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviCreator.php");
		?>
		
		
		<body>
			
				
		    <div id='content' class='content'>
			    
		        <div class='responsiveContainer white'>
			        
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">List of django_content_type</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p><button id="newdjango_content_type" onclick="window.location.href = '<?php echo $roothttp;?>/scripts/forms/django_content_typeForm.php';">New django_content_type</button></p>
		                </div>
		            </div>
			        
			        <div class='row'>
		                <div class='col-1'></div>
		
		                <div class='col-10 narrow' style='overflow-x: scroll;'>
		                    <p><?php $general->makeTable("SELECT id from django_content_type"); ?></p>
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
					
					var id = $(this).find("td:first").text();
					
					//console.log(id);
					
					window.location.href = siteRoot + 'scripts/forms/django_content_typeForm.php?id=' + id;
		
					
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
		
		