
		
		
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
		    <title>video Form</title>
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
		                    <h2 style="text-align:left;">video Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tablevideo" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/videoTable.php';">Table of video</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  video  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="video">
					    <?php echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('url', 'url', '', 'tooltip here');
echo $formv1->generateText('active', 'active', '', 'tooltip here');
echo $formv1->generateText('split', 'split', '', 'tooltip here');
echo $formv1->generateText('created', 'created', '', 'tooltip here');
echo $formv1->generateText('updated', 'updated', '', 'tooltip here');
echo $formv1->generateText('author', 'author', '', 'tooltip here');
echo $formv1->generateText('description', 'description', '', 'tooltip here');
echo $formv1->generateText('duration', 'duration', '', 'tooltip here');
echo $formv1->generateText('thumbnail', 'thumbnail', '', 'tooltip here');
?>
						    <button id="submitvideo">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 videoPassed = $("#id").text();
		
			if ( videoPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("video");
		
				videoRequired = new Object;
		
				videoRequired = getNamesFormElements("video");
		
				videoString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("video", videoString, getNamesFormElements("video"), 1);
		
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
				    
				    $("#messageBox").append("Editing video id "+idPassed);
		
				    enableFormInputs("video");
		
				});
		
				try {
		
					$("form#video").find("button#deletevideo").length();
		
				}catch(error){
		
					$("form#video").find("button").after("<button id='deletevideo'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletevideo (){
		
				//videoPassed is the current record, some security to check its also that in the id field
		
				if (videoPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this video?")) {
		
					disableFormInputs("video");
		
					var videoObject = pushDataFromFormAJAX("video", "video", "id", videoPassed, "2"); //delete video
		
					videoObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("video deleted");
								edit = 0;
								videoPassed = null;
								window.location.href = siteRoot + "scripts/forms/videoTable.php";
								//go to video list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("video");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitvideoForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var videoObject = pushDataFromFormAJAX("video", "video", "id", null, "0"); //insert new object
		
					videoObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New video no "+data+" created");
							edit = 1;
							$("#id").text(data);
							videoPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var videoObject = pushDataFromFormAJAX("video", "video", "id", videoPassed, "1"); //insert new object
		
					videoObject.done(function (data){
		
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
		
					fillForm(videoPassed);
		
				}else{
					
					$("#messageBox").append("New video");
					
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
		
		
				$("#content").on('click', '#submitvideo', (function(event) {
			        event.preventDefault();
			        $('#video').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletevideo', (function(event) {
			        event.preventDefault();
			        deletevideo();
		
		
			    }));
		
				$("#video").validate({
		
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
url: { required: true },   
active: { required: true },   
split: { required: true },   
created: { required: true },   
updated: { required: true },   
author: { required: true },   
description: { required: true },   
duration: { required: true },   
thumbnail: { required: true },   
},messages: {
name: { required: 'message' },   
url: { required: 'message' },   
active: { required: 'message' },   
split: { required: 'message' },   
created: { required: 'message' },   
updated: { required: 'message' },   
author: { required: 'message' },   
description: { required: 'message' },   
duration: { required: 'message' },   
thumbnail: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitvideoForm();
		
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