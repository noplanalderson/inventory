<?php
defined('BASEPATH') OR die('No direct script access allowed');
/** 
 * Helper API Request
 * 
 * Dibuat untuk mempermudah operasi API
 * Cukup dengan memanggil fungsi sesuai method request yang dibutuhkan
 * sehingga tidak perlu memanggil library API_Request
 * 
 * @author Muhammad Ridwan Na'im
 * @since 2024
 * @package SIMDC
 * @version 1.0
*/
function guzzleInit() {
    $CI =& get_instance();
    $CI->load->library('api_request');
    return $CI->api_request;
}

if(!function_exists('apiGet')) 
{
    function apiGet($endpoint) {
        return guzzleInit()->get($endpoint);
    }
}

if(!function_exists('apiPost')) 
{
    function apiPost($endpoint, $data) {
        return guzzleInit()->post($endpoint, $data);
    }
}

if(!function_exists('apiPut')) 
{
    function apiPut($endpoint, $data) {
        return guzzleInit()->put($endpoint, $data);
    }
}

if(!function_exists('apiDelete')) 
{
    function apiDelete($endpoint) {
        return guzzleInit()->delete($endpoint);
    }
}