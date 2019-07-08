<?php

namespace App\Controllers;


class Article extends Controller
{
    public $model_name = "\App\Models\Article";
    public $template = '/../../templates/article.php';

    function add(){
        $article = new \App\Models\Article();
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->image = self::generateRandomString().'.jpg';
        if (move_uploaded_file($_FILES['image']['tmp_name'], "images/".$article->image))
        {
            $result = $article->save();
            if($result){
                $this->view->message = 'Удачно';
                echo $this->view->render(__DIR__.'/../../templates/result.php');
            }else{
                $this->view->message = 'Неудачно';
                echo $this->view->render(__DIR__.'/../../templates/result.php');
            }
        }else{
            $this->view->message = 'Неудачно';
            echo $this->view->render(__DIR__.'/../../templates/result.php');
        }
    }
    function save(){
    }
    function modify($id){
    }
    function delete($id){
    }
    function show ($id){
        echo "TEST";
    }
}