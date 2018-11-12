<?php 

    session_start( );


  ?>

<!DOCTYPE html>
<html>
<title>
    <?php echo $page_title ?>
    
    </title>
<head> 
<meta charset="utf-8">
<script src="includes/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("input").focus(function(){
        $(this).css("background-color", "#ffffff");
    });
    $("input").blur(function(){
        $(this).css("background-color", "#ffffff");
    })
});
</script>

    
<link rel="stylesheet" type="text/css" href="styles%20image.css">
</head>

<div id="holder">
    <div id="menu">
        <?php echo $page_header ?>
        <img src="includes/USL.png" width="20%" align="right" class="otherimg">
    </div>


      


