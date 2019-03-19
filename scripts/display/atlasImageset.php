
		
		
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
		    <title>Endoscopy Atlas</title>
		</head>
		
		<style>
			
			.content, #menu, .responsiveContainer {
				
				color: white;
				background-color: black;
				
				
				
			}
			
			.content {
				
				max-height:none;
				
			}
			
			.navbar, .dropbtn, .dropdown .dropbtn, .navbar a, .dropdown, .dropdown-content {
				
				background-color: #2670DD;
				
			}
			
			footer {
				
				color: white;
				background-color: black;
				
			}
			
			.startTyping {
				
				font-size: large;
				
				
			}
			
			.modifiers {
				
				background-color: #2670DD; /* Blue UZ */
			    border: none;
			    color: white;
			    padding: 5px 10px;
			    text-align: center;
			    text-decoration: none;
			    display: inline-block;
			    font-size: 16px;
				
				
			}
			
			[class*="col-"] {
			    float: left;
			    padding: 15px;
			    /*border: 1px solid red;*/
			}
			
			[class*="slim-col-"] {
			    float: left;
			    padding: 1px;
			    /*border: 1px solid red;*/
			}
			
			
			
			
		</style>
				
		<?php
		include(BASE_URI . "/scripts/logobar.php");
		
		include(BASE_URI . "/includes/naviv1.php");
		
		include(BASE_URI . "/includes/naviTag.php");
		?>
		
		
		
		<div class="darkClass">
		
		</div>
		
		<div class="modal" style="display:none;">
			
			<div class='modalContent'>
				
			</div>
			<div class='modalClose'>
				<p><br><button onclick="$('.modal, .darkClass').hide();">Close this window</button></p>
			</div>
			
		</div>
		
		<body>
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
			
			<div id="images" style="display:none;"><?php ?></div>
			
			<?php echo $general->getImageIdsProcedure(); //gets data for tagCategories and imageids?>

		
		    <div id='content' class='content'>
			    
			    <?php
		
				       if ($id){
		
							$q = "SELECT  id, name, type, author  FROM  imageSet  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}else{
								
								$result = $general->connection->RunQuery($q);
								
								if ($result->num_rows > 0){
			
									while($row = $result->fetch_array(MYSQLI_ASSOC)){
										
										
										$id = $row['id'];
										$description = $row['name'];
										$title = $row['type'];
										$author = $row['author'];
									
									}
						
									echo '<div id="imageSetid" style="display:none;">' . $id . '</div>';

			
								}	
								
							}
						}
						
					
						
						
						
						
						
						
						
		
		?>

		
		        <div class='responsiveContainer white'>
		
			        <div class='row' id='imageSetTitleBar'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;"><?php echo $title;?></h2>
		                    <p style='text-align:left;'><?php echo $description;?></p>
		                    <!--<div id='procedureTagsDisplay' class='responsiveContainer' style='text-align:left;'>
			                    <div class='col-9'>
			                    
			                    Procedural tags: 
			                    
			                   
			                    </div>
			                    <div id='resetButtonDiv' class='col-3'>
			                    </div>
		                    </div>-->
		                    
		                    
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light veryNarrow center'>
		                    
		                    <p><button id="captionHide" class="modifiers">Toggle captions</button></p>
		                </div>
		            </div>
		
		
			        			    
			    <div class='row' id='imageTitle'>
				    
			    </div>
			    
			    <div id='imageDisplay'>
				
				<?php echo $general->getTaggedImageSetsv3($id, BASE_URL);?>
				
				
				</div>
			    
				<!--<div class='row' id='imageDisplay'>
					<div class='col-2'>
					</div>
					<div class='col-8'>
				
					</div>
				    <div class='col-2'>
					</div>    
				</div>-->
		
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




//!atlasTag specific functions

function getSecondBarName(){
	
	var tagName = $('#tagName').text();
	
	$('#naviTagName').html('<p style="text-align:right;">Showing images matching '+tagName.toLowerCase()+'</p>');
	
	
	
}

function getSecondBarButton(){
	
	$('#naviTagLeft').html('<button type="button" class="redButton veryNarrow" id="back" onclick="window.location.href = siteRoot + \'scripts/display/atlas.php\';"><--Back</p>');
	
	
	
}


//!new 

//get all procedure tags and insert at the top of the document

function insertProcedureTags () {
	
	var data = $('#procedureTags').text();
	
	var formData = $.parseJSON(data);
	
	
	
	$.each(formData, function(key, value) {
				
		var tagid = value['tagid'];
		var tagName = value['tagName'];
        
       	html = '<button id="' + tagid + '" class="tagButton">'+tagName+'</button>';
       	
       	$('#procedureTagsDisplay').find('div').first().append(html);
       	
       	//console.log(html);
        
        //data.append(key, value);
		    
	});
	
	
}


$(document).ready(function() {

    

    insertProcedureTags();
    
    
    

    $('#loading').bind('ajaxStart', function() {
        $(this).show();
    }).bind('ajaxStop', function() {
        $(this).hide();
    });

    var titleGraphic = $(".title").height();
    var titleBar = $("#menu").height();
    $(".title").css('height', (titleBar));


    $(window).resize(function() {
        waitForFinalEvent(function() {
            //alert("Resize...");
            var titleGraphic = $(".title").height();
            var titleBar = $("#menu").height();
            $(".title").css('height', (titleBar));

        }, 100, 'Resize header');
    });


   
    
    
    //!new
    
    //!load the buttons for the second navi bar
    
    //getSecondBarName();
    
    getSecondBarButton();
    
				    
    //reset tags button
    
    $('.content').on('click', '.resetTags', function() {
	    
	    
	    $('.tagSet').show();
		
		$('.tagSet').prev().show();
		
		$('.lslimage').show()
	
		//var hello = $(this).parent().parent().prev().children();
		
		//console.log(hello);
	
		$(this).parent().parent().prev().children().removeClass('greenButton').addClass('tagButton');
		
		$(this).remove();
	    
	    
	})
	
	//take to the individual tag display page
	
	$('.tagLink').on('click', function (){
		
		var tagid = $(this).attr('id');
		
		tagid = tagid.slice(3);
		
		window.location.href = siteRoot + "scripts/display/atlasTag.php?id="+tagid;
		
		
		
		
	})
	
	$('.pubMedSearch').on('click', function (){
		
		
		//get the tag name
		
		var searchTerm = $('#imageSetTitleBar').find('h2').html();
		
		console.log(searchTerm);
		
		PopupCenter("https://www.ncbi.nlm.nih.gov/pubmed?term="+searchTerm, 'PubMed Search (endoWiki)', 600, 700);

		
		
		
		
	})
    
    $('.uptodateSearch').on('click', function (){
		
		
		//get the tag name
		
		var searchTerm = $('#imageSetTitleBar').find('h2').html();
		
		console.log(searchTerm);
		
		PopupCenter("https://www.uptodate.com/contents/search?search="+searchTerm, 'UpToDate Search (endoWiki)', 600, 700);

		
		
		
		
	})
   
    
    

    //!Add new tag to single image

    $('.content').on('click', '.addTag', function() {


        event.preventDefault();

        var cellClicked = $(this);

        imageID = $(cellClicked).closest('tr').find('td:eq(0)').attr('id');

        console.log('File id is' + imageID);

        singleTag = 1;

        $('.darkClass').show();



        var selectorObject = getDataQuery('tagCategories', '', {
            'id': 'id',
            'Category Name': 'tagCategoryName'
        }, 2);

        //console.log(selectorObject);

        selectorObject.done(function(data) {

            //console.log(data);

            $('.modal').show();

            $('.modal').show();
            $('.modal').css('max-height', 800);
            $('.modal').css('max-width', 800);
            $('.modal').css('overflow', 'scroll');



            $('.modal').find('.modalContent').html('<h3>Choose Tag Category</h3>');


            $('.modal').find('.modalContent').append('<p>' + data + '</p>');

            $('.modal').find('.modalContent').append('<button id="newTagCategory">Add new tag category</button>');

            return;



        })

    })

    $('.modal').on('click', '.tagCategoriesrow', function() {

        event.preventDefault();

        var cellClicked = $(this);

        var tagCategoryID = $(cellClicked).closest('tr').find('td:eq(0)').text();

        //console.log('File id is'+fileID);

        $('.darkClass').show();



        var selectorObject = getDataQuery('tags', 'tagCategories_id =\'' + tagCategoryID + '\'', {
            'id': 'id',
            'Tag Name': 'tagName'
        }, 2);

        //console.log(selectorObject);

        selectorObject.done(function(data) {

            //console.log(data);

            $('.modal').show();

            $('.modal').show();
            $('.modal').css('max-height', 800);
            $('.modal').css('max-width', 800);
            $('.modal').css('overflow', 'scroll');



            $('.modal').find('.modalContent').html('<h3>Choose Tag</h3>');


            $('.modal').find('.modalContent').append('<p>' + data + '</p>');

            $('.modal').find('.modalContent').append('<button id="newTag">Add new tag </button>');


            return;



        })

    })

    $('.modal').on('click', '.tagsrow', function() {

        //!commit the tag to the database

        event.preventDefault();

        var cellClicked = $(this);

        var tagID = $(cellClicked).closest('tr').find('td:eq(0)').text();

        //console.log('File id is'+fileID);

        $('.darkClass').show();

        //collect objects imageID, tagID and insert into imageTags

        //check connections do not already exist

        //query imagesTag for where images_id = imageID and tags_id = tagID

        //3 new tag for matching a row

        if (singleTag == 1) {

            var selectorObject = getDataQuery('imagesTag', '`images_id` = ' + imageID + ' and `tags_id` = ' + tagID + '', {
                '0': 'images_id',
                '1': 'tags_id'
            }, 3);

            //console.log(selectorObject);
            var alreadyExists;

            selectorObject.done(function(data) {



                if (data) {

                    console.log('important data is' + data);

                    if (data == 1) {

                        alert('This image tag combination already exists');
                        alreadyExists = 1;
                        $('.modal').hide();

                        $('.darkClass').hide();

                    } else {

                        alreadyExists = 0;
                    }

                }

                if (alreadyExists == 0) {

                    var tagsImagesObject = pushDataAJAX('imagesTag', 'id', '', 0, {
                        'images_id': imageID,
                        'tags_id': tagID
                    }); //insert new object

                    tagsImagesObject.done(function(data) {

                        console.log('tagsImagesObject = ' + data);

                        if (data) {

                            if (isNormalInteger(data)) {

                                //alert ("Tag added");

                                //add the tag to the table

                                $('.file').find('td[id=' + imageID + ']').closest('tr').find('td:eq(3)').append('<button id="' + data + '" class="tagButton">' + $(cellClicked).closest('tr').find('td:eq(1)').text() + '</button>');

                                $('.modal').hide();

                                $('.darkClass').hide();

                                return;


                            } else {

                                alert("Error, try again");

                            }



                        }


                    });

                }


            })


        } else if (singleTag == 0) {

            //table, outputformat, array containing pairs to insert

            //combine the objects

            //fileList {0: 'id', 1: 'id2'} etc

            //tag same in each case tagID

            var tagImages = new Object();

            $.each(images, function(k, v) {

                console.log(k);
                console.log(v);

                tagImages[k] = {
                    'images_id': v,
                    'tags_id': tagID
                };



            })

            console.dir(tagImages);

            //imageTag = {0 = Object {images_id : id, tags_id : tagID

            var selectorObject = JSONDataQuery('imagesTag', tagImages, 4); //check these don't already exist

            //console.log(selectorObject);
            var alreadyExists;

            selectorObject.done(function(data) {



                if (data) {

                    console.log('important data is' + data);

                    if (data == 1) {

                        alert('One of these images is already tagged with this tag, select individually');
                        alreadyExists = 1;
                        $('.modal').hide();

                        $('.darkClass').hide();

                    } else {

                        alreadyExists = 0;
                    }

                }

                if (alreadyExists == 0) {

                    var tagsImagesObject = JSONDataQuery('imagesTag', tagImages, 5); //insert new object

                    tagsImagesObject.done(function(data) {

                        console.log('tagsImagesObject = ' + data);

                        if (data) {

                            if (data != 0) {

                                //alert ("Tag added");

                                var returnedData = $.parseJSON(data);

                                console.dir(returnedData);

                                //add the tag to the table rows

                                var xy = 0;

                                $('#imagesTable').find('tr').find('td:eq(3)').each(function() {


                                    $(this).append('<button id="' + returnedData[xy] + '" class="tagButton">' + $(cellClicked).closest('tr').find('td:eq(1)').text() + '</button>');

                                    xy++;

                                })

                                $('.modal').hide();

                                $('.darkClass').hide();

                                return;


                            } else {

                                alert("Error, try again");

                            }



                        }


                    });

                }

            })

        }

    })


    //!Add new tag to all images uploaded

    $('.content').on('click', '.addTagAll', function() {


        event.preventDefault();

        var cellClicked = $(this);

        //get an array of the required image id's

        //var images = new Object();

        x = 0;

        $('#imagesTable').find('tr').find('td:eq(0)').each(function() {

            //console.log(this);

            var fileid = $(this).attr('id');

            images[x] = fileid;

            x++;


        })

        singleTag = 0;


        console.dir(images);

        $('.darkClass').show();



        var selectorObject = getDataQuery('tagCategories', '', {
            'id': 'id',
            'Category Name': 'tagCategoryName'
        }, 2);

        //console.log(selectorObject);

        selectorObject.done(function(data) {

            //console.log(data);

            $('.modal').show();

            $('.modal').show();
            $('.modal').css('max-height', 800);
            $('.modal').css('max-width', 800);
            $('.modal').css('overflow', 'scroll');



            $('.modal').find('.modalContent').html('<h3>Choose Tag Category</h3>');


            $('.modal').find('.modalContent').append('<p>' + data + '</p>');

            $('.modal').find('.modalContent').append('<button id="newTagCategory">Add new tag category</button>');

            return;



        })

    })




    $("#content").on('click', '#deleteimages', (function(event) {
        event.preventDefault();
        deleteimages();


    }));

    /*$("#content").on('click', '.tagButton', (function(event) {

        var button = $(this);

        var tagImageid = $(this).attr('id');

        // console.log(tagImageid);

        if (confirm("Do you wish to delete this tag from the image?")) {

            //disableFormInputs("images");

            var imagesObject = pushDataAJAX('imagesTag', 'id', tagImageid, 2, ''); //delete images

            imagesObject.done(function(data) {

                console.log(data);

                if (data) {

                    if (data == 1) {

                        //alert ("tag connection deleted");
                        $(button).remove();

                        //edit = 0;
                        //imagesPassed = null;
                        //window.location.href = siteRoot + "scripts/forms/imagesTable.php";
                        //go to images list

                    } else {

                        alert("Error, try again");

                        //enableFormInputs("images");

                    }



                }


            });

        }


    }));
    
    */
    
    $("#content").on('change', '#searchBox', (function(event) {

        var value = $(this).val();
		var option = $('#json-datalist').find("[value='" + value + "']").attr('data-id');
		
		
		  console.log('Tag to look for images is '+option);	
		  
		  //tagid
		  
		  request = $.ajax({
	        url: siteRoot + "scripts/getImages.php",
	        type: "get",
	        data: 'tagid='+option,
	
		   });
		   
		   request.done(function(data){
			   
			   if (data){
			   
			    $('#imageTitle').html('<h3 style="text-align:left;">'+value+'</h3>');
			   	$('#imageDisplay').html(data);
			   
			   }
			   
		   });
	
		  
        
 
    }));

    $('.modal').on('click', '#newTagCategory', function() {

        $('.modal').hide();

        $('.darkClass').hide();

        PopupCenter(siteRoot + "scripts/forms/tagCategoriesForm.php", 'New Tag Category', 600, 700);

        //window.open(, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



    })

    $('.modal').on('click', '#newTag', function() {

        $('.modal').hide();

        $('.darkClass').hide();

        PopupCenter(siteRoot + "scripts/forms/tagsForm.php", 'New Tag', 600, 700);


        //window.open(siteRoot + "scripts/forms/tagsForm.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



    })
    
    $('.content').on('click', '#captionHide', function() {

        $('.caption').toggle();
        $('.describer').toggle();
		
		if ($(this).text() == 'Toggle captions'){
			
			$(this).text('Captions shown');
			
		}
		
		if ($(this).text() == 'Captions shown'){
			
			$(this).text('Captions hidden');
			
		} else if ($(this).text() == 'Captions hidden'){
			
			$(this).text('Captions shown');
			
		}
		
		//$(this).text('Captions shown');
        


        //window.open(siteRoot + "scripts/forms/tagsForm.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



    })
    
    $('.content').on('click', '#resetPage', function(event) {
		event.preventDefault();
        $('#imageTitle').html('');
		$('#imageDisplay').html('');
		$('#searchBox').val('');
        


        //window.open(siteRoot + "scripts/forms/tagsForm.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



    })
    
    //! allows opening of navbar with click
    
    $('.dropbtn').on('click', function(){
	
		//console.dir(this);
		
		
		
		$(this).parent().find('.dropdown-content').toggle();
	
	
	})

    


    

})		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include(BASE_URI . "/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>