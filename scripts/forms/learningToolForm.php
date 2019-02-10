
		
		
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
		    <title>learningTool Form</title>
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
		                    <h2 style="text-align:left;">learningTool Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  learningTool  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="learningTool">
					    <?php echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('active', 'active', '', 'tooltip here');
echo $formv1->generateText('paid', 'paid', '', 'tooltip here');
echo $formv1->generateText('paidTier', 'paidTier', '', 'tooltip here');
?>
						    <button id="submitlearningTool">Submit</button>
		
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
		
			 learningToolPassed = $("#id").text();
		
			if ( learningToolPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("learningTool");
		
				learningToolRequired = new Object;
		
				learningToolRequired = getNamesFormElements("learningTool");
		
				learningToolString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("learningTool", learningToolString, getNamesFormElements("learningTool"), 1);
		
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
				    
				    $("#messageBox").text("Editing learningTool id "+idPassed);
		
				    enableFormInputs("learningTool");
		
				});
		
				try {
		
					$("form#learningTool").find("button#deletelearningTool").length();
		
				}catch(error){
		
					$("form#learningTool").find("button").after("<button id='deletelearningTool'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletelearningTool (){
		
				//learningToolPassed is the current record, some security to check its also that in the id field
		
				if (learningToolPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this learningTool?")) {
		
					disableFormInputs("learningTool");
		
					var learningToolObject = pushDataFromFormAJAX("learningTool", "learningTool", "id", learningToolPassed, "2"); //delete learningTool
		
					learningToolObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("learningTool deleted");
								edit = 0;
								learningToolPassed = null;
								window.location.href = siteRoot + "scripts/forms/learningToolTable.php";
								//go to learningTool list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("learningTool");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitlearningToolForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var learningToolObject = pushDataFromFormAJAX("learningTool", "learningTool", "id", null, "0"); //insert new object
		
					learningToolObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New learningTool no "+data+" created");
							edit = 1;
							$("#id").text(data);
							learningToolPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var learningToolObject = pushDataFromFormAJAX("learningTool", "learningTool", "id", learningToolPassed, "1"); //insert new object
		
					learningToolObject.done(function (data){
		
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
		
					fillForm(learningToolPassed);
		
				}else{
					
					$("#messageBox").text("New learningTool");
					
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
		
		
				$("#content").on('click', '#submitlearningTool', (function(event) {
			        event.preventDefault();
			        $('#learningTool').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletelearningTool', (function(event) {
			        event.preventDefault();
			        deletelearningTool();
		
		
			    }));
		
				$("#learningTool").validate({
		
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
active: { required: true },   
paid: { required: true },   
paidTier: { required: true },   
},messages: {
name: { required: 'message' },   
active: { required: 'message' },   
paid: { required: 'message' },   
paidTier: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitlearningToolForm();
		
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