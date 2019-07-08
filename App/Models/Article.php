<?php

namespace App\Models;


use App\Db;

class Article extends Model
{
    public const TABLE = 'articles';

    public $title;
    public $text;
    public $datetime;
    public $image;

    public function __construct()
    {

    }
}