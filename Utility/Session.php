<?php

namespace simpleChat\Utility;

use \Exception;

/**
 * Description of Session
 * Manage session of the user. Specific task like login and logout
 * are implemented in child classes.
 *
 * @author mlin
 */

class Session
{
    /*
     * @type SessionVars
     * Stores reference to SessionVars object
     */
    protected $vars;
    
    /*
     * @type Login
     * Stores reference to Login object
     */
    protected $db;
    
    /*
     * @type bool
     * Inform if session data in database was updated
     */
    protected static $updatedSession = false;
            
    
    /*
     * Create new instances of required classes and if it wasn't done before,
     * update data in database
     */
    public function __construct()
    {
        $this->db = new Login();
        $this->vars = new SessionVars();
        
        if( $this->isLogged() && self::$updatedSession === false)
            $this->sustainSession();
    }
    
    
    /*
     * Check if current user is logged
     * 
     * @return bool
     */
    public function isLogged()
    {
        if( $this->vars->isLogged() )
        {
            return true;
        }
        
        return false;
    }
    
    
    /*
     * Refresh session time in database if necessary
     * 
     * @return void
     */
    public function sustainSession()
    {
        self::$updatedSession = true;
        
        try
        {
            if( $this->getSessionTime() < time() - 70 )
            {
                $this->updateSessionTime();
            }
        }
        catch (Exception $ex)
        {
            $this->vars->destroySession();
        }
    }
    
    
    /*
     * Get name of current user
     * 
     * @return string
     */
    public function getName()
    {
        return $this->vars->getLogin();
    }
    
    
    /*
     * Update session time in database
     * 
     * @return void
     */
    protected function updateSessionTime()
    {
        self::$updatedSession = 1;
        
        $db = new SessionData();
        
        $db->updateTime($this->vars->getSessionID(), $this->vars->updateSessionTime());
    }
    
    
    /*
     * Invoke methods of SessionVars object if method of specified name wasn't declared
     * in this class.
     * 
     * @return mixed - a result of invoked method
     */
    public function __call($name, $arguments)
    {
        if( method_exists($this->vars, $name) )
        {
            return call_user_func_array( array($this->vars, $name), $arguments );
        }
    }
}
