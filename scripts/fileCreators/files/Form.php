
		
		
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
		    <title> Form</title>
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
		                    <h2 style="text-align:left;"> Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="table" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/Table.php';">Table of </button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  ``  FROM  ``  WHERE    = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="">
					    <?php ?>
						    <button id="submit">Submit</button>
		
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
		
			 Passed = $("#id").text();
		
			if ( Passed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("");
		
				Required = new Object;
		
				Required = getNamesFormElements("");
		
				String = '``=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("", String, getNamesFormElements(""), 1);
		
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
				    
				    $("#messageBox").append("Editing  id "+idPassed);
		
				    enableFormInputs("");
		
				});
		
				try {
		
					$("form#").find("button#delete").length();
		
				}catch(error){
		
					$("form#").find("button").after("<button id='delete'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function delete (){
		
				//Passed is the current record, some security to check its also that in the id field
		
				if (Passed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this ?")) {
		
					disableFormInputs("");
		
					var Object = pushDataFromFormAJAX("", "", "", Passed, "2"); //delete 
		
					Object.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert (" deleted");
								edit = 0;
								Passed = null;
								window.location.href = siteRoot + "scripts/forms/Table.php";
								//go to  list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var Object = pushDataFromFormAJAX("", "", "", null, "0"); //insert new object
		
					Object.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New  no "+data+" created");
							edit = 1;
							$("#id").text(data);
							Passed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var Object = pushDataFromFormAJAX("", "", "", Passed, "1"); //insert new object
		
					Object.done(function (data){
		
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
		
					fillForm(Passed);
		
				}else{
					
					$("#messageBox").append("New ");
					
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
		
		
				$("#content").on('click', '#submit', (function(event) {
			        event.preventDefault();
			        $('#').submit();
		
		
			    }));
		
			    $("#content").on('click', '#delete', (function(event) {
			        event.preventDefault();
			        delete();
		
		
			    }));
		
				$("#").validate({
		
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
		
			            submitForm();
		
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