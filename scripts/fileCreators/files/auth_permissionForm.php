
		
		
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
		    <title>auth_permission Form</title>
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
		                    <h2 style="text-align:left;">auth_permission Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableauth_permission" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/auth_permissionTable.php';">Table of auth_permission</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `auth_permission`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="auth_permission">
					    <?php echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('content_type_id', 'content_type_id', '', 'tooltip here');
echo $formv1->generateText('codename', 'codename', '', 'tooltip here');
?>
						    <button id="submitauth_permission">Submit</button>
		
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
		
			 auth_permissionPassed = $("#id").text();
		
			if ( auth_permissionPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("auth_permission");
		
				auth_permissionRequired = new Object;
		
				auth_permissionRequired = getNamesFormElements("auth_permission");
		
				auth_permissionString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("auth_permission", auth_permissionString, getNamesFormElements("auth_permission"), 1);
		
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
				    
				    $("#messageBox").append("Editing auth_permission id "+idPassed);
		
				    enableFormInputs("auth_permission");
		
				});
		
				try {
		
					$("form#auth_permission").find("button#deleteauth_permission").length();
		
				}catch(error){
		
					$("form#auth_permission").find("button").after("<button id='deleteauth_permission'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteauth_permission (){
		
				//auth_permissionPassed is the current record, some security to check its also that in the id field
		
				if (auth_permissionPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this auth_permission?")) {
		
					disableFormInputs("auth_permission");
		
					var auth_permissionObject = pushDataFromFormAJAX("auth_permission", "auth_permission", "id", auth_permissionPassed, "2"); //delete auth_permission
		
					auth_permissionObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("auth_permission deleted");
								edit = 0;
								auth_permissionPassed = null;
								window.location.href = siteRoot + "scripts/forms/auth_permissionTable.php";
								//go to auth_permission list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("auth_permission");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitauth_permissionForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var auth_permissionObject = pushDataFromFormAJAX("auth_permission", "auth_permission", "id", null, "0"); //insert new object
		
					auth_permissionObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New auth_permission no "+data+" created");
							edit = 1;
							$("#id").text(data);
							auth_permissionPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var auth_permissionObject = pushDataFromFormAJAX("auth_permission", "auth_permission", "id", auth_permissionPassed, "1"); //insert new object
		
					auth_permissionObject.done(function (data){
		
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
		
					fillForm(auth_permissionPassed);
		
				}else{
					
					$("#messageBox").append("New auth_permission");
					
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
		
		
				$("#content").on('click', '#submitauth_permission', (function(event) {
			        event.preventDefault();
			        $('#auth_permission').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteauth_permission', (function(event) {
			        event.preventDefault();
			        deleteauth_permission();
		
		
			    }));
		
				$("#auth_permission").validate({
		
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
content_type_id: { required: true },   
codename: { required: true },   
},messages: {
name: { required: 'message' },   
content_type_id: { required: 'message' },   
codename: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitauth_permissionForm();
		
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