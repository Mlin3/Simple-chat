<?php

namespace simpleChat\Utility;

/**
 * Description of Messege
 * Basic class used as container for messages exchanged with clients.
 * @author mlin
 */
class Message
{
    /*
     * @type int
     * Code which has some meaning for client
     */
    public $code;
    
    /*
     * @type string
     * Type of message, has no meaning right now
     */
    public $type;
    
    /*
     * @type mixed
     * Some kind of message to the client
     */
    public $content;
    
    /*
     * Fill fields with given data.
     * 
     * @param int $code
     * @param mixed $content
     * @param string $type
     */
    public function __construct($code, $content = '', $type = 'basic')
    {
        $this->set($code, $content, $type);
    }
    
    /*
     * @param same as above
     * 
     * @return void
     */
    public function set($code, $content = '', $type = 'basic')
    {
        $this->code = $code;
        $this->type = $type;
        $this->content = $content;
    }
}
