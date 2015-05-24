<?php

namespace JarvisPHP\Core;

/**
 * JarvisResponse
 * the json response of JarvisPHP
 * 
 * @author Ugo Raffaele Piemontese
 */
class JarvisResponse {
    private $answer = '';
	private $audio = '';
    private $choosen_plugin = 'none';
	private $success = false;
    
    public function __construct($answer, $audio, $choosen_plugin='none', $success=false) {
        $this->answer = $answer;
		$this->audio = $audio;
        $this->choosen_plugin = $choosen_plugin;
        $this->success = $success;
    }
    
    public function send() {
        JarvisPHP::$slim->response->headers->set('Content-Type', 'application/json');
        $response = new \stdClass();
        $response->answer = $this->answer;
		$response->audio = $this->audio;
        $response->success = $this->success;
        $response->choosen_plugin = $this->choosen_plugin;
        JarvisPHP::$slim->response->setBody(json_encode($response));
    }
}
