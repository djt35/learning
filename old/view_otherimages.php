 <?php  
        $page_title='Study Images - ESD // POEM';
        $page_header='(ESD) images';
        include ('image_header.php');   
        
?>
    <div id="navi">
      <li><a href="studyserver_l.php">Home</a></li>
    <li><a href="/studyserver/PROSPER/PROSPER_l.php"> Data Entry </a></li>
	<li><a href="/studyserver/PROSPER/tables.php"> Study Manager </a></li></li>
    <li><a href="imageserver.php"> Image/media server </a></li>
    <li ><a href="new_images.php"> Upload Images </a></li>
<li><a href="view_images.php"> View Images </a></li>
<li class="active"><a href="view_otherimages.php"> View ESD/POEM Images </a></li>

    <li><a href="logout.php"> Logout </a></li>

    </div>

<?php 
error_reporting(0);

if((isset($_GET['MRN'])) && (is_numeric($_GET['MRN']))) {
       $lesionid = $_GET['MRN'];
        //echo 'page accessed via GET';
        } elseif ((isset($_POST['MRN'])) && (is_numeric($_POST['MRN']))) {
            $lesionid = $_POST['MRN'];} 
		
		echo "<div id='lesionid' style='display: none;'>$lesionid</div>";
?>
    

<script>

</script>


<body>   
<div class="content">

	
			<?php    
			
				define ('MYSQL', '../../mysqli_connect_PROSPER.php');
				require (MYSQL);
			
			
			if (isset($lesionid)) {
				
				$query = "
				SELECT MRN, filename, display, Procedure_type, position, DATE_FORMAT( date, '%d %M, %Y' ) AS dr 
				FROM  `imagesOther`
				WHERE MRN = $lesionid
				ORDER BY position LIMIT 1
				";
            	$res = mysqli_query($dbc, $query);
				$num = mysqli_num_rows($res);
				//echo $num;
				//echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $query . ' </p>';
	
				if ($num > 0) {
				
					//echo "<button id='back'>Back to Studies page</button>";
					while($row = mysqli_fetch_array($res))
					{   
						
						echo "<h2 style='text-align: center;'>".$row['Procedure_type']." performed on ".$row['dr']." at Westmead Hospital</h2>";
						echo "<div id='lesionid' style='display: none;'>$lesionid</div>";}
				
            //echo "</select></td>\n";
            mysqli_free_result($res);
				}else{
					
					//echo "The passed lesion does not exist or has no images <br/><br/><br/>";
				//	echo "<button id='back'>Back to Studies page</button>";
					
				}
		
			}else{
				
				echo "<p class=\"describe\" align=\"left\">Image display, select a lesion below</p>
	<form id=\"selectLesion\">    
		<select name='LesionID' id='LesionID'>
			<option hidden disabled selected value></option>";
				
				$query = "
				SELECT MRN, filename, display, Procedure_type, position, DATE_FORMAT( date, '%d %M, %Y' ) AS dr 
				FROM  `imagesOther`
				GROUP BY MRN
				ORDER BY position
				";
			
            	$res = mysqli_query ($dbc, $query);
					while($row = mysqli_fetch_array($res))
					{   
						echo "<option value=\"".$row['MRN']."\"";
                		echo ">Study (Patient) MRN&nbsp".$row['MRN']."&nbspProcedure Date&nbsp".$row['dr']."&nbspProcedure type: &nbsp".$row['Procedure_type']."</option>"; }
				
            echo "</select></td><br/><br/>\n";
            mysqli_free_result($res);
				
				
				
				
			}
		
		
		?>
		
	
	
	
	</form>
	
	<div class="img2text" style="color:white; display:none;">
				<h1>Paris 0-IIaIs LSL extending over a colonic fold</h1>
					<h3> removed by EMR dissection technique</h3>

				</div> 
	
<div id="Style1" style="display:none;">
			
	</div>
 
  <div id="Style2"> 
			
	</div> 
  
 <div id="Style3" style="display:none;">
    

</div>
    
    </div>
</body>
<script>

loadImages();

function loadImages () {
	var lesionid=$('#lesionid')
	 .clone()    //clone the element
        .children() //select all the children
        .remove()   //remove all the children
        .end()  //again go back to selected element
        .text(); 
	
	if (lesionid) {
	
	$.ajax({
        url: 'get_images_view_other.php',
        type: 'POST',
        data: 'LesionID='+lesionid,
        cache: false,
        success: function(data, textStatus, jqXHR)
        {
            if(typeof data.error === 'undefined')
            {
                console.log('SUCCESS: grabbed images ' + data);
				$('#Style2').html(data);
            }
            else
            {
                // Handle errors here
                console.log('ERRORS: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
        },
        complete: function()
        {
            // STOP LOADING SPINNER
        }
    });
	}
	
	
}	
	
	
$(document).ready(function() {
	
	$(document).ajaxStart(function(){
        $("#loader").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#loader").css("display", "none");
    });
    
$('#LesionID').on('change', function() {
    var lesionID = $(this).val();
	
	$.ajax({
        url: 'get_images_view_other.php',
        type: 'POST',
        data: 'LesionID='+lesionID,
        cache: false,
        success: function(data, textStatus, jqXHR)
        {
            if(typeof data.error === 'undefined')
            {
                console.log('SUCCESS: grabbed images ' + data);
				$('#Style2').html(data);
            }
            else
            {
                // Handle errors here
                console.log('ERRORS: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
        },
        complete: function()
        {
            // STOP LOADING SPINNER
        }
    });
	

   
});
	
$('#back').on('click', function() {

	var referringPage = document.referrer;
	window.location.href = referringPage;


})
	
	
});
    
    


</script>
<?php include ('footer.html'); ?>

</html>

