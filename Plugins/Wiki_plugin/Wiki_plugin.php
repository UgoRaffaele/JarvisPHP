<?php

namespace JarvisPHP\Plugins\Wiki_plugin;

use JarvisPHP\Core\JarvisSession;
use JarvisPHP\Core\JarvisPHP;
use JarvisPHP\Core\JarvisLanguage;
use JarvisPHP\Core\JarvisTTS;

/**
 * A simple Wiki plugin
 * @author Ugo Raffaele Piemontese
 * @website http://www.ugopiemontese.eu
 */
class Wiki_plugin implements \JarvisPHP\Core\JarvisPluginInterface{
    /**
     * Priority of plugin
     * @var int  
     */
    var $priority = 4;
    
    /**
     * the behaviour of plugin
     * @param string $command
     */
    function answer($command) {
        $answer = '';
        if (JarvisSession::get('echo_not_first_passage')) {
			$wiki_query_url = _WIKI_URL . "?action=opensearch&search=" . urlencode($command) . "&namespace=0&format=xml&limit=1";
			// Make call with cURL
			$session = curl_init($wiki_query_url);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($session);
			// Convert XML to PHP object
			$xml = simplexml_load_string($result);
			if (strlen($xml->Section->Item->Description) > 0) {
				$answer = sprintf(JarvisLanguage::translate('search_result_is',get_called_class()), $xml->Section->Item->Description);
			} else {
				$answer = JarvisLanguage::translate('nothing_found',get_called_class());
			}
        } else {
            JarvisSession::set('echo_not_first_passage',true);
            JarvisPHP::getLogger()->debug('Answering to command: "'.$command.'"');
            $answer = JarvisLanguage::translate('let_me_search',get_called_class());
        }
        $response = new \JarvisPHP\Core\JarvisResponse($answer, JarvisTTS::speak($answer), JarvisPHP::getRealClassName(get_called_class()), true);
        $response->send();
    }
    
    /**
     * Get plugin's priority
     * @return int
     */
    function getPriority() {
        return $this->priority;
    }
    
    /**
     * Is it the right plugin for the command?
     * @param string $command
     * @return boolean
     */
    function isLikely($command) {
        return preg_match(JarvisLanguage::translate('preg_match_activate_plugin',get_called_class()), $command);
    }
    
    /**
     * Does the plugin need a session?
     * @return boolean
     */
    function hasSession() {
        return true;
    }
}
