<?php

namespace simpleChat\Utility;

/**
 * Description of Messenger
 * Direct communication with clients. Encode messages and send them
 * with correct headers.
 *
 * @author mlin
 */
class Messenger
{
    /*
     * Send message to a browser. According to type of $content variable or
     * value of $type a right method is invoked to form a message.
     * 
     * @param string|Message $content - string or instance of Message class
     * @param string $type - if a message is a javascript code, a js value should be given.
     * 
     * @return void
     */
    static public function send($content, $type = '')
    {
        $messenger = new self();
        
        if ($content instanceof Message)
        {
            $messenger->sendJson($content);
        }
        
        else if($type === 'js')
        {
            $messenger->sendJS($content);
        }
        
        else
        {
            $messenger->sendHTML($content);
        }
    }
    
    
    /*
     * Send a message as html
     * 
     * @param string $content
     * 
     * @return void
     */
    public function sendHTML($content)
    {
        header('Content-Type: text/html; charset=utf-8');
        
        echo $content;
    }
    
    
    /*
     * Send a message as JSON
     * 
     * @param Message $message
     * 
     * @return void
     */
    public function sendJson(Message $message)
    {
        header('Content-Type: application/json');
        
        echo json_encode($message);
    }
    
    
    /*
     * Send javascript code
     * 
     * @param string $content
     * 
     * @return void
     */
    public function sendJS($content)
    {
        header('Content-Type: application/javascript');
        
        echo $content;
    }
    
    
    /*
     * Decode json string
     * 
     * @param string $json
     * 
     * @return mixed - return encoded json object
     */
    public function decodeJson($json)
    {
        return json_decode($json);
    }
}
