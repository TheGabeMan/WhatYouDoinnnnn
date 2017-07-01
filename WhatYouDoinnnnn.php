<?php 

print "<h1>Dit is een Telegram Bot 0004</h1>";
$botToken = "403038496:AAE4V-FKddyZM0S2VAPYKw7r7NPR-F2nDLg";
$website = "https://api.telegram.org/bot".$botToken;

$content = file_get_contents('php://input');
$update = json_decode($content, TRUE);

writeDebug("debug content:" .$content);
writeDebug("debug update :" .$update);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

writeDebug("debug chatid : " .$chatId);
writeDebug("debug message: " .$message);


switch($message) {
    
    case "/test":
        sendMessage($chatId, "test");
        break;
    case "/hi":
        sendMessage($chatId, "hi there!");
        break;
    case "/list":
        sendMessage($chatId, "LIST ONTVANGEN");
        print("<h1>Dit is een Telegram Bot LIJST</h1>");
        break;
    case "/time":
        sendMessage($chatId, "Current date and time is " . date("Y-m-d H:i:s"));
        break;
    case "/buttons":
        writeDebug("debug buttons chatid: " .$chatId);
        $keyboard = array(array("MEETING","C-I-P","LIST"));
        $resp = array("keyboard" => $keyboard,"resize_keyboard" => true,"one_time_keyboard" => true);
        $reply = json_encode($resp);
        $url = $website."/sendmessage?chat_id=".$chatId."&text=".urlencode("Kies optie:")."&reply_markup=".$reply;
        writeDebug("debug buttons 2:" .$url);
        file_get_contents($url);
        break;
    case $chatId = "":
        writeDebug( "ChatId is leeg" .$chatId);
        break;
    default: 
        writeDebug( "Debug bij default: ".$chatId." --- ".$website);
        sendMessage($chatId, "Geen commando dus ik doe iets anders", $website);
        
    
}

writeDebug("</br> <p> - New Run - </p>&nbsp;</br>");



function sendMessage ($chatId, $message, $website) {
    
    $url = $website."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
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
