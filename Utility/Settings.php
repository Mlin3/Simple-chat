<?php

namespace simpleChat\Utility;

/**
 * Description of Settings
 *
 * @author mlin
 */
class Settings
{
    private $xml;
    
    static function read($key)
    {
        $settings = new self();
        
        $settings->loadSettings(VAR_PATH . 'settings.xml');
        
        return new SettingsBag($settings->getArray($key));
    }
    
    public function loadSettings($path)
    {
        if(file_exists($path))
        {
            $this->xml = new \SimpleXMLElement($path, 0, true);
        }
        else
        {
            throw new \Exception('Error');
        }
    }
    
    public function getArray($key)
    {
        return $this->xml->xpath('/settings/'.$key)[0];
    }
}
