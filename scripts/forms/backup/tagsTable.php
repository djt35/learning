
		
		<?php
		
			$requiredUserLevel = 1;

			require ('../../includes/config.inc.php'); 
			

			
			require (BASE_URI.'/scripts/headerCreator.php');
		
		
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		
		
		
		?>

		<script src="<?php echo BASE_URL . '/includes/tableinclude.js'; ?>" type="text/javascript"></script>


		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>Tag and Reference Manager</title>
		</head>
		
		<?php
		include(BASE_URI . "/scripts/logobar.php");
		
		include(BASE_URI . "/includes/naviCreator.php");
		?>
		
		<div class="darkClass">
		
		</div>
		
		<div class="modal" style="display:none;">
			
			<div class='modalContent'>
				
			</div>
			<div class='modalClose'>
				<p><br><button onclick="$('.modal, .darkClass').hide();">Close this window</button></p>
			</div>
			
		</div>
		<body>
			
				
		    <div id='content' class='content'>
			    
		        <div class='responsiveContainer white'>
			        
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">Tag and Reference Manager</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p><button id="newtags" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/tagsForm.php';">New tags</button></p>
		                </div>
					</div>
					
					<div class='row'>
		                <div class='col-3'>
		                    <p style="text-align:right;">Search:</p>
		                </div>
		
		                <div id="searchBox" class='col-6 yellow-light narrow left'>
							<p></p>
							<div><button type="button" id="resetTable">Reset Table</button>&nbsp;&nbsp;<button type="button" id="hideSearch">Hide Search Box</button></div>
						</div>
						
						<div class='col-3'>
		                    
		                </div>
		            </div>
			        
			        <div class='row'>
		                <div class='col-1'></div>
		
		                <div class='col-10 narrow' style='overflow-x: scroll;'>
		                    <p><?php $general->makeTableTagManager("SELECT a.`id`, a.`tagCategories_id`, a.`tagName` from `tags` as a ORDER BY tagCategories_id, tagName ASC", BASE_URL); ?></p>
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

			//var alreadyExists = null;

			

			$(document).ready(function () {

				$("#dataTable").find("tr");

				$(".content").on("click", ".datarow", function () {

					var id = $(this).parent().find("td:first").text();

					id.trim();

					console.log(id);

					window.location.href = siteRoot + 'scripts/forms/tagsForm.php?id=' + id;


				})

				$('.modal').on('click', '#newReference', function() {

					$('.modal').hide();

					$('.darkClass').hide();

					PopupCenter(siteRoot + "scripts/forms/referencesForm.php", 'New Reference', 600, 700);

					//window.open(, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



				})


				var titleGraphic = $(".title").height();
				var titleBar = $("#menu").height();
				$(".title").css('height', (titleBar));


				$(window).resize(function () {
					waitForFinalEvent(function () {
						//alert("Resize...");
						var titleGraphic = $(".title").height();
						var titleBar = $("#menu").height();
						$(".title").css('height', (titleBar));

					}, 100, 'Resize header');
				});

				//for each .header find th . data 
				makeSearchBox();
				//make a searchBox
				//search to find like


				

				$('.content').on('click', '.referenceintable', function (e) {

					var myid = $(this).attr('data');

					

					console.log(myid);

					if (confirm("Do you wish to delete this reference from the tag [can't be undone]?")) {

						var id = $(this).closest('tr').find("td:eq(0)").text();

						console.log(id + 'is tagid');

						var tr=$(this);

						

						var imagesObject = pushDataAJAX('referencesTag', 'id', myid, 2, ''); //delete tags

						imagesObject.done(function (data) {

							console.log(data);

							if (data) {

								if (data == 1) {

									alert("tag-reference connection deleted");
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
						
					
				});

				

				$('.modal').on('click', '.referencesrow', function (e) {

							var id = $(this).find("td:first").text();

							id.trim();

							//alert(id + tagsid);

							if (tagsid) {
								var selectorObject = getDataQuery('referencesTag', '`references_id` = ' + id + ' and `tag_id` = ' + tagsid + '', {
									'0': 'references_id',
									'1': 'tag_id'
								}, 3);

								var alreadyExists;

								selectorObject.done(function (data) {

										if (data) {

											//console.log('important data is' + data);

											if (data == 1) {

												alert('This reference tag combination already exists');
												alreadyExists = 1;
												$('.modal').hide();

												$('.darkClass').hide();

											} else {

												alreadyExists = 0;
											}



											if (alreadyExists == 0) {

												var tagsImagesObject = pushDataAJAX('referencesTag', 'id', '', 0, {
													'references_id': id,
													'tag_id': tagsid
												}); //insert new object

												tagsImagesObject.done(function (data) {

													//console.log('tagsImagesObject = ' + data);

													if (data) {

														if (isNormalInteger(data)) {

															alert("Reference added");

															//add the tag to the table

															//$('.file').find('td[id=' + imageID + ']').closest('tr').find('td:eq(6)').append('<button id="' + data + '" class="tagButton">' + $(cellClicked).closest('tr').find('td:eq(1)').text() + '</button>');

															$('.modal').hide();

															$('.darkClass').hide();

															location.reload();

															return;


														} else {

															alert("Error, try again");

														}



													}


												});

											}
										}

										
								})
								
							}
							
						});


				

				$('.content').on('click', '.deleteTag', function () {

					if (confirm("Do you wish to delete this tag [can't be undone]?")) {

						var id = $(this).closest('tr').find("td:eq(0)").text();

						var tr = $(this).closest('tr');

						var imagesObject = pushDataAJAX('tags', 'id', id, 2, ''); //delete tags

						imagesObject.done(function (data) {

							console.log(data);

							if (data) {

								if (data == 1) {

									alert("tag connection deleted");
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


				});

				$('.content').on('click', '.reference', function () {


					event.preventDefault();

					var cellClicked = $(this);

					imageID = $(this).closest('tr').find("td:eq(0)").text();;

					console.log('tag id is' + imageID);

					tagsid = imageID;

					singleTag = 1;

					$('.darkClass').show();



					var selectorObject = getDataQuery('references', '', {
						'id': 'id',
						'authors': 'authors',
						'reference': 'formatted',
						'DOI': 'DOI',
						'journal': 'journal',

					}, 2);

					//console.log(selectorObject);

					selectorObject.done(function (data) {

						//console.log(data);

						$('.modal').show();

						$('.modal').show();
						$('.modal').css('max-height', 800);
						$('.modal').css('max-width', 800);
						$('.modal').css('overflow', 'scroll');



						$('.modal').find('.modalContent').html('<h3>Choose Reference</h3>');

						$('.modal').find('.modalContent').append('<div class="modalMessageBox"></div>');

						$('.modal').find('.modalContent').append('<p>' + data + '</p>');

						$('.modal').find('.modalContent').append('<button id="newReference">Add new reference</button>');

						makeSearchBoxModal();

						return;



					})

				})

			});
			</script>    
		    
		    
		<?php
		
		    // Include the footer file to complete the template:
		    include(BASE_URI . "/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>
		
		