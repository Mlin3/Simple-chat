<?php

namespace simpleChat\Controllers;

use simpleChat\Utility\Session;
use simpleChat\Utility\Viewer;

class StandardController extends ChatController
{
    public function start()
    {
        $session = new Session();
        $viewer = new Viewer();
        
        if ($session->isLogged())
        {
            $viewer->displayChat();
        } 
        else
        {
            $viewer->displayFormLogin();
            
        }
    }
}
