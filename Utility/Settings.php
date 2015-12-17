<?php

namespace simpleChat\Utility;

/**
 * Description of Settings
 *
 * Load settings stored in xml file
 * 
 * @author mlin
 */
class Settings
{
    /*
     * @type SimpleXMLElement
     * 
     * Stores SimpleXMLElement instance.
     */
    private $xml;
    
    
    /*
     * Read settings for specified key from xml file
     * and return SettingsBag object storing this settings
     * 
     * @param string $key
     * 
     * @return SettingsBag
     */
    static function read($key)
    {
        $settings = new self();
        
        $settings->loadSettings(VAR_PATH . 'settings.xml');
        
        return new SettingsBag($settings->getArray($key));
    }
    
    
    /*
     * Load xml file
     * 
     * @throws Exception
     * @return void
     */
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
    
    
    /*
     * Get settings as array of SimpleXMLElement objects
     * 
     * @param string $key
     * 
     * @return array
     */
    public function getArray($key)
    {
        return $this->xml->xpath('/settings/'.$key)[0];
    }
}
