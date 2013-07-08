<?php
/**
 * /UpMvc/View.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Hämta mallar och rendrera dem som strängar
 * 
 * Läser in mallar (oftast HTML) och ersätter satta variabler för att returnera
 * en färdig sträng med den struktur du angett i mallen. Används mest i
 * controllers för att skapa ett dokument klart att skickas till webbläsaren.
 * View ger dig möjlighet att kombinera olika mallar för att skapa ett komplett
 * dokument.
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.3.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class View
{
    /**
     * @var array Variabler för användning i vyer (templates)
     * @access private
     */
    private $vars = array();
    
    /**
     * Sätt variabler/värden för att användas i vyer
     *
     * Första argumentet är nyckeln till din variabel som sedan används i 
     * mallarna. Andra argumentet är själva innehållet, vilket kan vara en
     * enkel sträng/siffra, ett array eller varför inte ett helt objekt.
     *
     * @param string $key   Variabelnamn (nyckel)
     * @param mixed  $value Värde
     * @throws \InvalidArgumentException Om $key inte är ett giltigt variabelnamn
     * @return UpMvc\View
     */
    public function set($key, $value)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $key)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett giltigt variabelnamn', __METHOD__));
        }
        $this->vars[$key] = $value;

        return $this;
    }
    
    /**
     * Rendrerar en vy
     *
     * Läser in en fil/mall/template, extraherar satta variabler som satts med
     * set-metoden och ersätter variablerna med sitt respektive innehåll. Det
     * rendrerade innehållet returneras som en sträng.
     *
     * @param string $template Mallnamn
     * @throws \InvalidArgumentException Om argumentet inte är en sträng
     * @throws \DomainException Om vy-filen inte kan hittas
     * @return string Rendrerad vy
     */
    public function render($template)
    {
        if (!is_string($template)) {
            throw new \InvalidArgumentException(sprintf('%s: Argumentet måste vara en giltig sökväg till en mall', __METHOD__));
        }
        if (!is_file($template)) {
            throw new \DomainException(sprintf('%s: Mallen/filen &quot;%s&quot; kunde inte hittas', __METHOD__, $template));
        }
        extract($this->vars);
        ob_start();
        include $template;

        return ob_get_clean();
    }
}
