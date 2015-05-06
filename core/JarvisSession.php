<?php

class JarvisSession {
    
    static function start() {
        session_start();
    }
    
    static function setActivePlugin($pluginName) {
        $_SESSION['active_plugin'] = $pluginName;
    }
    
    static function getActivePlugin() {
        return $_SESSION['active_plugin'];
    }
    
    static function sessionInProgress() {
        return !empty($_SESSION['active_plugin']);
    }
    
    static function terminate() {
        unset($_SESSION['active_plugin']);
    }
    
    static function set($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    static function get($name) {
        return $_SESSION[$name];
    }
}