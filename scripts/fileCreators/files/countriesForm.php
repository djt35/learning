
		
		
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
		    <title>countries Form</title>
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
		                    <h2 style="text-align:left;">countries Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tablecountries" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/countriesTable.php';">Table of countries</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `CountryID`  FROM  `countries`  WHERE  CountryID  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="countries">
					    <?php echo $formv1->generateText('CountryID', 'CountryID', '', 'tooltip here');
echo $formv1->generateText('CountryName', 'CountryName', '', 'tooltip here');
echo $formv1->generateText('TwoCharCountryCode', 'TwoCharCountryCode', '', 'tooltip here');
echo $formv1->generateText('ThreeCharCountryCode', 'ThreeCharCountryCode', '', 'tooltip here');
?>
						    <button id="submitcountries">Submit</button>
		
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
		
			 countriesPassed = $("#id").text();
		
			if ( countriesPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("countries");
		
				countriesRequired = new Object;
		
				countriesRequired = getNamesFormElements("countries");
		
				countriesString = '`CountryID`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("countries", countriesString, getNamesFormElements("countries"), 1);
		
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
				    
				    $("#messageBox").append("Editing countries id "+idPassed);
		
				    enableFormInputs("countries");
		
				});
		
				try {
		
					$("form#countries").find("button#deletecountries").length();
		
				}catch(error){
		
					$("form#countries").find("button").after("<button id='deletecountries'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletecountries (){
		
				//countriesPassed is the current record, some security to check its also that in the id field
		
				if (countriesPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this countries?")) {
		
					disableFormInputs("countries");
		
					var countriesObject = pushDataFromFormAJAX("countries", "countries", "CountryID", countriesPassed, "2"); //delete countries
		
					countriesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("countries deleted");
								edit = 0;
								countriesPassed = null;
								window.location.href = siteRoot + "scripts/forms/countriesTable.php";
								//go to countries list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("countries");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitcountriesForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var countriesObject = pushDataFromFormAJAX("countries", "countries", "CountryID", null, "0"); //insert new object
		
					countriesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New countries no "+data+" created");
							edit = 1;
							$("#id").text(data);
							countriesPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var countriesObject = pushDataFromFormAJAX("countries", "countries", "CountryID", countriesPassed, "1"); //insert new object
		
					countriesObject.done(function (data){
		
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
		
					fillForm(countriesPassed);
		
				}else{
					
					$("#messageBox").append("New countries");
					
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
		
		
				$("#content").on('click', '#submitcountries', (function(event) {
			        event.preventDefault();
			        $('#countries').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletecountries', (function(event) {
			        event.preventDefault();
			        deletecountries();
		
		
			    }));
		
				$("#countries").validate({
		
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
CountryID: { required: true },   
CountryName: { required: true },   
TwoCharCountryCode: { required: true },   
ThreeCharCountryCode: { required: true },   
},messages: {
CountryID: { required: 'message' },   
CountryName: { required: 'message' },   
TwoCharCountryCode: { required: 'message' },   
ThreeCharCountryCode: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitcountriesForm();
		
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