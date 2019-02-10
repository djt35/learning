
		
		
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
		    <title>django_content_type Form</title>
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
		                    <h2 style="text-align:left;">django_content_type Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  django_content_type  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="django_content_type">
					    <?php echo $formv1->generateText('app_label', 'app_label', '', 'tooltip here');
echo $formv1->generateText('model', 'model', '', 'tooltip here');
?>
						    <button id="submitdjango_content_type">Submit</button>
		
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
		
			 django_content_typePassed = $("#id").text();
		
			if ( django_content_typePassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("django_content_type");
		
				django_content_typeRequired = new Object;
		
				django_content_typeRequired = getNamesFormElements("django_content_type");
		
				django_content_typeString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("django_content_type", django_content_typeString, getNamesFormElements("django_content_type"), 1);
		
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
				    
				    $("#messageBox").text("Editing django_content_type id "+idPassed);
		
				    enableFormInputs("django_content_type");
		
				});
		
				try {
		
					$("form#django_content_type").find("button#deletedjango_content_type").length();
		
				}catch(error){
		
					$("form#django_content_type").find("button").after("<button id='deletedjango_content_type'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletedjango_content_type (){
		
				//django_content_typePassed is the current record, some security to check its also that in the id field
		
				if (django_content_typePassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this django_content_type?")) {
		
					disableFormInputs("django_content_type");
		
					var django_content_typeObject = pushDataFromFormAJAX("django_content_type", "django_content_type", "id", django_content_typePassed, "2"); //delete django_content_type
		
					django_content_typeObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("django_content_type deleted");
								edit = 0;
								django_content_typePassed = null;
								window.location.href = siteRoot + "scripts/forms/django_content_typeTable.php";
								//go to django_content_type list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("django_content_type");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitdjango_content_typeForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var django_content_typeObject = pushDataFromFormAJAX("django_content_type", "django_content_type", "id", null, "0"); //insert new object
		
					django_content_typeObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New django_content_type no "+data+" created");
							edit = 1;
							$("#id").text(data);
							django_content_typePassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var django_content_typeObject = pushDataFromFormAJAX("django_content_type", "django_content_type", "id", django_content_typePassed, "1"); //insert new object
		
					django_content_typeObject.done(function (data){
		
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
		
					fillForm(django_content_typePassed);
		
				}else{
					
					$("#messageBox").text("New django_content_type");
					
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
		
		
				$("#content").on('click', '#submitdjango_content_type', (function(event) {
			        event.preventDefault();
			        $('#django_content_type').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletedjango_content_type', (function(event) {
			        event.preventDefault();
			        deletedjango_content_type();
		
		
			    }));
		
				$("#django_content_type").validate({
		
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
app_label: { required: true },   
model: { required: true },   
},messages: {
app_label: { required: 'message' },   
model: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitdjango_content_typeForm();
		
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