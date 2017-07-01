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
        writeDebug("debug buttons MEETING: ");
        sendMessage($chatId, urlencode("MEETING omschrijving: "));
        
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

?>
