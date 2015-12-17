<?php

namespace simpleChat\Controllers;

use simpleChat\Utility\JsTemplater;
use simpleChat\Utility\Messenger;
use simpleChat\Utility;
use simpleChat\Utility\Templater;

/**
 * Description of JsController
 *
 * @author mlin
 */
class JsController extends ChatController
{
    public function start()
    {
        $templater = new JsTemplater('main');
        
        $templater->register('BASE_URL', Utility\SITE_DOMAIN . Utility\SITE_PATH . 'web/index.php/');
        
        $templater->attachInline('ChatTemplate', new Templater('chat'));
        
        $templater->attachInline('LoginTemplate', new Templater('login'));

        Messenger::send($templater->render(), 'js');
    }
}
