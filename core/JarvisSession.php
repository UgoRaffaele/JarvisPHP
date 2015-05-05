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
}