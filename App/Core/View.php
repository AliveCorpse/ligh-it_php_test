<?php

namespace App\Core;

class View
{
    protected $data = [];

    public function render($template)
    {
        ob_start();

        foreach ($this->data as $name => $value) {
            $$name = $value;
        }

        include __DIR__ . '/../templates/' . $template;
        $content = ob_get_contents();
        ob_clean();

        return $content;
    }
}
