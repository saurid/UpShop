<?php
/**
 * /UpMvc/Controller/Exception.php
 * @package UpMvc2
 */

namespace UpMvc\Controller;

use UpMvc;

/**
 * Controller för ramverkets interna felhantering
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.8
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Exception
{
    /**
     * Konstruktor
     * @param \Exception $e
     */
    public function index(\Exception $e)
    {
        $c = UpMvc\Container::get();

        $trace = $e->getTrace();
        foreach ($trace as $key => $stack) {
            $trace[$key]['args'] = array_map('gettype', $trace[$key]['args']);
        }
        echo $c->view
            ->set('title', 'Up MVC-fel!')
            ->set('exception', $e)
            ->set('router', new UpMvc\RouteResolver())
            ->set('trace', $trace)
            ->render('UpMvc/View/exception.php');
    }
}