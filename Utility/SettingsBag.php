<?php

namespace simpleChat\Utility;

/**
 * Description of SettingsBag
 * 
 * Provide easy access for settings
 *
 * @author mlin
 */
class SettingsBag
{
    /*
     * @type array
     * 
     * Stores settings in key => value format
     */
    private $settings = array();
    
    
    /*
     * Convert array of of SimpleXMLElement objects to array of strings values
     */
    public function __construct($settings)
    {
        foreach($settings as $setting)
        {
            $this->settings[$setting->getName()] = (string) $setting;
        }
    }
    
    /*
     * Provide access for strored values as fields of object
     * 
     * @return string
     */
    public function __get($property)
    {
        if ( array_key_exists( ($key = strtolower( $property ) ), $this->settings ) )
        {
            return $this->settings[$key];
        }   
    }
}
