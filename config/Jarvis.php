<?php
/**
 * Jarvis configuration file
 */

//Set locale
define('_LANGUAGE', 'en');

//Set path
define('_PATH', $_SERVER["DOCUMENT_ROOT"].'/JarvisPHP/replies');

//Set absolute path
define('_ABSPATH', '/JarvisPHP/replies');

//Command session timeout, in seconds
define('_COMMAND_SESSION_TIMEOUT', 30);

//Select TTS class
define('_JARVIS_TTS', 'Espeak_tts');

//Define system's name
define('_SYSTEM_NAME', 'JarvisPhp');