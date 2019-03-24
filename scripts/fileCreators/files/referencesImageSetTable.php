
		
		<?php

		$requiredUserLevel = 1;

		//$openaccess = 1 allows the page to be viewed without login and skips the rest of the script
			//$requiredUserLevel corresponds to database users access level; if not set the page simply requires login
			//$paid allows setting of pages which require subscription and login

			//define token from url


			require ('../../includes/config.inc.php');
			$location = BASE_URL . '/scripts/forms/creatormenu.php';
			require (BASE_URI . '/scripts/headerCreator.php');
		
		
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		
		
		
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>referencesImageSet Table</title>
		</head>
		
		<?php
		include(BASE_URI . "/scripts/logobar.php");
		
		include(BASE_URI . "/includes/naviCreator.php");
		?>
		
		<script src='<?php echo BASE_URL . '/includes/tableinclude.js'; ?>' type='text/javascript'></script>
		
		
		
		<body>
			
				
		    <div id='content' class='content'>
			    
		        <div class='responsiveContainer white'>
			        
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">List of referencesImageSet</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p><button id="newreferencesImageSet" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/referencesImageSetForm.php';">New referencesImageSet</button></p>
		                </div>
					</div>
					
					<div class='row'>
		                <div class='col-3'>
		                    <p style='text-align:right;'>Search:</p>
		                </div>
		
		                <div id='searchBox' class='col-6 yellow-light narrow left'>
							<p></p>
							<div><button type='button' id='resetTable'>Reset Table</button>&nbsp;&nbsp;<button type='button' id='hideSearch'>Hide Search Box</button></div>
						</div>
						
						<div class='col-3'>
		                    
		                </div>
		            </div>
			        
			        <div class='row'>
		                <div class='col-1'></div>
		
		                <div class='col-10 narrow' style='overflow-x: scroll;'>
		                    <p><?php $general->makeSearchableTableDelete("SELECT `id`, `imageSet_id`, `references_id` from `referencesImageSet`"); ?></p>
		                </div>
		
		                <div class='col-1'></div>
		            </div>
		
			        
		        </div>
		        
		    </div>
		<script>
		switch (document.location.hostname) {
			case 'www.endoscopy.wiki':

				var rootFolder = 'http://www.endoscopy.wiki/';
				break;
			case 'localhost':
				var rootFolder = 'http://localhost:90/dashboard/learning/';
				break;
			default: // set whatever you want
		}

		var siteRoot = rootFolder;
		
		var tagsid = null;

			$(document).ready(function() {

				makeSearchBox();
		
				$("#dataTable").find("tr");
		
				$(".content").on("click", ".datarow", function(){
					
					var id = $(this).parent().find('td:first').text();

					id.trim();
					
					window.location.href = siteRoot + 'scripts/forms/referencesImageSetForm.php?id=' + id;
		
					
				})

				$('.content').on('click', '.deleteTag', function () {

					if (confirm('Do you wish to delete this referencesImageSet [can\'t be undone]?')) {

						var id = $(this).closest('tr').find('td:eq(0)').text();

						var tr = $(this).closest('tr');

						var imagesObject = pushDataAJAX('referencesImageSet', 'id', id, 2, ''); //delete referencesImageSet

						imagesObject.done(function (data) {

							console.log(data);

							if (data) {

								if (data == 1) {

									alert('referencesImageSet deleted');
									$(tr).hide();

									//edit = 0;
									//imagesPassed = null;
									//window.location.href = siteRoot + 'scripts/forms/imagesTable.php';
									//go to images list

								} else {

									alert('Error, try again');

									//enableFormInputs('images');

								}
							}
						});

					}


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
		    include(BASE_URI ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>
		
		