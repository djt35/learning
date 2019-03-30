
		
		
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
		    <title>UserPaidImageSet Form</title>
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
		                    <h2 style="text-align:left;">UserPaidImageSet Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableUserPaidImageSet" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/UserPaidImageSetTable.php';">Table of UserPaidImageSet</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `UserPaidImageSet`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="UserPaidImageSet">
					    <?php echo $formv1->generateText('user_id', 'user_id', '', 'tooltip here');
echo $formv1->generateText('imageSet_id', 'imageSet_id', '', 'tooltip here');
?>
						    <button id="submitUserPaidImageSet">Submit</button>
		
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
		
			 UserPaidImageSetPassed = $("#id").text();
		
			if ( UserPaidImageSetPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("UserPaidImageSet");
		
				UserPaidImageSetRequired = new Object;
		
				UserPaidImageSetRequired = getNamesFormElements("UserPaidImageSet");
		
				UserPaidImageSetString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("UserPaidImageSet", UserPaidImageSetString, getNamesFormElements("UserPaidImageSet"), 1);
		
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
				    
				    $("#messageBox").append("Editing UserPaidImageSet id "+idPassed);
		
				    enableFormInputs("UserPaidImageSet");
		
				});
		
				try {
		
					$("form#UserPaidImageSet").find("button#deleteUserPaidImageSet").length();
		
				}catch(error){
		
					$("form#UserPaidImageSet").find("button").after("<button id='deleteUserPaidImageSet'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteUserPaidImageSet (){
		
				//UserPaidImageSetPassed is the current record, some security to check its also that in the id field
		
				if (UserPaidImageSetPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this UserPaidImageSet?")) {
		
					disableFormInputs("UserPaidImageSet");
		
					var UserPaidImageSetObject = pushDataFromFormAJAX("UserPaidImageSet", "UserPaidImageSet", "id", UserPaidImageSetPassed, "2"); //delete UserPaidImageSet
		
					UserPaidImageSetObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("UserPaidImageSet deleted");
								edit = 0;
								UserPaidImageSetPassed = null;
								window.location.href = siteRoot + "scripts/forms/UserPaidImageSetTable.php";
								//go to UserPaidImageSet list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("UserPaidImageSet");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitUserPaidImageSetForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var UserPaidImageSetObject = pushDataFromFormAJAX("UserPaidImageSet", "UserPaidImageSet", "id", null, "0"); //insert new object
		
					UserPaidImageSetObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New UserPaidImageSet no "+data+" created");
							edit = 1;
							$("#id").text(data);
							UserPaidImageSetPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var UserPaidImageSetObject = pushDataFromFormAJAX("UserPaidImageSet", "UserPaidImageSet", "id", UserPaidImageSetPassed, "1"); //insert new object
		
					UserPaidImageSetObject.done(function (data){
		
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
		
					fillForm(UserPaidImageSetPassed);
		
				}else{
					
					$("#messageBox").append("New UserPaidImageSet");
					
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
		
		
				$("#content").on('click', '#submitUserPaidImageSet', (function(event) {
			        event.preventDefault();
			        $('#UserPaidImageSet').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteUserPaidImageSet', (function(event) {
			        event.preventDefault();
			        deleteUserPaidImageSet();
		
		
			    }));
		
				$("#UserPaidImageSet").validate({
		
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
user_id: { required: true },   
imageSet_id: { required: true },   
},messages: {
user_id: { required: 'message' },   
imageSet_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitUserPaidImageSetForm();
		
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