<?php

namespace simpleChat\Utility;

use Exception;

/**
 * Description of SessionLogin
 *
 * @author mlin
 */
class SessionLogin extends Session
{
    public function login()
    {
        $request = new Request();
        
        if( !$this->isLogged() )
        {
            if( Validator::login( $request->input('login') ) )
            {
                $this->vars->setSession( $request->input('login') );
                
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
