<?php
// launchctl unload -w ~/Library/LaunchAgents/homebrew-php.josegonzalez.php54.plist
// 
require 'config.php';

/**
 * Auto loads the libraries directory
 * @param  string $class the class name
 * @return bool        false if nothing found
 */
function libs_autoload( $class ) {

    $file = 'libs/' . $class . '.php';

    if ( !file_exists( $file ) ) {

        return false;

    }

    require $file;

}

/**
 * Autoloads the models directory
 * @param  string $class The name of the class
 * @return bool        false if nothing found
 */
function models_autoload( $class ) {

    $file = 'models/' . $class . '.php';

    if ( !file_exists( $file ) ) {

        return false;

    }

    require $file;

}

spl_autoload_register('libs_autoload');
spl_autoload_register('models_autoload');

$bootstrap = new Bootstrap();
