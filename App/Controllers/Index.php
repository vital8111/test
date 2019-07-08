<?php

namespace App\Controllers;


class Index extends Controller
{
    public function handle ($param=[]){
        $articles = \App\Models\Article::findAll();
        $this->view->articles = $articles;
        echo $this->view->render(__DIR__.'/../../templates/index.php');
    }

    function add()
    {
        // TODO: Implement add() method.
    }

    function save()
    {
        // TODO: Implement save() method.
    }

    function modify($id)
    {
        // TODO: Implement modify() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }
}