
		
		
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
		    <title>imageImageSetDraft Form</title>
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
		                    <h2 style="text-align:left;">imageImageSetDraft Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  imageImageSetDraft  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="imageImageSetDraft">
					    <?php echo $formv1->generateText('image_id', 'image_id', '', 'tooltip here');
echo $formv1->generateText('imageSet_id', 'imageSet_id', '', 'tooltip here');
?>
						    <button id="submitimageImageSetDraft">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 imageImageSetDraftPassed = $("#id").text();
		
			if ( imageImageSetDraftPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("imageImageSetDraft");
		
				imageImageSetDraftRequired = new Object;
		
				imageImageSetDraftRequired = getNamesFormElements("imageImageSetDraft");
		
				imageImageSetDraftString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("imageImageSetDraft", imageImageSetDraftString, getNamesFormElements("imageImageSetDraft"), 1);
		
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
				    
				    $("#messageBox").text("Editing imageImageSetDraft id "+idPassed);
		
				    enableFormInputs("imageImageSetDraft");
		
				});
		
				try {
		
					$("form#imageImageSetDraft").find("button#deleteimageImageSetDraft").length();
		
				}catch(error){
		
					$("form#imageImageSetDraft").find("button").after("<button id='deleteimageImageSetDraft'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimageImageSetDraft (){
		
				//imageImageSetDraftPassed is the current record, some security to check its also that in the id field
		
				if (imageImageSetDraftPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this imageImageSetDraft?")) {
		
					disableFormInputs("imageImageSetDraft");
		
					var imageImageSetDraftObject = pushDataFromFormAJAX("imageImageSetDraft", "imageImageSetDraft", "id", imageImageSetDraftPassed, "2"); //delete imageImageSetDraft
		
					imageImageSetDraftObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("imageImageSetDraft deleted");
								edit = 0;
								imageImageSetDraftPassed = null;
								window.location.href = siteRoot + "scripts/forms/imageImageSetDraftTable.php";
								//go to imageImageSetDraft list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("imageImageSetDraft");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimageImageSetDraftForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imageImageSetDraftObject = pushDataFromFormAJAX("imageImageSetDraft", "imageImageSetDraft", "id", null, "0"); //insert new object
		
					imageImageSetDraftObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New imageImageSetDraft no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imageImageSetDraftPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imageImageSetDraftObject = pushDataFromFormAJAX("imageImageSetDraft", "imageImageSetDraft", "id", imageImageSetDraftPassed, "1"); //insert new object
		
					imageImageSetDraftObject.done(function (data){
		
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
		
					fillForm(imageImageSetDraftPassed);
		
				}else{
					
					$("#messageBox").text("New imageImageSetDraft");
					
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
		
		
				$("#content").on('click', '#submitimageImageSetDraft', (function(event) {
			        event.preventDefault();
			        $('#imageImageSetDraft').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteimageImageSetDraft', (function(event) {
			        event.preventDefault();
			        deleteimageImageSetDraft();
		
		
			    }));
		
				$("#imageImageSetDraft").validate({
		
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
image_id: { required: true },   
imageSet_id: { required: true },   
},messages: {
image_id: { required: 'message' },   
imageSet_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitimageImageSetDraftForm();
		
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