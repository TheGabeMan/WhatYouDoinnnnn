<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$inline_keyboard = [
    new InlineKeyboardButton(['text' => 'inline', 'switch_inline_query' => 'true']),
    new InlineKeyboardButton(['text' => 'callback', 'callback_data' => 'identifier']),
    new InlineKeyboardButton(['text' => 'open url', 'url' => 'https://github.com/akalongman/php-telegram-bot']),
];
$data = [
    'chat_id' => $chat_id,
    'text'    => 'inline keyboard',
    'reply_markup' => new InlineKeyboardMarkup(['inline_keyboard' => [$inline_keyboard]]),
];


?>