<?php

namespace simpleChat\Utility;

/**
 * Description of Templater
 *
 * Load required template and render it
 * 
 * @author mlin
 */
class Templater
{
    /*
     * @type string
     * 
     * Stores template code
     */
    protected $template;
    
    /*
     * @type string
     * 
     * Extension of file to load
     */
    protected $extension;
    
    /*
     * @type int
     */
    const URL = 2;
    
    
    /*
     * Set extenstion and load template if specified
     */
    public function __construct($template = '', $extension = '.html')
    {
        $this->extension = $extension;
        
        if ($template !== '')
        {
            $this->load($template);
        }
    }
    
    
    /*
     * Load specified file
     * 
     * @param string $template
     * 
     * @return void
     */
    public function load($template)
    {
        $this->template = file_get_contents(VIEWS_PATH . $template . $this->extension);
    }
    
    
    /*
     * Attach another instance of Templater class in place of $key
     * 
     * @param string $key
     * @param Templater $child
     * 
     * @return void
     */
    public function attach($key, Templater $child)
    {
        $this->register($key, $child->render());
    }
    
    
    /*
     * Attach another instance of Templater class in place of key and convert
     * its code to one line
     * 
     * @param string $key
     * @param Templater $child
     * 
     * @return void
     */
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
    
    
    /*
     * Put value in place of key
     * 
     * @param string $key
     * @param string $value
     * @param int $type
     * 
     * @return void
     */
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
    
    
    /*
     * Return html code of template
     * 
     * @return string
     */
    public function render()
    {
        return $this->template;
    }
}
