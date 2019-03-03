
		
		
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
		    <title>auth_group Form</title>
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
		                    <h2 style="text-align:left;">auth_group Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  auth_group  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="auth_group">
					    <?php echo $formv1->generateText('name', 'name', '', 'tooltip here');
?>
						    <button id="submitauth_group">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
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
		
			 auth_groupPassed = $("#id").text();
		
			if ( auth_groupPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("auth_group");
		
				auth_groupRequired = new Object;
		
				auth_groupRequired = getNamesFormElements("auth_group");
		
				auth_groupString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("auth_group", auth_groupString, getNamesFormElements("auth_group"), 1);
		
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
				    
				    $("#messageBox").text("Editing auth_group id "+idPassed);
		
				    enableFormInputs("auth_group");
		
				});
		
				try {
		
					$("form#auth_group").find("button#deleteauth_group").length();
		
				}catch(error){
		
					$("form#auth_group").find("button").after("<button id='deleteauth_group'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteauth_group (){
		
				//auth_groupPassed is the current record, some security to check its also that in the id field
		
				if (auth_groupPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this auth_group?")) {
		
					disableFormInputs("auth_group");
		
					var auth_groupObject = pushDataFromFormAJAX("auth_group", "auth_group", "id", auth_groupPassed, "2"); //delete auth_group
		
					auth_groupObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("auth_group deleted");
								edit = 0;
								auth_groupPassed = null;
								window.location.href = siteRoot + "scripts/forms/auth_groupTable.php";
								//go to auth_group list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("auth_group");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitauth_groupForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var auth_groupObject = pushDataFromFormAJAX("auth_group", "auth_group", "id", null, "0"); //insert new object
		
					auth_groupObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New auth_group no "+data+" created");
							edit = 1;
							$("#id").text(data);
							auth_groupPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var auth_groupObject = pushDataFromFormAJAX("auth_group", "auth_group", "id", auth_groupPassed, "1"); //insert new object
		
					auth_groupObject.done(function (data){
		
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
		
					fillForm(auth_groupPassed);
		
				}else{
					
					$("#messageBox").text("New auth_group");
					
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
		
		
				$("#content").on('click', '#submitauth_group', (function(event) {
			        event.preventDefault();
			        $('#auth_group').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteauth_group', (function(event) {
			        event.preventDefault();
			        deleteauth_group();
		
		
			    }));
		
				$("#auth_group").validate({
		
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
},messages: {
name: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitauth_groupForm();
		
			          	console.log("submitted form");
		
		
		
			    }
		
		
		
		
		    });
		
		})
		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include(BASE_URI . "/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>