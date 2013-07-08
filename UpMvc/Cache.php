<?php
/**
 * /UpMvc/Cache.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Lagra och hämta cachad data i filsystemet
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.3.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Cache
{
    /**
     * @var string Cachemapp
     * @access private
     */
    private $path;

    /**
     * @var string Cache-id
     * @access private
     */
    private $key;

    /**
     * @var string Filnamn för cachefil
     * @access private
     */
    private $file;

    /**
     * Konstruktor
     *
     * @param string $key  Cache-id
     * @param string $path Cachemapp
     * @throws \InvalidArgumentException Om $key inte är en sträng
     * @throws \InvalidArgumentException Om $path inte är en sträng
     */
    public function __construct($key = null, $path = 'Cache')
    {
        // Om ingen nyckel är satt, skapas en unik nyckel från URL
        if (!$key) {
            $key = md5(
                $_SERVER['SERVER_PROTOCOL'] .
                $_SERVER['REQUEST_METHOD'] .
                $_SERVER['HTTP_HOST'] .
                $_SERVER['REQUEST_URI']
            );
        }

        if (!is_string($key)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet (Cache-id) måste vara en sträng', __METHOD__));
        }

        if (!is_string($path)) {
            throw new \InvalidArgumentException(sprintf('%s: Andra argumentet (Cachemapp) måste vara en sträng', __METHOD__));
        }

        // Skapa cachemapp om den inte redan finns
        if (!is_dir($path)) {
            mkdir($path, 0755);
        }

        $this->path = $path;
        $this->key  = $key;
        $this->file = $this->path . DIRECTORY_SEPARATOR . $this->key;
    }

    /**
     * Hämta cachad data om den finns lagrad
     * 
     * Standard lagringstid är en timme (3600 sekunder). Returnerar sträng med
     * data om den finns och är aktuell, annars false. Detta gör att du kan
     * spara i en variabel samtidigt som du gör kontrollen.
     * Exempel:
     * <code>if ($data = $cache->get()) {
     *     echo $data;
     * }</code>
     * @param integer $expiration Lagringstid i sekunder
     * @throws \InvalidArgumentException Om $expiration inte är ett heltal
     * @return string|boolean Data eller false
     */
    public function get($expiration = 3600)
    {
        if (!is_integer($expiration)) {
            throw new \InvalidArgumentException(sprintf('%s: Argumentet (antal sekunder) måste vara ett heltal', __METHOD__));
        }

        if (file_exists($this->file) AND filemtime($this->file) > time() - $expiration) {
            return file_get_contents($this->file);
        }

        return false;
    }

    /**
     * Lagra data i cachefil
     *
     * Returnerar samma data för att kunna skriva ut samtidigt som lagringen.
     * Exempel:
     * <code>echo $cache->set($data);</code>
     *
     * @param string $data Data som ska lagras
     * @throws \InvalidArgumentException Om $data inte är en sträng
     * @return string Data
     */
    public function set($data)
    {
        if (!is_string($data)) {
            throw new \InvalidArgumentException(sprintf('%s: Argumentet måste vara en sträng', __METHOD__));
        }
        file_put_contents($this->file, $data);

        return $data;
    }
}
