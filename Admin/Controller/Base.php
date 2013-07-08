<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace Admin\Controller;

use UpMvc;
use App\Model as Model;

class Base
{
    /**
     * Servicecontainer-objekt
     * @access protected
     */
    protected $c;
    
    /**
     * Sätt upp gemensamma objekt och variabler
     */
    public function __construct()
    {
        $this->c = UpMvc\Container::get();
        
        $this->c->view
            ->set('user',    $this->c->user_model)
            ->set('request', $this->c->request)
            ->set('error',   $this->c->error);
    }
}
