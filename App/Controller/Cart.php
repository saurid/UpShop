<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

namespace App\Controller;

use UpMvc;
use UpMvc\Container as Up;

class Cart
{
    private $categories;

    public function __construct()
    {
        $this->categories = Up::category()->getAll();
    }

    /**
     * Visa varukorgen
     */
    public function show()
    {
        echo Up::view()
            ->set('title',         'Varukorg')
            ->set('cart',          Up::cart())
            ->set('categories',    $this->categories)
            ->set('categorycount', count($this->categories))
            ->set('error',         Up::error())
            ->set('order',         Up::order())
            ->set('request',       Up::request())
            ->set('shipping',      Up::shipping())
            ->set('user',          Up::user())
            ->set('content',       Up::view()->render('App/View/cart.php'))
            ->render('App/View/layout.php');
    }
    
    /**
     * Skicka ordermail till kund och admin
     */
    public function order()
    {
        Up::view()
            ->set('title',         'Varukorg')
            ->set('cart',          Up::cart())
            ->set('categories',    $this->categories)
            ->set('categorycount', count($this->categories))
            ->set('error',         Up::error())
            ->set('order',         Up::order())
            ->set('request',       Up::request())
            ->set('shipping',      Up::shipping())
            ->set('user',          Up::user());
        
        if (isset($_POST['submit'])) {

            if (!isValidEmail(Up::request()->get('email'))) {
                Up::error()->set('email', 'E-postadressen verkar inte vara giltig!');
            }
            if (!isLength(Up::request()->get('contact'), 20)) {
                Up::error()->set('contact', 'Du måste ange ditt namn och postadress!');
            }
            if (!isPhoneNo(Up::request()->get('phone'))) {
                Up::error()->set('phone', 'Du måste skriva in ett telefonnummer!');
            }
            if (Up::error()->getCount() == 0) {
                Up::order()->setNumber();
                
                Up::view()
                    ->set('contact', Up::request()->get('contact'))
                    ->set('email',   Up::request()->get('email'))
                    ->set('phone',   Up::request()->get('phone'))
                    ->set('content', Up::view()->render('App/View/order.php'));

                // Kundmail
                $headers =
                    'MIME-Version: 1.0' . "\r\n" .
                    'Content-type: text/html; charset=utf-8' . "\r\n" .
                    'From: ' . Up::site_email() . "\r\n" .
                    'Reply-To: ' . Up::site_email() . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $subject = 'Orderbekräftelse från ' . Up::site_name();
                $message = Up::view()->render('App/View/order_user.php');
                $errors  = false;
                
                if (!mail(Up::request()->get('email'), $subject, $message, $headers)) {
                    echo '<p>Fel: Gick ej att skicka mail till kunden.</p>';
                    $errors = true;
                }
                
                // Administratörsmail
                if (!$errors) {
                    $to      = Up::site_email();
                    $subject = 'Order från ' . Up::site_name();
                    $message = Up::view()->render('App/View/order_admin.php');

                    if (!mail($to, $subject, $message, $headers)) {
                        echo '<p>Gick ej att skicka mail till administratören.</p>';
                        $errors = true;
                    }
                }
                
                // Order genomförd
                Up::cart()->deleteAll();
                header('Location: ' . Up::site_path() . '/Payment/show');
                exit;
            }
            else {
                Up::error()->set('general', 'Något gick fel! Kontrollera dina inmatade uppgifter och försök igen.');
            }
        }
    
        // Om ej fel, rendrera sidan
        echo Up::view()
            ->set('content', Up::view()->render('App/View/cart.php'))
            ->render('App/View/layout.php');
    }
    
    /**
     * Lägg artikel i varukorg
     */
    public function add()
    {
        Up::cart()->add((int)$_POST['id'], (int)$_POST['count']);
        header('Location: ' . $_POST['urlref']);
        exit;
    }
    
    /**
     * Ändra artikel (antal) i varukorg
     */
    public function edit()
    {
        Up::cart()->edit((int)$_POST['id'], (int)$_POST['count']);
        header('Location: ' . $_POST['urlref']);
        exit;
    }
    
    /**
     * Ta bort artikel ur varukorg
     */
    public function delete()
    {
        Up::cart()->delete((int)$_POST['id']);
        header('Location: ' . $_POST['urlref']);
        exit;
    }
    
    /**
     * Töm hela varukorgen
     */
    public function deleteAll()
    {
        Up::cart()->deleteAll();
        header('Location: ' . $_POST['urlref']);
        exit;
    }
}
