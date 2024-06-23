<?php
defined('BASEPATH') OR die('No direct script access allowed');
/** 
 * Class Access_control
 * 
 * Library untuk melakukan kontrol terhadap sesi aktif dan mencegah akses tidak sah
 * 
 * @author Muhammad Ridwan Na'im
 * @since 2024
 * @package SIMDC
 * @version 1.0
*/
class Access_control {

    protected $uid;

    protected $gid;

    public function __construct() {
        $this->uid = sessionGet('uid');
        $this->gid = sessionGet('gid');
    }

    public function isLogin() : bool
    {
        return (bool) empty($this->uid && $this->gid);
    }

    public function checkAccess() : bool
    {
        return (bool) $this->isLogin() && $this->gid === 'admin';
    }
}