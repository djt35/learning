
		
		
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
		    <title>imageImageSet Form</title>
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
		                    <h2 style="text-align:left;">imageImageSet Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  imageImageSet  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="imageImageSet">
					    <?php echo $formv1->generateText('image_id', 'image_id', '', 'tooltip here');
echo $formv1->generateText('imageSet_id', 'imageSet_id', '', 'tooltip here');
?>
						    <button id="submitimageImageSet">Submit</button>
		
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
		
			 imageImageSetPassed = $("#id").text();
		
			if ( imageImageSetPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("imageImageSet");
		
				imageImageSetRequired = new Object;
		
				imageImageSetRequired = getNamesFormElements("imageImageSet");
		
				imageImageSetString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("imageImageSet", imageImageSetString, getNamesFormElements("imageImageSet"), 1);
		
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
				    
				    $("#messageBox").text("Editing imageImageSet id "+idPassed);
		
				    enableFormInputs("imageImageSet");
		
				});
		
				try {
		
					$("form#imageImageSet").find("button#deleteimageImageSet").length();
		
				}catch(error){
		
					$("form#imageImageSet").find("button").after("<button id='deleteimageImageSet'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimageImageSet (){
		
				//imageImageSetPassed is the current record, some security to check its also that in the id field
		
				if (imageImageSetPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this imageImageSet?")) {
		
					disableFormInputs("imageImageSet");
		
					var imageImageSetObject = pushDataFromFormAJAX("imageImageSet", "imageImageSet", "id", imageImageSetPassed, "2"); //delete imageImageSet
		
					imageImageSetObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("imageImageSet deleted");
								edit = 0;
								imageImageSetPassed = null;
								window.location.href = siteRoot + "scripts/forms/imageImageSetTable.php";
								//go to imageImageSet list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("imageImageSet");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimageImageSetForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imageImageSetObject = pushDataFromFormAJAX("imageImageSet", "imageImageSet", "id", null, "0"); //insert new object
		
					imageImageSetObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New imageImageSet no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imageImageSetPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imageImageSetObject = pushDataFromFormAJAX("imageImageSet", "imageImageSet", "id", imageImageSetPassed, "1"); //insert new object
		
					imageImageSetObject.done(function (data){
		
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
		
					fillForm(imageImageSetPassed);
		
				}else{
					
					$("#messageBox").text("New imageImageSet");
					
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
		
		
				$("#content").on('click', '#submitimageImageSet', (function(event) {
			        event.preventDefault();
			        $('#imageImageSet').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteimageImageSet', (function(event) {
			        event.preventDefault();
			        deleteimageImageSet();
		
		
			    }));
		
				$("#imageImageSet").validate({
		
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
		
			            submitimageImageSetForm();
		
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