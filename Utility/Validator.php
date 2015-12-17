<?php

namespace simpleChat\Utility;

/**
 * Description of Validator
 *
 * @author mlin
 */
class Validator
{
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
