
		
		
		<?php
			
			//further to do; add description to chapter table
			//fix ability yo skip
		
		
		require ('includes/config.inc.php');
		
		require (BASE_URI . '/scripts/headerIndex.php');
		
		/*$host = substr($_SERVER['HTTP_HOST'], 0, 5);
		if (in_array($host, array('local', '127.0', '192.1'))) {
		    $local = TRUE;
		} else {
		    $local = FALSE;
		}
		
		if ($local){
			
		
		require ($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/scripts/headerIndex.php');
			
			
		}else{
		
		require ($_SERVER['DOCUMENT_ROOT'].'/scripts/headerIndex.php'); //set this at login in session
		
		} //set this at login in session
		
		*/
	
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
		
		
		<script src=<?php echo BASE_URL . "/dist/jquery.vimeo.api.min.js"?>></script>

		
		
		
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
		include(BASE_URI . "/scripts/logobar.php");
		
		include(BASE_URI . "/includes/naviv1.php");
		?>
		
		<!---->
		
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
								include(BASE_URI . "/includes/footer.html");
								exit();
		
							}
						}else {
							
							echo "This page requires the id of a video existing in the database to be passed";
							echo '</div></div>';
							include(BASE_URI . "/includes/footer.html");
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
					
					
					
					<div class='col-9 images'>
						
						<div class='responsiveContainer'>
							
							<?php
								
								//select 9 random grade 1 images from the databse and dsiplay
								
								$general->getHighestRatedImagesCover (BASE_URL);
								
								
							?>
							<!--
							
							<div class = 'row'>
						
								<div class='col-3'>
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
								</div>
								
							
							
							</div>	
							
							<div class = 'row'>
						
								<div class='col-3'>
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
								</div>
								
							
							
							</div>	
							
							<div class = 'row'>
						
								<div class='col-3'>
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
								</div>
								
								<div class='col-3'>
									
									
									<img class='cover' src='<?php echo BASE_URL . '/includes/images/image6828.jpg';?>'>
									
								</div>
								
							
							
							</div>																											
						-->
														
							
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
												 
								    <div class='col-12 black whiteborder center news'>
									    
									    <div id='chapterInfo'>
										    
										    <p id='chapterHeading'><b>New on endoWiki</b></p>
										    						    
										    
										   
											
										</div>
										
										<div id='buttons'></div>
									</div>
									
								</div> 
									
						</div> 
									
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

var serializedReturn;

var serializedReturnForgot;

function submitusersForgotForm (){

	var dataToSend = serializedReturnForgot;

	disableFormInputs('usersForgot');

	console.log(serializedReturnForgot);

	var usersObject = $.ajax({
		url: siteRoot + "scripts/mailLogin.php",
		type: "get",
		data: serializedReturnForgot,


	});

			usersObject.done(function (data){

				console.log(data);

				enableFormInputs('usersForgot');

				if ($.isNumeric(data)){

					alert ("If this email address is registered you will soon receive an email. \n If you do not receive it and you are sure you are registered please check your junk mail folder.");
					$('.modal').hide();
					$('.darkClass').hide();


				}else {

					alert(data);

				}


			});



}

function submitusersForm (){
		
		
			var dataToSend = serializedReturn;

			disableFormInputs('users');

			console.log(serializedReturn);

			var usersObject = $.ajax({
						url: siteRoot + "scripts/registerUser.php",
						type: "get",
						data: serializedReturn,

				
					});

			usersObject.done(function (data){

				console.log(data);

				enableFormInputs('users');

				if ($.isNumeric(data)){

					alert ("You were successfully registered for the site \n Please now login with your details");
					$('.modal').hide();
					$('.darkClass').hide();


				}else {

					alert(data);

				}


			});

		


	}


$(document).ready(function() {

	
        
    //!modify navbar to include page specific links
    
    /*var navBarEntry = '<div class="dropdown"><button class="dropbtn activeButton">Video Atlas</button><div class="dropdown-content"><a href="' + siteRoot + 'scripts/display/displayVideo.php">All Videos</a><hr></div></div>';
    
    $('.navbar').find('a:eq(1)').after(navBarEntry);*/
	/*
    $('#loading').bind('ajaxStart', function() {
        $(this).show();
    }).bind('ajaxSuccess', function() {
        $(this).hide();
    });
    */
    $(".news").css("height", $(".images").height());
    

    var titleGraphic = $(".title").height();
    var titleBar = $("#menu").height();
    $(".title").css('height', (titleBar));


    $(window).resize(function() {
        waitForFinalEvent(function() {
            //alert("Resize...");
            var titleGraphic = $(".title").height();
            var titleBar = $("#menu").height();
            $(".title").css('height', (titleBar));
            $(".news").css("height", $(".images").height());

        }, 100, 'Resize header');
    });
	
	$(".modal").on('click', '#submitusers', (function(event) {
					//alert('detected');
					event.preventDefault();
					var form = $('#users');
					serializedReturn = $('input[name!=confirm], select', $(form)).serialize();
			        $('#users').submit();
		
		
				}));
				
	$(".modal").on('click', '#submitusersForgot', (function(event) {
					//alert('detected');
					event.preventDefault();
					var form = $('#usersForgot');
					serializedReturnForgot = $('input, select', $(form)).serialize();
			        $('#usersForgot').submit();
		
		
			    }));

	$(".modal").on("click", "#signUp", function(){

		

		var manipulation = $.ajax({
						url: siteRoot + "scripts/forms/userIndexForm.php",
						type: "get",
						data: '',

				
					});

					manipulation.done(function(data) {

						console.log('manipulation = ' + data);

                        if (data) {
							
							$('.modal').show();

					$('.darkClass').show();

					//$('.modal').show();
					$('.modal').css('max-height', 800);
					$('.modal').css('max-width', 800);
					$('.modal').css('overflow', 'scroll');

					$('.modal').find('.modalContent').html('<h3>Sign Up to EndoWiki</h3>');
					
					$('.modal').find('.modalContent').append('<p>Thanks for expressing your interest in Endoscopy Wiki. <br> Joining is free. <br> Multiple high quality learning opportunities are only a few clicks away.</p>');

					$('.modal').find('.modalContent').append(data);

					$("#users").validate({
		
		invalidHandler: function(event, validator) {
			var errors = validator.numberOfInvalids();
			console.log("there were " + errors + "errors");
			if (errors) {
				var message = errors == 1 ?
					"You missed 1 field. It has been highlighted" :
					"You missed " + errors + " fields. They have been highlighted";
				$('div.error span').html(message);
				$('div.error').css('fontSize',10);
				$('div.error').show();
			} else {
				$('div.error').hide();
			}
		},rules: {

			firstname: { required: true },   
			surname: { required: true },   
			email: { required: true, email: true },   
			password: { minlength : 8, required: true },   
			confirm : {
                    minlength : 8,
                    equalTo : "#password"
                },
			centreName: { required: true },
			centreCity: { required: true },
			specialistInterest: { required: true },
			trainee: { required: true },
			yearsIndependent: { number: true, required: true, max: 70 },
			yearsEndoscopy: { number: true, required: true, max: 70 },
			endoscopyTrainingProgramme : { required: true },
			emailPreferences: { required: true },  


	},messages: {

			firstname: { required: 'Please enter your first name' },   
			surname: { required: 'Please enter your surname' },   
			email: { required: 'Please enter your email address', email: 'Please enter a valid email address'},   
			password: { minlength: 'Password must be 8 or more characters', required: 'Please enter a password' },   
			confirm: {minlength: 'Password must be 8 or more characters', equalTo: 'Passwords do not match'},
			centreName: { required: 'Please enter the name of your institution' },
			centreCity: { required: 'Please enter your institution city' },
			specialistInterest: { required: 'Please select your specialist interest' },
			trainee: { required: 'Are you a trainee?' },
			yearsIndependent: { required: 'How many years have you been practising your specialty (incl. training)' },
			yearsEndoscopy: { required: 'How many years have you been performing endoscopy?' },
			endoscopyTrainingProgramme : { required: 'Required' },
			emailPreferences: { required: 'Required' },


			//access_level: { required: 'Please enter user access level' },   

	},
			submitHandler: function(form) {

				//alert('got past the validation');
				submitusersForm();

				//console.log("User form submitted");



		}




	});
						}
					})

	});

	$(".modal").on("click", "#forgot", function(){

		

var manipulation = $.ajax({
				url: siteRoot + "scripts/forms/userForgotPasswordForm.php",
				type: "get",
				data: '',

		
			});

			manipulation.done(function(data) {

				console.log('manipulation = ' + data);

				if (data) {
					
					$('.modal').show();

			$('.darkClass').show();

			//$('.modal').show();
			$('.modal').css('max-height', 800);
			$('.modal').css('max-width', 800);
			$('.modal').css('overflow', 'scroll');

			$('.modal').find('.modalContent').html('<h3>Forgotten Password</h3>');
			
			$('.modal').find('.modalContent').append('<p>Enter your email address below. <br> If this email address is registered you will receive a password reset email.</p><br>');

			$('.modal').find('.modalContent').append(data);

			$('.modal').find('.modalContent').append('<div class="errorTxt" style="font-size:12px;"></div>');

			$("#usersForgot").validate({

invalidHandler: function(event, validator) {
	var errors = validator.numberOfInvalids();
	console.log("there were " + errors + "errors");
	if (errors) {
		var message = errors == 1 ?
			"You missed 1 field. It has been highlighted" :
			"You missed " + errors + " fields. They have been highlighted";
		$('div.error span').html('<br>'+message);
		$('.error').css('fontSize',10);
		$('div.error').show();
	} else {
		$('div.error').hide();
	}
},rules: {

	  
	email: { required: true, email: true },   
	


},messages: {

	
	email: { required: 'Please enter the registered email address', email: 'Please enter a valid email address'},   
	


	//access_level: { required: 'Please enter user access level' },   

},errorElement : 'div',
    errorLabelContainer: '.errorTxt',
	submitHandler: function(form) {

		//alert('got past the validation');
		submitusersForgotForm();

		//console.log("User form submitted");



}




});
				}
			})

});
	
   
		

    

})		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include(BASE_URI ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>