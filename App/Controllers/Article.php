<?php

namespace App\Controllers;


class Article extends Controller
{
    public $model_name = "\App\Models\Article";
    public $template = '/../../templates/item';

    function add(){
        $points = Point::findAll();
        $this->view->points = $points;
        $groups = Group::makeList();
        $this->view->groups = $groups;
        $types = Item_type::findAll();
        $this->view->types = $types;

        echo $this->view->render(__DIR__ . '/../../templates/item_add.php');
    }
    function save(){
        $item = new \App\Models\Item();
        $item->id = $_POST['id'];
        $item->name = $_POST['name'];
        $item->point_id = $_POST['point_id'];
        $item->type_id = $_POST['type_id'];
        $item->group_id = $_POST['group_id'];
        $result = $item->save();
        if($result){
            $this->view->message = 'Удачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }else{
            $this->view->message = 'Неудачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }
    }
    function modify($id){
        $this->view->item = \App\Models\Item::findById($id);
        $points = Point::findAll();
        $this->view->points = $points;
        $groups = Group::makeList();
        $this->view->groups = $groups;
        $types = Item_type::findAll();
        $this->view->types = $types;

        echo $this->view->render(__DIR__ . '/../../templates/item_modify.php');
    }
    function delete($id){
        $item = \App\Models\Item::findById($id);
        $result = $item->delete();
        if($result){
            $this->view->message = 'Удачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }else{
            $this->view->message = 'Неудачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }
    }
}