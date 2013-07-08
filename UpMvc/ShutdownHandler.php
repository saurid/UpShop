<?php
/**
 * /UpMvc/ExceptionHandler.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Hantering av PHP shutdown errors
 *
 * Startas i index.php med:
 * <code>$shutdownhandler = new ShutdownHandler();
 * $shutdownhandler->register();</code>
 *
 * Läs mer i manualen om
 * {@link http://www.php.net/manual/en/function.register-shutdown-function.php register_shutdown_function()}
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.9
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class ShutdownHandler
{
    /**
     * Hantera shutdown errors
     */
    public function handle()
    {
        $error = error_get_last();

        if ($error !== null) {
            if ($error['type'] === E_ERROR) {
                ob_clean();
                require('View/shutdown.php');
            }
        }
    }

    /**
     * Starta/Registrera shutdown error handlern
     */
    public function register()
    {
        register_shutdown_function(array($this, 'handle'));
    }
}
