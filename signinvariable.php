<?php 
if ($checkUserResult->num_rows === 0) {
    echo '<div class ="absolute mt-20 ">EMail or the password is wrong. Please check. </div>';
    
                                  
} else if ($checkUserResult->num_rows === 1){
    // Set Verified to FALSE by default
    header("Location: index.php");
    
      exit();
    
}
?>