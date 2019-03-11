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

<form id="users">
<?php 
					    
$countries = array();

$q = "SELECT `CountryID`, `CountryName` FROM countries";

$result = $general->connection->RunQuery($q);

while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				$id = $row['CountryID'];
				$name = $row['CountryName'];
		
				$countries[$id] = $name;
		
		}
									
//echo $formv1->generateText('user_id', 'user_id', '', 'tooltip here');
echo '<fieldset>';
echo $formv1->generateText('Firstname', 'firstname', '', 'tooltip here');
echo $formv1->generateText('Surname', 'surname', '', 'tooltip here');
echo $formv1->generateText('Email Address', 'email', '', 'tooltip here');
echo $formv1->generatePassword('Password', 'password', '', 'tooltip here');
echo $formv1->generatePassword('Reenter Password', 'confirm', '', 'tooltip here');
//echo '<button type="button" id="hash">hash</button>';
echo '</fieldset>';
echo '<br><br>';

echo '<fieldset>';
echo $formv1->generateText('Institution name', 'centreName', '', 'tooltip here');
echo $formv1->generateText('Institution City', 'centreCity', '', 'tooltip here');
echo $formv1->generateSelectCustom('Country', 'centreCountry', '', $countries, 'tooltip here');
echo $formv1->generateText('Phone number', 'contactPhone', '', 'tooltip here');

echo '</fieldset>';
echo '<br><br>';

echo '<fieldset>';
echo $formv1->generateSelect('What is your specialist interest?', 'specialistInterest', '', 'specialistInterest', 'tooltip here');
echo $formv1->generateSelect('Are you a trainee?', 'trainee', '', 'Yes_No', 'tooltip here');
echo $formv1->generateText('How many years have you practiced? (total incl. training)', 'yearsIndependent', '', 'tooltip here');
echo $formv1->generateText('How many years have you performed endoscopy for independently?', 'yearsEndoscopy', '', 'tooltip here');
echo $formv1->generateSelect('Have you ever undertaken an endoscopy fellowship (dedicated, >6months)', 'endoscopyTrainingProgramme', '', 'Yes_No', 'tooltip here');
echo $formv1->generateSelect('Email preferences <sub>(can be changed later)</sub>', 'emailPreferences', '', 'emailPreferences', 'tooltip here');

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
<button type="button" id="submitusers">Submit</button>
		
</form>