<?php

namespace simpleChat\Utility;

/**
 * Description of SessionData
 * 
 * Extends Database class with method to update
 * session time
 * 
 * @author mlin
 */
class SessionData extends Database
{
    /*
     * @param string $sessionID
     * @param int $sessionTime
     * 
     * @throws Exception
     * @return void
     */
    public function updateTime($sessionID, $sessionTime)
    {
        $statement = $this->query(
                'update users set time=:time where sessionID=:sessionID',
                array(
                    ':time' => $sessionTime,
                    ':sessionID' => $sessionID
                )
            );
        
        
        if($statement->rowCount() !== 1)
            throw new \Exception();
    }
}
