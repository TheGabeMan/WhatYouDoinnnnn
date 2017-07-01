<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function WriteToLogDB($URLOKArray)
{
    require 'open-database.php';
    
    // Write to log table
    $sql = "INSERT INTO `ConnectionLog`(`timestamp`,`url01`,`url02`, `url03`) VALUES( now(), $URLOKArray[0], $URLOKArray[1],$URLOKArray[2]);";
    printf($sql);
    if (!mysqli_query($dbcon,$sql))
      { die('Error: ' . mysqli_error($dbcon)); }
    $results = mysqli_query($dbcon,$sql);
    
    
    printf("%d Row inserted.\n", mysqli_affected_rows($dbcon));
    printf("Error Nr.\n", mysqli_errno($dbcon));
    printf("Error  \n",  mysqli_error($dbcon));
    
    mysqli_close($dbcon);
}

?>
