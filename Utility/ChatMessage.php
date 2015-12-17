<?php

namespace simpleChat\Utility;

/**
 * Description of ChatMessage
 *
 * Extends class Message with additional fields storing
 * data exchanged during chat sessions.
 * 
 * @author mlin
 */
class ChatMessage extends Message
{
    public $messages;
    public $users;
    
    /*
     * @param int $code
     * @param array $content - expect array with 2 elements, first storing
     * messages and second containing list of logged users.
     * @param string $type
     */
    function __construct($code, $content = array(), $type = 'chatLive')
    {
        parent::__construct($code, '', $type);
        
        $this->messages = $content[0];
        $this->users = $content[1];
    }
}
