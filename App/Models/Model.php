<?php

namespace App\Models;

use App\Db;

abstract class Model
{
    public $id;

    public const TABLE = '';

    public static function findAll(){
        $db = new Db();
        $sql = 'SELECT * FROM '.static::TABLE;
        return $db->query(
            $sql,
            [],
            static::class);
    }
    public static function findById($id){
        $db = new Db();
        $sql = 'SELECT * FROM '.static::TABLE.' WHERE id= :id';
        $data = [':id'=>$id];
        $result = $db->query($sql,$data,static::class);
        if(isset($result[0]))
            return $result[0];
        else
            return false;
    }
        public function insert (){
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];
        foreach ($fields as $name=>$value){
            if('id'==$name) continue;
            $cols[] = $name;
            $data[':'.$name] = $value;
        }
        $sql = 'INSERT INTO '.static::TABLE.'(' . implode(',',$cols) . ') VALUES (' . implode(',',array_keys($data)) . ')';
        $db = new Db();
        $result = $db->execute($sql,$data);
        $this->id = $db->getLastId();
        return $result;
    }
    public function update(){
        $fields = get_object_vars($this);
        $data = [];
        foreach ($fields as $name=>$value){
            $data[':'.$name] = $value;
            if('id'==$name) continue;
            $str[] = $name.'=:'.$name;
        }
        $sql = 'UPDATE '. static::TABLE . ' SET '.implode(',',$str).' WHERE id=:id';
        $db = new Db();
        return $db->execute($sql,$data);
    }
    public function save(){
        if(is_null($this->id)|$this->id=="") {
            return $this->insert();
        }
        else {
            return $this->update();
        }
    }
    public function delete(){
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $data = [':id'=>$this->id];
        $db = new Db();
        return $db->execute($sql,$data);
    }
}