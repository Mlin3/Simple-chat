<?php

namespace simpleChat\Utility;

/**
 * Description of Templater
 *
 * @author mlin
 */
class Templater
{
    protected $template;
    protected $extension;
    
    const URL = 2;
    
    
    function __construct($template = '', $extension = '.html')
    {
        $this->extension = $extension;
        
        if ($template !== '')
        {
            $this->load($template);
        }
    }
    
    
    public function load($template)
    {
        $this->template = file_get_contents(VIEWS_PATH . $template . $this->extension);
    }
    
    
    public function attach($key, Templater $child)
    {
        $this->register($key, $child->render());
    }
    
    
    public function attachInline($key, Templater $child)
    {
        $this->register(
                $key,
                str_replace(
                        array('  ', "\t", "\n", "\r"),
                        ' ',
                        $child->render()
                ));
    }
    
    
    public function register($key, $value, $type = 1)
    {
        if($type === 2)
        {
            $value = SITE_DOMAIN . SITE_PATH . $value;
        }
        
        $this->template = preg_replace(
                '/\{\$[ ]*?' . $key . '[ ]*?\}/i',
                $value,
                $this->template
        );
    }
    
    
    public function render()
    {
        return $this->template;
    }
}
