<?php

namespace simpleChat\Utility;

/**
 * Description of Validator
 *
 * Check if input match pattern
 * 
 * @author mlin
 */
class Validator
{
    /*
     * Check if login name match required pattern
     * 
     * @param string $login
     * 
     * @return bool
     */
    static public function login($login)
    {
        if( preg_match('/^[a-z0-9_\-\(\)]{2,25}$/i', $login) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
