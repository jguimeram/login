<?php

namespace Login\app;

use RuntimeException;

class Render
{

    private string $path = "../views/";

    public function load(string $file, array $params = []): string|false
    {
        //set keys of the array as variables if params are provided:
        if (!empty($params)) {
            extract($params);
        }
        ob_start();
        require($this->path . $file . ".php");
        $output = ob_get_clean();
        if ($output === false) {
            throw new RuntimeException('Failed to fetch output from view');
        }
        return $output;
    }
}
