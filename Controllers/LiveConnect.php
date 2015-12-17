<?php

namespace simpleChat\Controllers;

use simpleChat\Utility\Session;
use simpleChat\Utility\ChatData;
use simpleChat\Utility\ChatMessage;
use simpleChat\Utility\Request;
use Exception;

/**
 * Description of LiveConnect
 * Control request made by logged user.
 * 
 * @author mlin
 */
class LiveConnect
{
    /*
     * @type string
     * Id of last message read by user
     */
    protected $lastMessageID;
    
    
    /*
     * Parse logged user request.
     * 
     * @throws Exception
     * @return ChatMessage
     */
    static public function controller()
    {
        $liveConnect = new self();
        $request = new Request();
        
        
        if ($request->action === 'normal')
        {
            return $liveConnect->mantainSession();
        }
        else if ($request->action === 'addMessage')
        {
            return $liveConnect->addMessage();
        }
        else
        {
            throw new Exception('Incorrect request');
        }
    }
    
    
    /*
     * Get unread messages and users list
     * 
     * @return ChatMessage
     */
    public function mantainSession()
    {
        $session = new Session();
        
        $db = new ChatData();
        
        $messages = $this->getLastMessageID( $db->getMessages() );
        
        $session->setLastMessageID( $this->lastMessageID );
        
        $users = $db->getUsers();
                    
        return new ChatMessage(201, array($messages, $users) );
    }
    
    
    /*
     * Add new message to database and invoke mantainSession method
     * 
     * @return ChatMessage
     */
    public function addMessage()
    {
        $request = new Request();
        $session = new Session();
        
        $db = new ChatData();
        
        $db->addMessage($session->getName(), $request->message);

        
        return $this->mantainSession();
    }
    
    /*
     * Get id of last message send to user
     * 
     * @return mixed
     */
    protected function getLastMessageID( $messages )
    {
        if( count($messages) > 0 )
        {
            $this->lastMessageID = $messages[ count($messages) - 1 ][0];
            
            foreach($messages as &$message)
            {
                array_shift($message);
            }
        }
        else
        {
            $this->lastMessageID = -1;
        }
        
        return $messages;
    }
}
