
		
		
			<?php
			require ('../../includes/config.inc.php');
			require (BASE_URI . '/scripts/headerCreator.php');
		
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
		    <title>config Form</title>
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
		                    <h2 style="text-align:left;">config Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableconfig" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/configTable.php';">Table of config</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `config`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="config">
					    <?php echo $formv1->generateText('siteActive', 'siteActive', '', 'tooltip here');
echo $formv1->generateText('userid', 'userid', '', 'tooltip here');
?>
						    <button id="submitconfig">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 configPassed = $("#id").text();
		
			if ( configPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("config");
		
				configRequired = new Object;
		
				configRequired = getNamesFormElements("config");
		
				configString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("config", configString, getNamesFormElements("config"), 1);
		
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
				    
				    $("#messageBox").append("Editing config id "+idPassed);
		
				    enableFormInputs("config");
		
				});
		
				try {
		
					$("form#config").find("button#deleteconfig").length();
		
				}catch(error){
		
					$("form#config").find("button").after("<button id='deleteconfig'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteconfig (){
		
				//configPassed is the current record, some security to check its also that in the id field
		
				if (configPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this config?")) {
		
					disableFormInputs("config");
		
					var configObject = pushDataFromFormAJAX("config", "config", "id", configPassed, "2"); //delete config
		
					configObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("config deleted");
								edit = 0;
								configPassed = null;
								window.location.href = siteRoot + "scripts/forms/configTable.php";
								//go to config list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("config");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitconfigForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var configObject = pushDataFromFormAJAX("config", "config", "id", null, "0"); //insert new object
		
					configObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New config no "+data+" created");
							edit = 1;
							$("#id").text(data);
							configPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var configObject = pushDataFromFormAJAX("config", "config", "id", configPassed, "1"); //insert new object
		
					configObject.done(function (data){
		
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
		
					fillForm(configPassed);
		
				}else{
					
					$("#messageBox").append("New config");
					
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
		
		
				$("#content").on('click', '#submitconfig', (function(event) {
			        event.preventDefault();
			        $('#config').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteconfig', (function(event) {
			        event.preventDefault();
			        deleteconfig();
		
		
			    }));
		
				$("#config").validate({
		
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
siteActive: { required: true },   
userid: { required: true },   
},messages: {
siteActive: { required: 'message' },   
userid: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitconfigForm();
		
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