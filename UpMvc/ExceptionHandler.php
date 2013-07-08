<?php
/**
 * /UpMvc/ExceptionHandler.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Hantering av exceptions
 *
 * Startas i index.php med:
 * <code>$exceptionhandler = new ExceptionHandler();
 * $exceptionhandler->register();</code>
 *
 * Läs mer i manualen om
 * {@link http://www.php.net/manual/en/function.set-exception-handler.php set_exception_handler()}
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.9
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class ExceptionHandler
{
    /**
     * Hantera exceptions
     * @param \Exception $e
     */
    public function handle(\Exception $e)
    {
        ob_clean();
        $output = new Controller\Exception($e);
        echo $output->index($e);
    }

    /**
     * Starta/Registrera exceptionhandlern
     */
    public function register()
    {
        set_exception_handler(array($this, 'handle'));
    }
}
