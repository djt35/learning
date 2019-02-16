<?php 
        $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $sql = "SELECT Name, Type, textType, Value1, Value2, Text, MessageVariable, Message_t FROM Sheet1 WHERE position=".$iterationForm." AND Type IS NOT NULL ORDER BY `Order` ASC";
            $result = mysqli_query ($dbc, $sql);
            while($row = mysqli_fetch_array($result)) {
                if (($row["Type"])==1){
                    generateSelect (($row["Text"]), ($row["Name"]) , ($row["Value1"]), ($row["Value2"]), $_POST[($row["Name"])], ($row["Message_t"])); 
                    errorMessage(($row["MessageVariable"]));
                } 
                elseif (($row["Type"])==2){
                    if($row["textType"]==1){$type="number";}elseif($row["textType"]==2){$type="text";}elseif($row["textType"]==3){$type="date";}
                    
                    generateText (($row["Text"]), ($row["Name"]) , $type, $_POST[($row["Name"])], ($row["Message_t"]));  
                    errorMessage(($row["MessageVariable"]));
                } 
                elseif (($row["Type"])==3){
                   generateChecked(($row["Text"]), ($row["Name"]), ($row["Value1"]), ($row["Value2"]), $_POST[($row["Name"])], ($row["Message_t"])); 
                    errorMessage(($row["MessageVariable"]));
                }
                elseif (($row["Type"])==4) {
                    generateTextArea (($row["Text"]), ($row["Name"]) , $_POST[($row["Name"])], ($row["Message_t"]));
                    errorMessage(($row["MessageVariable"]));
        
                }
                elseif (($row["Type"])==5){
                    generateHidden (($row["Text"]), ($row["Name"]) , 'hidden', $_POST[($row["Name"])]);  
                    errorMessage(($row["MessageVariable"]));
                } 
            }
       mysqli_free_result($result);
       ?>