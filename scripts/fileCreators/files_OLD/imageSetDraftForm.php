
		
		
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
		    <title>imageSetDraft Form</title>
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
		                    <h2 style="text-align:left;">imageSetDraft Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  imageSetDraft  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="imageSetDraft">
					    <?php echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('type', 'type', '', 'tooltip here');
echo $formv1->generateText('author', 'author', '', 'tooltip here');
echo $formv1->generateText('created', 'created', '', 'tooltip here');
echo $formv1->generateText('updated', 'updated', '', 'tooltip here');
echo $formv1->generateText('approved', 'approved', '', 'tooltip here');
?>
						    <button id="submitimageSetDraft">Submit</button>
		
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
		
			 imageSetDraftPassed = $("#id").text();
		
			if ( imageSetDraftPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("imageSetDraft");
		
				imageSetDraftRequired = new Object;
		
				imageSetDraftRequired = getNamesFormElements("imageSetDraft");
		
				imageSetDraftString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("imageSetDraft", imageSetDraftString, getNamesFormElements("imageSetDraft"), 1);
		
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
				    
				    $("#messageBox").text("Editing imageSetDraft id "+idPassed);
		
				    enableFormInputs("imageSetDraft");
		
				});
		
				try {
		
					$("form#imageSetDraft").find("button#deleteimageSetDraft").length();
		
				}catch(error){
		
					$("form#imageSetDraft").find("button").after("<button id='deleteimageSetDraft'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimageSetDraft (){
		
				//imageSetDraftPassed is the current record, some security to check its also that in the id field
		
				if (imageSetDraftPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this imageSetDraft?")) {
		
					disableFormInputs("imageSetDraft");
		
					var imageSetDraftObject = pushDataFromFormAJAX("imageSetDraft", "imageSetDraft", "id", imageSetDraftPassed, "2"); //delete imageSetDraft
		
					imageSetDraftObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("imageSetDraft deleted");
								edit = 0;
								imageSetDraftPassed = null;
								window.location.href = siteRoot + "scripts/forms/imageSetDraftTable.php";
								//go to imageSetDraft list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("imageSetDraft");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimageSetDraftForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imageSetDraftObject = pushDataFromFormAJAX("imageSetDraft", "imageSetDraft", "id", null, "0"); //insert new object
		
					imageSetDraftObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New imageSetDraft no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imageSetDraftPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imageSetDraftObject = pushDataFromFormAJAX("imageSetDraft", "imageSetDraft", "id", imageSetDraftPassed, "1"); //insert new object
		
					imageSetDraftObject.done(function (data){
		
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
		
					fillForm(imageSetDraftPassed);
		
				}else{
					
					$("#messageBox").text("New imageSetDraft");
					
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
		
		
				$("#content").on('click', '#submitimageSetDraft', (function(event) {
			        event.preventDefault();
			        $('#imageSetDraft').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteimageSetDraft', (function(event) {
			        event.preventDefault();
			        deleteimageSetDraft();
		
		
			    }));
		
				$("#imageSetDraft").validate({
		
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
type: { required: true },   
author: { required: true },   
created: { required: true },   
updated: { required: true },   
approved: { required: true },   
},messages: {
name: { required: 'message' },   
type: { required: 'message' },   
author: { required: 'message' },   
created: { required: 'message' },   
updated: { required: 'message' },   
approved: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitimageSetDraftForm();
		
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