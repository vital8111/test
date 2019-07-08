<?php

namespace App\Controllers;


use App\Views\View;

abstract class Controller
{
    public $model_name = "\App\Models\Model";
    public $template = "";

    public function __construct()
    {
        $this->view = new View();
    }

    protected function access() : bool{
        return true;
    }

    public function __invoke($param=[]){
        if ($this->access()){
            $this->handle($param);
        }else{
            die('Нет доступа');
        }
    }

    protected function handle($params = [])
    {
        if(isset($params['action'])) {
            switch ($params['action']) {
                case "add":
                    $this->add();
                    break;
                case "save":
                    $this->save();
                    break;
                case "modify":
                    $this->modify($params['id']);
                    break;
                case "delete":
                    $this->delete($params['id']);
                    break;
                case "show":
                    $this->show($params['id']);
                    break;
                default:
                    $this->index();
                    break;
            }
        }else{
            $this->index();
        }
    }

    function index(){
        $this->view->things = $this->model_name::findAll();
        echo $this->view->render(__DIR__.$this->template.'_index.php');
    }
    function show($id){
        $this->view->thing = $this->model_name::findById($id);
        echo $this->view->render(__DIR__.$this->template.'_show.php');
    }
    abstract function add();
    abstract function save();
    abstract function modify($id);
    abstract function delete($id);
}