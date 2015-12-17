<?php

namespace simpleChat\Utility;
use PDO;

/**
 * Description of ChatData
 * 
 * Retrieve list of logged users and new messages. If new message was sent,
 * it is written to database.
 * 
 * @author mlin
 */
class ChatData extends Database
{
    /*
     * Get new messages which id is higher than one stored in session variable and
     * time at which they was added is higher than time of login.
     * 
     * @return array
     */
    public function getMessages()
    {
        $session = new \simpleChat\Utility\Session();
        
        $statement = $this->query(
            'select messageID, userName, content, time from messages where messageID > :messageID and time > :time order by time',
                    
                    array(
                        ':messageID' => $session->getLastMessageID(),
                        ':time' => $session->getLoginTime()
                    )
                );
        
        return $statement->fetchAll(PDO::FETCH_NUM);
    }
    
    
    /*
     * Return array of logged users.
     * 
     * @return array
     */
    public function getUsers()
    {
        if( $this->wasChanged('users') )
        {
            $statement = $this->query('select userName from users order by userName');
        
            $users = array();

            foreach($statement->fetchAll(PDO::FETCH_NUM) as $user)
            {
                $users[] = $user[0];
            }

            return $users;
        }
        
        
        return 'not changed';
    }
    
    
    /*
     * Add new message to database
     * 
     * @param string $name
     * @param string $message
     * 
     * @return void
     */
    public function addMessage($name, $message)
    {
        $this->query(
                'insert into messages (userName, content, time) values (:name, :message, :time)',
                array(
                    ':name' => $name,
                    ':message' => $message,
                    ':time' => time()
                ));
    }
    
    
    /*
     * Do nothing important right now
     */
    protected function wasChanged($key)
    {
        return true;
        
        /*$session = new Session();
        $db = new FileDB($key);
        
        if($session->getLastTime($key) < $db->getAsFloat())
            return true;
        else
            return false;*/
    }
}
