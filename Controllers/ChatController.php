<?php

namespace simpleChat\Controllers;

require __DIR__ . '/../Utility/constants.php';
require __DIR__ . '/../Utility/autoloader.php';

use simpleChat\Utility\Request;


abstract class ChatController
{
    protected $path;
    /*
     * Return a right controller depending on the reqest type.
     * 
     * @param string $path - Path to root folder
     */
    static public function newInstance($path = \simpleChat\Utility\ROOT_PATH)
    {
        $request = new Request();
        
        
        if ($request->isAjax())
        {
            return new AjaxController();
        }
        else if ($request->jsCode())
        {
            return new JsController();
        }
        else
        {
            return new StandardController($path);
        }
    }
    
    /*
     * This function is supposed to form an answer to the request.
     */
    abstract public function start();
}

