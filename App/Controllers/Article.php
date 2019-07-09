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
                echo $this->view->message;
                //echo $this->view->render(__DIR__.'/../../templates/result.php');
            }else{
                $this->view->message = 'Неудачно';
                echo $this->view->message;
                //echo $this->view->render(__DIR__.'/../../templates/result.php');
            }
        }else{
            $this->view->message = 'Неудачно';
            echo $this->view->message;
            //echo $this->view->render(__DIR__.'/../../templates/result.php');
        }
    }
    function save(){
    }
    function modify($id){
        //var_dump($_POST);
        //var_dump($_FILES);
        $article = \App\Models\Article::findById($id);
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->image = self::generateRandomString().'.jpg';
        if (move_uploaded_file($_FILES['image']['tmp_name'], "images/".$article->image))
        {
            $result = $article->save();
            if($result){
                $this->view->message = 'Удачно';
                echo $this->view->message;
                //echo $this->view->render(__DIR__.'/../../templates/result.php');
            }else{
                $this->view->message = 'Неудачно';
                echo $this->view->message;
                //echo $this->view->render(__DIR__.'/../../templates/result.php');
            }
        }else{
            $this->view->message = 'Неудачно';
            echo $this->view->message;
            //echo $this->view->render(__DIR__.'/../../templates/result.php');
        }

    }
    function delete($id){
        $article = \App\Models\Article::findById($id);
        if ($article->delete())
            echo "Удачно";
        else
            echo "Неудачно";
    }
    function show ($id){
        $article = \App\Models\Article::findById($id);
        echo json_encode($article);
    }
    function all(){
        $articles = \App\Models\Article::findAll();
        foreach($articles as $article)
        {
            echo '<article class="container">';
            echo '<div class="row">';
            echo '<button type="button" class="btn btn-warning btn-modify" onclick="modify(event);">Изменить</button>';
            echo '<button type="button" class="btn btn-danger btn-del" onclick="del('."$article->id".');">Удалить</button>';
            echo '</div>';
            echo '<div class="row">';
            echo '<h2>'.$article->id.'.'.$article->title.'</h2>';
            echo '</div>';
            echo '<div class="row">';
            echo '<div class="col-sm-9">';
            echo '<p>'.$article->text.'</p>';
            echo '<p>'.$article->datetime.'</p>';
            echo '</div>';
            echo '<div class="col-sm-3">';
            echo '<img src="/images/'.$article->image.'" class="img-fluid">';
            echo '</div>';
            echo '</div>';
            echo '<input type="hidden" name="id" value='.$article->id.'>';
            echo '</article>';
            echo '<hr>';
        }
        //echo json_encode($articles);
    }
}