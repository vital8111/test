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
                case "all":
                    $this->all();
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
    abstract function add();
    abstract function save();
    abstract function modify($id);
    abstract function delete($id);
    abstract function show($id);
    abstract function all();



    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}