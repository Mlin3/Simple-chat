<?php

namespace simpleChat\Utility;

/**
 * Description of Login
 * Extends class Database with functions needed to login
 *
 * @author mlin
 */
class Login extends Database
{    
    /*
     * Add a new user to database, method first check if chosen name is free.
     * 
     * @param string $login - name of the new user
     * @param string @sessionID - id of new session
     * @param int $time - current Unix timestamp
     * 
     * @return void
     */
    public function addNewUser( $login, $sessionID, $time )
    {
        if( $this->checkIfNameIsFree($login) )
        {    
            $this->query(
                'insert into users values (:sessionID, :login, :time)',
                array(
                    ':sessionID' => $sessionID,
                    ':login' => $login,
                    ':time'=> $time
                )
            );
        }
        else
        {
            throw new \Exception('Login is busy', 405);
        }
    }
    
    /*
     * Check if name is free.
     * 
     * @param string $login - name to check
     * 
     * @return bool
     */
    public function checkIfNameIsFree($login)
    {
        $statement = $this->query(
                'select count(*) from users where userName=:login',
                array(':login' => $login)
            );
        
        if( $statement->fetchColumn() === '0')
            return true;
        else
            return false;
    }
    
    /*
     * Delete user
     * 
     * @param string $sessionID
     * 
     * @return void
     */
    public function deleteUser($sessionID)
    {
        $this->query(
                'delete from users where sessionID=:sessionID',
                array(':sessionID' => $sessionID)
            );
    }
}
