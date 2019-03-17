
		
		
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
		    <title>imagesTagDraft Form</title>
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
		                    <h2 style="text-align:left;">imagesTagDraft Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableimagesTagDraft" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/imagesTagDraftTable.php';">Table of imagesTagDraft</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `imagesTagDraft`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="imagesTagDraft">
					    <?php echo $formv1->generateText('images_id', 'images_id', '', 'tooltip here');
echo $formv1->generateText('tags_id', 'tags_id', '', 'tooltip here');
?>
						    <button id="submitimagesTagDraft">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 imagesTagDraftPassed = $("#id").text();
		
			if ( imagesTagDraftPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("imagesTagDraft");
		
				imagesTagDraftRequired = new Object;
		
				imagesTagDraftRequired = getNamesFormElements("imagesTagDraft");
		
				imagesTagDraftString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("imagesTagDraft", imagesTagDraftString, getNamesFormElements("imagesTagDraft"), 1);
		
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
				    
				    $("#messageBox").append("Editing imagesTagDraft id "+idPassed);
		
				    enableFormInputs("imagesTagDraft");
		
				});
		
				try {
		
					$("form#imagesTagDraft").find("button#deleteimagesTagDraft").length();
		
				}catch(error){
		
					$("form#imagesTagDraft").find("button").after("<button id='deleteimagesTagDraft'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimagesTagDraft (){
		
				//imagesTagDraftPassed is the current record, some security to check its also that in the id field
		
				if (imagesTagDraftPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this imagesTagDraft?")) {
		
					disableFormInputs("imagesTagDraft");
		
					var imagesTagDraftObject = pushDataFromFormAJAX("imagesTagDraft", "imagesTagDraft", "id", imagesTagDraftPassed, "2"); //delete imagesTagDraft
		
					imagesTagDraftObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("imagesTagDraft deleted");
								edit = 0;
								imagesTagDraftPassed = null;
								window.location.href = siteRoot + "scripts/forms/imagesTagDraftTable.php";
								//go to imagesTagDraft list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("imagesTagDraft");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimagesTagDraftForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imagesTagDraftObject = pushDataFromFormAJAX("imagesTagDraft", "imagesTagDraft", "id", null, "0"); //insert new object
		
					imagesTagDraftObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New imagesTagDraft no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imagesTagDraftPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imagesTagDraftObject = pushDataFromFormAJAX("imagesTagDraft", "imagesTagDraft", "id", imagesTagDraftPassed, "1"); //insert new object
		
					imagesTagDraftObject.done(function (data){
		
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
		
					fillForm(imagesTagDraftPassed);
		
				}else{
					
					$("#messageBox").append("New imagesTagDraft");
					
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
		
		
				$("#content").on('click', '#submitimagesTagDraft', (function(event) {
			        event.preventDefault();
			        $('#imagesTagDraft').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteimagesTagDraft', (function(event) {
			        event.preventDefault();
			        deleteimagesTagDraft();
		
		
			    }));
		
				$("#imagesTagDraft").validate({
		
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
		
			            submitimagesTagDraftForm();
		
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