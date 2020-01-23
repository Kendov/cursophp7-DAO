<?php
spl_autoload_register(function($class_name){
    $classDir = "class";
    $fileName = $classDir.DIRECTORY_SEPARATOR.$class_name . ".php";
    if(file_exists($fileName)) require_once($fileName);
})



?>