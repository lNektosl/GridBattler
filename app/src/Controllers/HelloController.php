<?php

namespace App\Controllers;

class HelloController
{


    public function test(string $name){
        // normally we don't want to echo from a controller method directly
        // but rather load a view template
        
        echo "Hi, {$name}!";
    }

        public function greet($vars = [])
    {
        $name = $vars['name'] ?? 'World';
        $callback = [$this, 'test'];
        $callback($name);
    }
}
