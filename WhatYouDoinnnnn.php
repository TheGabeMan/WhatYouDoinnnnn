<?php 

print "<h1>Dit is een Telegram Bot</h1>";
$botToken = "403038496:AAE4V-FKddyZM0S2VAPYKw7r7NPR-F2nDLg";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);


$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];



switch($message) {
    
    case "/test":
        sendMessage($chatId, "test");
        break;
    case "/hi":
        sendMessage($chatId, "hi there!");
        break;
    default: 
        sendMessage($chatId, "Geen commando dus ik doe iets anders");
    
}

function sendMessage ($chatId, $message) {
    
    $url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
    file_get_contents($url);
    
}
 

# https://api.telegram.org/bot403038496:AAE4V-FKddyZM0S2VAPYKw7r7NPR-F2nDLg/setWebhook?url=https://phpserver-whatyoudoinnnnn.publicpaas.openshift.openline.nl/WhatYouDoinnnnn.php



?>
