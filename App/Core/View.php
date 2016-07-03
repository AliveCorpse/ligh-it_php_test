<?php

namespace App\Core;

class View
{
    protected $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

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

    public function display($template)
    {
        echo $this->render($template);
    }
}
