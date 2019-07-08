<?php

namespace App;


class Db
{
    protected  $dbh;
    public function __construct()
    {
        $config = Config::getInstance()->getConfig()['db'];
        $this->dbh = new \PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
            $config['user'],
            $config['pass'],
            array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
    public function query($sql,$data=[], $class){

        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        $data = $sth->fetchAll(\PDO::FETCH_CLASS,$class);
        return $data;
    }

    public function execute($sql,$data=[]){
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }
    public function getLastId(){
        return $this->dbh->lastInsertId();
    }
}

/*$pdo = new PDO(
    'mysql:host=hostname;dbname=defaultDbName',
    'username',
    'password',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);*/