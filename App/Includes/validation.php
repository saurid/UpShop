<?php
/**
 * @package UpShop
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpShop
 * @link    http://www.phpportalen.net/viewtopic.php?t=117004
 */

/** 
 * Validera e-postadress
 * @param mixed
 * @return boolean
 */
function isValidEmail($string)
{
    return preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $string);
}

/** 
 * Validera telefonnummer
 * @param mixed
 * @return boolean
 */
function isPhoneNo($string)
{
    return preg_match("/^[0-9- +()]{7,20}+$/", $string);
}

/** 
 * Validera längd på sträng
 * @param mixed
 * @return boolean
 */
function isLength($string, $length)
{
    if (strlen($string) < $length) {
        return false;
    } else {
        return true;
    }
}

/** 
 * Validera siffror
 * @param mixed
 * @return boolean
 */
function isNumeric($string)
{
    $string = str_replace(',', '.', $string);
    return is_numeric($string);
}

/** 
 * Validera heltal
 * @param mixed
 * @return boolean
 */
function isInteger($string)
{
    if (trim(intval($string)) == $string) {
        return true;
    } else {
        return false;
    }
}
