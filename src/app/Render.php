<?php

namespace Login\app;

class Render
{

    private string $path = "../views/";


    public function load(string $file, mixed $params): string|false
    {
        //set keys of the array as variables:
        extract($params);
        ob_start();
        require($this->path . $file . ".php");
        return ob_get_clean();
    }
}
