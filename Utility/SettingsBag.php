<?php

namespace simpleChat\Utility;

/**
 * Description of SettingsBag
 *
 * @author mlin
 */
class SettingsBag
{
    private $settings = array();
    
    function __construct($settings)
    {
        foreach($settings as $setting)
        {
            $this->settings[$setting->getName()] = (string) $setting;
        }
    }
    
    function __get($property)
    {
        if ( array_key_exists( ($key = strtolower( $property ) ), $this->settings ) )
        {
            return $this->settings[$key];
        }   
    }
}
