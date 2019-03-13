
		
		
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
		    <title>imagesDraft Form</title>
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
		                    <h2 style="text-align:left;">imagesDraft Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableimagesDraft" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/imagesDraftTable.php';">Table of imagesDraft</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  imagesDraft  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="imagesDraft">
					    <?php echo $formv1->generateText('url', 'url', '', 'tooltip here');
echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('type', 'type', '', 'tooltip here');
echo $formv1->generateText('created', 'created', '', 'tooltip here');
echo $formv1->generateText('updated', 'updated', '', 'tooltip here');
echo $formv1->generateText('order', 'order', '', 'tooltip here');
?>
						    <button id="submitimagesDraft">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 imagesDraftPassed = $("#id").text();
		
			if ( imagesDraftPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("imagesDraft");
		
				imagesDraftRequired = new Object;
		
				imagesDraftRequired = getNamesFormElements("imagesDraft");
		
				imagesDraftString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("imagesDraft", imagesDraftString, getNamesFormElements("imagesDraft"), 1);
		
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
				    
				    $("#messageBox").append("Editing imagesDraft id "+idPassed);
		
				    enableFormInputs("imagesDraft");
		
				});
		
				try {
		
					$("form#imagesDraft").find("button#deleteimagesDraft").length();
		
				}catch(error){
		
					$("form#imagesDraft").find("button").after("<button id='deleteimagesDraft'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimagesDraft (){
		
				//imagesDraftPassed is the current record, some security to check its also that in the id field
		
				if (imagesDraftPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this imagesDraft?")) {
		
					disableFormInputs("imagesDraft");
		
					var imagesDraftObject = pushDataFromFormAJAX("imagesDraft", "imagesDraft", "id", imagesDraftPassed, "2"); //delete imagesDraft
		
					imagesDraftObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("imagesDraft deleted");
								edit = 0;
								imagesDraftPassed = null;
								window.location.href = siteRoot + "scripts/forms/imagesDraftTable.php";
								//go to imagesDraft list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("imagesDraft");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimagesDraftForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imagesDraftObject = pushDataFromFormAJAX("imagesDraft", "imagesDraft", "id", null, "0"); //insert new object
		
					imagesDraftObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New imagesDraft no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imagesDraftPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imagesDraftObject = pushDataFromFormAJAX("imagesDraft", "imagesDraft", "id", imagesDraftPassed, "1"); //insert new object
		
					imagesDraftObject.done(function (data){
		
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
		
					fillForm(imagesDraftPassed);
		
				}else{
					
					$("#messageBox").append("New imagesDraft");
					
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
		
		
				$("#content").on('click', '#submitimagesDraft', (function(event) {
			        event.preventDefault();
			        $('#imagesDraft').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteimagesDraft', (function(event) {
			        event.preventDefault();
			        deleteimagesDraft();
		
		
			    }));
		
				$("#imagesDraft").validate({
		
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
url: { required: true },   
name: { required: true },   
type: { required: true },   
created: { required: true },   
updated: { required: true },   
order: { required: true },   
},messages: {
url: { required: 'message' },   
name: { required: 'message' },   
type: { required: 'message' },   
created: { required: 'message' },   
updated: { required: 'message' },   
order: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitimagesDraftForm();
		
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