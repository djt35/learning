
		
		
			<?php
		
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
		
			$formv1 = new formGenerator;
			$general = new general;
			$video = new video;
			$tagCategories = new tagCategories;
		
		
		
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
		    <title>auth_group_permissions Form</title>
		</head>
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviCreator.php");
		?>
		
		<body>
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
		
		    <div id='content' class='content'>
		
		        <div class='responsiveContainer white'>
		
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">auth_group_permissions Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  auth_group_permissions  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="auth_group_permissions">
					    <?php echo $formv1->generateText('id', 'id', '', 'tooltip here');
echo $formv1->generateText('group_id', 'group_id', '', 'tooltip here');
echo $formv1->generateText('permission_id', 'permission_id', '', 'tooltip here');
?>
						    <button id="submitauth_group_permissions">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 auth_group_permissionsPassed = $("#id").text();
		
			if ( auth_group_permissionsPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("auth_group_permissions");
		
				auth_group_permissionsRequired = new Object;
		
				auth_group_permissionsRequired = getNamesFormElements("auth_group_permissions");
		
				auth_group_permissionsString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("auth_group_permissions", auth_group_permissionsString, getNamesFormElements("auth_group_permissions"), 1);
		
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
		
				    enableFormInputs("auth_group_permissions");
		
				});
		
				try {
		
					$("form#auth_group_permissions").find("button#deleteauth_group_permissions").length();
		
				}catch(error){
		
					$("form#auth_group_permissions").find("button").after("<button id='deleteauth_group_permissions'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteauth_group_permissions (){
		
				//auth_group_permissionsPassed is the current record, some security to check its also that in the id field
		
				if (auth_group_permissionsPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this auth_group_permissions?")) {
		
					disableFormInputs("auth_group_permissions");
		
					var auth_group_permissionsObject = pushDataFromFormAJAX("auth_group_permissions", "auth_group_permissions", "id", auth_group_permissionsPassed, "2"); //delete auth_group_permissions
		
					auth_group_permissionsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("auth_group_permissions deleted");
								edit = 0;
								auth_group_permissionsPassed = null;
								window.location.href = siteRoot + "scripts/forms/auth_group_permissionsTable.php";
								//go to auth_group_permissions list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("auth_group_permissions");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitauth_group_permissionsForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var auth_group_permissionsObject = pushDataFromFormAJAX("auth_group_permissions", "auth_group_permissions", "id", null, "0"); //insert new object
		
					auth_group_permissionsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New auth_group_permissions no "+data+" created");
							edit = 1;
							$("#id").text(data);
							auth_group_permissionsPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var auth_group_permissionsObject = pushDataFromFormAJAX("auth_group_permissions", "auth_group_permissions", "id", auth_group_permissionsPassed, "1"); //insert new object
		
					auth_group_permissionsObject.done(function (data){
		
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
		
					fillForm(auth_group_permissionsPassed);
		
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
		
		
				$("#content").on('click', '#submitauth_group_permissions', (function(event) {
			        event.preventDefault();
			        $('#auth_group_permissions').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteauth_group_permissions', (function(event) {
			        event.preventDefault();
			        deleteauth_group_permissions();
		
		
			    }));
		
				$("#auth_group_permissions").validate({
		
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
id: { required: true },   
group_id: { required: true },   
permission_id: { required: true },   
},messages: {
id: { required: 'message' },   
group_id: { required: 'message' },   
permission_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitauth_group_permissionsForm();
		
			          	console.log("submitted form");
		
		
		
			    }
		
		
		
		
		    });
		
		})
		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include($root ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>