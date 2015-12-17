<?php

namespace simpleChat\Controllers;

use simpleChat\Utility\Session;
use simpleChat\Utility\Viewer;


/**
 * Description of StandardController
 * 
 * Print html code
 * 
 * @author mlin
 */
class StandardController extends ChatController
{
    /*
     * Print html code
     * 
     * @return void
     */
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
