 <?php  
        $page_title='iACE Elearning - Login';
        $page_header='iACE Study Elearning';
        include ('image_header_initial.php');
            
        
?>

    <div id="navi">
        <li class="active"><a href="elearn.php">Login page for iACE elearning</a></li>
        <li><a href="https://www.acestudy.net/index.php">Back to main ACE site</a></li>

    </div>
    
</div>
</header>


<div class="content">
 <?php
    
    
      // Check if the form has been submitted:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

              // Need two helper files:
              require ('login_functions.php');
             define ('MYSQL', '../mysqli_connect_learning.php');
             require (MYSQL);

           // Check the login:
             list ($check, $data) = check_login($dbc,
               $_POST['email'], $_POST['pass']);

             if ($check) { // OK!

                // Set the session data:
                $_SESSION['user_id'] = $data['user_id'];
                $_SESSION['firstname'] = $data['firstname'];
                $_SESSION['surname'] = $data['surname'];  
                $_SESSION['centre'] = $data['centre']; 
            

                  if (!(isset($_SESSION["user_id"])))
                    echo "User ID is not set in the session";
                 echo 'row dump'; var_dump($row);
                 echo '<br> data dum; '; var_dump($data);
                 echo '<br> session dump '; var_dump($_SESSION);
                    echo $_SESSION["user_id"];
                 
                 
                    // Redirect:
                redirect_user('learning.php');

                 } else { // Unsuccessful!

                    // Assign $data to $errors for
                    $errors = $data;
                    foreach ($errors as $msg) {
                        echo " - $msg<br />\n";
                    }

                 mysqli_close($dbc); // Close the database connection.

              } // End of the main submit conditional.
        }
              // Create the page:
              ?>
    
<h2>Login</h2>
    
   <form action="elearn.php" method="post">
       <fieldset>
       <p> Email address: <input type="text" name="email" size="30" maxlength="80"></p>
        <p> Password: <input type="password" name="pass" size="30" maxlength="80"></p>
        <p><input type="submit" name="submit" value="Submit" /></p>
           <p> </p>
       </fieldset>
    </form>
    <br>
    <br>
    <br>
    <p><b>Note: </b>login to this system is by invitation only.  Please enter the login details you were provided.  
    If you believe you should be able to login but do not have login credentials please contact the host study centre.</p>
      </div>
    </body>
   <?php include ('footer.html'); ?>