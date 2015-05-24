<?php

namespace JarvisPHP\Speakers;

//Load TTS config
require 'config/Espeak_config.php';

/**
 * Wrapper class for using espeak as tts
 *
 * @author Ugo Raffaele Piemontese
 * @website http://www.ugopiemontese.eu
 */
class Espeak_tts {
    
    public static function speak($sentence) {
		$date = new \DateTime();
        exec('/usr/bin/espeak -w '._ESPEAK_PATH.'/'.$date->getTimestamp().'_out.wav -v'._ESPEAK_LANGUAGE.'+'._ESPEAK_VOICE.' "'.$sentence.'"');
		return _ESPEAK_ABSPATH.'/'.$date->getTimestamp().'_out.wav';
    }
    
}
