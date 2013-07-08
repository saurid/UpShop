<?php
/**
 * /UpMvc/Route.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Kör en given route
 * 
 * Använder RouteResolver för att tolka en route-sträng och
 * instansierar och kör sedan rätt controller/action.
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.3.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Route
{
    /**
     * Kör controller och action
     *
     * Låter RouteResolver-objektet göra sitt jobb och skapar sedan en instans
     * av vald controller och kör dess action/metod.
     *
     * @param string $route Route
     * @throws \BadMethodCallException Om controllern inte finns
     * @throws \BadMethodCallException Om action-metod inte finns
     */
    public static function execute($route = null)
    {
        // Skapa Route Resolver
        $route = new RouteResolver($route);
        
        // Kontrollera att controller finns
        if (!class_exists($route->getClass(), true)) {
            throw new \BadMethodCallException(sprintf('%s: Controllern &quot;%s&quot; finns inte, eller kan inte anropas', __METHOD__, $route->getClass()));
        }
        
        // Skapa controllerobjekt
        $classname  = $route->getClass();
        $controller = new $classname();
        
        // Kontrollera att action går att kalla
        if (!method_exists($controller, $route->getAction())) {
            throw new \BadMethodCallException(sprintf('%s: Action &quot;%s&quot; finns inte, eller kan inte anropas', __METHOD__, $route->getAction()));
        }
        
        // Kör vald controller/action med ev. parametrar som argument
        call_user_func_array(
            array($controller, $route->getAction()),
            $route->getParameters()
        );
    }
}
