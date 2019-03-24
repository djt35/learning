
		
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
		
		<div class="darkClass">
		
		</div>
		
		<div class="modal" style="display:none;">
			
			<div class='modalContent'>
				
			</div>
			<div class='modalClose'>
				<p><br><button onclick="$('.modal, .darkClass').hide();">Close this window</button></p>
			</div>
			
		</div>

		<html>
		<head>
		    <title>imageSet Table</title>
		</head>
		
		<?php
		include(BASE_URI . "/scripts/logobar.php");
		
		include(BASE_URI . "/includes/naviv1.php");
		?>
		
		
		<body>
			
				
		    <div id='content' class='content'>
			    
		        <div class='responsiveContainer white'>
			        
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">List of imageSet</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p><button id="newimageSet" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/imageSetForm.php';">New imageSet</button></p>
		                </div>
		            </div>
			        
			        <div class='row'>
		                <div class='col-1'></div>
		
		                <div class='col-10 narrow' style='overflow-x: scroll;'>
		                    <p><?php $general->makeTableImagesv2("SELECT a.`type`, a.`author`, a.`id`, c.`url`, a.`created`, a.`updated`, a.`manipulated` 
FROM `imageSet` as a 
INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id`
INNER JOIN `images` as c on b.`image_id` = c.`id` GROUP BY a.`id` ORDER BY a.`id` desc", BASE_URL); ?></p>
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

var imageSetid = null;
		
				
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
						
						//get array of image filenames

						var overallObject = new Object();

						overallObject['query'] = 'getFilenames';

						var filesObject = JSONDataQuery(id, overallObject,9);

						filesObject.done(function(data) {

							console.dir(data);

							filesMoveObject = $.ajax({
								url: siteRoot + "scripts/moveImagesDeleted.php",
								type: "POST",
								contentType: "application/json",
								data: data,
							});

							filesMoveObject.done(function(data) {

								console.dir(data);

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

							})
						})
			
			            
			
			        }

		
					
				})
				
				$(".content").on("click", ".manipulateSet", function(){
					
					var id = $(this).closest('tr').find("td:eq(2)").text();

					imageSetid = id;
					
					var tr = $(this).closest('tr');
					
					//console.log(id);
					$('.modal').show();

					$('.darkClass').show();

					//$('.modal').show();
					$('.modal').css('max-height', 800);
					$('.modal').css('max-width', 800);
					$('.modal').css('overflow', 'scroll');

					$('.modal').find('.modalContent').html('<h3>Manipulate Images</h3>');

					//crop yes no
					//type olympus 1 pentax 2
					//watermark and resize automatic  -- and should occur on image upload

					$('.modal').find('.modalContent').append('<form id="manipulateForm"><p>Crop : <select id="crop" name="crop"><option value="0">No</option><option value="1">Yes</option></select></p><p>Type : <select id="type" name="type"><option value="1">Olympus middle</option><option value="2">Pentax left</option><option value="3">Olympus ultrathin</option></select></p></form>');

					//$('.modal').find('.modalContent').append('<p>Crop : <select id="crop" name="crop"><option value="0">No</option><option value="1">Yes</option></select></p>');

					//$('.modal').find('.modalContent').append('<p>Type : <select id="type" name="type"><option value="1">Olympus middle</option><option value="2">Pentax left</option></select></p>');

					//$('.modal').find('.modalContent').append('</form>');


					$('.modal').find('.modalContent').append('<button id="startManipulation">Start</button>');
					
					$(".modal").find('#type').prop('disabled', true);
					//set a manipulated field added
					//set it in the update script

					/*
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
			
			        }*/

		
					
				})
				
				$(".modal").on("click", "#startManipulation", function(){

					//alert('picked up the click');

					var formString = $(".modal").find('#manipulateForm').serialize();

					var manipulation = $.ajax({
						url: siteRoot + "scripts/cropimage.php",
						type: "get",
						data: 'imageSet='+imageSetid+'&'+formString,

				
					});

					manipulation.done(function(data) {

						console.log('manipulation = ' + data);

                        if (data) {

							alert(data);

							$('.modal').hide();

							$('.darkClass').hide();
							
							location.reload();

                            return;


						}else {

							alert("Error, try again");

						}


					})

				});

				$(".modal").on("change", "#crop", function(){
					
					if ($(this).val() == '0'){

						$(".modal").find('#type').prop('disabled', true);

					}

					if ($(this).val() == '1'){

					$(".modal").find('#type').prop('disabled', false);

					}
					//alert('picked up the click');

				});

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
		
		