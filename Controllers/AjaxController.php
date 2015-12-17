<?php


namespace simpleChat\Controllers;

use simpleChat\Utility\Messenger;
use simpleChat\Utility\SessionLogin;
use simpleChat\Utility\Request;
use simpleChat\Utility\ChatMessage;
use Exception;
use simpleChat\Utility\Message;

/**
 * Description of AjaxController
 *
 * @author mlin
 */
class AjaxController extends ChatController
{
    protected $session;


    public function start()
    {
        $request = new Request();
        $this->session = new SessionLogin();

        
        if($this->session->isLogged())
        {
            
            if($request->urlAction === 'liveConnect')
            {
                try
                {
                    Messenger::send(LiveConnect::controller());
                }
                catch (\PDOException $e)
                {
                    Messenger::send(new Message($e->getCode(), $e->getMessage()));
                }
                catch (Exception $ex)
                {
                    Messenger::send($request->invalid(Request::INCORRECT_ACTION));
                }
            }
            else if ($request->urlAction === 'logout')
            {
                Messenger::send($this->logout());
            }
            else
            {
                Messenger::send($request->invalid(Request::INCORRECT_ACTION));
            }
        }
        else
        {
            if($request->urlAction === 'login')
            {
                $this->login();
            }
            else
            {
                Messenger::send($request->invalid(Request::NO_SESSION));
            }
        }
    }
    
    
    protected function login()
    {
        try
        {
            $this->session->login();
                    
            $db = new \simpleChat\Utility\ChatData();
            $messages = $db->getMessages();
            $users = $db->getUsers();
                    
            Messenger::send( new ChatMessage(201, array($messages, $users) ));
        }
        catch(Exception $e)
        {
            Messenger::send(new Message($e->getCode(), $e->getMessage()));
        }
    }
    
    
    protected function logout()
    {
        $logout = new \simpleChat\Utility\Logout();
        
        $logout->exec();
        
        return new Message(205);
    }
}
