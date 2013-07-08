<?php
/**
 * Första anhalten i ramverket
 * 
 * Hämtar konfiguration och startar upp alla nödvändiga objekt som behövs.
 * Autoloader som automatiskt laddar in klasser (include behöver inte användas).
 * Error handler som möjliggör snyggare och mer funktionsrika felmeddelanden.
 * Till sist körs routern som delegerar vidare körningen av sidan till
 * rätt Controller/action.
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.4.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc;

/**
 * Starta automatisk laddning av klasser
 */
require 'UpMvc/Autoload.php';
$autoloader = new Autoload();
$autoloader->register();

/**
 * Ladda intern konfiguration
 */
require 'UpMvc/config.php';

/**
 * Starta hantering av shutdown errors (php Fatal errors),
 * php-funktioner utan exceptions samt vanliga exceptions
 */
$shutdownhandler = new ShutdownHandler();
$shutdownhandler->register();
$errorhandler = new ErrorHandler();
$errorhandler->register();
$exceptionhandler = new ExceptionHandler();
$exceptionhandler->register();

/**
 * Ladda Applikationens konfiguration och starta session
 */
require 'App/config.php';
session_start();

/**
 * Kör aktuell route från URL
 */
Route::execute();
