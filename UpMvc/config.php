<?php
/**
 * Konfiguration av Up MVC's kärna
 *
 * Sätter upp objektberoenden genom closures och lagrar dem i servicecontainern.
 * OBS: Ändra inte om du inte vet vad du gör!
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.10.2
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc;

use Upmvc\Container as Up;

/**
 * Variabler
 */
Up::set('site_path', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'));

/**
 * Closure som returnerar en instans av UpMvc\Database
 */
Up::set('database', function () {
    return new Database(Up::pdo());
});

/**
 * Closure som returnerar en instans av PDO
 */
Up::set('pdo', function () {
    $dsn = sprintf(
        '%s:dbname=%s;host=%s',
        Up::db_engine(),
        Up::db_name(),
        Up::db_host()
    );
    return new \PDO(
        $dsn,
        Up::db_user(),
        Up::db_password(),
        array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
    );
});

/**
 * Closure som returnerar en instans av UpMvc\Request
 */
Up::set('request', function () {
    return new Request();
});

/**
 * Closure som returnerar en instans av UpMvc\View
 */
Up::set('view', function () {
    return new View();
});
