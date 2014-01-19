<?php
/**
 * /UpMvc/ExceptionHandler.php
 * 
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Hantering av exceptions.
 *
 * Startas i index.php med:
 * <code>$exceptionhandler = new ExceptionHandler();
 * $exceptionhandler->register();</code>
 *
 * Läs mer i manualen om exception handlers här:
 * {@link http://www.php.net/manual/en/function.set-exception-handler.php set_exception_handler()}
 * 
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class ExceptionHandler
{
    /**
     * Hantera exceptions.
     * 
     * @param \Exception $e Exceptionobjekt.
     */
    public function handle(\Exception $e)
    {
        if (ob_get_contents()) {
            ob_clean();
        }
        $output = new Controller\Exception($e);
        echo $output->index($e);
    }

    /** Registrera exceptionhandlern. */
    public function register()
    {
        set_exception_handler(array($this, 'handle'));
    }
}
