<?php 

print "<h1>Dit is een Telegram Bot 0002</h1>";
$botToken = "403038496:AAE4V-FKddyZM0S2VAPYKw7r7NPR-F2nDLg";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

print($update);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];



switch($message) {
    
    case "/test":
        sendMessage($chatId, "test");
        break;
    case "/hi":
        sendMessage($chatId, "hi there!");
        break;
    case "list":
        sendMessage($chatId, "LIST ONTVANGEN");
        print("<h1>Dit is een Telegram Bot LIJST</h1>");
        break;
    case "/time":
        sendMessage($chatId, "Current date and time is " . date("Y-m-d H:i:s"));
        break;
    case "/buttons":
        $keyboard = array(array("MEETING","C-I-P","LIST"));
        $resp = array("keyboard" => $keyboard,"resize_keyboard" => true,"one_time_keyboard" => true);
        $reply = json_encode($resp);
        $url = $website."/sendmessage?chat_id=".$chatId."&text=oi&reply_markup=".$reply;
        file_get_contents($url);
        break;
    default: 
        sendMessage($chatId, "Geen commando dus ik doe iets anders");
    
}

  


function sendMessage ($chatId, $message) {
    
    $url = $website."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
    $context = stream_context_create( array(
        'https' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        )
    ));
    file_get_contents($url, FALSE, $context);
    
}
 

# https://api.telegram.org/bot403038496:AAE4V-FKddyZM0S2VAPYKw7r7NPR-F2nDLg/setWebhook?url=https://phpserver-whatyoudoinnnnn.publicpaas.openshift.openline.nl/WhatYouDoinnnnn.php



?>
