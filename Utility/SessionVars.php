<?php

namespace simpleChat\Utility;

/**
 * Description of SessionPHP
 * 
 * Manage PHP session vars.
 *
 * @author mlin
 */
class SessionVars
{
    /*
     * @type bool
     * 
     * Stores information if session vars were initialized or not.
     */
    private static $isInitialized = false;
    
    
    /*
     * If session vars weren't initialized it happens here. 
     * 
     * @return void
     */
    public static function startSession()
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
            
            self::$isInitialized = true;
        }
    }
    
    
    public function __construct()
    {    
        self::startSession();
    }
    
    
    /*
     * Check if user is logged.
     * 
     * @return bool
     */
    public function isLogged()
    {
        if( $_SESSION['login'] !== '')
            return true;
        else
            return false;
        
    }
    
    
    /*
     * Set session vars during login
     * 
     * @param string $login
     * 
     * @return void
     */
    public function setSession( $login )
    {
        $_SESSION['login'] = $login;
        
        $_SESSION['id'] = uniqid('', true);
        
        $_SESSION['lastMessageID'] = -1;
        
        $this->updateSessionTime();
        
        $this->setLoginTime();
    }
    
    
    /*
     * Destroy session vars during logout
     * 
     * @return void
     */
    public function destroySession()
    {
        $_SESSION['login'] = '';
        $_SESSION['id'] = '';
        $_SESSION['time'] = 0;
        $_SESSION['lastMessageID'] = -1;
    }
    
    
    /*
     * Get user nickname
     * 
     * @return string
     */
    public function getLogin()
    {
        return $_SESSION['login'];
    }
    
    
    /*
     * Get id of current session
     * 
     * @return string
     */
    public function getSessionID()
    {
        return $_SESSION['id'];
    }
    
    
    /*
     * Get time of last database update
     * 
     * @return int
     */
    public function getSessionTime()
    {
        return $_SESSION['time'];
    }
    
    
    /*
     * Get new time
     * 
     * @return int
     */
    public function updateSessionTime()
    {
        $_SESSION['time'] = time();
        
        return $_SESSION['time'];
    }
    
    
    /*
     * Get last read message id
     * 
     * @return string
     */
    public function getLastMessageID()
    {
        return $_SESSION['lastMessageID'];
    }
    
    
    /*
     * Set last read message id
     * 
     * @param mixed $lastMessageID
     * 
     * @return void
     */
    public function setLastMessageID( $lastMessageID )
    {
        if( $lastMessageID !== -1)
        {
            $_SESSION['lastMessageID'] = $lastMessageID;
        }
    }
    
    
    /*
     * Get time of login
     * 
     * @return int
     */
    public function getLoginTime()
    {
        return $_SESSION['loginTime'];
    }
    
    
    /*
     * Set login time
     * 
     * @return void
     */
    protected function setLoginTime()
    {
        $_SESSION['loginTime'] = time();
    }
}
