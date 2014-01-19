<?php
/**
 * Första anhalten i ramverket.
 * 
 * Hämtar konfiguration och startar upp alla nödvändiga objekt som behövs.
 * Error handlers som möjliggör snyggare och mer funktionsrika felmeddelanden.
 * Autoloader som automatiskt laddar in klasser (include behöver inte användas).
 * Till sist körs routern som delegerar vidare körningen av sidan till
 * rätt Controller/action.
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc;

/** Felhantering av shutdown errors, php-funktioner utan exceptions samt vanliga exceptions. */
require 'vendor/saurid/UpMvc/ShutdownHandler.php';
require 'vendor/saurid/UpMvc/ErrorHandler.php';
require 'vendor/saurid/UpMvc/ExceptionHandler.php';

$shutdownhandler  = new ShutdownHandler();
$errorhandler     = new ErrorHandler();
$exceptionhandler = new ExceptionHandler();

$shutdownhandler->register();
$errorhandler->register();
$exceptionhandler->register();

/** Automatisk laddning av klasser och filer. */
require 'vendor/autoload.php';

/** Starta session. */
session_start();

/** Kör aktuell route från URL. */
Route::execute();
