
		
		
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
		    <title>learningToolSlides Form</title>
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
		                    <h2 style="text-align:left;">learningToolSlides Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  learningToolSlides  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="learningToolSlides">
					    <?php echo $formv1->generateText('slideorder', 'slideorder', '', 'tooltip here');
echo $formv1->generateText('slide_id', 'slide_id', '', 'tooltip here');
echo $formv1->generateText('learningTool_id', 'learningTool_id', '', 'tooltip here');
?>
						    <button id="submitlearningToolSlides">Submit</button>
		
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
		
			 learningToolSlidesPassed = $("#id").text();
		
			if ( learningToolSlidesPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("learningToolSlides");
		
				learningToolSlidesRequired = new Object;
		
				learningToolSlidesRequired = getNamesFormElements("learningToolSlides");
		
				learningToolSlidesString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("learningToolSlides", learningToolSlidesString, getNamesFormElements("learningToolSlides"), 1);
		
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
				    
				    $("#messageBox").text("Editing learningToolSlides id "+idPassed);
		
				    enableFormInputs("learningToolSlides");
		
				});
		
				try {
		
					$("form#learningToolSlides").find("button#deletelearningToolSlides").length();
		
				}catch(error){
		
					$("form#learningToolSlides").find("button").after("<button id='deletelearningToolSlides'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletelearningToolSlides (){
		
				//learningToolSlidesPassed is the current record, some security to check its also that in the id field
		
				if (learningToolSlidesPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this learningToolSlides?")) {
		
					disableFormInputs("learningToolSlides");
		
					var learningToolSlidesObject = pushDataFromFormAJAX("learningToolSlides", "learningToolSlides", "id", learningToolSlidesPassed, "2"); //delete learningToolSlides
		
					learningToolSlidesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("learningToolSlides deleted");
								edit = 0;
								learningToolSlidesPassed = null;
								window.location.href = siteRoot + "scripts/forms/learningToolSlidesTable.php";
								//go to learningToolSlides list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("learningToolSlides");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitlearningToolSlidesForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var learningToolSlidesObject = pushDataFromFormAJAX("learningToolSlides", "learningToolSlides", "id", null, "0"); //insert new object
		
					learningToolSlidesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New learningToolSlides no "+data+" created");
							edit = 1;
							$("#id").text(data);
							learningToolSlidesPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var learningToolSlidesObject = pushDataFromFormAJAX("learningToolSlides", "learningToolSlides", "id", learningToolSlidesPassed, "1"); //insert new object
		
					learningToolSlidesObject.done(function (data){
		
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
		
					fillForm(learningToolSlidesPassed);
		
				}else{
					
					$("#messageBox").text("New learningToolSlides");
					
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
		
		
				$("#content").on('click', '#submitlearningToolSlides', (function(event) {
			        event.preventDefault();
			        $('#learningToolSlides').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletelearningToolSlides', (function(event) {
			        event.preventDefault();
			        deletelearningToolSlides();
		
		
			    }));
		
				$("#learningToolSlides").validate({
		
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
slideorder: { required: true },   
slide_id: { required: true },   
learningTool_id: { required: true },   
},messages: {
slideorder: { required: 'message' },   
slide_id: { required: 'message' },   
learningTool_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitlearningToolSlidesForm();
		
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