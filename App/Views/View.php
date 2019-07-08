<?php

namespace App\Views;
/**
 * Class View
 * @package App\Views
 *
 * @property array $articles
 */

class View
{
    protected $data = [];

    public function render($template)
    {
        ob_start();
        include __DIR__ . '/../../templates/template.php';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }
}