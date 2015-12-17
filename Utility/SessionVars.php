<?php

namespace simpleChat\Utility;

/**
 * Description of SessionPHP
 * This class main purpose is to manage PHP functions related to session.
 *
 * @author mlin
 */
class SessionVars
{
    static private $isInitialized = 0;
    
    static public function startSession()
    {
        
        if( !self::$isInitialized )
        {
            session_start();
            
            if( !isset($_SESSION['login']) )
            {
                $_SESSION['login'] = '';
            }
            
            if( !isset($_SESSION['id']) )
            {
                $_SESSION['id'] = '';
            }
            
            if( !isset($_SESSION['time']) )
            {
                $_SESSION['time'] = 0.0;
            }
            
            if( !isset($_SESSION['lastMessageID']) )
            {
                $_SESSION['lastMessageID'] = -1;
            }
            
            if( !isset($_SESSION['loginTime']) )
            {
                $_SESSION['loginTime'] = \PHP_INT_MAX;
            }
            
            self::$isInitialized = 1;
        }
    }
    
    
    function __construct()
    {
        
        self::startSession();
    }
    
    
    public function isLogged()
    {
        
        if( $_SESSION['login'] !== '')
            return true;
        else
            return false;
        
    }
    
    public function setSession( $login )
    {
        $_SESSION['login'] = $login;
        
        $_SESSION['id'] = uniqid('', true);
        
        $_SESSION['lastMessageID'] = -1;
        
        $this->updateSessionTime();
        
        $this->setLoginTime();
    }
    
    public function destroySession()
    {
        $_SESSION['login'] = '';
        $_SESSION['id'] = '';
        $_SESSION['time'] = 0.0;
        $_SESSION['lastMessageID'] = -1;
    }
    
    public function getLogin()
    {
        return $_SESSION['login'];
    }
    
    public function getSessionID()
    {
        return $_SESSION['id'];
    }
    
    public function getSessionTime()
    {
        return $_SESSION['time'];
    }
    
    public function updateSessionTime()
    {
        $_SESSION['time'] = time();
        
        return $_SESSION['time'];
    }
    
    public function getLastMessageID()
    {
        return $_SESSION['lastMessageID'];
    }
    
    public function setLastMessageID( $lastMessageID )
    {
        if( $lastMessageID !== -1)
        {
            $_SESSION['lastMessageID'] = $lastMessageID;
        }
    }
    
    public function getLoginTime()
    {
        return $_SESSION['loginTime'];
    }
    
    protected function setLoginTime()
    {
        $_SESSION['loginTime'] = time();
    }
}
