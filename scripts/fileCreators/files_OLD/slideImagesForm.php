
		
		
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
		    <title>slideImages Form</title>
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
		                    <h2 style="text-align:left;">slideImages Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  slideImages  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="slideImages">
					    <?php echo $formv1->generateText('images_id', 'images_id', '', 'tooltip here');
echo $formv1->generateText('slide_id', 'slide_id', '', 'tooltip here');
?>
						    <button id="submitslideImages">Submit</button>
		
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
		
			 slideImagesPassed = $("#id").text();
		
			if ( slideImagesPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("slideImages");
		
				slideImagesRequired = new Object;
		
				slideImagesRequired = getNamesFormElements("slideImages");
		
				slideImagesString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("slideImages", slideImagesString, getNamesFormElements("slideImages"), 1);
		
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
				    
				    $("#messageBox").text("Editing slideImages id "+idPassed);
		
				    enableFormInputs("slideImages");
		
				});
		
				try {
		
					$("form#slideImages").find("button#deleteslideImages").length();
		
				}catch(error){
		
					$("form#slideImages").find("button").after("<button id='deleteslideImages'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteslideImages (){
		
				//slideImagesPassed is the current record, some security to check its also that in the id field
		
				if (slideImagesPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this slideImages?")) {
		
					disableFormInputs("slideImages");
		
					var slideImagesObject = pushDataFromFormAJAX("slideImages", "slideImages", "id", slideImagesPassed, "2"); //delete slideImages
		
					slideImagesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("slideImages deleted");
								edit = 0;
								slideImagesPassed = null;
								window.location.href = siteRoot + "scripts/forms/slideImagesTable.php";
								//go to slideImages list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("slideImages");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitslideImagesForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var slideImagesObject = pushDataFromFormAJAX("slideImages", "slideImages", "id", null, "0"); //insert new object
		
					slideImagesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New slideImages no "+data+" created");
							edit = 1;
							$("#id").text(data);
							slideImagesPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var slideImagesObject = pushDataFromFormAJAX("slideImages", "slideImages", "id", slideImagesPassed, "1"); //insert new object
		
					slideImagesObject.done(function (data){
		
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
		
					fillForm(slideImagesPassed);
		
				}else{
					
					$("#messageBox").text("New slideImages");
					
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
		
		
				$("#content").on('click', '#submitslideImages', (function(event) {
			        event.preventDefault();
			        $('#slideImages').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteslideImages', (function(event) {
			        event.preventDefault();
			        deleteslideImages();
		
		
			    }));
		
				$("#slideImages").validate({
		
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
slide_id: { required: true },   
},messages: {
images_id: { required: 'message' },   
slide_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitslideImagesForm();
		
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