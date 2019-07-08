<?php

namespace App\Controllers;


class Article extends Controller
{
    public $model_name = "\App\Models\Article";
    public $template = '/../../templates/article.php';

    function add(){
        echo $this->view->render(__DIR__ . '/../../templates/item_add.php');
    }
    function save(){
        $article = new \App\Models\Article();
        $article->id = $_POST['id'];
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->image = $_POST['image'];
        $result = $article->save();
        if($result){
            $this->view->message = 'Удачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }else{
            $this->view->message = 'Неудачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }
    }
    function modify($id){
        $this->view->item = \App\Models\Article::findById($id);
        echo $this->view->render(__DIR__ . '/../../templates/item_modify.php');
    }
    function delete($id){
        $article = \App\Models\Article::findById($id);
        $result = $article->delete();
        if($result){
            $this->view->message = 'Удачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }else{
            $this->view->message = 'Неудачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }
    }
}