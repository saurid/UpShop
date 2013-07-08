<?php
/**
 * /UpMvc/Autoload.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Automatisk inladdning av klasser för att inte behöva använda include/require
 *
 * Underscore-tecken "_" i klassnamn konverteras till snedstreck för att hämta
 * klasser från filsystemet. Kan även hantera klasser som använder namespaces i
 * php>5.3. Startas i index.php med:
 * <code>$autoloader = new UpMvc\Autoload();
 * $autoloader->register();</code>
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Autoload
{
    /**
     * Automatiskt laddning av klasser enligt PSR-0 Final Proposal (PHP
     * Standards Working Group). Läs mer på:
     * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
     * 
     * @param string $className Klassnamn
     */
    public function load($className)
    {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        $DS = DIRECTORY_SEPARATOR;

        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', $DS, $namespace) . $DS;
        }
        $fileName .= str_replace('_', $DS, $className) . '.php';
        
        if (file_exists($fileName)) {
            require_once $fileName;
        }
    }

    /**
     * Starta/Registrera autoloadern
     */
    public function register()
    {
        spl_autoload_register(array($this, 'load'));
    }
}
