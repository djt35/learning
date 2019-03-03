
		
		
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
		    <title>imageSet Form</title>
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
		                    <h2 style="text-align:left;">imageSet Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  imageSet  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="imageSet">
					    <?php echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('type', 'type', '', 'tooltip here');
echo $formv1->generateText('author', 'author', '', 'tooltip here');
echo $formv1->generateText('created', 'created', '', 'tooltip here');
echo $formv1->generateText('updated', 'updated', '', 'tooltip here');
?>
						    <button id="submitimageSet">Submit</button>
		
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
		
			 imageSetPassed = $("#id").text();
		
			if ( imageSetPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("imageSet");
		
				imageSetRequired = new Object;
		
				imageSetRequired = getNamesFormElements("imageSet");
		
				imageSetString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("imageSet", imageSetString, getNamesFormElements("imageSet"), 1);
		
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
				    
				    $("#messageBox").text("Editing imageSet id "+idPassed);
		
				    enableFormInputs("imageSet");
		
				});
		
				try {
		
					$("form#imageSet").find("button#deleteimageSet").length();
		
				}catch(error){
		
					$("form#imageSet").find("button").after("<button id='deleteimageSet'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimageSet (){
		
				//imageSetPassed is the current record, some security to check its also that in the id field
		
				if (imageSetPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this imageSet?")) {
		
					disableFormInputs("imageSet");
		
					var imageSetObject = pushDataFromFormAJAX("imageSet", "imageSet", "id", imageSetPassed, "2"); //delete imageSet
		
					imageSetObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("imageSet deleted");
								edit = 0;
								imageSetPassed = null;
								window.location.href = siteRoot + "scripts/forms/imageSetTable.php";
								//go to imageSet list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("imageSet");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimageSetForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imageSetObject = pushDataFromFormAJAX("imageSet", "imageSet", "id", null, "0"); //insert new object
		
					imageSetObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New imageSet no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imageSetPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imageSetObject = pushDataFromFormAJAX("imageSet", "imageSet", "id", imageSetPassed, "1"); //insert new object
		
					imageSetObject.done(function (data){
		
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
		
					fillForm(imageSetPassed);
		
				}else{
					
					$("#messageBox").text("New imageSet");
					
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
		
		
				$("#content").on('click', '#submitimageSet', (function(event) {
			        event.preventDefault();
			        $('#imageSet').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteimageSet', (function(event) {
			        event.preventDefault();
			        deleteimageSet();
		
		
			    }));
		
				$("#imageSet").validate({
		
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
},messages: {
name: { required: 'message' },   
type: { required: 'message' },   
author: { required: 'message' },   
created: { required: 'message' },   
updated: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitimageSetForm();
		
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