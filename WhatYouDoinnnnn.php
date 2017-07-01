<?php 

print "<h1>Dit is een Telegram Bot 0004</h1>";
$botToken = "403038496:AAE4V-FKddyZM0S2VAPYKw7r7NPR-F2nDLg";
$website = "https://api.telegram.org/bot".$botToken;

$content = file_get_contents('php://input');
$update = json_decode($content, TRUE);
$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

// Debug data
writeDebug("debug content:" .$content);
writeDebug("debug update :" .$update);
writeDebug("debug chatid : " .$chatId);
writeDebug("debug message: " .$message);

switch($message) {
    
    case "/WhoIsBas":
        sendMessage($chatId, urlencode("The Beethoven to be"));
        break;
    case "/hi":
        sendMessage($chatId, urlencode("hi there!"));
        break;
    case "/list":
        sendMessage($chatId, urlencode("LIST ONTVANGEN"));
        break;
    case "/time":
        sendMessage($chatId, urlencode("Current date and time is " . date("Y-m-d H:i:s")));
        break;
    case "/buttons":
        writeDebug("debug buttons chatid: " .$chatId);
        $keyboard = array(array("MEETING","IPWC","BUREAU_OVERLEG"));
        $resp = array("keyboard" => $keyboard,"resize_keyboard" => true,"one_time_keyboard" => true);
        $reply = json_encode($resp);
        writeDebug("debug buttons 2:".$url);
        
        sendMessage($chatId, urlencode("Kies optie:")."&reply_markup=".$reply);
        break;
    
    // Responses to the buttons: MEETING IPWC BUREAU_OVERLEG
    case "MEETING":
        writeDebug("debug after buttons MEETING: ");
        sendMessage($chatId, urlencode("MEETING omschrijving: "));
        writeDebug("debug after buttons MEETING and sendMessage ");
        WriteRow($chatId, $message);
        
        
    case "IPWC":
        writeDebug("debug buttons IPWC: ");
        sendMessage($chatId, urlencode("IPWC omschrijving: "));
        
    case "BUREAU_OVERLEG":
        writeDebug("debug buttons BUREAU_OVERLEG: ");
        sendMessage($chatId, urlencode("BUREAU_OVERLEG omschrijving: "));
        

        
        
        
    default: 
        writeDebug("debug default chatid: " .$chatId);
        sendMessage($chatId, urlencode("Geen commando dus ik doe iets anders"));
        
    
}

writeDebug("</br> <p> - New Run - </p>&nbsp;</br>");



function sendMessage ($chatId, $message) {
    
    
    $botToken = "403038496:AAE4V-FKddyZM0S2VAPYKw7r7NPR-F2nDLg";
    $website = "https://api.telegram.org/bot".$botToken;
    
    $url = $website."/sendMessage?chat_id=".$chatId."&text=".$message;
    $context = stream_context_create( array(
        'https' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        )
    ));
    writeDebug("debug url to SendMessage :" .$url);
    file_get_contents($url, FALSE, $context);
    
}
 

function writeDebug( $data ){
    
    $logfile ="log_WhatYouDoinnnnn.log";
    file_put_contents($logfile, date("Y-m-d H:i:s").$data."</br>", FILE_APPEND);
    
}


function WriteRow($chatId, $message){
    
    /*
     * What should the database look like?
     * Table Name ---> ActivTable
     * chatID = unique for each user
     * TimeStamp = date and time this entry was made (for now I'll use this. Later start time and duration should be used.
     * StartTime = time like 10:00, 10:30, 10:45
     * DurationMin = duration in Minutes
     * Activity = Activity description
     * Activity Type = Type of activity which can be IPWC (Incident, Problem, Wijziging, Controle) or D (Desk Meeting) or M (Meeting) or R (pRoject)
     * 
     */
    writeDebug(" Arrived at WriteRow with " . $chatId . " and " . $message );
    require_once("open-database.php");
    
    writeDebug(" WriteRow with " . $chatId . " and " . $message );
    $sqlString = "INSERT INTO `ActivTable`(`chatid`,`timestamp`,starttime`,`durationmin`,`activitytype`,`activitydescription`) VALUES($chatId, now(), `10:00`, 15, `P`, `Standaard Problem`); ";
    
    writeDebug(" SQLString =  " . $sqlString );
    if (!mysqli_query($dbcon,$sql))
      { 
        writeDebug("Error with database" .mysqli_error($dbcon) );
        die('Error: ' . mysqli_error($dbcon)); 
        
      }
    $results = mysqli_query($dbcon,$sql);
}

function WriteToLogDB($URLOKArray)
{
    require_once( 'open-database.php');
    
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
