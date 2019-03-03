

<?php

	require ('../../headerCreator.php');	


$formv1 = new formGenerator;
$general = new general;
$video = new video;
$tagCategories = new tagCategories;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
    <title></title>
</head>

<?php
include(BASE_URI . '/scripts/logobar.php');

include(BASE_URI . '/includes/naviCreator.php');
?>


<body>
	
		
    <div id="content" class="content">
	    
        <div class="responsiveContainer white">
	        
	        <div class="row">
                <div class="col-9">
                    <h2 style='text-align:left;'>Users</h2>
                </div>

                <div id='messageBox' class="col-3 yellow-light narrow center">
                    <p></p>
                </div>
            </div>
	        
	        <div class="row">
                <div class="col-1"></div>

                <div class="col-10 narrow" style="overflow-x: scroll;">
                    <p><?php $general->makeTable('SELECT user_id, firstname, surname, email, centre from users'); ?></p>
                </div>

                <div class="col-1"></div>
            </div>

	        
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

		
	$(document).ready(function() {

		$('#dataTable').find('tr');

		$('.content').on('click', '.datarow', function(){
			
			var id = $(this).find('td:first').text();
			
			//console.log(id);
			
			window.location.href = siteRoot + "scripts/forms/userForm.php?id=" + id;

			
		})
		
		
	  	var titleGraphic = $('.title').height();
		var titleBar = $('#menu').height();
		$('.title').css("height",(titleBar));	
		
		
		$(window).resize(function () {
	    waitForFinalEvent(function(){
	      //alert('Resize...');
	      var titleGraphic = $('.title').height();
		  var titleBar = $('#menu').height();
		  $('.title').css("height",(titleBar));	
			
	    }, 100, "Resize header");
			});



    });



	</script>    
    
    
<?php

    // Include the footer file to complete the template:
    include(BASE_URI .'/includes/footer.html');




    ?>
</body>
</html>