<?php
/**
 * /UpMvc/Form/Same.php
 * 
 * @package UpMvc2\Form
 */

namespace UpMvc\Form;

use UpMvc;
use UpMvc\Container as Up;

/**
 * Basklass till formulärfält.
 * 
 * Innehåller alla funktioner som behövs för skapandet av varje del av det
 * kompletta formulärfältet, tillsammans med de enskilda fältobjekten.
 * 
 * @package UpMvc2\Form
 * @author  Ola Waljefors
 * @version 2013.10.2
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
abstract class Base
{
    /** @type string Namn på formulärfält. */
    protected $name;
    
    /** @type string Formulärfältets rubrik. */
    protected $label;
    
    /** @type array Parametrar för radio, bockar och väljlistor. */
    protected $parameters;
    
    /** @type object UpMvc\View-objekt. */
    protected $view;
    
    /** @type string Errorsträng. */
    protected $error;
    
    /** @type object UpMvc\Request-objekt. */
    protected $request;
    
    /** @type array Valideringsregler. */
    protected $rules;
    
    /**
     * Konstruktor.
     * 
     * @param string $name       Namn på formulärfält.
     * @param string $label      Formulärfältets rubrik.
     * @param array  $parameters Parametrar för radio, bockar och väljlistor.
     * 
     * @throws \InvalidArgumentException Om $name inte är ett giltigt variabelnamn.
     * @throws \InvalidArgumentException Om $label inte är en sträng.
     * @todo Typkontrollera tredje argumentet.
     */
    public function __construct($name, $label, $parameters = null)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $name)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett giltigt variabelnamn', __METHOD__));
        }
        if (!is_string($label)) {
            throw new \InvalidArgumentException(sprintf('%s: Andra argumentet måste vara en textsträng som beskriver formulärfältet', __METHOD__));
        }
        $this->name       = $name;
        $this->label      = $label;
        $this->parameters = $parameters;
    }
    
    /** Rendrera formulärfält. */
    abstract public function render();
    
    /**
     * Sätt valideringsregler för fältet.
     * 
     * @param UpMvc\Permission\Role $rule Valideringsobjekt.
     * 
     * @throws \InvalidArgumentException Om $rule inte är UpMvc\Validation\Base-objekt.
     * @return UpMvc\Form\Base
     */
    public function setRule($rule)
    {
        if (!$rule instanceof UpMvc\Validation\Base) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett objekt av typen UpMvc\Validation\Base', __METHOD__));
        }
        $this->rules[] = $rule;

        return $this;
    }
    
    /**
     * Validerar fältet?
     * 
     * @return boolean true
     */
    public function isValid()
    {
        foreach ($this->rules as $rule) {
            if ($rule->validate(Up::request()->get($this->getName())) === false) {
                return false;
            }
        }

        return true;
    }
    
    /**
     * Sätt felmeddelande för fältet.
     * 
     * @param string $error Felmeddelande.
     * 
     * @throws \InvalidArgumentException Om argumentet inte är en sträng.
     * @return UpMvc\Form\Base
     */
    public function setError($error)
    {
        if (!is_string($error)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara en textsträng som beskriver en felaktig/otillåten inmatning', __METHOD__));
        }
        $this->error = $error;
        
        return $this;
    }
    
    /**
     * Hämta ev felmeddelande för fältet, om formuläret är skickat.
     * 
     * @param string $html Sträng med placeholder %s för felmeddelande.
     * 
     * @todo Typkontrollera argumentet och se till att den har ett %s.
     * @return string Felmeddelande.
     */
    public function getError($html = '%s')
    {
        if (Up::request()->get('submit')) {
            if ($this->rules) {
                if (!$this->isValid()) {
                    if ($this->error) {
                        return sprintf($html, $this->error);
                    }
                }
            }
        }
    }
    
    /**
     * Hämta requestvariabel.
     * 
     * @param string $name Namn på fält.
     * 
     * @return string Variabel
     */
    public function getRequest($name)
    {
        return Up::request()->get($name);
    }
    
    /**
     * Hämta fältets namn.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Hämta fältets rubrik.
     * 
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * Hämta fältets parametrar.
     * 
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
