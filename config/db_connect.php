
<?php

// MySQLi Connect to database
    $conn = mysqli_connect("localhost", "dane", "123456", "cogrammer");

    // Check connection
    If(!$conn){
        echo "Connection Error: " . mysqli_connect_error();
    }

?>