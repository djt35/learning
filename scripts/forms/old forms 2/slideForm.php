
		
		
			<?php
		
			require ('../../includes/config.inc.php'); require (BASE_URI.'/scripts/headerCreator.php');
		
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
		    <title>slide Form</title>
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
		                    <h2 style="text-align:left;">slide Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  slide  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="slide">
					    <?php echo $formv1->generateText('id', 'id', '', 'tooltip here');
echo $formv1->generateText('audio_id', 'audio_id', '', 'tooltip here');
echo $formv1->generateText('video_id', 'video_id', '', 'tooltip here');
?>
						    <button id="submitslide">Submit</button>
		
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
		
			 slidePassed = $("#id").text();
		
			if ( slidePassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("slide");
		
				slideRequired = new Object;
		
				slideRequired = getNamesFormElements("slide");
		
				slideString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("slide", slideString, getNamesFormElements("slide"), 1);
		
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
		
				    enableFormInputs("slide");
		
				});
		
				try {
		
					$("form#slide").find("button#deleteslide").length();
		
				}catch(error){
		
					$("form#slide").find("button").after("<button id='deleteslide'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteslide (){
		
				//slidePassed is the current record, some security to check its also that in the id field
		
				if (slidePassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this slide?")) {
		
					disableFormInputs("slide");
		
					var slideObject = pushDataFromFormAJAX("slide", "slide", "id", slidePassed, "2"); //delete slide
		
					slideObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("slide deleted");
								edit = 0;
								slidePassed = null;
								window.location.href = siteRoot + "scripts/forms/slideTable.php";
								//go to slide list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("slide");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitslideForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var slideObject = pushDataFromFormAJAX("slide", "slide", "id", null, "0"); //insert new object
		
					slideObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New slide no "+data+" created");
							edit = 1;
							$("#id").text(data);
							slidePassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var slideObject = pushDataFromFormAJAX("slide", "slide", "id", slidePassed, "1"); //insert new object
		
					slideObject.done(function (data){
		
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
		
					fillForm(slidePassed);
		
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
		
		
				$("#content").on('click', '#submitslide', (function(event) {
			        event.preventDefault();
			        $('#slide').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteslide', (function(event) {
			        event.preventDefault();
			        deleteslide();
		
		
			    }));
		
				$("#slide").validate({
		
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
id: { required: true },   
audio_id: { required: true },   
video_id: { required: true },   
},messages: {
id: { required: 'message' },   
audio_id: { required: 'message' },   
video_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitslideForm();
		
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