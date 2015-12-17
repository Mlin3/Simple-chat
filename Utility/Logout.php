<?php

namespace simpleChat\Utility;

/**
 * Description of Logout
 * Extends class Session with one method which purpose is, as
 * class name is hinting, to logout a user by destroying his session's vars
 * and by removing coresponding database rows
 *
 * @author mlin
 */
class Logout extends Session
{
    /*
     * @return void
     */
    public function exec()
    {
        $this->db->deleteUser( $this->vars->getSessionID() );
        $this->vars->destroySession();
    }
}
