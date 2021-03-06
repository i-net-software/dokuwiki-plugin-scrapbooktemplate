<?php
/**
 * DokuWiki Plugin scrapbooktemplate (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  i-net software / Gerry Weißbach <tool@inetsoftware.de>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class action_plugin_scrapbooktemplate_replaceraw extends DokuWiki_Action_Plugin {

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(Doku_Event_Handler $controller) {

       $controller->register_hook('ACTION_EXPORT_POSTPROCESS', 'BEFORE', $this, 'handle_action_export_postprocess');
    }

    /**
     * [Custom event handler which performs action]
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     * @return void
     */

    public function handle_action_export_postprocess(Doku_Event &$event, $param) {
        
        if ( $event->data['mode'] != 'raw' || empty( $_REQUEST['scrapbookinsert'] ) ) { return; }
        
        $pageData = array(
            'tpl' => $event->data['output'],
            'id' => cleanId($_REQUEST['scrapbookinsert'])
        );
        $event->data['output'] = parsePageTemplate($pageData);
    }
}

// vim:ts=4:sw=4:et:
