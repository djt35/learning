<?php

$openaccess=1;

require ('../../includes/config.inc.php'); 
require (BASE_URI.'/scripts/headerScript.php');
		
$formv1 = new formGenerator;
$general = new general;
$video = new video;
$tagCategories = new tagCategories;
$user = new users;
?>

<form id="usersForgot">
<?php 
					    
									
//echo $formv1->generateText('user_id', 'user_id', '', 'tooltip here');
echo '<fieldset>';
echo $formv1->generateText('Email Address', 'email', '', 'tooltip here');

echo '</fieldset>';
echo '<br><br>';
/*
echo '<fieldset>';
echo $formv1->generateText('timezone', 'timezone', '', 'tooltip here');
echo $formv1->generateText('registered_date', 'registered_date', '', 'tooltip here');
echo $formv1->generateText('last_login', 'last_login', '', 'tooltip here');
echo $formv1->generateText('previous_login', 'previous_login', '', 'tooltip here');
echo $formv1->generateSelect('User access level', 'access_level', '', 'access_level', 'tooltip here');
echo $formv1->generateText('key', 'key', '', 'tooltip here');
//echo '<button type="button" id="random">random key</button><br><br>';
echo '</fieldset>';
echo '<br><br>';
*/

?>
<button type="button" id="submitusersForgot">Submit</button>
		
</form>