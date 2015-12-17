<?php

namespace simpleChat\Controllers;

use simpleChat\Utility\Session;
use simpleChat\Utility\ChatData;
use simpleChat\Utility\ChatMessage;
use simpleChat\Utility\Request;
use Exception;

/**
 * Description of LiveConnect
 *
 * @author mlin
 */
class LiveConnect
{
    protected $lastMessageID;
    
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
    
    public function mantainSession()
    {
        $session = new Session();
        
        $db = new ChatData();
        
        $messages = $this->getLastMessageID( $db->getMessages() );
        
        $session->setLastMessageID( $this->lastMessageID );
        
        $users = $db->getUsers();
                    
        return new ChatMessage(201, array($messages, $users) );
    }
    
    public function addMessage()
    {
        $request = new Request();
        $session = new Session();
        
        $db = new ChatData();
        
        $db->addMessage($session->getName(), $request->message);

        
        return $this->mantainSession();
    }
    
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
