<?php

use function GuzzleHttp\json_decode;

defined('BASEPATH') OR die('No direct script access allowed');
/** 
 * Class API_Request
 * 
 * Library untuk melakukan request ke API Server
 * Mendukung method berikut
 * - POST
 * - GET
 * - PUT
 * - DELETE
 * 
 * @author Muhammad Ridwan Na'im
 * @since 2024
 * @package SIMDC
 * @version 1.0
*/
class API_Request {
    
    protected object $client;

    protected array $auth;

    public function __construct()
    {
        $this->client   = new \GuzzleHttp\Client(['base_uri' => API_URL]);
        $this->auth     = array(API_USER, API_PASSWD);
    }

    public function get(string $endpoint) :array
    {
        $res = $this->client->get($endpoint, [
            'auth' => $this->auth
        ]);

        return array_merge(['code' => $res->getStatusCode()], json_decode($res->getBody()->getContents(),true));
    }

    public function post(string $endpoint, array $data) :array
    {
        $res = $this->client->post($endpoint, [
            'auth' => $this->auth,
            'form_params' => $data
        ]);

        return array_merge(['code' => $res->getStatusCode()], json_decode($res->getBody()->getContents(),true));
    }

    public function put(string $endpoint, array $data) :array
    {
        $res = $this->client->put($endpoint, [
            'auth' => $this->auth,
            'form_params' => $data
        ]);

        return array_merge(['code' => $res->getStatusCode()], json_decode($res->getBody()->getContents(),true));
    }

    public function delete(string $endpoint) :array
    {
        $res = $this->client->delete($endpoint, [
            'auth' => $this->auth
        ]);

        return array_merge(['code' => $res->getStatusCode()], json_decode($res->getBody()->getContents(),true));
    }
}