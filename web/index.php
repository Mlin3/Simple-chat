<?php

require '../Controllers/ChatController.php';

use simpleChat\Controllers\ChatController;

$chat = ChatController::newInstance();

$chat->start();