
		
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
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>video Table</title>
		</head>
		
	
		<?php
		include(BASE_URI . "/scripts/logobar.php");
		
		include(BASE_URI . "/includes/naviv1.php");
		//echo '<div class="navbar structure">Creators > Video > Table</div>';		?>
		
		
		<body>
			
				
		    <div id='content' class='content'>
			    
		        <div class='responsiveContainer white'>
			        
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">List of video</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p><button id="newvideo" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/videoUploadForm.php';">New video</button></p>
		                </div>
		            </div>
			        
			        <div class='row'>
		                <div class='col-1'></div>
		
		                <div class='col-10 narrow' style='overflow-x: scroll;'>
		                    <p><?php $general->makeTable("SELECT id, name, url, active, split, created, updated from video order by created asc"); ?></p>
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
			
			//after loading find tr, fast last td, insert td with edit chapter set for this video
		
				
			$(document).ready(function() {
				
				var navBarEntry = '<div class="dropdown"><button class="dropbtn activeButton">Video Creators&#9660;</button><div class="dropdown-content"><a href="' + siteRoot + 'scripts/forms/videoUploadForm.php">New Video</a><hr><a href="' + siteRoot + 'scripts/forms/videoTable.php">Video Table</a></div></div>';
    
    $('.navbar').find('.dropdown:eq(3)').after(navBarEntry);
		
				$("#dataTable").find("tr");
				
				$("#dataTable").find("tr").each(function(){
					
					var id = $(this).find("td:first").text();
					
					var split = $(this).find("td:eq(4)").text();
					
					split = split.trim();
					
					if (split == 1){
					
					
				
					$(this).find("td:last").after('<td><a href=\''+ siteRoot + 'scripts/forms/videoChapterForm.php?id=' + id+'\'>Edit Chapters</a></td>');
					
					}
				
				});
		
				$(".content").on("click", ".datarow", function(){
					
					var id = $(this).find("td:first").text();
					
					//console.log(id);
					
					window.location.href = siteRoot + 'scripts/forms/videoUploadForm.php?id=' + id;
		
					
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
		    include(BASE_URI . "/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>
		
		