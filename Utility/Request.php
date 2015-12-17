<?php

namespace simpleChat\Utility;

/**
 * Description of Request
 * Parse request variables and give some methods to work
 * with them.
 *
 * @author mlin
 */
class Request
{
    /*
     * @type string
     * stores $_POST['action'] or null if not set
     */
    public $action = '';
    
    /*
     * @type string
     * stores a second part of uri (the first is usually ajax or js string)
     * if not set it's empty string ('')
     */
    public $urlAction = '';
    
    /*
     * @type string
     * new message send by user or null
     */
    public $message;
    
    
    /*
     * @type array
     * Stores all part of uri as array
     */
    protected $uri = array();
    
    /*
     * @type int
     */
    const NO_SESSION = 2;
    const INCORRECT_ACTION = 3;
    
    
    /*
     * Parse uri and set POST variables
     */
    function __construct()
    {
        $this->loadUri();
        $this->setRequestVariables();
    }
    
    
    /*
     * Check if request is made by js code
     * 
     * @return bool
     */
    public function isAjax()
    {
        if( $this->uri[0] === 'ajax' )
            return true;
        
        return false;
    }
    
    
    /*
     * Check if request is for javascript code
     * 
     * @return bool
     */
    public function jsCode()
    {
        if( $this->uri[0] === 'js' )
            return true;
        
        return false;
    }
    
    
    /*
     * In case of incorrect request return Message instance with corresponding
     * code.
     * 
     * @param int $error - error type
     * 
     * @return Message or void if incorrect $error was specified.
     */
    public function invalid($error)
    {
        if( $error === 2 )
            return new Message(403);
        else if( $error === 3 )
            return new Message(400);
    }
    
    
    /*
     * Wrapper for filter_input function
     * 
     * @param string $key
     * 
     * @return string
     */
    public function input($key)
    {
        return filter_input(INPUT_POST, $key);
    }
    
    
    /*
     * Load uri to object variable
     * 
     * @return void
     */
    protected function loadUri()
    {
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        
        $uri = str_replace(SITE_PATH . 'web/', '', $uri);
        
        $uri = str_replace('index.php', '', $uri);
        $uri = trim($uri, "/\t\n\r");

        $uri = explode('/', $uri);
        
        $this->uri = $uri;
    }
    
    
    /*
     * Set object variables according to values being given in POST variable and
     * as part of uri
     * 
     * @return void
     */
    protected function setRequestVariables()
    {
        $this->action = filter_input(INPUT_POST, 'action');
        
        if(isset($this->uri[1]))
            $this->urlAction = $this->uri[1];
        else
            $this->urlAction = '';
        
        $this->message = filter_input(INPUT_POST, 'message');
    }
}
