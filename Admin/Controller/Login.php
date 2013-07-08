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

class Login extends Base
{
    /**
     * Visa loginsida
     */
    public function index()
    {
        echo $this->c->view
            ->set('user',    $this->c->user_model)
            ->set('request', $this->c->request)
            ->set('error',   $this->c->error)
            ->set('title',   'Admin login')
            ->set('content', $this->c->view->render('Admin/View/login.php'))
            ->render('Admin/View/layout.php');
    }
    
    /**
     * Logga in
     */
    public function login()
    {
        $this->c->user_model->login(
            $this->c->request->get('email'),
            $this->c->request->get('password')
        );

        if ($this->c->user_model->isIn()) {
            header('Location: ' . $this->c->site_path . '/Admin/Item');
            exit;
        }
        else {
            $this->c->error->set('login', 'Användare eller lösenord är felaktigt');
            $this->index();
        }
    }
    
    /**
     * Logga ut
     */
    public function logout()
    {
        $this->c->user_model->logout();
        header('Location: ' . $this->c->site_path . '/Admin/Login');
        exit;
    }
}
