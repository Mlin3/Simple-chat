<?php

namespace simpleChat\Utility;

use PDO;


/**
 * Description of SessionDB
 * Abstract class for database related stuff.
 *
 * @author mlin
 */
abstract class Database
{
    /*
     * @type PDO
     * Stores PDO instance in static variable so it will
     * be avaible for all instances of this and child classes
     */
    protected static $handle = null;
    
    /*
     * If there is no connection, create one
     */
    final public function __construct()
    {
        if( self::$handle === null)
        {
            $this->connect();
        }
    }
    
    /*
     * If there is no active connection to database, create one and store it in
     * static variable so it'll be available for another instances.
     * 
     * @return void
     */
    final public function connect()
    { 
        $settings = Settings::read('database');
            
        try
        {
            self::$handle = new PDO(
                'mysql:host=' . $settings->host .
                ';dbname=' . $settings->dbname .
                ';port=' . $settings->port ,
                $settings->user,
                $settings->password,
                array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )
            );
            
            $this->cleanUp();
            
        } catch (Exception $ex)
        {
            throw new \Exception('Can\'t connect to database.');
        }
    }  
    
    /*
     * Invoke query to database
     * 
     * @param string $query - sql statement
     * @param array $args - argument for the query, it's expecting key => value
     * or key => array(value, type_of_value) format, type_of_value is PDO
     * constants for specific type of value.
     * 
     * @return PDOStatement
     */
    protected function query($query, $args = '')
    {
        $statement = self::$handle->prepare($query);
        
        if( $args !== '')
        {
            foreach($args as $key => $arg)
            {
                if( is_array($arg) )
                {
                    $statement->bindValue($key, $arg[0], $arg[1]);
                }
                else
                {
                    $statement->bindValue($key, $arg);
                }
            }
        }
        
        $statement->execute();
        
        return $statement;
    }
    
    
    /*
     * Delete all inactive users
     * 
     * @return void
     */
    protected function cleanUp()
    {
        $this->query(
                'delete from users where time < :time',
                array( ':time' => ( time() - 120 ) )
            );
    }
}
