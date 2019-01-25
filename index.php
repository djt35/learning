
		
		
		<?php
			
			//further to do; add description to chapter table
			//fix ability yo skip
		
		
		
		require ($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/scripts/headerIndex.php'); //set this at login in session
	
		$formv1 = new formGenerator;
		$general = new general;
		$video = new video;
		$tagCategories = new tagCategories;
		
		
		/*
		foreach ($_GET as $k=>$v){
		
			$sanitised = $general->sanitiseInput($v);
			$_GET[$k] = $sanitised;
		
		
		}
		
		if (isset($_GET["id"]) && is_numeric($_GET["id"])){
			$id = $_GET["id"];
		
		}else{
		
			$id = null;
		
		}
		
		*/
		
		//TERMINATE THE SCRIPT IF NOT A SUPERUSER
		
		
		
		// Page content
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>endoWiki</title>
		</head>	  
		
		
		<script src=<?php echo $roothttp . "/dist/jquery.vimeo.api.min.js"?>></script>

		
		
		
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
				
				overflow-x: scroll;
				
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
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviv1.php");
		?>
		
		<div id="loading">
	
		</div>
		
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
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
			
			
		
		    <div id='content' class='content'>
		
		        <div class='responsiveContainer white'>
		
			        
		
		
			        <p><?php
		
				        /*if ($id){
		
							$q = "SELECT  `id`  FROM  `video`  WHERE  `id`  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								echo '</div></div>';
								include($root ."/includes/footer.html");
								exit();
		
							}
						}else {
							
							echo "This page requires the id of a video existing in the database to be passed";
							echo '</div></div>';
							include($root ."/includes/footer.html");
							exit();
							
						}*/
		
		?></p>
		
		<div class='row'>
		                <div class='col-9'>
		                    <h2 class='' id="pageTitle" style="text-align:left; margin:0;"><?php echo 'Quality photos, videos and learning in Endoscopy and Endoscopic Resection';?></h2>
		                    		                </div>
		                
					
					</div>  
		
		                
		            </div>
		
			<div id="vimeoid" style="display:none;"><?php ?></div>
			
			<div id="videoChapterData" style="display:none;"><?php ?></div>
				

			        
				<div class='row'>
					
					
					
					<div class='col-9'>
						
						<div class='responsiveContainer'>
							
							<div class = 'row'>
						
								<div class='col-3'>
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
								</div>
								
							
							
							</div>	
							
							<div class = 'row'>
						
								<div class='col-3'>
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
								</div>
								
							
							
							</div>	
							
							<div class = 'row'>
						
								<div class='col-3'>
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo $roothttp . 'includes/images/image6828.jpg';?>'>
									
								</div>
								
							
							
							</div>																											
						
														
							
						</div>	
						
					</div>
					
					
					
					
					<div class='col-3'>
					
						<div class='responsiveContainer'>
									
								<div class='row'>	
									<div class='col-12 yellow-light center'>
										<div id='chapterSelector'>
											Welcome to endoWiki
											<?php ?>
										</div>
										<div id='chapterSelectorMessage'></div>
										
									</div>
									
								</div>
								
								<div class='row'>	
												 
								    <div class='col-12 black whiteborder center' style="min-height:60vh;">
									    
									    <div id='chapterInfo'>
										    
										    <p id='chapterHeading'><b>New on endoWiki</b></p>
										    						    
										    
										   
											
										</div>
										
										<div id='buttons'></div>
									</div>
									
								</div> 
									
						</div> 
									
					</div>				
					  
				</div>
				
				<div class='row'>
					<div class='col-1'>
					</div>
					<div class='col-10'>
					
						<div id='images' class='standardBack'>
							
						</div>
					    <!--<<form id="imageUpload">
					    
					    input name="files[]" type="file" multiple="multiple" accept=".jpg, .jpeg, .bmp"/>-->
					    
					    <!--<button id="submitimagefiles">Submit</button>
		
					    </form>-->
					</div>
				    <div class='col-1'>
					</div>    
				</div>
				
				<hr>
				
				<div class='row'>
					
				</div>
				
				
				
				
		
		        </div>
		
		    </div>
		<script>
			
var siteRoot = "http://localhost:90/dashboard/learning/";


$(document).ready(function() {

        
    //!modify navbar to include page specific links
    
    /*var navBarEntry = '<div class="dropdown"><button class="dropbtn activeButton">Video Atlas</button><div class="dropdown-content"><a href="' + siteRoot + 'scripts/display/displayVideo.php">All Videos</a><hr></div></div>';
    
    $('.navbar').find('a:eq(1)').after(navBarEntry);*/

    $('#loading').bind('ajaxStart', function() {
        $(this).show();
    }).bind('ajaxStop', function() {
        $(this).hide();
    });

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
		    include($root ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>