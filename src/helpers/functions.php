<?php

/**
 * debug
 *
 * @param  mixed $args
 * @param  bool $die if true, executes die() and stops execution
 * @return void
 */
function debug(mixed $args, bool $die = false)
{
    echo "<pre>";
    var_dump($args);
    echo "</pre>";

    if ($die) die();
}
