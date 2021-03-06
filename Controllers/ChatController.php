<?php

namespace simpleChat\Controllers;

require __DIR__ . '/../Utility/constants.php';
require __DIR__ . '/../Utility/autoloader.php';

use simpleChat\Utility\Request;


/**
 * Description of ChatController
 * 
 * Returns instance of one of the child class.
 * 
 * @author mlin
 */
abstract class ChatController
{
    /*
     * @type string
     */
    protected $path;
    
    
    /*
     * Return a right controller depending on the reqest type.
     * 
     * @param string $path - Path to root folder
     */
    public static function newInstance($path = \simpleChat\Utility\ROOT_PATH)
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
     * This function is supposed to process the request and print response.
     */
    abstract public function start();
}

