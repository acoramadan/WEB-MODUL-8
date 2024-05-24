<?php
    try{
    $con = new mysqli("localhost","root","","asistensiweb");
    }catch(mysqli_sql_exception $e){
        echo "". $e->getMessage();
    }
?>