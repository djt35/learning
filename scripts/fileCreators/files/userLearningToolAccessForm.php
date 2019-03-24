
		
		
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
			$tagCategories = new tagCategories;?>
		
		<script src='<?php echo BASE_URL . '/includes/tableinclude.js'; ?>' type='text/javascript'></script>
		
		<?php

		foreach ($_GET as $k=>$v){
		
			$sanitised = $general->sanitiseInput($v);
			$_GET[$k] = $sanitised;
		
		
		}
		
		if (isset($_GET["id"]) && is_numeric($_GET["id"])){
			$id = $_GET["id"];
		
		}else{
		
			$id = null;
		
		}
		
		
		
		//TERMINATE THE SCRIPT IF NOT A SUPERUSER
		
		
		
		// Page content
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>userLearningToolAccess Form</title>
		</head>
		
		<?php
		include(BASE_URI . "/scripts/logobar.php");
		
		include(BASE_URI . "/includes/naviCreator.php");
		?>
		
		<body>
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
		
		    <div id='content' class='content'>
		
		        <div class='responsiveContainer white'>
		
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">userLearningToolAccess Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableuserLearningToolAccess" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/userLearningToolAccessTable.php';">Table of userLearningToolAccess</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `userLearningToolAccess`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="userLearningToolAccess">
					    <?php echo $formv1->generateText('userid', 'userid', '', 'tooltip here');
echo $formv1->generateText('learningToolid', 'learningToolid', '', 'tooltip here');
echo $formv1->generateText('access', 'access', '', 'tooltip here');
?>
						    <button id="submituserLearningToolAccess">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
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
		
			 userLearningToolAccessPassed = $("#id").text();
		
			if ( userLearningToolAccessPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("userLearningToolAccess");
		
				userLearningToolAccessRequired = new Object;
		
				userLearningToolAccessRequired = getNamesFormElements("userLearningToolAccess");
		
				userLearningToolAccessString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("userLearningToolAccess", userLearningToolAccessString, getNamesFormElements("userLearningToolAccess"), 1);
		
				//console.log(selectorObject);
		
				selectorObject.done(function (data){
		
					//console.log(data);
		
					var formData = $.parseJSON(data);
		
		
				    $(formData).each(function(i,val){
					    $.each(val,function(k,v){
					        $("#"+k).val(v);
					        //console.log(k+' : '+ v);
					    });
		
				    });
				    
				    $("#messageBox").append("Editing userLearningToolAccess id "+idPassed);
		
				    enableFormInputs("userLearningToolAccess");
		
				});
		
				try {
		
					$("form#userLearningToolAccess").find("button#deleteuserLearningToolAccess").length();
		
				}catch(error){
		
					$("form#userLearningToolAccess").find("button").after("<button id='deleteuserLearningToolAccess'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteuserLearningToolAccess (){
		
				//userLearningToolAccessPassed is the current record, some security to check its also that in the id field
		
				if (userLearningToolAccessPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this userLearningToolAccess?")) {
		
					disableFormInputs("userLearningToolAccess");
		
					var userLearningToolAccessObject = pushDataFromFormAJAX("userLearningToolAccess", "userLearningToolAccess", "id", userLearningToolAccessPassed, "2"); //delete userLearningToolAccess
		
					userLearningToolAccessObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("userLearningToolAccess deleted");
								edit = 0;
								userLearningToolAccessPassed = null;
								window.location.href = siteRoot + "scripts/forms/userLearningToolAccessTable.php";
								//go to userLearningToolAccess list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("userLearningToolAccess");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submituserLearningToolAccessForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var userLearningToolAccessObject = pushDataFromFormAJAX("userLearningToolAccess", "userLearningToolAccess", "id", null, "0"); //insert new object
		
					userLearningToolAccessObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New userLearningToolAccess no "+data+" created");
							edit = 1;
							$("#id").text(data);
							userLearningToolAccessPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var userLearningToolAccessObject = pushDataFromFormAJAX("userLearningToolAccess", "userLearningToolAccess", "id", userLearningToolAccessPassed, "1"); //insert new object
		
					userLearningToolAccessObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("Data updated");
								edit = 1;
		
							} else if (data == 0) {
		
							alert("No change in data detected");
		
						    } else if (data == 2) {
		
							alert("Error, try again");
		
						    }
		
		
		
						}
		
		
					});
		
		
		
		
				}
		
		
			}
		
			$(document).ready(function() {
		
				if (edit == 1){
		
					fillForm(userLearningToolAccessPassed);
		
				}else{
					
					$("#messageBox").append("New userLearningToolAccess");
					
				}
		
				
		
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
		
		
				$("#content").on('click', '#submituserLearningToolAccess', (function(event) {
			        event.preventDefault();
			        $('#userLearningToolAccess').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteuserLearningToolAccess', (function(event) {
			        event.preventDefault();
			        deleteuserLearningToolAccess();
		
		
			    }));
		
				$("#userLearningToolAccess").validate({
		
			        invalidHandler: function(event, validator) {
			            var errors = validator.numberOfInvalids();
			            console.log("there were " + errors + "errors");
			            if (errors) {
			                var message = errors == 1 ?
			                    "You missed 1 field. It has been highlighted" :
			                    "You missed " + errors + " fields. They have been highlighted";
			                $('div.error span').html(message);
			                $('div.error').show();
			            } else {
			                $('div.error').hide();
			            }
			        },rules: {
userid: { required: true },   
learningToolid: { required: true },   
access: { required: true },   
},messages: {
userid: { required: 'message' },   
learningToolid: { required: 'message' },   
access: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submituserLearningToolAccessForm();
		
			          	console.log("submitted form");
		
		
		
			    }
		
		
		
		
		    });
		
		})
		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include(BASE_URI ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>