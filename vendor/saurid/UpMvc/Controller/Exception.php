<?php
/**
 * /UpMvc/Controller/Exception.php
 * 
 * @package UpMvc2
 */

namespace UpMvc\Controller;

use UpMvc;
use UpMvc\Container as Up;

/**
 * Controller för ramverkets interna felhantering.
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Exception
{
    /**
     * Konstruktor.
     * 
     * @param \Exception $e
     */
    public function index(\Exception $e)
    {
        $trace = $e->getTrace();
        foreach ($trace as $key => $stack) {
            $trace[$key]['args'] = array_map('gettype', $trace[$key]['args']);
        }
        
        echo Up::view()
            ->set('title', 'Up MVC-fel!')
            ->set('exception', $e)
            ->set('router', new UpMvc\RouteResolver())
            ->set('trace', $trace)
            ->render('vendor/saurid/UpMvc/View/exception.php', true);
    }
}
