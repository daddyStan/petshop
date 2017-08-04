<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 03.08.2017
 * Time: 22:34
 */

require "root.php";

class api extends root
{
    public $db;
    protected $availibleTables;

    public function __construct($params=null)
    {
        require (__DIR__ . '/../model/db.php');
        $this->availibleTables = [
            'session',
            'users'
        ];
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

    /**
     * Тестовый метод
     */
    public function user() {
        echo "user";
    }

    public function table() {
        if(isset($_GET['table']) && in_array($_GET['table'],$this->availibleTables)) {
            if(isset($_GET['id'])) {
                $q = $this->db->dbQueryArryReturn("select * from `" . $_GET['table'] . "` where `ID`='" . $_GET['id'] . "' ");
            } else {
                $q = $this->db->dbQueryArryReturn("select * from `" . $_GET['table'] . "`");
            }
        } else {
            echo 'Название таблицы - обязательный параметр, убедитесь, что у Вас есть доступ к таблице';
        }
        if($q) {
            $this->status = 'ok';
            $this->data = $q;
            $this->message='';
        } else {
            $this->status = 'error';
            $this->data = [];
            $this->message = 'Произошла ошибка на уровне взаимодействия с базой данных, обратитесь к администратору';
        }

        $this->renderJson();
    }

    public function SessionSubscribe() {
        if(isset($_GET['sessionId']) && isset($_GET['userId'])) {
            $q = $this->db->dbQueryArryReturn("select * from `" . $_GET['table'] . "` where `ID`='" . $_GET['id'] . "' ");
        } else {
            $this->status = 'error';
            $this->data = [];
            $this->message = 'Произошла ошибка на уровне взаимодействия с базой данных, обратитесь к администратору';
        }

        $this->renderJson();
    }
}