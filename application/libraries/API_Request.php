<?php
defined('BASEPATH') OR die('No direct script access allowed');
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
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

    public function setupRequest(string $method, string $endpoint, array $request) : array
    {
        try {
            $res = $this->client->$method($endpoint, $request);
            $result = array_merge(['code' => $res->getStatusCode()], json_decode($res->getBody()->getContents(),true));

        } catch (ClientException $e) {
            $result = array('code' => $e->getResponse()->getStatusCode(), 'message' => 'Client error: ' . $e->getMessage());
        } catch (ServerException $e) {
            $result = array('code' => $e->getResponse()->getStatusCode(), 'message' => 'Server error: ' . $e->getMessage());
        } catch (ConnectException $e) {
            $result = array('code' => 504, 'message' => 'Connection error: ' . $e->getMessage());
        } catch (RequestException $e) {
            $result = array('code' => 504, 'message' => 'Request error: ' . $e->getMessage());
        } catch (\Exception $e) {
            $result = array('code' => 504, 'message' => 'General error: ' . $e->getMessage());
        }

        return $result;
    }

    public function get(string $endpoint) :array
    {
        return $this->setupRequest('get', $endpoint, [
            'auth' => $this->auth
        ]);
    }

    public function post(string $endpoint, array $data) :array
    {
        return $this->setupRequest('post', $endpoint, [
            'auth' => $this->auth,
            'form_params' => $data
        ]);
    }

    public function put(string $endpoint, array $data) :array
    {
        return $this->setupRequest('put', $endpoint, [
            'auth' => $this->auth,
            'form_params' => $data
        ]);
    }

    public function delete(string $endpoint) :array
    {
        return $this->setupRequest('delete', $endpoint, [
            'auth' => $this->auth
        ]);
    }
}