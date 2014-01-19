<?php
/**
 * /UpMvc/ErrorHandler.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Felhantering.
 *
 * Felhantering av PHP-funktioner som normalt inte har exceptions. Konverterar
 * vanliga felmeddelanden till exceptions där det är möjligt.
 *
 * Startas i index.php med:
 * <code>$errornhandler = new ErrorHandler();
 * $errorhandler->register();</code>
 *
 * Läs mer i manualen om
 * {@link http://php.net/manual/en/function.set-error-handler.php set_error_handler()}
 * 
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2013.2.9
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class ErrorHandler
{
    /**
     * Kör PHP's interna felhantering som exceptions.
     * 
     * @param integer $errno   Nummer på fel.
     * @param string  $errstr  Felmeddelande.
     * @param string  $errfile Fil där felet uppstod.
     * @param integer $errline Rad där felet uppstod.
     * 
     * @return boolean true
     */
    public function handle($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            return;
        }
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);

        return true;
    }

    /** Starta/Registrera errorhandlern */
    public function register()
    {
        set_error_handler(array($this, 'handle'));
    }
}
