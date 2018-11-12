<?php 

    session_start( );

  ?>

<!DOCTYPE html>
<html>
<title>
    <?php $page_title ?>
    
    </title>
<head> 
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("input").focus(function(){
        $(this).css("background-color", "#ffffff");
    });
    $("input").blur(function(){
        $(this).css("background-color", "#ffffff");
    })
    $("#Age").blur(function(){
        if $("Age").val < "18" {
          $("Age").append("This value cannot be under 18");
        }})
       ;
});
</script>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
    <header>
<div id="holder">
    <div id="menu">
        <?php echo $page_header ?>
        <img src="includes/USL.png" width="175px" align="right">
    </div>
      


