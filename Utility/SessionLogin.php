<?php

namespace simpleChat\Utility;

use Exception;

/**
 * Description of SessionLogin
 *
 * Try to add new user to database
 * 
 * @author mlin
 */
class SessionLogin extends Session
{
    /*
     * Add user to database or throw exception on error
     * 
     * @throws Exception
     * @return Message
     */
    public function login()
    {
        $request = new Request();
        
        if( !$this->isLogged() )
        {
            if( Validator::login( $request->input('login') ) )
            {
                $this->vars->setSession( $request->input('login') );
                
                //Try to add user to database, if nickname is already in use
                //the exception will be thrown, PDOException can be thrown on
                //error as well.
                try
                {
                    $this->db->addNewUser( $this->vars->getLogin(),
                                           $this->vars->getSessionID(),
                                           $this->vars->getSessionTime());
                }
                catch (Exception $e)
                {
                    $this->vars->destroySession();
                    
                    throw new Exception($e->getMessage(), $e->getCode());
                }
                
                
                return new Message(200, 'Login ok');
            }
            else
            {
                throw new Exception('Incorrect login', 401);
            }
        }
        else
        {
            throw new Exception('User is already logged.', 400);
        }
    }
}
