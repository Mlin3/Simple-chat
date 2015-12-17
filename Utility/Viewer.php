<?php

namespace simpleChat\Utility;

/**
 * Description of Viewer
 * 
 * Print html output
 *
 * @author mlin
 */
class Viewer
{
    /*
     * Print login form
     * 
     * @return void
     */
    public function displayFormLogin()
    {
        $this->loadTemplate('login');
    }
    
    /*
     * Print html code for chat
     * 
     * @return void
     */
    public function displayChat()
    {
        $this->loadTemplate('chat');
    }
    
    /*
     * Load and print specified template
     * 
     * @param string $template
     * 
     * @return void
     */
    protected function loadTemplate($template)
    {
        $main = new Templater('main');
        
        $body = new Templater($template);
        
        $main->attach('Body', $body);
        
        $main->register('JSPath', 'web/index.php/js/', Templater::URL);
        $main->register('CSSPath', 'web/css/main.css', Templater::URL);
        
        Messenger::send($main->render());
    }
}
