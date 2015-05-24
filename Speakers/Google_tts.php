<?php

namespace JarvisPHP\Speakers;

//Load TTS config
require 'config/Google_config.php';

/**
 * Wrapper class for using GoogleTTS as tts
 *
 * @author Ugo Raffaele Piemontese
 * @website http://www.ugopiemontese.eu
 */
class Google_tts {
    
    public static function speak($sentence) {
		$date = new \DateTime();
        file_put_contents(_GOOGLE_PATH.'/'.$date->getTimestamp().'_out.mp3', file_get_contents('http://translate.google.com/translate_tts?tl='._LANGUAGE.'&q='.urlencode($sentence)));
		return _GOOGLE_ABSPATH.'/'.$date->getTimestamp().'_out.mp3';
    }
    
}
