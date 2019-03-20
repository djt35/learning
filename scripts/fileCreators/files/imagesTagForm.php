
		
		
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
		    <title>imagesTag Form</title>
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
		                    <h2 style="text-align:left;">imagesTag Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableimagesTag" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/imagesTagTable.php';">Table of imagesTag</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `imagesTag`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="imagesTag">
					    <?php echo $formv1->generateText('images_id', 'images_id', '', 'tooltip here');
echo $formv1->generateText('tags_id', 'tags_id', '', 'tooltip here');
?>
						    <button id="submitimagesTag">Submit</button>
		
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
		
			 imagesTagPassed = $("#id").text();
		
			if ( imagesTagPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("imagesTag");
		
				imagesTagRequired = new Object;
		
				imagesTagRequired = getNamesFormElements("imagesTag");
		
				imagesTagString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("imagesTag", imagesTagString, getNamesFormElements("imagesTag"), 1);
		
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
				    
				    $("#messageBox").append("Editing imagesTag id "+idPassed);
		
				    enableFormInputs("imagesTag");
		
				});
		
				try {
		
					$("form#imagesTag").find("button#deleteimagesTag").length();
		
				}catch(error){
		
					$("form#imagesTag").find("button").after("<button id='deleteimagesTag'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimagesTag (){
		
				//imagesTagPassed is the current record, some security to check its also that in the id field
		
				if (imagesTagPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this imagesTag?")) {
		
					disableFormInputs("imagesTag");
		
					var imagesTagObject = pushDataFromFormAJAX("imagesTag", "imagesTag", "id", imagesTagPassed, "2"); //delete imagesTag
		
					imagesTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("imagesTag deleted");
								edit = 0;
								imagesTagPassed = null;
								window.location.href = siteRoot + "scripts/forms/imagesTagTable.php";
								//go to imagesTag list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("imagesTag");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimagesTagForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imagesTagObject = pushDataFromFormAJAX("imagesTag", "imagesTag", "id", null, "0"); //insert new object
		
					imagesTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New imagesTag no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imagesTagPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imagesTagObject = pushDataFromFormAJAX("imagesTag", "imagesTag", "id", imagesTagPassed, "1"); //insert new object
		
					imagesTagObject.done(function (data){
		
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
		
					fillForm(imagesTagPassed);
		
				}else{
					
					$("#messageBox").append("New imagesTag");
					
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
		
		
				$("#content").on('click', '#submitimagesTag', (function(event) {
			        event.preventDefault();
			        $('#imagesTag').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteimagesTag', (function(event) {
			        event.preventDefault();
			        deleteimagesTag();
		
		
			    }));
		
				$("#imagesTag").validate({
		
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
images_id: { required: true },   
tags_id: { required: true },   
},messages: {
images_id: { required: 'message' },   
tags_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitimagesTagForm();
		
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