<?php

namespace App;


class Config
{

    private $config =[
        'db' =>[
            'host'=>'localhost',
            'dbname'=>'test',
            'user'=>'root',
            'pass'=>''
        ]
    ];
    static private $_instance;

    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public static function getInstance()
    {
        if (!self::$_instance)
            self::$_instance = new self;
        return self::$_instance;
    }
    public function getConfig(){
        return $this->config;
    }
}