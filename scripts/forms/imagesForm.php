
		
		
			<?php
		
			$host = substr($_SERVER['HTTP_HOST'], 0, 5);
		if (in_array($host, array('local', '127.0', '192.1'))) {
		    $local = TRUE;
		} else {
		    $local = FALSE;
		}
		
		if ($local){
			
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
			
			
		}else{
			
			require ($_SERVER['DOCUMENT_ROOT'].'/scripts/headerCreator.php');;
		}
		
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
		    <title>images Form</title>
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
		                    <h2 style="text-align:left;">images Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  images  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="images">
					    <?php echo $formv1->generateText('url', 'url', '', 'tooltip here');
echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('type', 'type', '', 'tooltip here');
echo $formv1->generateText('order', 'order', '', 'tooltip here');

?>
						    <button id="submitimages">Submit</button>
		
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
		
			 imagesPassed = $("#id").text();
		
			if ( imagesPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("images");
		
				imagesRequired = new Object;
		
				imagesRequired = getNamesFormElements("images");
		
				imagesString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("images", imagesString, getNamesFormElements("images"), 1);
		
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
				    
				    $("#messageBox").text("Editing images id "+idPassed);
		
				    enableFormInputs("images");
		
				});
		
				try {
		
					$("form#images").find("button#deleteimages").length();
		
				}catch(error){
		
					$("form#images").find("button").after("<button id='deleteimages'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimages (){
		
				//imagesPassed is the current record, some security to check its also that in the id field
		
				if (imagesPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this images?")) {
		
					disableFormInputs("images");
		
					var imagesObject = pushDataFromFormAJAX("images", "images", "id", imagesPassed, "2"); //delete images
		
					imagesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("images deleted");
								edit = 0;
								imagesPassed = null;
								window.location.href = siteRoot + "scripts/forms/imagesTable.php";
								//go to images list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("images");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimagesForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imagesObject = pushDataFromFormAJAX("images", "images", "id", null, "0"); //insert new object
		
					imagesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New images no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imagesPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imagesObject = pushDataFromFormAJAX("images", "images", "id", imagesPassed, "1"); //insert new object
		
					imagesObject.done(function (data){
		
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
		
					fillForm(imagesPassed);
		
				}else{
					
					$("#messageBox").text("New images");
					
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
		
		
				$("#content").on('click', '#submitimages', (function(event) {
			        event.preventDefault();
			        $('#images').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteimages', (function(event) {
			        event.preventDefault();
			        deleteimages();
		
		
			    }));
		
				$("#images").validate({
		
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
order: {required: true }  
},messages: {
url: { required: 'message' },   
name: { required: 'message' },   
type: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitimagesForm();
		
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