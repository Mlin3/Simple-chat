<?php

require '../Utility/constants.php';
require '../Utility/autoloader.php';

use simpleChat\Utility\Session;
use simpleChat\Utility\SessionLogin;

$session = new Session();

$login = new SessionLogin();

$session->setSession('franek');

var_dump($login->getSessionID());