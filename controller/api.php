<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 03.08.2017
 * Time: 22:34
 */

//namespace controller;

class api
{
    public $db;

    public function __construct($params=null)
    {
        require (__DIR__ . '/../model/db.php');
        $this->db = model\DB::getInstance();
        if(!is_null($params)) {
            method_exists($this,$params['method']) ? $this->$params['method']() : $this->index();
        } else {
            $this->index();
        }
    }

    public function index() {
        echo "Уточните метод";
    }

    public function user() {
        echo "user";
    }

    public function table() {

    }
}