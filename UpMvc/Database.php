<?php
/**
 * /UpMvc/Database.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Gränssnitt mot databas genom PDO
 *
 * Kombinerar phps standardklasser PDO och PDOStatement så att du kan jobba mot
 * endast ett gränssnitt. Metoderna prepare, execute fetchAll och lastInsertId
 * påminner om de i PDO, men ger här ett något förenklat flöde. PHP-manualen
 * kan ge mer information om det behövs:
 *
 * http://www.php.net/manual/en/pdo.prepare.php
 * http://www.php.net/manual/en/pdostatement.execute.php
 * http://www.php.net/manual/en/pdostatement.fetchall.php
 * http://www.php.net/manual/en/pdo.lastinsertid.php
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.3.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Database
{
    /**
     * @var Lagrar PDO-objekt
     * @access private
     */
    private $pdo;
    
    /**
     * @var resource PDO statement
     * @access private
     */
    private $statement;
    
    /**
     * Konstruktor
     * @param \PDO $pdo PDO-objekt
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * Kör PDO prepare
     * @param string $statement SQL-sats
     */
    public function prepare($statement)
    {
        $this->statement = $this->pdo->prepare($statement);

        return $this;
    }
    
    /**
     * Kör PDOStatement execute
     * @param array $parameters Parametrar
     * @throws \InvalidArgumentException Om argumentet inte är en array
     * @return UpMvc\Database
     */
    public function execute($parameters = array())
    {
        if (!is_array($parameters)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara en array', __METHOD__));
        }
        $this->statement->execute($parameters);

        return $this;
    }
    
    /**
     * Kör PDOStatement fetchAll
     * @param constant $style PDO fetchmetod
     * @throws \InvalidArgumentException Om argumentet inte är en PDO fetch_styles
     * @return array Resultat
     */
    public function fetchAll($style = \PDO::FETCH_BOTH)
    {
        if (!is_integer($style)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett av de i php-manualen beskrivna PDO fetch_styles', __METHOD__));
        }
        
        return $this->statement->fetchAll($style);
    }
    
    /**
     * Kör PDO lastInsertId
     * @return integer Senaste Id från senast körda fråga
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
