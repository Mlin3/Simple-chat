<?php

namespace simpleChat\Utility;

/**
 * Description of Viewer
 *
 * @author mlin
 */
class Viewer
{
    public function displayFormLogin()
    {
        $this->loadTemplate('login');
    }
    
    public function displayChat()
    {
        $this->loadTemplate('chat');
    }
    
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
