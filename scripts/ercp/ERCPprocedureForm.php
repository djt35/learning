
		
		
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
		    <title>ERCPprocedure Form</title>
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
		                    <h2 style="text-align:left;">ERCPprocedure Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  ERCPprocedure  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="ERCPprocedure">
					    <?php ?>
						    <button id="submitERCPprocedure">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 ERCPprocedurePassed = $("#id").text();
		
			if ( ERCPprocedurePassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("ERCPprocedure");
		
				ERCPprocedureRequired = new Object;
		
				ERCPprocedureRequired = getNamesFormElements("ERCPprocedure");
		
				ERCPprocedureString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("ERCPprocedure", ERCPprocedureString, getNamesFormElements("ERCPprocedure"), 1);
		
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
				    
				    $("#messageBox").text("Editing ERCPprocedure id "+idPassed);
		
				    enableFormInputs("ERCPprocedure");
		
				});
		
				try {
		
					$("form#ERCPprocedure").find("button#deleteERCPprocedure").length();
		
				}catch(error){
		
					$("form#ERCPprocedure").find("button").after("<button id='deleteERCPprocedure'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteERCPprocedure (){
		
				//ERCPprocedurePassed is the current record, some security to check its also that in the id field
		
				if (ERCPprocedurePassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this ERCPprocedure?")) {
		
					disableFormInputs("ERCPprocedure");
		
					var ERCPprocedureObject = pushDataFromFormAJAX("ERCPprocedure", "ERCPprocedure", "id", ERCPprocedurePassed, "2"); //delete ERCPprocedure
		
					ERCPprocedureObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("ERCPprocedure deleted");
								edit = 0;
								ERCPprocedurePassed = null;
								window.location.href = siteRoot + "scripts/forms/ERCPprocedureTable.php";
								//go to ERCPprocedure list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("ERCPprocedure");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitERCPprocedureForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var ERCPprocedureObject = pushDataFromFormAJAX("ERCPprocedure", "ERCPprocedure", "id", null, "0"); //insert new object
		
					ERCPprocedureObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New ERCPprocedure no "+data+" created");
							edit = 1;
							$("#id").text(data);
							ERCPprocedurePassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var ERCPprocedureObject = pushDataFromFormAJAX("ERCPprocedure", "ERCPprocedure", "id", ERCPprocedurePassed, "1"); //insert new object
		
					ERCPprocedureObject.done(function (data){
		
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
		
					fillForm(ERCPprocedurePassed);
		
				}else{
					
					$("#messageBox").text("New ERCPprocedure");
					
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
		
		
				$("#content").on('click', '#submitERCPprocedure', (function(event) {
			        event.preventDefault();
			        $('#ERCPprocedure').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteERCPprocedure', (function(event) {
			        event.preventDefault();
			        deleteERCPprocedure();
		
		
			    }));
		
				$("#ERCPprocedure").validate({
		
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
			        },
			        submitHandler: function(form) {
		
			            submitERCPprocedureForm();
		
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