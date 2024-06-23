<?php
defined('BASEPATH') OR die('No direct script access allowed');
/** 
 * Helper Session
 * 
 * Dibuat untuk mempermudah pemanggilan session
 * 
 * @author Muhammad Ridwan Na'im
 * @since 2024
 * @package SIMDC
 * @version 1.0
*/
function initSession() {
    $CI =& get_instance();
    return $CI->session;
}

if(!function_exists('sessionSet')) 
{
    function sessionSet(array $param) {
        initSession()->set_userdata($param);
    }
}

if(!function_exists('sessionGet')) 
{
    function sessionGet(string $index) {
        return initSession()->userdata($index);
    }
}