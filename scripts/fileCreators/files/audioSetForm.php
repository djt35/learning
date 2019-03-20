
		
		
			<?php

			//$openaccess = 1 allows the page to be viewed without login and skips the rest of the script
			//$requiredUserLevel corresponds to database users access level; if not set the page simply requires login
			//$paid allows setting of pages which require subscription and login

			//define token from url

			require ('../../includes/config.inc.php');
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
		    <title>audioSet Form</title>
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
		                    <h2 style="text-align:left;">audioSet Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableaudioSet" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/audioSetTable.php';">Table of audioSet</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `audioSet`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="audioSet">
					    <?php echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('type', 'type', '', 'tooltip here');
?>
						    <button id="submitaudioSet">Submit</button>
		
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
		
			 audioSetPassed = $("#id").text();
		
			if ( audioSetPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("audioSet");
		
				audioSetRequired = new Object;
		
				audioSetRequired = getNamesFormElements("audioSet");
		
				audioSetString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("audioSet", audioSetString, getNamesFormElements("audioSet"), 1);
		
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
				    
				    $("#messageBox").append("Editing audioSet id "+idPassed);
		
				    enableFormInputs("audioSet");
		
				});
		
				try {
		
					$("form#audioSet").find("button#deleteaudioSet").length();
		
				}catch(error){
		
					$("form#audioSet").find("button").after("<button id='deleteaudioSet'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteaudioSet (){
		
				//audioSetPassed is the current record, some security to check its also that in the id field
		
				if (audioSetPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this audioSet?")) {
		
					disableFormInputs("audioSet");
		
					var audioSetObject = pushDataFromFormAJAX("audioSet", "audioSet", "id", audioSetPassed, "2"); //delete audioSet
		
					audioSetObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("audioSet deleted");
								edit = 0;
								audioSetPassed = null;
								window.location.href = siteRoot + "scripts/forms/audioSetTable.php";
								//go to audioSet list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("audioSet");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitaudioSetForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var audioSetObject = pushDataFromFormAJAX("audioSet", "audioSet", "id", null, "0"); //insert new object
		
					audioSetObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New audioSet no "+data+" created");
							edit = 1;
							$("#id").text(data);
							audioSetPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var audioSetObject = pushDataFromFormAJAX("audioSet", "audioSet", "id", audioSetPassed, "1"); //insert new object
		
					audioSetObject.done(function (data){
		
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
		
					fillForm(audioSetPassed);
		
				}else{
					
					$("#messageBox").append("New audioSet");
					
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
		
		
				$("#content").on('click', '#submitaudioSet', (function(event) {
			        event.preventDefault();
			        $('#audioSet').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteaudioSet', (function(event) {
			        event.preventDefault();
			        deleteaudioSet();
		
		
			    }));
		
				$("#audioSet").validate({
		
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
name: { required: true },   
type: { required: true },   
},messages: {
name: { required: 'message' },   
type: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitaudioSetForm();
		
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