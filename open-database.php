<?php
       # Making this DockerCompatible.
       # db_hostname is the name of the docker container in which MySQL runs
 
    // ----------- Database connection ----------//
    $mysql_db_hostname = "WhatDoin";
    $mysql_db_user = "TelegramSQL";
    $mysql_db_password = "L@mpMyG@B";
    $mysql_db_database = "dbWhatDoin";  
    
    $dbcon = mysqli_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password) 
                       or die("Failed to connect to MySQL: " . mysqli_connect_error());
    
    mysqli_select_db($dbcon, $mysql_db_database) or die("Could not select database" . mysqli_connect_error());

    
/*    
$config = array('db_ip' => 'WhatDoin', 
		'db_user' => 'TelegramSQL',
		'db_pass' => 'L@mpMyG@B',
		'db_name' => 'dbWhatDoin'
		);
    
*/     
    
?>