<?php
try {
  $connection = mysqli_connect("localhost", "root", "admin123", "products");
}    
catch(Exception $e)
{
    echo $e->getMessage();
}

?>
