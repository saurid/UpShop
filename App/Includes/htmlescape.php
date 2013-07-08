<?php
/**
 * @author Ola Waljefors
 * @version 2013.1.1
 * @package UpShop
 * @link http://www.phpportalen.net/viewtopic.php?t=117004
 */

/** 
 * HTML-säkra strängar med utskrift
 * @param string
 */
function _e($string)
{
    echo nl2br(htmlspecialchars($string, ENT_QUOTES));
}

/** 
 * HTML-säkra strängar med retur
 * @param string
 * @return string
 */
function _er($string)
{
    return nl2br(htmlspecialchars($string, ENT_QUOTES));
}
