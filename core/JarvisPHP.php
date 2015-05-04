<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class JarvisPHP {
    
    static $rules = array();
    
    static function initialize() {
        //Autoloading classes
        spl_autoload_register(function($className)
        {
            $namespace=str_replace("\\","/",__NAMESPACE__);
            $className=str_replace("\\","/",$className);
            $class="/plugins/".(empty($namespace) ? "" : $namespace."/")."{$className}.php";
            include_once($class);
        });
        
        //Session
        session_start();
    }
    
    static function enablePlugin($plugin) {
        $pluginToEnable = new $plugin;
        //Load rules for the plugin
        $pluginRules = $pluginToEnable->loadRules();
        //Insert in global list of rules
        foreach($pluginRules as $rule) {
            array_push(JarvisPHP::$rules, array($plugin, $rule));
        }
        //Clear variables
        unset($pluginRules);
        unset($pluginToEnable);
    }
    
    /**
     * Parse the command and execute the plugin
     * @param string $command
     */
    static function elaborateCommand($command) {
        //Verify if there is an active plugin
        if(!empty($_SESSION['active_plugin'])) {
            $plugin_class = $_SESSION['active_plugin'];
            $plugin = new $plugin_class();
            $plugin->answer($command);
        }
        else {
            //TODO ntltools parsing
            $trainingSet = new NlpTools\Documents\TrainingSet(); // will hold the training documents
            $tokenizer = new NlpTools\Tokenizers\WhitespaceTokenizer(); // will split into tokens
            $ff = new NlpTools\FeatureFactories\DataAsFeatures(); // see features in documentation
        }
    }

    
} //JarvisPHP